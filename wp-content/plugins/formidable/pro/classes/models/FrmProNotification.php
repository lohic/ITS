<?php
class FrmProNotification{

    public static function add_attachments($attachments, $form, $args) {
        $defaults = array(
            'entry'     => false,
            'email_key' => '',
        );
        $args = wp_parse_args($args, $defaults);
        $entry = $args['entry'];

        // Used for getting the file ids for sub entries
        $atts = array(
            'entry'         => $entry,  'default_email' => false,
            'include_blank' => false,   'id'            => $entry->id,
            'plain_text'    => true,    'format'        => 'array',
            'filter'        => false,
        );

        $file_fields = FrmField::get_all_types_in_form($form->id, 'file', '', 'include');

        foreach ( $file_fields as $file_field ) {
            $file_options = $file_field->field_options;

            //Only go through code if file is supposed to be attached to email
            if ( ! isset($file_options['attach']) || ! $file_options['attach'] ) {
                continue;
            }

            $file_ids = array();
            //Get attachment ID for uploaded files
            if ( isset( $entry->metas[ $file_field->id ] ) ) {
                $file_ids = $entry->metas[ $file_field->id ];
            } else if ( $file_field->form_id != $form->id ) {
                // this is in a repeating or embedded field
                $file_ids = self::fill_files_from_children( $atts, $file_field );
            } else if ( isset($file_field->field_options['post_field']) && !empty($file_field->field_options['post_field']) ) {
                //get value from linked post
                $file_ids = FrmProEntryMetaHelper::get_post_or_meta_value( $entry, $file_field );
            }

            //Only proceed if there is actually an uploaded file
            if ( empty($file_ids) ) {
                continue;
            }

            // Get each file in this field
            foreach ( (array) $file_ids as $file_id ) {
                if ( empty($file_id) ) {
                    continue;
                }

				// For multi-file upload fields in repeating sections
				if ( is_array( $file_id ) ) {
					foreach ( $file_id as $f_id ) {
						// Add attachments
						self::add_to_attachments( $attachments, $f_id );
					}
					continue;
				}

				// Add the attachments now
				self::add_to_attachments( $attachments, $file_id );
            }
        }

        return $attachments;
    }

	/**
	 * This is a file field in a repeating or embedded field
	 */
	private static function fill_files_from_children( $atts, $file_field ) {
        $values = $file_ids = array();
        FrmEntryFormat::fill_entry_values( $atts, $file_field, $values );

		$file_options = $file_field->field_options;
		$parent_field = isset( $file_options['in_section'] ) ? $file_options['in_section'] : '';
		$has_subentries = isset( $values[ $parent_field ] ) && isset( $values[ $parent_field ]['entries'] ) && is_array( $values[ $parent_field ]['entries'] );

		if ( $has_subentries ) {
			foreach ( $values[ $parent_field ]['entries'] as $entry ) {
                if ( isset( $entry[ $file_field->id ] ) ) {
                    $file_ids[] = $entry[ $file_field->id ]['val'];
                }
			}
		}

		return $file_ids;
	}

	/**
	* Add to email attachments
	*
	* @since 2.0
	* Called by add_attachments in FrmProNotification
	*/
	private static function add_to_attachments( &$attachments, $file_id ) {
		if ( empty( $file_id ) ) {
			return;
		}
		// Get the file
		$file = get_post_meta( $file_id, '_wp_attached_file', true);
		if ( $file ) {
			$uploads = wp_upload_dir();
			$attachments[] = $uploads['basedir'] . '/'. $file;
		}
	}

	/**
	 * @deprecated 2.03.04
	 */
    public static function entry_created($entry_id, $form_id) {
	    $new_function = 'FrmFormActionsController::trigger_actions("create", ' . $form_id . ', ' . $entry_id . ', "email")';
	    _deprecated_function( __FUNCTION__, '2.03.04', $new_function );
	    FrmFormActionsController::trigger_actions( 'create', $form_id, $entry_id, 'email' );
    }
}

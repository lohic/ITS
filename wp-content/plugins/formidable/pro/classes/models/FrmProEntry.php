<?php
class FrmProEntry{
    
    function frmpro_editing($continue, $form_id, $action='new'){
        _deprecated_function( __FUNCTION__, '1.07.05', 'FrmProEntriesController::maybe_editing');
        return FrmProEntriesController::maybe_editing($continue, $form_id, $action);
    }
    
    function user_can_edit($entry, $form=false){
        _deprecated_function( __FUNCTION__, '1.07.05', 'FrmProEntriesHelper::user_can_edit' );
        return FrmProEntriesHelper::user_can_edit($entry, $form);
    }
    
    function user_can_edit_check($entry, $form){
        _deprecated_function( __FUNCTION__, '1.07.05', 'FrmProEntriesHelper::user_can_edit_check' );
        return FrmProEntriesHelper::user_can_edit_check($entry, $form);
    }
    
    function user_can_delete($entry, $form = false) {
        _deprecated_function( __FUNCTION__, '1.07.05', 'FrmProEntriesHelper::user_can_delete' );
        return FrmProEntriesHelper::user_can_delete($entry, $form);
    }
    
    function get_tagged_entries($term_ids, $args = array()){
        return get_objects_in_term( $term_ids, 'frm_tag', $args );
    }
    
    function get_entry_tags($entry_ids, $args = array()){
        return wp_get_object_terms( $entry_ids, 'frm_tag', $args );
    }
    
    function get_related_entries($entry_id){
        $term_ids = FrmProEntry::get_entry_tags($entry_id, array('fields' => 'ids'));
        $entry_ids = FrmProEntry::get_tagged_entries($term_ids);
        foreach ($entry_ids as $key => $id){
            if ($id == $entry_id)
                unset($entry_ids[$key]);
        }
        return $entry_ids;
    }

    function pre_validate($errors, $values){
        global $frm_entry_meta, $frm_entry, $frmdb, $frmpro_settings, $frm_vars;
        
        $user_ID = get_current_user_id();
        $params = (isset($frm_vars['form_params']) && is_array($frm_vars['form_params']) && isset($frm_vars['form_params'][$values['form_id']])) ? $frm_vars['form_params'][$values['form_id']] : FrmEntriesController::get_params($values['form_id']);
        
        if($params['action'] != 'create'){
            if(FrmProFormsHelper::going_to_prev($values['form_id'])){
                add_filter('frm_continue_to_create', '__return_false');
                $errors = array();
            }else if(FrmProFormsHelper::saving_draft($values['form_id'])){
                //$errors = array();
            }
            return $errors;
        }
        
        $frm_form = new FrmForm();
        $form = $frm_form->getOne($values['form_id']);
        $form_options = maybe_unserialize($form->options);
        
        $can_submit = true;
        if (isset($form_options['single_entry']) and $form_options['single_entry']){
            if ($form_options['single_entry_type'] == 'cookie' and isset($_COOKIE['frm_form'. $form->id . '_' . COOKIEHASH])){
                $can_submit = false;
            }else if ($form_options['single_entry_type'] == 'ip'){
                $prev_entry = $frm_entry->getAll(array('it.ip' => $_SERVER['REMOTE_ADDR']), '', 1);
                if ($prev_entry)
                    $can_submit = false;
            }else if (($form_options['single_entry_type'] == 'user' or (isset($form->options['save_draft']) and $form->options['save_draft'] == 1)) and !$form->editable){
                if($user_ID){
                    $args = array('user_id' => $user_ID, 'form_id' => $form->id);
                    if($form_options['single_entry_type'] != 'user')
                        $args['is_draft'] = 1;
                    $meta = $frmdb->get_var($frmdb->entries, $args);
                    unset($args);
                }
                
                if (isset($meta) and $meta)
                    $can_submit = false;
            }
            
            if (!$can_submit){
                $k = is_numeric($form_options['single_entry_type']) ? 'field'. $form_options['single_entry_type'] : 'single_entry';
                $errors[$k] = $frmpro_settings->already_submitted;
                add_filter('frm_continue_to_create', '__return_false');
                return $errors;
            }
        }
        unset($can_submit);
        
        if ((($_POST and isset($_POST['frm_page_order_'. $form->id])) or FrmProFormsHelper::going_to_prev($form->id)) and !FrmProFormsHelper::saving_draft($form->id)){
            add_filter('frm_continue_to_create', '__return_false');
        }else if ($form->editable and isset($form_options['single_entry']) and $form_options['single_entry'] and $form_options['single_entry_type'] == 'user' and $user_ID and (!is_admin() or defined('DOING_AJAX'))){
            $meta = $frmdb->get_var($frmdb->entries, array('user_id' => $user_ID, 'form_id' => $form->id));
            
            if($meta){
                $errors['single_entry'] = $frmpro_settings->already_submitted;
                add_filter('frm_continue_to_create', '__return_false');
            }
        }
        
        if(FrmProFormsHelper::going_to_prev($values['form_id']))
            $errors = array();
        
        return $errors;
    }
        
    function validate($params, $fields, $form, $title, $description){
        global $frm_entry, $frm_settings, $frm_vars;
        
        if ((($_POST and isset($_POST['frm_page_order_'. $form->id])) or FrmProFormsHelper::going_to_prev($form->id)) and !FrmProFormsHelper::saving_draft($form->id)){
            $errors = '';
            $fields = FrmFieldsHelper::get_form_fields($form->id);
            $form_name = $form->name;
            $submit = isset($form->options['submit_value']) ? $form->options['submit_value'] : $frm_settings->submit_value;
            $values = $fields ? FrmEntriesHelper::setup_new_vars($fields, $form) : array();
            require(FrmAppHelper::plugin_path() .'/classes/views/frm-entries/new.php');
            add_filter('frm_continue_to_create', '__return_false');
        }else if ($form->editable and isset($form->options['single_entry']) and $form->options['single_entry'] and $form->options['single_entry_type'] == 'user'){
            
            $user_ID = get_current_user_id();
            if($user_ID){
                $entry = $frm_entry->getAll(array('it.user_id' => $user_ID, 'it.form_id' => $form->id), '', 1, true);
                if($entry)
                    $entry = reset($entry);
            }else{
                $entry = false;
            }
            
            if ($entry and !empty($entry) and (!isset($frm_vars['created_entries'][$form->id]) or !isset($frm_vars['created_entries'][$form->id]['entry_id']) or $entry->id != $frm_vars['created_entries'][$form->id]['entry_id'])){
                FrmProEntriesController::show_responses($entry, $fields, $form, $title, $description);
            }else{
                $record = $frm_vars['created_entries'][$form->id]['entry_id'];
                $saved_message = isset($form->options['success_msg']) ? $form->options['success_msg'] : $frm_settings->success_msg;
                if(FrmProFormsHelper::saving_draft($form->id)){
                    global $frmpro_settings;
                    $saved_message = isset($form->options['draft_msg']) ? $form->options['draft_msg'] : $frmpro_settings->draft_msg;
                }
                $saved_message = apply_filters('frm_content', $saved_message, $form, ($record ? $record : false));
                $message = wpautop(do_shortcode($record ? $saved_message : $frm_settings->failed_msg));
                $message = '<div class="frm_message" id="message">'. $message .'</div>';
                
                FrmProEntriesController::show_responses($record, $fields, $form, $title, $description, $message, '', $form->options);
            }
            add_filter('frm_continue_to_create', '__return_false');
        }else if(FrmProFormsHelper::saving_draft($form->id)){
            global $frmpro_settings;
            
            $record = (isset($frm_vars['created_entries']) and isset($frm_vars['created_entries'][$form->id])) ? $frm_vars['created_entries'][$form->id]['entry_id'] : 0;
            if($record){
                $saved_message = isset($form->options['draft_msg']) ? $form->options['draft_msg'] : $frmpro_settings->draft_msg;
                $saved_message = apply_filters('frm_content', $saved_message, $form, $record);
                $message = '<div class="frm_message" id="message">'. wpautop(do_shortcode($saved_message)) .'</div>';

                FrmProEntriesController::show_responses($record, $fields, $form, $title, $description, $message, '', $form->options);
                add_filter('frm_continue_to_create', '__return_false');
            }
        }
    }
    
    function set_cookie($entry_id, $form_id){
        _deprecated_function( __FUNCTION__, '1.07.05', 'FrmProEntriesController::maybe_set_cookie');
        return FrmProEntriesController::maybe_set_cookie($entry_id, $form_id);
    }
    
    function update_post($entry_id, $form_id){
        if ( !isset($_POST['frm_wp_post']) ) {
            return;
        }
        
        $post_id = FrmProEntriesHelper::get_field('post_id', $entry_id);
        if ( $post_id ) {
            $post = get_post($post_id, ARRAY_A);
            unset($post['post_content']);
            $this->insert_post($entry_id, $post, true, $form_id);
        } else {
            $this->create_post($entry_id, $form_id);
        }
    }
    
    function create_post($entry_id, $form_id){
        if ( !isset($_POST['frm_wp_post']) ) {
            return;
        }
        
        global $wpdb, $frmdb, $frmpro_display;
        $post_id = NULL;
        
        $post = array(
            'post_type' => FrmProFormsHelper::post_type($form_id),
        );

        if ( isset($_POST['frm_user_id']) && is_numeric($_POST['frm_user_id']) ) {
            $post['post_author'] = $_POST['frm_user_id'];
        }
            
        $status = false;
        foreach ( $_POST['frm_wp_post'] as $post_data => $value ) {
            if ( $status ) {
                continue;
            }
            
            $post_data = explode('=', $post_data);
                
            if ( $post_data[1] == 'post_status' ) {
                $status = true;
            }
        }
        
        if ( !$status ) {
            $form_options = $frmdb->get_var($wpdb->prefix .'frm_forms', array('id' => $form_id), 'options');
            $form_options = maybe_unserialize($form_options);
            if ( isset($form_options['post_status']) && $form_options['post_status'] == 'publish' ) {
                $post['post_status'] = 'publish';
            }
        }
        
        //check for auto view and set frm_display_id
        $display = $frmpro_display->get_auto_custom_display(compact('form_id', 'entry_id'));
        if ( $display ) {
            $_POST['frm_wp_post_custom']['=frm_display_id'] = $display->ID;
        }
        
        $post_id = $this->insert_post($entry_id, $post, false, $form_id);
    }
    
    function insert_post($entry_id, $post, $editing=false, $form_id=false){
        $field_ids = $new_post = array();
        
        foreach($_POST['frm_wp_post'] as $post_data => $value){
            $post_data = explode('=', $post_data);
            $field_ids[] = (int) $post_data[0];
            
            if(isset($new_post[$post_data[1]]))
                $value = array_merge((array)$value, (array)$new_post[$post_data[1]]);
            
            $post[$post_data[1]] = $new_post[$post_data[1]] = $value;
            //delete the entry meta below so it won't be stored twice
        }
        
        //if empty post content and auto display, then save compiled post content
        $display_id = ($editing) ? get_post_meta($post['ID'], 'frm_display_id', true) : (isset($_POST['frm_wp_post_custom']['=frm_display_id']) ? $_POST['frm_wp_post_custom']['=frm_display_id'] : 0);
        
        if(!isset($post['post_content']) and $display_id){
            $dyn_content = get_post_meta($display_id, 'frm_dyncontent', true);
            $post['post_content'] = apply_filters('frm_content', $dyn_content, $form_id, $entry_id);
        }
        
        $post_ID = wp_insert_post( $post );
    	
    	if ( is_wp_error( $post_ID ) or empty($post_ID))
    	    return;
    	
    	// Add taxonomies after save in case user doesn't have permissions
    	if(isset($_POST['frm_tax_input']) ){
            foreach ($_POST['frm_tax_input'] as $taxonomy => $tags ) {
                if ( is_taxonomy_hierarchical($taxonomy) )
    				$tags = array_keys($tags);
    			
                wp_set_post_terms( $post_ID, $tags, $taxonomy );
    			
    			unset($taxonomy);
    			unset($tags);
    		}
        }
    	
    	global $frm_entry_meta, $user_ID, $frm_vars, $wpdb;

    	$exclude_attached = array();
    	if(isset($frm_vars['media_id']) and !empty($frm_vars['media_id'])){
    	    global $wpdb;
    	    //link the uploads to the post
    	    foreach((array)$frm_vars['media_id'] as $media_id){
    	        $exclude_attached = array_merge($exclude_attached, (array)$media_id);
    	        
    	        if(is_array($media_id)){
    	            $attach_string = implode( ',', array_filter($media_id) );
    	            if ( !empty($attach_string) ){
    				    $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_parent = %d WHERE post_type = %s AND ID IN ( $attach_string )", $post_ID, 'attachment' ) );
    				
    	                foreach($media_id as $m){
    	                    clean_attachment_cache( $m );
    	                    unset($m);
    	                }
    	            }
    	        }else{
    	            $wpdb->update( $wpdb->posts, array('post_parent' => $post_ID), array( 'ID' => $media_id, 'post_type' => 'attachment' ) );
    	            clean_attachment_cache( $media_id );
    	        }
    	    }
    	}

    	if($editing and count($_FILES) > 0){
    	    global $wpdb;
    	    $args = array( 
    	        'post_type' => 'attachment', 'numberposts' => -1, 
    	        'post_status' => null, 'post_parent' => $post_ID, 
    	        'exclude' => $exclude_attached
    	    ); 

            //unattach files from this post
            $attachments = get_posts( $args );
            foreach($attachments as $attachment)
                $wpdb->update( $wpdb->posts, array('post_parent' => null), array( 'ID' => $attachment->ID ) );
    	}

    	if(isset($_POST['frm_wp_post_custom'])){
        	foreach($_POST['frm_wp_post_custom'] as $post_data => $value){
        	    $post_data = explode('=', $post_data);
                $field_id = $post_data[0];

                if($value == '')
                    delete_post_meta($post_ID, $post_data[1]);
                else
                    update_post_meta($post_ID, $post_data[1], $value);
            	$frm_entry_meta->delete_entry_meta($entry_id, $field_id);
            	
            	unset($post_data);
            	unset($value);
            }
        }
        
        if ( !$editing ) {
            //save post_id with the entry
            if ( $wpdb->update( $wpdb->prefix .'frm_items', array('post_id' => $post_ID), array( 'id' => $entry_id ) ) ) {
                wp_cache_delete( $entry_id, 'frm_entry' );
            }
        }
        
        if(isset($dyn_content)){
            $new_content = apply_filters('frm_content', $dyn_content, $form_id, $entry_id);
            if($new_content != $post['post_content']){
                global $wpdb;
                $wpdb->update( $wpdb->posts, array( 'post_content' => $new_content ), array('ID' => $post_ID) );
            }
        }
        
        // delete entry meta so it won't be duplicated
        $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->prefix}frm_item_metas WHERE item_id=%d AND field_id", $field_id, $entry_id) . " IN (". implode(',', $field_ids) .")");
        
    	update_post_meta( $post_ID, '_edit_last', $user_ID );
    	return $post_ID;
    }
    
    function destroy_post($entry_id, $entry) {
        if ( $entry ) {
            $post_id = $entry->post_id;
        } else {
            global $wpdb;
            $post_id = $wpdb->get_var($wpdb->prepare("SELECT post_id FROM {$wpdb->prefix}frm_items WHERE id=%d", $entry_id));
        }
        
        if ( $post_id ) {
            wp_delete_post($post_id);
        }
    }
    
    function create_comment($entry_id, $form_id){
        $comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;

        $post = get_post($comment_post_ID);

        if ( empty($post->comment_status) )
        	return;

        // get_post_status() will get the parent status for attachments.
        $status = get_post_status($post);

        $status_obj = get_post_status_object($status);

        if ( !comments_open($comment_post_ID) ) {
        	do_action('comment_closed', $comment_post_ID);
        	//wp_die( __('Sorry, comments are closed for this item.') );
        	return;
        } elseif ( 'trash' == $status ) {
        	do_action('comment_on_trash', $comment_post_ID);
        	return;
        } elseif ( !$status_obj->public && !$status_obj->private ) {
        	do_action('comment_on_draft', $comment_post_ID);
        	return;
        } elseif ( post_password_required($comment_post_ID) ) {
        	do_action('comment_on_password_protected', $comment_post_ID);
        	return;
        } else {
        	do_action('pre_comment_on_post', $comment_post_ID);
        }

        $comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : '';

        // If the user is logged in
        $user_ID = get_current_user_id();
        if ( $user_ID ) {
            global $current_user;
        
        	$display_name = (!empty( $current_user->display_name )) ? $current_user->display_name : $current_user->user_login;
        	$comment_author       = $wpdb->escape($display_name);
        	$comment_author_email = ''; //get email from field
        	$comment_author_url   = $wpdb->escape($user->user_url);
        }else{
            $comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : '';
            $comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : '';
            $comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : '';
        }

        $comment_type = '';

        if (!$user_ID and get_option('require_name_email') and (6 > strlen($comment_author_email) || $comment_author == '') )
        		return;

        if ( $comment_content == '')
        	return;


        $commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'user_ID');

        $comment_id = wp_new_comment( $commentdata );
 
    }
    
    // check if entry being updated just switched draft status
    public function is_new_entry($entry) {
        _deprecated_function( __FUNCTION__, '1.07.05', 'FrmProEntriesController::is_new_entry');
        return FrmProEntriesHelper::is_new_entry($entry);
    }
    
    public function check_draft_status($values, $id){
        _deprecated_function( __FUNCTION__, '1.07.05', 'FrmProEntriesController::check_draft_status');
        return FrmProEntriesController::check_draft_status($values, $id);
    }
    
    function get_field($field='is_draft', $id){
        $entry = wp_cache_get( $id, 'frm_entry' );
        if($entry)
            return $entry->{$field};
        
        global $wpdb, $frmdb;
        return $wpdb->get_var($wpdb->prepare("SELECT $field FROM $frmdb->entries WHERE id=%d", $id));
    }

}

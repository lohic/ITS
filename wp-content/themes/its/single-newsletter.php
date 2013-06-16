<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php bloginfo('name') ?> | <?php the_title() ?></title>
<style type="text/css" media="print">
	
	
	@media print{
		.no_visible{
			display:none!important;
		}
		
		.main h1,.main h2,.main h3,.main h4,.main h5,.main h6,.main p,.main li{
		-webkit-hyphens:auto;
	}
		
		.main p{
			text-align:justify;
		}
		
		body{
			background:#FFF;
		}

        #download{
            display: none;
        }
	}

</style>
</head>

<!-- GABARIT SINGLE-NEWSLETTER.PHP -->

<body bgcolor="#CCCCCC">
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
<?php if(get_field('pdf_file')) { ?>
<table width="630" border="0" cellpadding="0" cellspacing="0" align="center" id="download" style="background:#333333;" class="no_visible">
    <tr>    
        <td><p style="font-family:Tahoma, Arial, sans-serif;color:#329687;font-size:10px;text-align:center;margin:5px 0;" class="no_visible">Pour télécharger la newsletter au format PDF, <a href="<?php the_field('pdf_file'); ?>" style="color:#FFFFFF;text-decoration:none;" target="_blank">cliquez ici</a></p></td>
    </tr>
</table>
<?php } ?>

<table width="630" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>	
    	<td><p style="font-family:Tahoma, Arial, sans-serif;color:#666666;font-size:10px;text-align:right;margin:5px 0;" class="no_visible">Si ce message ne s'affiche pas correctement, <a href="<?php the_permalink(); ?>" style="color:#329687;text-decoration:none;">cliquez ici</a></p></td>
    </tr>
</table>
<table width="630" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" align="center"> <!--header -->
	<tr>
    	<td rowspan="3" height="195" valign="top"><img src="<?php bloginfo('template_url') ?>/images/news-head_ITS.png" width="215" height="195" alt="ITS" /></td>
    	<td height="90" valign="top"><img src="<?php bloginfo('template_url') ?>/images/news-head_Institut.png" width="210" height="90" alt="Institut Tribune Socialiste" /></td>
    	<td height="90" valign="top"><img src="<?php bloginfo('template_url') ?>/images/news-head_logo.png" width="205" height="90" alt="logo ITS" /></td>
    </tr>
	<tr>
        <td height="45" colspan="2" valign="top"><p style="font-family:'Gill Sans','Gill Sans MT',Arial, sans-serif;font-style:italic;font-size:16px;margin:7px 0 0 7px;"><?php the_title() ?><?php $ladate = get_field('date'); if(!empty($ladate)) echo ' • '.$ladate; ?></p></td>
    </tr>
	<tr>
   	  <td height="60" valign="top"><img src="<?php bloginfo('template_url') ?>/images/news-head_milieu.png" width="210" height="60" alt="" /></td>
   	  <td height="60" valign="top"><img src="<?php bloginfo('template_url') ?>/images/news-head_lettre.png" width="205" height="60" alt="La lettre de l'ITS" /></td>
    </tr>
	<tr>
   	  <td>&nbsp;</td>
   	  <td>&nbsp;</td>
   	  <td>&nbsp;</td>
    </tr>
</table>
<table width="630" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" align="center"> <!--table principale pour réunir les deux colonnes -->
<tr>
		<td width="30">&nbsp;</td>
    	<td valign="top"> <!--colonne 1 -->
        	<table class="main" width="400" border="0" cellpadding="0" cellspacing="0">
            	<?php while(has_sub_field("main")): ?>
                	<tr>
                    	<td>
                	<?php if(get_row_layout() == "actualite"): // layout: Content ?>
                    		<!-- ACTUALITE -->
                    		<table border="0" cellpadding="0" cellspacing="0"> 
                            	<tr>
                                    <td><h2 style="color:#333;font-family:'Gill Sans','Gill Sans MT',Arial, sans-serif;font-weight:bold;font-size:23px;margin:0;"><?php the_sub_field("titre"); ?></h2></td>
                              	</tr>
                                <tr>
                                    <td><h3 style="color:#333;font-family:'Gill Sans','Gill Sans MT',Arial, sans-serif;font-weight:normal;font-size:15px;text-transform:uppercase;margin:5px 0;"><?php the_sub_field("sous-titre"); ?></h3></td>
                                </tr>
                                <tr>
                                	<td><h4 style="color:#F03;font-family:'Gill Sans','Gill Sans MT',Arial, sans-serif;font-weight:bold;font-size:15px;text-transform:uppercase;margin:3px 0;"><?php the_sub_field("chapeau"); ?></h4></td>
                                </tr>
                                <tr>
                                    <td>
                                    	<!-- style="font-family:Tahoma, Arial, sans-serif;color:#333;font-size:12px;margin:5px 0;padding:0;" -->
                                        <?php echo newsletter_content_format( get_sub_field("texte") ); ?>
                                    </td>
                                </tr>
                                <tr>
                                	<td><img src="<?php bloginfo('template_url') ?>/images/news-separateur1.png" width="400" height="5" style="margin:12px 0;" alt=""/></td>
                                </tr>
                            </table>
                    <?php elseif(get_row_layout() == "rubrique"):?>
                    		<!-- TITRE RUBRIQUE -->
                			<table width="100%" border="0" cellpadding="0" cellspacing="0"> 
                                <tr>
                                    <td><img src="<?php bloginfo('template_url') ?>/images/rub-gauche/news-<?php the_sub_field('titre_de_rubrique');?>.png" width="400" height="20" style="margin:15px 0;" alt="<?php the_sub_field('titre_de_rubrique');?>" /></td>
                                </tr>
                            </table>
                    <?php elseif(get_row_layout() == "sous_rubrique"):?>
                    		<!-- TITRE RUBRIQUE -->
                			<table width="100%" border="0" cellpadding="0" cellspacing="0"> 
                                <tr>
                                    <td><h2 style="color:#F03;font-family:'Gill Sans','Gill Sans MT',Arial, sans-serif;font-weight:bold;font-size:15px;text-transform:uppercase;margin:3px 0;"><?php $field = get_sub_field_object('titre_de_la_sous_rubrique');
$value = get_sub_field('titre_de_la_sous_rubrique');
$label = $field['choices'][ $value ]; echo $label;//the_sub_field('titre_de_la_sous_rubrique');?></h2></td>
                                </tr>
                            </table>
                	<?php elseif(get_row_layout() == "galerie"):?>
                    		<!--tableau bandeau images -->
                            <table border="0" cellpadding="0" cellspacing="0" width="400"> 
                           		<tr>
                            <?php
															
								$image_ref[] = get_sub_field('image_1') ;
								$image_ref[] = get_sub_field('image_2') ;
								$image_ref[] = get_sub_field('image_3') ;
								
								$qte = 0;								
								for($i = (count($image_ref)-1); $i>=0; $i--){									
									if(!empty($image_ref[$i])){
										$qte ++;
									}
								}
								
								if($qte == 1){
									echo
									'<td valign="top">'.newsletter_image( $image_ref[0], 'newsletter-3x' )->image. newsletter_image( $image_ref[0], 'newsletter-3x' )->legende. '</td>';
								}else if($qte == 2){
									echo
									'<td valign="top">'.newsletter_image( $image_ref[0], 'newsletter-1x' )->image.newsletter_image( $image_ref[0], 'newsletter-1x' )->legende.'</td>
									<td width="17">&nbsp;</td>
									<td valign="top">'.newsletter_image( $image_ref[1], 'newsletter-2x' )->image.newsletter_image( $image_ref[1], 'newsletter-2x' )->legende.'</td>';	
								}else if($qte == 3){
									echo
									'<td valign="top">'.newsletter_image( $image_ref[0], 'newsletter-1x' )->image. newsletter_image( $image_ref[0], 'newsletter-1x' )->legende.'</td>
									<td width="17">&nbsp;</td>
									<td valign="top">'.newsletter_image( $image_ref[1], 'newsletter-1x' )->image. newsletter_image( $image_ref[1], 'newsletter-1x' )->legende.'</td>
									<td width="17">&nbsp;</td>
									<td valign="top">'.newsletter_image( $image_ref[2], 'newsletter-1x' )->image. newsletter_image( $image_ref[2], 'newsletter-1x' )->legende.'</td>';	
								}
							?>  
                            	</tr>
                            </table>                          
                            
                    <?php endif; ?>
             			</td>
                    </tr>
                <?php endwhile; ?>
            
            	
            </table>
        </td>
		<td width="30">&nbsp;</td>
        
        
        
        <!--colonne 2 -->
        
        
    	<td valign="top" width="140"> 
        	<table border="0" cellpadding="0" cellspacing="0">
            	<?php while(has_sub_field("actualites")): ?>
            	<tr>
                	<td>
                	<?php if(get_row_layout() == "actualite"): // layout: Content ?>
                    
                    	<!-- info 1 -->
                    	<table border="0" cellpadding="0" cellspacing="0"> 
                        	<?php if(get_sub_field("titre")){ ?>
                        	<tr>
                            	<td><h2 style="color:#F03;font-family:'Gill Sans','Gill Sans MT',Arial, sans-serif;font-weight:bold;font-size:14px;margin:10px 0 3px 0;"><?php the_sub_field("titre"); ?></h2></td>
                            </tr>
                            <?php } ?>
                            <?php if(get_sub_field("sous_titre")){ ?>
                            <tr>
                                <td><h3 style="color:#333;font-family:'Gill Sans','Gill Sans MT',Arial, sans-serif;font-weight:normal;font-size:15px;text-transform:uppercase;margin:5px 0;"><?php the_sub_field("sous_titre"); ?></h3></td>
                            </tr>
                            <?php } ?>
                        	<tr>
                            	<td>
                                	<?php echo newsletter_content_format(get_sub_field("texte")); ?>
                                    
									<?php if(get_sub_field("lien")){?>
                                    	<p style="margin:10px 0;"><a href="<?php the_sub_field("lien");?>" target="_blank" style="color:#F03;font-family:'Gill Sans','Gill Sans MT',Arial, sans-serif;font-size:12px;"><?php if(get_sub_field("texte_du_lien")){ the_sub_field("texte_du_lien"); }else{ the_sub_field("lien"); }?></a></p>
                                    <?php } ?>
                                    
                                </td>
                            </tr>
                        	<tr>
                            	<td><img src="<?php bloginfo('template_url') ?>/images/news-separateur2.png" width="140" height="5" style="margin:0 0 7px 0;" alt=""/></td>
                            </tr>
                        </table>
                    <?php //elseif(get_row_layout() == "rubrique"):?>
                   
                    <?php elseif(get_row_layout() == "rubrique"):?>
                    		<!-- TITRE RUBRIQUE -->
                			<table width="100%" border="0" cellpadding="0" cellspacing="0"> 
                                <tr>
                                    <td><img src="<?php bloginfo('template_url') ?>/images/rub-droite/news-d-<?php the_sub_field('titre_de_la_rubrique');?>.png" width="140" height="35" alt="<?php the_sub_field('titre_de_la_rubrique');?>" style="margin-top:10px;" /></td>
                                </tr>
                                <!--<tr>
                                    <td bgcolor="#000" height="10"><font style="font-size:5px;">&nbsp;</font></td>
                                </tr>-->
                            </table>
                    <?php elseif(get_row_layout() == "sous_rubrique"):?>
                    		<!-- TITRE SOUS RUBRIQUE -->
                			<table width="100%" border="0" cellpadding="0" cellspacing="0"> 
                                <tr>
                                    <td><h2 style="color:#F03;font-family:'Gill Sans','Gill Sans MT',Arial, sans-serif;font-weight:bold;font-size:15px;text-transform:uppercase;margin:10px 0 3px;"><?php $field = get_sub_field_object('titre_de_la_sous_rubrique');
$value = get_sub_field('titre_de_la_sous_rubrique');
$label = $field['choices'][ $value ]; echo $label;//the_sub_field('titre_de_la_sous_rubrique');?></h2></td>
                                </tr>
                            </table>
                    <?php elseif(get_row_layout() == "image"):?>
                    	<!-- image -->
                    	<table cellpadding="0" cellspacing="0" style="margin-top:7px">
                            <tr>
                            	<td>
                                 <?php
                                 if( get_sub_field('lien') ) echo '<a href="'.get_sub_field('lien').'" target="_blank">'; 
								 //echo wp_get_attachment_image( get_sub_field('image'), 'newsletter-right');
								 echo newsletter_image( get_sub_field('image'), 'newsletter-right' )->image. newsletter_image( get_sub_field('image'), 'newsletter-right' )->legende;
								 if( get_sub_field('lien') ) echo '</a>';
								 ?>
                                </td>
                            </tr>
                        </table>
                        
                    <?php endif; ?>
             			</td>
                    </tr>
                <?php endwhile; ?>

            </table>
        </td>
		<td width="30">&nbsp;</td>
  </tr>
</table>
<table width="630" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" align="center"> <!--footer -->
    <tr>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
    </tr>
    <tr bgcolor="#333333">
   	  <td width="280" height="85"><img src="<?php bloginfo('template_url') ?>/images/news-foot_ITS.png" width="280" height="80" alt="ITS Institut Tribune Socialiste" /></td>
    	<td valign="top" height="85"><p style="color:#DDDDDD;font-family:'Gill Sans','Gill Sans MT',Arial, sans-serif;font-size:13px;"><a href="http://www.institut-tribune-socialiste.fr" style="color:#DDDDDD;text-decoration:none;">www.institut-tribune-socialiste.fr</a><br />
          <a href="mailto:contact@institut-tribune-socialiste.fr" style="color:#DDDDDD;text-decoration:none;">contact@institut-tribune-socialiste.fr</a></p></td>
    	<td width="90" height="85"><img src="<?php bloginfo('template_url') ?>/images/news-foot_logo.png" width="90" height="80" alt="logo ITS" /></td>
    </tr>
</table>
<?php endwhile; endif; ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-39412038-1']);
  _gaq.push(['_setDomainName', 'institut-tribune-socialiste.fr']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
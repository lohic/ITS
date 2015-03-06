<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php bloginfo('name') ?> | <?php the_title() ?></title>
<script type="text/javascript" src="http://use.typekit.com/lwg4aka.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<style>
    @font-face {
        font-family: 'signika';
        src: url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-bold.eot');
        src: url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-bold.eot?#iefix') format('embedded-opentype'),
             url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-bold.woff') format('woff'),
             url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-bold.ttf') format('truetype'),
             url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-bold.svg#signikabold') format('svg');
        font-weight: 700;
        font-style: normal;
    }

    @font-face {
        font-family: 'signika';
        src: url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-semibold.eot');
        src: url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-semibold.eot?#iefix') format('embedded-opentype'),
             url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-semibold.woff') format('woff'),
             url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-semibold.ttf') format('truetype'),
             url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-semibold.svg#signikasemibold') format('svg');
        font-weight: 600;
        font-style: normal;
    }

    @font-face {
        font-family: 'signika';
        src: url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-regular.eot');
        src: url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-regular.eot?#iefix') format('embedded-opentype'),
             url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-regular.woff') format('woff'),
             url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-regular.ttf') format('truetype'),
             url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-regular.svg#signikaregular') format('svg');
        font-weight: 500;
        font-style: normal;
    }

    @font-face {
        font-family: 'signika';
        src: url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-light.eot');
        src: url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-light.eot?#iefix') format('embedded-opentype'),
             url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-light.woff') format('woff'),
             url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-light.otf') format('truetype'),
             url('<?php bloginfo( 'template_url' ); ?>/fonts/signika-light.svg#signikalight') format('svg');
        font-weight: 400;
        font-style: normal;
    }

    body{
        font-family: 'signika';
    }

    h1.titre{
        color:#F03;
        margin: 30px;
        text-transform: uppercase;
        font-family:"futura-pt", sans-serif;
        font-weight:800;
        font-style:normal;
    }

    .content{
        margin: 0 30px 30px;
    }

    .content img{
        max-width: 100%;
        height: auto;
    }

    .content img.alignleft{
        float: left;
        margin: 0 1em 1em 0;
    }
    .content img.alignright{
        float: right;
        margin: 0 0 1em 1em;
    }

    .content img.aligncenter{
        margin: 0 auto 1em;
        display: block;
    }


    .content > :first-child{
        margin-top:0;
    }

    .content address:before{
        content:"—";
        display: block;
    }
    .content address:after{
        content:"—";
        display: block;
    }

    .content .wp-caption{
        max-width: 570px !important;
    }

    .content p.wp-caption-text{
        text-align: right;
        font-size: 0.8em;
        margin-top: 4px;
    }
        

</style>
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

<!-- GABARIT SINGLE-MAIL.PHP -->

<body bgcolor="#CCCCCC">


<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>



<table width="630" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC" align="center" style="margin-top:30px">
    <tr>    
        <td valign="top">
            <!--  style="color:#F03;font-family:'Gill Sans','Gill Sans MT',Arial, sans-serif;font-size:30px; text-transform: uppercase; margin:0;" -->
            <h1 class="titre"><?php the_title(); ?></h1>
        </td>
    </tr>
    <tr>
        <!--  style="color:#333;font-family:'Gill Sans','Gill Sans MT',Arial, sans-serif;font-size:14px;" -->    
        <td valign="top">
            <div class="content">
            <?php the_content();?>
            </div>
        </td>
    </tr>
</table>


<table width="630" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC" align="center" style="margin-bottom:30px"> <!--footer -->
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

<?php endwhile;?>
<? endif; ?>
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

<!-- fin GABARIT SINGLE-MAIL.PHP -->
</html>
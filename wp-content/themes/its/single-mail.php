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

<!-- GABARIT SINGLE-MAIL.PHP -->

<body bgcolor="#CCCCCC">

<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>


<h1><?php the_title(); ?></h1>
<?php the_content();?>



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
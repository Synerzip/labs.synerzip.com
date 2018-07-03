<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php wp_title('&raquo;',true,'right'); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes" />

<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-icon">

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700,700i,800|Roboto+Slab:100,300" rel="stylesheet"> 
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_enqueue_script( "site-jquery", get_bloginfo('template_url')."/js/plugins.js", array( 'jquery' ) ); ?>
<?php wp_enqueue_script( "site-js", get_bloginfo('template_url')."/js/site.js", array( 'site-jquery' ) ); ?>
	
<link href="<?php bloginfo('template_url'); ?>/css/style.css" type="text/css" rel="stylesheet" />
	<link href="<?php bloginfo('template_url'); ?>/css/bootstrap.css" type="text/css" rel="stylesheet" />
	<link href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
	
	
<!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '749891575186365'); 
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=749891575186365&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112921641-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-112921641-1');
</script>

</head>
<body class="hashtag">
<div id="page">
    <header id="header">
		<div class="shell"> 
			<div id="logo"><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?><span></span></a></div>
			<?php shiftnav_toggle( 'shiftnav-main' , ' ' , array('id' => 'shiftnav-toggle','el' => 'span','class' => 'fa fa-bars') ); ?> 
		</div>
    </header> <!-- /header -->
	<?php if(is_front_page()) { ?>
	<div id="home_banner">
		<div>    		
		<?php $args = array(
			'post_type' => 'banner',
			'posts_per_page' => -1,
			'order' => 'ASC',
			'orderby' => 'menu_order'
			);
		   $the_query = new WP_Query($args);
			if ($the_query->have_posts()) :
				$i=0; // counter
			while ($the_query->have_posts()) : $the_query->the_post(); ?>
		
			<div class="banner">
				<div class="text"><?php the_content(); ?></div>
			</div>
		 <?php endwhile; endif; ?>
		 </div>
	</div>
	<?php } 
	$current_link=get_permalink(); 
	$post_object = get_field('next_webinar', 'option');
			if( $post_object ): 

				// override $post
				$post = $post_object;
				setup_postdata( $post ); 
				$webinardate = get_post_meta($post->ID,'date',true);
				$webinar_link=get_permalink();
	if($webinar_link!=$current_link){
	?>
	<div id="rotator" class="clearfix">
		<div class="shell">
			<h5>Upcoming Webinar</h5>			
			<div class="content btn-small"><a href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a> <a href="<?php the_permalink(); ?>" class="more"><?php echo date('F d',strtotime($webinardate)); ?>&nbsp;&nbsp;&nbsp;
			
			<i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Register Now &raquo;</a>
				</div>				
		</div>
	</div>	
	<?php } wp_reset_postdata(); 
			 endif; ?>
    <div id="container">
    	<div id="content"> 
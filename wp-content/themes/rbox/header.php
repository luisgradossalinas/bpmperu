<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>


	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<title><?php if (is_front_page() ) {
    bloginfo('name');
	} elseif ( is_category() ) {
		single_cat_title(); echo ' - ' ; bloginfo('name');
	} elseif (is_single() ) {
		single_post_title();
	} elseif (is_page() ) {
		single_post_title(); echo ' - '; bloginfo('name');
	} elseif (is_archive() ) {
		single_month_title(); echo ' - '; bloginfo('name');
	} else {
		wp_title('',true);
	} ?></title>
			
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
		<?php wp_enqueue_style('dropdown', get_template_directory_uri()  . '/css/dropdown.css'); ?>
		<?php wp_enqueue_style('advanced', get_template_directory_uri()  . '/css/default.advanced.css'); ?>	
			
<?php if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_enqueue_script('jquery'); ?>

<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie6.css" />
<![endif]-->

<?php $options = get_option('Rbox_theme_options'); ?>
	<?php $googleanalytics= $options['Rbox_analytics']; ?>
	<?php echo stripslashes($googleanalytics); ?>
	
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<!--wrapper-->
	<div id="wrapper">
	
	<!--headercontainer-->
	<div id="header_container">
	
		<!--header-->
		<div id="header2">
		
			<div id="logo">

				<a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>"><?php bloginfo( 'name' ); ?></a>
				
			</div><!--logo end-->
			
			
			<!--menu-->
			
		<div id="menubar">
			
	<?php $navcheck = '' ; ?>
	
	<?php if (function_exists( 'wp_nav_menu' )) {
		$navcheck = wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'menu_class' => 'dropdown dropdown-horizontal reset' ,'fallback_cb' => '', 'echo' => false ) );
	} ?>

	<?php  if ($navcheck == '') { ?>
	
	<ul class="dropdown dropdown-horizontal reset">
		<li class="current"><a href="<?php echo home_url(); ?>" title="Home"><?php _e( 'Home', 'Rbox' ); ?></a></li>
					
<?php

				if(get_option('rb_menu_bar') == 'true'){
					wp_list_pages('title_li');
				}
		?>
		
		<?php
				if (get_option('rb_cat_bar') == 'true'){
					wp_list_categories('title_li');
					}
		?>

	</ul>
<?php } else echo($navcheck); ?> 

	</div>
		
	
	<!--menu end-->
			
			<div class="clear"></div>
			
		</div><!-- header end-->
		
	</div><!--header container end-->	
		

<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!-->
<?php /*
	28Aug17 - zig add gtm function after opening body tag
*/ ?>
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
	<?php /* 18Sept24 - zig - add newscenter pixel per Susanne Hopkins */ ?>
	<script async referrerpolicy='no-referrer-when-downgrade' src='https://tag.simpli.fi/sifitag/7fe65f2e-7209-465a-9500-30337a572982'></script>
	<?php
		global $be_themes_data; // Get Backend Options
		if(isset($be_themes_data['favicon']['url']) && !empty($be_themes_data['favicon']['url']) && $be_themes_data['favicon']['url']) {
			echo '<link rel="icon" type="image/png" href="'.$be_themes_data['favicon']['url'].'">';
		}
	?>

    <?php
    	if ( is_singular() ) {
    		wp_enqueue_script( 'comment-reply' );
    	}
    	wp_head();
    ?>
</head>
<body <?php body_class(); ?> data-be-site-layout='<?php echo $be_themes_data['layout']; ?>' data-be-page-template = '<?php echo basename(get_page_template(),".php"); ?>' >
<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>
	<?php
		do_action( 'after_body' );
		$widget_style = (isset($be_themes_data['seach_widget_style']) && !empty($be_themes_data['seach_widget_style'])) ? $be_themes_data['seach_widget_style'] : 'style1-header-search-widget';
		if($widget_style == 'style2-header-search-widget') {
			be_themes_get_header_search_form_widget( false, true);
		}
		if ( ('left' == $be_themes_data['opt-header-type'] ) && isset($be_themes_data['left-header-style']) ){
			$opt_header_type = 'left';
		} else if( ('top' == $be_themes_data['opt-header-type'] ) && isset($be_themes_data['opt-header-type']) ){
			$opt_header_type = 'top';
		}
		// based on the choice of header style call its header-default.php
		get_template_part('headers/'.$opt_header_type.'/header', 'default');
		// zig add above content CTA widget
		if (is_active_sidebar('reach-above-content')) {
 				echo '<div id="reach-above-content-wrap" class="clearfix">';
 					echo '<div id="reach-above-content" class="be-wrap be-row ">';
 						dynamic_sidebar( 'reach-above-content');
 					echo '</div>';
 				echo '</div>';
 		}

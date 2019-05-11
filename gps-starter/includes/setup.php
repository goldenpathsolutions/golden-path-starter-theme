<?php

include( 'shortcodes.php' );

function theme_styles() {
	wp_enqueue_style( 'bootstrap_css', get_stylesheet_directory_uri() . '/inc/bootstrap-4.1.3/css/bootstrap.min.css', array(), '4.1.3', FALSE);
	//wp_enqueue_style( 'fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', FALSE);
	wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/css/fontawesome-all.min.css', array(), '5.4.1', FALSE);
	wp_enqueue_style( 'simplecalendar', get_stylesheet_directory_uri() . '/lib/cal/SimpleCalendar.css', array(), '1.0', FALSE );
	wp_enqueue_style( 'slick_css', get_stylesheet_directory_uri() . '/css/slick.css', false, '1.8.0' );
	wp_enqueue_style( 'slick_theme_css', get_stylesheet_directory_uri() . '/css/slick-theme.css', false, '1.8.0' );
	wp_enqueue_style( 'wp-default', get_stylesheet_directory_uri() . '/css/wp-default.css', false, '1.0' );
	wp_enqueue_style( 'lity', get_stylesheet_directory_uri() . '/css/lity.min.css', false, '2.3.0' );
}
add_action( 'wp_enqueue_scripts', 'theme_styles');

function theme_js() {
	global $wp_scripts;
	wp_enqueue_script( 'bootstrap_js', get_stylesheet_directory_uri() . '/inc/bootstrap-4.1.3/js/bootstrap.min.js', array('jquery'), '4.1.3', TRUE );
	wp_enqueue_script( 'autogrow_js', get_stylesheet_directory_uri() . '/js/jquery.ns-autogrow.min.js', array('jquery'), '1.1.6', TRUE);
	wp_enqueue_script( 'lity', get_stylesheet_directory_uri() . '/js/lity.min.js', array('jquery'), '2.3.0', TRUE);
	wp_enqueue_script( 'sticky_sidebar', get_stylesheet_directory_uri() . '/js/sticky-sidebar.js', array('jquery'), '1.0.0', TRUE);
	wp_enqueue_script( 'jquery_sticky_sidebar', get_stylesheet_directory_uri() . '/js/jquery.sticky-sidebar.js', array('jquery'), '1.0.0', TRUE);
	wp_enqueue_script( 'createjs', '//code.createjs.com/createjs-2015.11.26.min.js', '1.0', true );
	wp_enqueue_script( 'parallax', get_stylesheet_directory_uri() . '/js/parallax.js', array('jquery'), '1.5.0', TRUE);
	wp_enqueue_script( 'slick_js', get_stylesheet_directory_uri() . '/js/slick.js', array('jquery'), '1.8.0', TRUE);
	wp_enqueue_script( 'site_js', get_stylesheet_directory_uri() . '/js/site.js', array('jquery'), filemtime(get_stylesheet_directory().'/js/site.js'), TRUE );
}
add_action( 'wp_enqueue_scripts', 'theme_js');

function fuelx_image_sizes(){

    // images at 2x
	add_image_size('section-bg', 3840, 1248);
	add_image_size('half', 1200, 1200);
	add_image_size('third', 800, 800);
	add_image_size('third-side-image', 957, 822, true);
	add_image_size('quarter', 600, 800);
}
add_action('after_setup_theme', 'fuelx_image_sizes');


/**
 * Add a custom message to the WP dashboard, at the top of all other boxes
 * note: dismiss the Gutenberg and other full width banners, this shows first in the 2 col section below those
 */
function mb_add_dashboard_widgets(){
    wp_add_dashboard_widget( 'mb_dashboard_widget', 'This is your Staging Site', 'mb_dashboard_widget_function' );
    
	global $wp_meta_boxes;
    $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core']; 
    $mb_widget_backup = array( 'mb_dashboard_widget' => $normal_dashboard['mb_dashboard_widget'] );
    unset( $normal_dashboard['mb_dashboard_widget'] );
    $sorted_dashboard = array_merge( $mb_widget_backup, $normal_dashboard );
    $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}

// add your custom message below. The CSS makes the widget post-it note yellow
function mb_dashboard_widget_function(){
	?>
	<style>
		#mb_dashboard_widget {
			background:rgba(255,255,136,0.6);
		}
		#mb_dashboard_widget .dashicons {
			font-size: 18px;
			opacity: 0.6;
		}
		.postbox .hndle {
			border-color:rgba(0,0,0,0.05)!important;
		}
	</style>
	<p>Any content added to the staging site will be set to go live when approved. If your site has already been launched, please make your site updates on the live site.</p>
	<p>Please contact your dev team before adding any content to the staging site.</p>
	<ul>
		<li><span class="dashicons dashicons-email"></span> <strong>Project Manager:</strong> 
			<a href="mailto:helloannakatz@gmail.com">Anna Katz</a></li>
		<li><span class="dashicons dashicons-email"></span> <strong>Primary Developer:</strong> 
			<a href="mailto:pjackson@goldenpathsolutions.com">Patrick Jackson</a></li>
	</ul>
	<?php
}

// show the widget ONLY on the wpengine version of the site, never LIVE
if( preg_match('/wpengine/', $_SERVER['HTTP_HOST']) ){
	add_action('wp_dashboard_setup', 'mb_add_dashboard_widgets');
}


/**
 * Add extra social fields to settings
 * social network URLs, etc... anything can go here, value retrieved by:
 * echo get_option( '[name]', '' );
 */
add_action('admin_init', 'mb_general_section');  
function mb_general_section() {  
    add_settings_section(  
        'mb_settings_section',
        '<span class="dashicons dashicons-admin-generic"></span> Social Media Links & Other Settings',
        'mb_section_options_callback',
        'general'
    );
	
	$socialNetworks = array(
		'linkedin' => array(
			'label' => 'LinkedIn (URL)',
			'note' => '',
			'placeholder' => ''
		),
		'instagram' => array(
			'label' => 'Instagram (URL)',
			'note' => '',
			'placeholder' => ''
		),
		'twitter' => array(
			'label' => 'Twitter (URL)',
			'note' => '',
			'placeholder' => ''
		),
		'facebook' => array(
			'label' => 'Facebook (URL)',
			'note' => '',
			'placeholder' => ''
		),
		'google_analytics' => array(
			'label' => 'Google Analytics UA Code',
			'note' => 'Set the UA code above. It will ONLY appear on the live site, when *.wpengine.com is not part of the URL.',
			'placeholder' => 'UA-XXXXXX'
		),
		'jira_tracker' => array(
			'label' => 'Jira Tracker (URL)',
			'note' => 'Add Jira Tracker URL here to activate. Will automatically be omitted on the live site.',
			'placeholder' => ''
		),
		'footer_tracking_codes' => array(
			'label' => 'Tracking Codes (Footer)',
			'note' => 'Copy and paste any tracking codes here that should into every page of your site, just before the </body> tag.',
			'placeholder' => '',
			'fieldType' => 'textarea'
		)
	);
	
	foreach( $socialNetworks as $name => $val ){
		
	    add_settings_field(
	        $name,
	        $val['label'],
	        'mb_textbox_callback',
	        'general',
	        'mb_settings_section',
	        array(
	            'name' => $name,
	            'note' => $val['note'],
	            'placeholder' => $val['placeholder'],
	            'fieldType' => $val['fieldType']
	        )  
	    );
	    
	    register_setting('general', $name, 'esc_attr');
	
	}
}

function mb_section_options_callback(){
    echo '<p>Define your social media URLs and other options for your theme here.</p>';  
}

function mb_textbox_callback($args){
    $option = get_option( $args['name'] );
    if( $args['fieldType'] == 'textarea' ){
    	echo '<textarea id="'. $args['name'] .'" name="'. $args['name'] .'" placeholder="'.( $args['placeholder'] != '' ? $args['placeholder']:'' ).'" class="large-text code" rows="5">' . $option . '</textarea>';
	} else {
		echo '<input type="text" id="'. $args['name'] .'" name="'. $args['name'] .'" value="' . $option . '" placeholder="'.( $args['placeholder'] != '' ? $args['placeholder']:'' ).'" class="regular-text" />';
	}
	
	if( $args['note'] != '' ){
	    echo '<p class="description">'.$args['note'].'</p>';
    }
}
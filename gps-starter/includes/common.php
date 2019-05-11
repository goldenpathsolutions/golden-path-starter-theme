<?

/**
 * Add to the list of mime types allowed for upload to the media library.
 * For example, lets us upload SVG
 *
 * @param $mimes
 *
 * @return mixed
 */
function add_uploadable_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'add_uploadable_mime_types' );

/**
 * Get SVG
 *
 * Converts SVG file into inline SVG, allowing us to apply CSS and JS to it
 *
 * @param $svg String URL for an SVG file
 *
 * @return string
 */
function get_svg( $svg ) {
	$svg          = substr( $svg, strpos( $svg, '/', - 1 ) );
	$fileContents = file_get_contents( $svg );
	$headers      = '<?xml version="1.0" encoding="utf-8"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">';

	return $headers . $fileContents;
}


/**
 * Move yoast metabox to the bottom of the metaboxes
 * @return string
 */
function yoasttobottom() {
	return 'low';
}

add_filter( 'wpseo_metabox_prio', 'yoasttobottom' );


// disable xmlrpc
add_filter( 'xmlrpc_enabled', '__return_false' );

// auto update wordpress core
//add_filter( 'auto_update_core', '__return_true' );
//add_filter( 'auto_update_plugin', '__return_true' );
//add_filter( 'auto_update_theme', '__return_true' );


// hide admin bar for non-admins
if ( ! current_user_can( 'administrator' ) ) {
	add_filter( 'show_admin_bar', '__return_false' );
}


/**
 * ACF Styling
 *
 * Updates some of the styling for Advanced Custom Fields in the editor
 * to make it a little easier to comprehend.
 */
function acf_styling() {
	echo '
		<style>
			.acf-flexible-content .layout:nth-child(even),
			.acf-field-setting-fc_layout:nth-child(even) td{
				background-color:rgba(0,0,0,.05) !important;
			} 
            .acf-flexible-content .layout:nth-child(even) .acf-th{
                background-color:rgba(0,0,0,.1);
            }
            .acf-flexible-content .layout:nth-child(even) .acf-button{
                background-color: rgba(0,0,0,.5);
                border-color: rgba(0,0,0,.5);
                box-shadow: none !important;
                text-shadow: none !important;
                color: #fff;
            }
            .acf-flexible-content .layout:nth-child(even) .acf-button:hover{
                box-shadow: 0 1px 0 rgba(0,0,0,.3) !important;
                text-shadow: 0 -1px 1px rgba(0,0,0,.3),1px 0 1px rgba(0,0,0,.3),0 1px 1px rgba(0,0,0,.3),-1px 0 1px rgba(0,0,0,.3) !important;
            }
            .acf-flexible-content .layout:nth-child(even) .acf-fc-layout-handle{
                background-color: rgba(0,0,0,0.3);
            }
			.acf-flexible-content .layout:nth-child(odd),
			.acf-field-setting-fc_layout:nth-child(odd) td{
				background-color:rgba(0, 115, 170, .05) !important;
			}
            .acf-flexible-content .layout:nth-child(odd) .acf-hl,
            .acf-flexible-content .layout:nth-child(odd) .acf-th{
                background-color:rgba(0, 115, 170, .1);
            }
            .acf-flexible-content .layout:nth-child(odd) .acf-fc-layout-handle{
                background-color: rgba(0, 115, 170, .3);
            }
            .acf-field-textarea[data-name="code"]{
                font-family: Courier, serif;
            }
        
		</style>
	';
}

add_action( 'admin_head', 'acf_styling' );


/**
 * Add Google Analytics
 *
 * Set the Google Analytics tracking code, GA_TRACKING_CODE,
 * in wp-config.php, and this will inject the snippet in the head section
 */
function add_googleanalytics() {

	if ( GA_TRACKING_CODE ) {
		?>
        <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '<?php echo GA_TRACKING_CODE; ?>');</script>
        <!-- End Google Tag Manager -->
		<?php
	}
}

add_action( 'wp_head', 'wpb_add_googleanalytics', 44 );


/**
 * Body Class Post Slug
 *
 * Adds the current post slug to the body class
 *
 * @param $classes
 * @param $class
 *
 * @return array
 */
function body_class_post_slug( $classes, $class ) {
	global $post;
	if ( ! is_home() && ! is_front_page() && $post ) {
		$classes[] = $post->post_name;
	}

	return $classes;
}

add_filter( 'body_class', 'body_class_post_slug', 10, 2 );

/**
 *
 * Body Class Tracer
 *
 * If the "show_tracer" class is set to true, adds "show-tracer" class to body tag.
 * Used to turn the tracer on/off during development
 *
 * @param $classes
 * @param $class
 *
 * @return array
 */
function body_class_tracer( $classes, $class ) {
	if ( get_field( 'show_tracer' ) ) {
		$classes[] = 'show-tracer';
	}

	return $classes;
}

add_filter( 'body_class', 'body_class_tracer', 10, 2 );

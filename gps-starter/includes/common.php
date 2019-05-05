<?
function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'cc_mime_types' );

function get_svg( $svg ) {
	$svg          = str_replace( 'http://fuelxhome.staging.wpengine.com/', '', $svg );
	$fileContents = file_get_contents( $svg );
	$headers      = '<?xml version="1.0" encoding="utf-8"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">';

	return $headers . $fileContents;
}

function yoasttobottom() {
	return 'low';
}

add_filter( 'wpseo_metabox_prio', 'yoasttobottom' );


// disable xmlrpc
add_filter( 'xmlrpc_enabled', '__return_false' );

// auto update wordpress core
add_filter( 'auto_update_core', '__return_true' );
add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );


// hide admin bar for non-admins
if ( ! current_user_can( 'administrator' ) ) {
	add_filter( 'show_admin_bar', '__return_false' );
}

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
                font-family: Courier;
            }
        
		</style>
	';
}

add_action( 'admin_head', 'acf_styling' );


function add_googleanalytics() {
	
	if ( GA_TRACKING_CODE ) {
		?>
        <!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','<?php echo GA_TRACKING_CODE; ?>');</script>
		<!-- End Google Tag Manager -->
		<?php
	}
}

add_action( 'wp_head', 'wpb_add_googleanalytics', 44 );


function mailto( $atts ) {
	ob_start();
	extract( shortcode_atts(
			array(
				'address' => false,
				'label'   => false
			), $atts )
	);

	// convert email address to character codes
	$obj               = array_map( function ( $x ) {
		return "&#" . strval( ord( $x ) ) . ";";
	}, str_split( $address ) );
	$encrypted_address = implode( $obj );

	// split email address into parts
	$parts  = explode( '@', $address );
	$name   = $parts[0];
	$domain = $parts[1];

	?>
    <script language="JavaScript"><!--
        var name = "<?php echo $name; ?>";
        var domain = "<?php echo $domain; ?>";
        document.write('<a href=\"mailto:' + name + '@' + domain + '\">');
		<?php

		if ( $label !== false ) {
			echo "document.write('" . $label . "' + '</a>');";
		} else {
			echo "document.write(name + '@' + domain + '</a>');";
		}

		?>
        // --></script>
    <noscript><a href="mailto:<?php echo $encrypted_address; ?>"><?php
			if ( $label !== false ) {
				echo $label;
			} else {
				echo $encrypted_address;
			}
			?></a></noscript><?php

	return ob_get_clean();

}

add_shortcode( 'mailto', 'mailto' );


function svg_image( $atts ) {
	ob_start();
	extract( shortcode_atts(
			array(
				'src'    => false,
				'expand' => false,
				'class'  => false
			), $atts )
	);

	if ( $expand ) {
		?>
        <style>
            .svg-image {
                width: 100%;
                height: 400px;
            }

            .svg-image svg {
                width: 100%;
                height: auto;
            }
        </style>
        <div class="svg-image <?php echo $class; ?>"><?php echo get_svg( $src ); ?></div>
		<?php
	} else {
		?>
        <img src="<?php echo $src; ?>" class="<?php echo $class; ?>"/>
		<?php
	}

	return ob_get_clean();
}

add_shortcode( 'svg_image', 'svg_image' );


function body_class_wpse_85793( $classes, $class ) {
	if ( ! is_home() && ! is_front_page() ) {
		$classes[] = 'interior';
	}

	return $classes;
}

add_filter( 'body_class', 'body_class_wpse_85793', 10, 2 );

function body_class_post_slug( $classes, $class ) {
	global $post;
	if ( ! is_home() && ! is_front_page() && $post ) {
		$classes[] = $post->post_name;
	}

	return $classes;
}

add_filter( 'body_class', 'body_class_post_slug', 10, 2 );

function body_class_tracer( $classes, $class ) {
	if ( get_field( 'show_tracer' ) ) {
		$classes[] = 'show-tracer';
	}

	return $classes;
}

add_filter( 'body_class', 'body_class_tracer', 10, 2 );

function body_class_hide_menu_bg( $classes, $class ) {
	if ( get_field( 'hide_menu_background' ) ) {
		$classes[] = 'hide-menu-bg';
	}

	return $classes;
}

add_filter( 'body_class', 'body_class_hide_menu_bg', 10, 2 );


/** ADD SUBMENU OPTION TO wp_nav_menu **/
function submenu_get_children_ids( $id, $items ) {
	$ids = wp_filter_object_list( $items, array( 'menu_item_parent' => $id ), 'and', 'ID' );
	foreach ( $ids as $id ) {
		$ids = array_merge( $ids, submenu_get_children_ids( $id, $items ) );
	}

	return $ids;
}

function submenu_limit( $items, $args ) {
	if ( empty( $args->submenu ) ) {
		return $items;
	}

	$ids       = wp_filter_object_list( $items, array( 'title' => $args->submenu ), 'and', 'ID' );
	$parent_id = array_pop( $ids );
	$children  = submenu_get_children_ids( $parent_id, $items );

	foreach ( $items as $key => $item ) {
		if ( ! in_array( $item->ID, $children ) ) {
			unset( $items[ $key ] );
		}
	}

	return $items;
}

add_filter( 'wp_nav_menu_objects', 'submenu_limit', 10, 2 );
/** END ADD SUBMENU OPTION TO wp_nav_menu **/


function get_subpage_anchors() {
	global $post;
	ob_start();

	$menu = fuelx_get_menu_items( 'primary' );
	//echo '<pre>'.$post->ID.' / '.print_r($menu,1).'</pre>';

	foreach ( $menu as $parent ) {
		if ( $parent->object_id == $post->ID ) {
			$parentMenuItem = $parent;
		}
	}

	$subMenuLinks = array();
	foreach ( $menu as $child ) {
		if ( $child->menu_item_parent == $parentMenuItem->ID ) {
			$subMenuLinks[] = array(
				'title'      => $child->post_title,
				'url'        => $child->url,
				'menu_order' => $child->menu_order
			);
		}
	}

	if ( count( $subMenuLinks ) > 0 ) {
		?>
        <ul>
			<?php

			foreach ( $subMenuLinks as $link ) {
				?>
                <li><a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a></li>
				<?php
			}

			?>
        </ul>
		<?php
	}

	//echo '<pre>'.$post->ID.' / '.print_r($subMenuLinks,1).'</pre>';

	return ob_get_clean();
}

add_shortcode( 'get_subpage_anchors', 'get_subpage_anchors' );

function fuelx_get_menu_items( $menu_name ) {
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

		return wp_get_nav_menu_items( $menu->term_id );
	}
}

function event_link( $url ) {
	$parsed = parse_url( $url );
	$host   = str_replace( 'www.', '', $parsed['host'] );
	$link   = '<a href="' . $url . '" target="_blank">' . strtolower( $host ) . '</a>';

	return $link;
}


function run_shortcode( $shortcode ) {
	do_shortcode( $shortcode );
}

add_shortcode( 'run_shortcode', 'run_shortcode' );

function upcoming_events() {
	$args   = array(
		'post_type'      => 'mcm_event',
		'post_status'    => 'publish',
		'posts_per_page' => 4,
		'max_num_pages'  => 4,
		'meta_key'       => 'expires',
		'meta_query'     => array(
			array(
				'key' => 'expires'
			),
			array(
				'key'     => 'expires',
				'value'   => date( 'Ymd' ),
				'compare' => '>='
			)
		),
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	);
	$loop   = new WP_Query( $args );
	$events = array();
	while ( $loop->have_posts() ) : $loop->the_post();
		$event    = get_fields();
		$events[] = array(
			'title'                   => get_the_title(),
			'date'                    => $event['date'],
			'location'                => $event['location'],
			'venue'                   => $event['venue'],
			'description'             => get_the_content(),
			'excerpt'                 => $event['excerpt'],
			'logo'                    => $event['logo'],
			'header_background_image' => $event['header_background_image'],
			'upcoming_events_excerpt' => $event['upcoming_events_excerpt'],
			'upcoming_events_logo'    => $event['upcoming_events_logo'],
			'tagline'                 => $event['tagline'],
			'link'                    => get_the_permalink()
		);
	endwhile;
	wp_reset_postdata();
	$count = count( $events );
	?>
    <div class="blade_layout_shortcode container_flex" id="upcoming_events" style="position: relative">
        <div class="container">
            <div class="row prow mx-auto">
                <div class="event-intro">
                    <h3>Upcoming Events</h3>
                    <h5><a href="/events">See All</a></h5>
                </div>
                <ul class="event-slides">
					<?php

					$i = 1;
					foreach ( $events AS $event ) {

						if ( ! $event['upcoming_events_logo'] || $event['upcoming_events_logo'] == '' ) {
							$event['upcoming_events_logo'] = get_stylesheet_directory_uri() . '/images/event-logo-template.jpg';
						}

						?>
                        <li id="slide_<?php echo $i; ?>">
                            <div class="col-xs-12 col-md-5">
                                <div class="event_info">
                                    <img class="full" src="<?= $event['upcoming_events_logo']; ?>">
                                    <div class="event_date" style="display:none;"><?= $event['date']; ?>
                                        | <?= $event['location']; ?></div>
                                    <div class="event_tag" style="display:none;"><?= $event['tagline']; ?></div>
                                </div>
                            </div>
                            <div class="col-xs-12 offset-md-1 col-md-5">
                                <h4><?= $event['date']; ?> <span class="location"><em>in</em> <?= $event['location']; ?></span>
                                </h4>
                                <p><?= $event['upcoming_events_excerpt']; ?></p>
                                <a href="<?= $event['link']; ?>" class="button orange">Join Us!</a>
                            </div>
                        </li>
						<?php

						$i += 1;
					}

					?>
                </ul>
            </div>
        </div>
        <div class="far_right">
			<?php

			if ( count( $events ) > 1 ) {
				?>
                <div class="slider_bars">
					<? $i = 1;
					foreach ( $events AS $event ): ?>
                        <div class="bar bar_gray" data-page="<?= $i; ?>">
                            <div class="bar_line gray">
                                <div class="bar_line progress"></div>
                            </div>
                            <div class="bar_number gray"><?= sprintf( "%02d", $i ); ?></div>
                        </div>
						<? ++ $i; endforeach; ?>
                </div>
				<?php
			}

			?>
        </div>
    </div>
	<?
}

add_shortcode( 'upcoming_events', 'upcoming_events' );

function our_performance_marketing() {
	?>
    <div class="blade_far_right container_fluid bg_grey left-angle-bottom our_performance_marketing"
         style="position: relative">
        <div class="container">
            <div class="row prow">
                <div class="col-xs-12 col-md-6">
					<?php echo show_text_block( 'our-performance-marketing-platform', true ); ?>
                    <a href="/lets-talk/" class="button orange">Talk to Us</a>
                </div>
            </div>
        </div>
        <img class="far_right performance-graphic"
             src="<?php echo get_stylesheet_directory_uri(); ?>/images/demo-module1@2x.gif">
    </div>
	<?php

}

add_shortcode( 'our_performance_marketing', 'our_performance_marketing' );

function image_slider( $atts ) {
	ob_start();
	extract( shortcode_atts(
			array(
				'images'        => false,
				'alt'           => '',
				'require_click' => false,
				'speed'         => 4000
			), $atts )
	);

	if ( $images ) {
		$images = explode( ',', $images );
		$first  = true;
		?>
        <div class="image_slider_container">
            <div class="image_slider <?php echo( $require_click ? 'require_click' : '' ); ?>"
                 data-speed="<?php echo $speed; ?>">
				<?php

				foreach ( $images as $image ) {
					?><img class="<?php echo( $first ? 'active' : '' ); ?>" src="<?php echo $image; ?>"
                           alt="<?php echo $alt; ?>" /><?php
					$first = false;
				}

				?>
            </div>
        </div>
		<?php
	}

	return ob_get_clean();

}

add_shortcode( 'image_slider', 'image_slider' );

function anchor_link( $title ) {
	$link = strtolower( preg_replace( "/ /", "-", preg_replace( "/[^A-Za-z0-9 ]/", "", $title ) ) );

	return '<a name="' . $link . '"></a>';
}

function slugify( $str ) {
	$str = strtolower( preg_replace( "/ /", "-", preg_replace( "/[^A-Za-z0-9 ]/", "", $str ) ) );

	return $str;
}

/**
 * get all documentation articles into categorized listin
 * output as accordion with category above article titles
 */
function documentation_categories() {

	// get categories in order
	$taxonomy = 'mcm_category_documentation';
	$terms = get_terms($taxonomy);

	// get all documents for each category
	$documents = array();

	foreach($terms as $term){
		
		$args      = array(
			'post_type'      => 'mcm_documentation',
			'post_status'    => 'publish',
			'posts_per_page' => 999,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'tax_query' => array(
		        array(
		            'taxonomy' => $taxonomy,
		            'field' => 'slug',
		            'terms' => $term->slug
		        )
		    )
		);
		
		$loop = new WP_Query( $args );
		
		while ( $loop->have_posts() ) : $loop->the_post();
			
			$doc = get_fields();
			
			$e = array(
				'id' => get_the_ID(),
				'title' => get_the_title(),
				'category' => $term->name,
				'link' => get_the_permalink(),
				//'description' => get_the_content(),
				//'excerpt' => get_the_excerpt(),
				//'fields' => $doc
			);
	
			$documents[] = $e;
	
		endwhile;
		wp_reset_postdata();
		
	}
	
	// format into a multi-dimentional array for accordion list
	$allDocuments = array();
	
	foreach ( $terms as $term ) {

		$documentsInCategory = array();
		foreach ( $documents as $doc ) {
			if ( $doc['category'] == $term->name ) {
				$documentsInCategory[] = $doc;
			}
		}


		$allDocuments[] = array(
			'category'  => $term->name,
			'documents' => $documentsInCategory
		);
	}
	
	return $allDocuments;
	
}
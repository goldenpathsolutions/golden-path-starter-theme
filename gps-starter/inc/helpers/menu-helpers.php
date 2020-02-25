<?php
namespace GPS\Helpers;

define( 'BASE_DIR', '/' );

/**
 * Get the full path of the current URL
 * optional $return_key return a specific element from the URL
 */
function get_url_path($return_key=false, $str=false){
	if($str === false){
		$str = $_SERVER["REQUEST_URI"];
	}

	$str = str_replace(get_site_url(), '', $str);

	if(BASE_DIR != '/'){
		$str = str_replace(BASE_DIR, '', $str);
	}
	$array = explode("/", $str);

	if($return_key !== false){
		return $array[$return_key];
	}

	return $array;
}


/**
 * Get simple array of menu.
 */
function wp_get_menu_array($current_menu) {

	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object( $locations[ $current_menu ] );
	$menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
	//die('<pre>'.$current_menu.' = '.print_r($menu_items,1));

	if($menu_items){
		$menu = array();
		foreach($menu_items as $m) {
			if(empty($m->menu_item_parent)) {

				$page_ID = $m->ID;

				$menu[$page_ID] = new \stdClass();
				$menu[$page_ID]->ID = $page_ID;
				$menu[$page_ID]->title = $m->title;
				$menu[$page_ID]->url = $m->url;
				$menu[$page_ID]->target = $m->target;
				$menu[$page_ID]->slug = get_url_path(1, $m->url);
				$menu[$page_ID]->children = array();
			}
		}

		// add child items
		foreach($menu_items as $m) {
			if(!empty($m->menu_item_parent)) {

				$page_ID = $m->ID;
				$parent_ID = $m->menu_item_parent;

				$menu[$parent_ID]->children[$page_ID] = new \stdClass();
				$menu[$parent_ID]->children[$page_ID]->ID = $page_ID;
				$menu[$parent_ID]->children[$page_ID]->title = $m->title;
				$menu[$parent_ID]->children[$page_ID]->url = $m->url;
				$menu[$parent_ID]->children[$page_ID]->target = $m->target;
				$menu[$parent_ID]->children[$page_ID]->slug = get_url_path(2, $m->url);//basename($m->url);
			}
		}

		return $menu;
	}
}
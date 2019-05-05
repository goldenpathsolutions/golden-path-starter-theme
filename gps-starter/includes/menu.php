<?
function main_menu(){
	?>
	<nav>
		<?php
			wp_nav_menu(
				array( 
					'menu' => 'Primary Menu',
				    'container_class' => 'main-menu',
				    'container' => 'ul',
				    'menu_class' => 'nav',
				    'link_before' => '<div class="menu_block"></div>',
				)
			); 
		?>
	</nav>
	<?	
}


function parent_menu(){
	global $post;
	if( is_page() && $post->post_parent) { 
		$submenu = get_the_title($post->post_parent);
	}
	else{
		$submenu = get_the_title();
	} 			
	wp_nav_menu(
		array( 
			'menu' => 'Primary Menu',
		    'depth' => 1,
		    'submenu' => $submenu,
		)
	);
}
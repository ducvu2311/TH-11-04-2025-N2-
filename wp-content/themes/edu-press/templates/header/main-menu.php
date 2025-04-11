<?php
/**
 * Header Main Menu Template
 *
 */

if ( has_nav_menu( 'primary' ) ) {
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'navbar-main-menu',
			'menu_id'        => 'primary-menu',
		)
	);
} else {
	wp_nav_menu(
		array(
			'theme_location' => '',
			'menu_class'     => 'navbar-main-menu',
			'container'      => false,
		)
	);
}

?>
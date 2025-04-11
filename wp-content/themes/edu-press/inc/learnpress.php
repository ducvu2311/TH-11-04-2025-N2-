<?php
// Enable override templates
use LearnPress\Helpers\Template;

// fix lp < 4.2.7
remove_action( 'learn-press/user-profile-account', LearnPress::instance()->template( 'profile' )->func( 'socials' ), 10 );
add_filter('learn-press/profile/header/sections', function (){
	return array(
		'profile/header/user-name.php',
		'profile/socials.php',
		'profile/header/user-bio.php',
	);
});

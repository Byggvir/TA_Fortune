<?php
/**
 * @package TA_Fortune
 * @version 0.1
 */
/*
Plugin Name: TA Fortune
Plugin URI: http://downlaod.byggvir.de/wordpress/extend/plugins/ta_fortune/
Description: This is my first plugin to imbed fortunes in a article.
Author: Thomas Arend
Version: 0.1
Author URI: http://byggvir.de/
*/

function tagetmyfortune() {

	$fortune=shell_exec('fortune');
	return wptexturize( $fortune ) ;
}

// This just echoes the chosen line, we'll position it later

function tafortune() {
	$chosen=tagetmyfortune();
	return "
	<!-- fortune start -->
	<p id='tafortune'>$chosen</p>
	<!-- fortune end -->
	";
}

// Now we set that function up to execute when the admin_notices action is called

add_action( 'admin_notices', 'tafortune' );

// We need some CSS to position the paragraph
function tafortune_css() {

	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#tafortune {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'tafortune_css' );

add_shortcode('fortune', 'tafortune');
?>

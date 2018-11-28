<?php
/**
 * @package TA_Fortune
 * @version 0.2
 */
/*
Plugin Name: TA Fortune
Plugin URI: http://downlaod.byggvir.de/wordpress/extend/plugins/ta_fortune/
Description: This is my first plugin to imbed fortunes in an article.
Author: Thomas Arend
Version: 0.2
Author URI: http://byggvir.de/
*/

function tagetmyfortune() {

	$fortune=shell_exec('fortune');
	return wptexturize( $fortune ) ;
}

// This just echoes the choosen line, we'll position it later

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
		padding-$x: 2em;
		padding-top: 1em;		
		margin: 0;
		font-size: 1em;
		color: blue;
	}
	</style>
	";
}

add_action( 'admin_head', 'tafortune_css' );

add_shortcode('fortune', 'tafortune');
?>

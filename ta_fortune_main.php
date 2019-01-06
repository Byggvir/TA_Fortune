<?php
/**
 *
 * @version 0.2
 * @wordpress-plugin
 * Plugin Name: TA Fortune
 * Plugin URI: http://wp-plugins.byggvir.de/ta-fortune/
 * Description: Zeigt ein Fortune im Text an.
 * Version:           2019.0.0
 * Author:            Thomas Arend
 * Author URI:        https://byggvir-de
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       ta-fortune
 * @package TA_Fortune
 * @return unknown
 */


function tagetmyfortune() {

	$fortune=shell_exec('fortune');
	return wptexturize( $fortune ) ;
}


// This just echoes the choosen line, we'll position it later


/**
 *
 * @return unknown
 */
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


/**
 * We need some CSS to position the paragraph
 */
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

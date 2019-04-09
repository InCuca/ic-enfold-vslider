<?php
/**
 * Plugin Name:     Enfold VSlider
 * Plugin URI:      https://incuca.net
 * Description:     Enfold VSlider Plugin
 * Author:          INCUCA
 * Author URI:      https://incuca.net
 * Text Domain:     ic-enfold-vslider
 * Version:         0.1.1
 *
 * @package         Ic_Enfold
 */

// Add shortcodes to Enfold
add_filter('avia_load_shortcodes', 'ic_enfold_vslider_shortcodes', 12, 1);

function ic_enfold_vslider_shortcodes($paths)
{
	$plugin_dir = plugin_dir_path(__FILE__);
	array_push($paths, $plugin_dir.'/shortcodes/');
	return $paths;
}
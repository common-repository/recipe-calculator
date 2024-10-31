<?php
/*
Plugin Name: Recipe Calculator
Plugin URI:  http://helloirena.com/plugins/recipe-calculator-2/
Description: Recipe Calculator - 1-click option for customizing portions, and instantly recalculating the needed ingredients for a recipe.
Version:     1.0.2
Author:      Irena Verweij
Author URI:  http://helloirena.com/
Text Domain: rcal
Domain Path: /languages

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//Load Languages
add_action( 'init', 'rcal_load_languages' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function rcal_load_languages() {
  load_plugin_textdomain( 'rcal', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

	//include metaboxes, functions
include( plugin_dir_path( __FILE__ ) . 'includes/metaboxes.php');
include( plugin_dir_path( __FILE__ ) . 'includes/functions.php');

	//Front-end Recipe Calculator
include( plugin_dir_path( __FILE__ ) . 'public/rcal.php');

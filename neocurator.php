<?php
/*
* Plugin Name:        NeoCurator
* Plugin URI:         http://www.niyiadewole.ca/
* Description:        Declares a plugin that will create a custom post type for digital curation of projects. This plugin registers the 'Projects' post type.
* Author:             Niyi Adewole
* Author URI:         http://www.niyiadewole.ca/
* Version:            1.0
* Requires at least:  6.2
* Requires PHP:       7.0
* License:            GPLv2
* License URI:        https://www.gnu.org/licenses/gpl-2.0.html
* Domain Path:        /languages
* Tags:               custom-menu, featured-images, theme-options, clear-cut
*/

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
  echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  exit;
}

// Variables
define('NEOCURATOR_VERSION', '1.0.0');
define('NEOCURATOR__MINIMUM_WP_VERSION', '6.0');
define('NEOCURATOR__PLUGIN_DIR', plugin_dir_path(__FILE__));
define('NC_PLUGIN_FILE', __FILE__);

// Includes
$rootFiles = glob(NEOCURATOR__PLUGIN_DIR . 'includes/*.php');
$subdirectoryFiles = glob(NEOCURATOR__PLUGIN_DIR . 'includes/**/*.php');
$allFiles = array_merge($rootFiles, $subdirectoryFiles);

foreach ($allFiles as $filename) {
  include_once($filename);
}


// Hooks
register_activation_hook(__FILE__, array('neocurator', 'nc_plugin_activation'));
register_deactivation_hook(__FILE__, array('neocurator', 'nc_plugin_deactivation'));

// add_action('init', array('neocurator', 'init'));

<?php
/**
 * Plugin Name: Rt Slider
 * Plugin URI: https://github.com/swapnilghone/rt-slider
 * Description: Straightforward slider plugin for WordPress, offering a seamless solution with its easy-to-use rt-slider shortcode. This plugin empowers you to create dynamic sliders effortlessly, allowing you to showcase your content in an engaging and visually appealing manner.
 * Version: 1.1
 * Author: Swapnil Ghone
 * Author URI: https://www.linkedin.com/in/swapnil-ghone/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: rt-slider
 * Domain Path: /languages
 *
 * @package rt-slider
 */

if ( ! defined( '__RT_VERSION' ) ) {
	define( '__RT_VERSION', '1.1' );
}

if ( ! defined( '__RT_SLICK_VERSION' ) ) {
	define( '__RT_SLICK_VERSION', '1.8.1' );
}

if ( ! defined( '__RT_PLUGIN_URL' ) ) {
	define( '__RT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( '__RT_PLUGIN_PATH' ) ) {
	define( '__RT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( '__RT_INC_PATH' ) ) {
	define( '__RT_INC_PATH', __RT_PLUGIN_PATH . 'inc/' );
}

if ( ! defined( '__RT_TEMPLATE_PATH' ) ) {
	define( '__RT_TEMPLATE_PATH', __RT_PLUGIN_PATH . 'templates/' );
}

if ( ! defined( '__RT_ASSETS_URL' ) ) {
	define( '__RT_ASSETS_URL', __RT_PLUGIN_URL . 'assets/' );
}

if ( ! defined( '__RT_ASSETS_PATH' ) ) {
	define( '__RT_ASSETS_PATH', __RT_PLUGIN_PATH . 'assets/' );
}

require_once __RT_INC_PATH . 'class-rt-autoloader.php';
\RT\Slider\inc\RT_Autoloader::init();

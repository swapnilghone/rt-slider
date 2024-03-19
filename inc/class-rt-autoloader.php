<?php
/**
 * Base class for plugin's auto loaders.
 *
 * @package rt-slider
 */

namespace RT\Slider\inc;

/**
 * RT_Autoloader class.
 */
class RT_Autoloader {

	/**
	 * RT_Autoloader Constructor
	 *
	 * @return void
	 */
	protected function __construct() { }

	/**
	 * Initializes the boot class and load assets.
	 */
	public static function init(): void {
		self::boot_classes();
		self::load_assets();
	}

	/**
	 * Autoload all classes.
	 */
	public static function boot_classes(): void {
		$classes = array(
			'RT\Slider\inc\RT_Admin'      => 'class-rt-admin.php',
			'RT\Slider\inc\RT_Shortcodes' => 'class-rt-shortcodes.php',
		);

		foreach ( $classes as $class => $file ) {
			if ( file_exists( __RT_INC_PATH . $file ) ) {
				require __RT_INC_PATH . $file;
				new $class();
			}
		}
	}

	/**
	 * Register Script enqueue hooks.
	 */
	public static function load_assets(): void {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_admin_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_frontend_scripts' ) );
	}

	/**
	 * Enqueue scripts for slider admin page.
	 *
	 * @param string $hook current admin page hook.
	 */
	public static function load_admin_scripts( string $hook ): void {

		if ( 'toplevel_page_rt-slider' !== $hook ) {
			return;
		}

		wp_enqueue_media();
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'rt-admin-script', __RT_ASSETS_URL . '/js/rt-admin-script.js', array( 'jquery', 'jquery-ui-sortable' ), __RT_VERSION, true );

		wp_enqueue_style( 'rt-admin-style', __RT_ASSETS_URL . 'css/rt-admin-style.css', array(), __RT_VERSION );
	}

	/**
	 * Enqueue scripts for slider shortcode.
	 */
	public static function load_frontend_scripts(): void {

		wp_register_script( 'rt-slick-script', __RT_ASSETS_URL . 'js/slick.min.js', array( 'jquery' ), __RT_SLICK_VERSION, true );
		wp_register_script( 'rt-script', __RT_ASSETS_URL . 'js/rt-script.js', array( 'jquery', 'rt-slick-script' ), __RT_VERSION, true );

		$rt_slider       = get_option( '__rt_slider' );
		$slider_settings = ! empty( $rt_slider['settings'] ) ? $rt_slider['settings'] : array();

		wp_localize_script( 'rt-script', 'slider_settings', apply_filters( 'rt_slider_settings', $slider_settings ) );

		wp_register_style( 'rt-slick-style', __RT_ASSETS_URL . 'css/slick.css', array(), __RT_SLICK_VERSION );
		wp_register_style( 'rt-slick-theme-style', __RT_ASSETS_URL . 'css/slick-theme.css', array(), __RT_SLICK_VERSION );
		wp_register_style( 'rt-style', __RT_ASSETS_URL . 'css/rt-style.css', array(), __RT_VERSION );
	}
}

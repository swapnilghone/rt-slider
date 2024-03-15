<?php
/**
 * Rt Slider Shortocdes class
 *
 * @package rt-slider
 */

namespace RT\Slider\inc;

/**
 * Class RT_Shortcodes.
 */
class RT_Shortcodes {

	/**
	 * RT_Shortcodes constructor.
	 * Init shortcodes.
	 */
	public function __construct() {
		add_shortcode( 'rt-slider', array( $this, 'rt_slide_callback' ) );
	}

	/**
	 * Output rt-slider shortcode definition
	 *
	 * @return string
	 */
	public function rt_slide_callback(): string {

		wp_enqueue_script( 'rt-slick-script' );
		wp_enqueue_script( 'rt-script' );

		wp_enqueue_style( 'rt-slick-style' );
		wp_enqueue_style( 'rt-slick-theme-style' );
		wp_enqueue_style( 'rt-style' );

		ob_start();
		$rt_slider = get_option( '__rt_slider' );
		if ( ! empty( $rt_slider ) ) {
			include __RT_TEMPLATE_PATH . 'shortcodes/rt-slider.php';
		}
		$output = ob_get_contents();

		ob_end_clean();

		return $output;
	}
}

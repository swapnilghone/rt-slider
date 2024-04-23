<?php
/**
 * Base class for plugin's auto loaders.
 *
 * @package rt-slider
 */

namespace RT\Slider\inc;

use WP_CLI;

/**
 * Class RT_CLI.
 */
class RT_CLI {


	public const OPTION_KEY = '__rt_slider';

	/**
	 * Set Slider Options
	 *
	 * ## options
	 *
	 * [--autoplay[=<autoplay>]]
	 * : Sets the Slider autoplay option.
	 * ---
	 * default: on
	 * options:
	 *   - on
	 *   - off
	 * ---
	 *
	 * [--infinite[=<infinite>]]
	 * : Sets the Slider infinite loop option.
	 * ---
	 * default: on
	 * options:
	 *   - on
	 *   - off
	 * ---
	 *
	 * [--speed[=<speed>]]
	 * : Sets the Slider Speed.
	 *
	 * [--width[=<width>]]
	 * : Sets the Slider width.
	 *
	 * [--height[=<height>]]
	 * : Sets the Slider height.
	 *
	 * [--arrows[=<arrows>]]
	 * : Sets the Slider arrows option to show or hide.
	 * ---
	 * default: on
	 * options:
	 *   - on
	 *   - off
	 * ---
	 *
	 * [--arrows_theme[=<arrows_theme>]]
	 * : Sets the Slider arrows theme.
	 * ---
	 * default: light
	 * options:
	 *   - light
	 *   - dark
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     # Set Slide Speed.
	 *     $ wp rts set_options --speed=500
	 *
	 * @param array $args Positional arguments to include when calling the command.
	 * @param array $options Associative arguments to include when calling the command.
	 *
	 * @return void
	 */
	public function set_options( array $args, array $options ): void {

		if ( empty( $options ) ) {
			WP_CLI::line( 'usage: wp rts set_options --help' );
			WP_CLI::error( 'At least one of the parameter is required.' );
		}

		$rt_options = get_option( self::OPTION_KEY );
		$settings   = $rt_options['settings'] ?? array();

		$valid_options = array( 'autoplay', 'infinite', 'speed', 'width', 'height', 'arrows', 'arrows_theme' );

		foreach ( $options as $key => $val ) {

			$this->validate_args( $key, $val );

			$settings[ $key ] = $val;
		}

		$rt_options['settings'] = $settings;

		$is_updated = update_option( self::OPTION_KEY, $rt_options );

		if ( $is_updated ) {
			WP_CLI::success( 'Slider Option Updated!' );
		} else {
			WP_CLI::warning( 'settings not Updated!' );
		}
	}

	/**
	 * Validates the command arguments
	 *
	 * @param string $key - argument key.
	 * @param string $val - argument value.
	 */
	public function validate_args( string $key, string $val ): void {

		if ( in_array( $key, array( 'autoplay', 'infinite', 'arrows' ), true ) && ! in_array( $val, array( 'on', 'off' ), true ) ) {
			WP_CLI::error( 'Invalid value for ' . $key . '. Please use either "on" or "off".' );
		}

		if ( in_array( $key, array( 'speed', 'width', 'height' ), true ) && ! is_numeric( $val ) ) {
			WP_CLI::error( 'Invalid value for ' . $key . '. value should be valid number.' );
		}

		if ( 'arrows_theme' === $key && ! in_array( $val, array( 'light', 'dark' ), true ) ) {
			WP_CLI::error( 'Invalid value for arrows_theme. Please use either "light" or "dark".' );
		}
	}
}


if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command( 'rts', 'RT\Slider\inc\RT_CLI' );
}

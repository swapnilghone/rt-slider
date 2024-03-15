<?php
/**
 * Base class for slider admin options.
 *
 * @package rt-slider
 */

namespace RT\Slider\inc;

/**
 * RT_Admin class.
 */
class RT_Admin {

	public const OPTION_KEY = '__rt_slider';

	/**
	 * RT_Shortcodes constructor.
	 * Init admin hooks.
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'register_slider_settings_page' ) );
		add_action( 'admin_init', array( $this, 'register_slider_settings' ) );
	}

	/**
	 * Register Slider settings page menu.
	 */
	public function register_slider_settings_page(): void {
		add_menu_page(
			__( 'Rt Slider', 'rt-slider' ),
			__( 'Rt Slider', 'rt-slider' ),
			'manage_options',
			'rt-slider',
			array( $this, 'slider_settings_page' ),
			'dashicons-art'
		);
	}

	/**
	 * Register Slider admin settings page.
	 */
	public function slider_settings_page(): void {

		// check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

        // phpcs:ignore WordPress.Security.NonceVerification.Recommended,
		if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error( 'rt-slider', 'rt_slider_message', __( 'Settings Saved', 'rt-slider' ), 'updated' );
		}

		// show error/update messages.
		settings_errors( 'rt-slider' );

		include __RT_TEMPLATE_PATH . 'admin/slider-section.php';
	}

	/**
	 * Register Slider settings,sections and fileds.
	 */
	public function register_slider_settings(): void {

		// Register a new setting for "rt-slider" page.
		register_setting(
			'rt-slider',
			self::OPTION_KEY,
			array(
				'type'              => 'array',
				'sanitize_callback' => array( $this, 'sanitize_option' ),
			)
		);

		// Register a new section in the "rt-slider" page.
		add_settings_section(
			'rt_slider_image_section',
			__( 'Slider Images', 'rt-slider' ),
			array( $this, 'image_section_description' ),
			'rt-slider'
		);

		add_settings_section(
			'rt_slider_settings_section',
			__( 'Settings', 'rt-slider' ),
			null,
			'rt-slider'
		);

		add_settings_field(
			'rt_slider_images',
			__( 'Upload Image', 'rt-slider' ),
			array( $this, 'render_image_box' ),
			'rt-slider',
			'rt_slider_image_section',
		);

		add_settings_field(
			'rt_slider_autoplay_settings',
			__( 'Autoplay', 'rt-slider' ),
			array( $this, 'render_settings_field' ),
			'rt-slider',
			'rt_slider_settings_section',
			array(
				'name'        => 'autoplay',
				'type'        => 'checkbox',
				'description' => 'click to enable autoplay',
			)
		);

		add_settings_field(
			'rt_slider_infinite_settings',
			__( 'Infinite Loop', 'rt-slider' ),
			array( $this, 'render_settings_field' ),
			'rt-slider',
			'rt_slider_settings_section',
			array(
				'name'        => 'infinite',
				'type'        => 'checkbox',
				'description' => 'click to enable infinite loop',
			)
		);

		add_settings_field(
			'rt_slider_speed_settings',
			__( 'Slider Speed', 'rt-slider' ),
			array( $this, 'render_settings_field' ),
			'rt-slider',
			'rt_slider_settings_section',
			array(
				'name'        => 'speed',
				'type'        => 'number',
				'description' => 'MS',
			)
		);

		add_settings_field(
			'rt_slider_width_settings',
			__( 'Slider Width', 'rt-slider' ),
			array( $this, 'render_settings_field' ),
			'rt-slider',
			'rt_slider_settings_section',
			array(
				'name'        => 'width',
				'type'        => 'number',
				'description' => 'PX',
			)
		);

		add_settings_field(
			'rt_slider_height_settings',
			__( 'Slider Height', 'rt-slider' ),
			array( $this, 'render_settings_field' ),
			'rt-slider',
			'rt_slider_settings_section',
			array(
				'name'        => 'height',
				'type'        => 'number',
				'description' => 'PX',
			)
		);

		add_settings_field(
			'rt_slider_arrow_settings',
			__( 'Show Arrow', 'rt-slider' ),
			array( $this, 'render_settings_field' ),
			'rt-slider',
			'rt_slider_settings_section',
			array(
				'name'        => 'arrows',
				'type'        => 'checkbox',
				'description' => 'click to enable navigation arrows',
			)
		);

		add_settings_field(
			'rt_slider_arrow_theme_settings',
			__( 'Arrow Theme', 'rt-slider' ),
			array( $this, 'render_settings_field' ),
			'rt-slider',
			'rt_slider_settings_section',
			array(
				'name'    => 'arrows_theme',
				'type'    => 'select',
				'options' => array( 'light', 'dark' ),
			)
		);
	}

	/**
	 * Output the description for settings image section
	 *
	 * @param array $args - section attributes.
	 */
	public function image_section_description( array $args ): void {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_attr_e( 'Copy and paste this shortcode into your posts or pages', 'rt-slider' ); ?></p>
		<div class="rt-shotcode-wrap">[rt-slider]</div>
		<?php
	}

	/**
	 * Renders the image settings section
	 */
	public function render_image_box(): void {
		$slider_images = get_option( self::OPTION_KEY );
		$images        = isset( $slider_images['images'] ) ? $slider_images['images'] : array();
		include __RT_TEMPLATE_PATH . 'admin/image-field.php';
	}

	/**
	 * Sanitize the settings field before saving to database
	 *
	 * @param array $options - settings array.
	 * @return array $options - sanatize settings array
	 */
	public function sanitize_option( array $options ): array {

		if ( isset( $options['images'] ) ) {
			$options['images'] = array_map( 'esc_attr', $options['images'] );
		}

		if ( isset( $options['settings'] ) ) {

			// unset the blank values before saving.
			$options['settings'] = array_filter(
				$options['settings'],
				function ( $val ) {
					return '' !== $val;
				}
			);

			$options['settings'] = array_map( 'esc_attr', $options['settings'] );
		}

		return $options;
	}

	/**
	 * Remders the settings field
	 *
	 * @param array $args - field options.
	 */
	public function render_settings_field( array $args ): void {

		$field_name    = isset( $args['name'] ) ? $args['name'] : '';
		$field_type    = isset( $args['type'] ) ? $args['type'] : 'text';
		$field_desc    = isset( $args['description'] ) ? $args['description'] : '';
		$field_options = isset( $args['options'] ) ? $args['options'] : array();

		$options     = get_option( self::OPTION_KEY );
		$settings    = isset( $options['settings'] ) ? $options['settings'] : array();
		$field_value = isset( $settings[ $field_name ] ) ? $settings[ $field_name ] : '';

		switch ( $field_type ) {
			case 'checkbox':
				include __RT_TEMPLATE_PATH . 'admin/checkbox-field.php';
				break;
			case 'select':
				include __RT_TEMPLATE_PATH . 'admin/select-field.php';
				break;
			default:
				include __RT_TEMPLATE_PATH . 'admin/default-field.php';
				break;
		}
	}
}
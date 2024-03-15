<?php
/**
 * Testing class for RT_Admin class.
 *
 * @package rt-slider
 */

/**
 * Class RT_Admin_Test
 */
class RT_Admin_Test extends WP_UnitTestCase {

	/**
	 * Initial setup for the test.
	 */
	public function setUp(): void {
		parent::setUp();
		wp_set_current_user(
			self::factory()->user->create(
				array(
					'role' => 'administrator',
				)
			)
		);
	}

	/**
	 * Constructor test
	 */
	public function test_construct() {

		$rt_admin = new RT\Slider\inc\RT_Admin();

		$this->assertEquals(
			10,
			has_action(
				'admin_menu',
				array( $rt_admin, 'register_slider_settings_page' )
			),
			'Failed to assert that admin menu is not registered.'
		);

		$this->assertEquals(
			10,
			has_action(
				'admin_init',
				array( $rt_admin, 'register_slider_settings' )
			),
			'Failed to assert that rt section is not registered.'
		);
	}

	/**
	 * Testing slider settings menu register
	 */
	public function test_register_slider_settings_page() {
		$rt_admin = new RT\Slider\inc\RT_Admin();
		$rt_admin->register_slider_settings_page();
		$this->assertNotEmpty( menu_page_url( 'rt-slider', false ), 'Failed to assert that rt slider menu is not registered.' );
	}

	/**
	 * Testing slider settings sections register
	 */
	public function test_register_slider_settings() {

		global $wp_registered_settings, $wp_settings_sections, $wp_settings_fields;
		$wp_registered_settings = array();

		$rt_admin = new RT\Slider\inc\RT_Admin();
		$rt_admin->register_slider_settings();

		// Check if the setting is registered.
		$this->assertTrue( isset( $wp_registered_settings['__rt_slider'] ), 'Slider Setting not registered' );

		// Check if the settings sections is registered.
		$this->assertTrue( isset( $wp_settings_sections['rt-slider']['rt_slider_image_section'] ), 'Slider image section not registered' );

		$this->assertTrue( isset( $wp_settings_sections['rt-slider']['rt_slider_settings_section'] ), 'Slider settings section not registered' );

		// Check if settings field is registered.
		$this->assertTrue( isset( $wp_settings_fields['rt-slider']['rt_slider_image_section']['rt_slider_images'] ), 'Slider image field not registered' );

		$this->assertTrue( isset( $wp_settings_fields['rt-slider']['rt_slider_settings_section']['rt_slider_autoplay_settings'] ), 'Slider settings autoplay field not registered' );
	}
}

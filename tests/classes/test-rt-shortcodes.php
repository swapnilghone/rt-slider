<?php
/**
 * Testing class for RT_Shortcodes class.
 *
 * @package Rt_Slider
 */

/**
 * Class RT_Shortcodes_Test
 */
class RT_Shortcodes_Test extends WP_UnitTestCase {

	/**
	 * Shortcode tag
	 *
	 * @var string
	 */
	public $shortcode_tag = 'rt-slider';

	/**
	 * Constructor test
	 * check if shortcode is registered
	 */
	public function test_construct() {

		new RT\Slider\inc\RT_Shortcodes();

		// Check if the shortcode is registered.
		$this->assertTrue(
			shortcode_exists( $this->shortcode_tag ),
			'rt-slider Shortcode not registered'
		);
	}


	/**
	 * Testing the shortcode callback
	 * checks if shortcode returns valid html
	 */
	public function test_rt_slide_callback() {

		$rt_shortcodes = new RT\Slider\inc\RT_Shortcodes();

		add_shortcode( $this->shortcode_tag, array( $rt_shortcodes, 'rt_slide_callback' ) );

		// Create a post with the shortcode.
		$post_id = $this->factory->post->create(
			array(
				'post_content' => do_shortcode( '[' . $this->shortcode_tag . ']' ),
			)
		);

		// Get the post content.
		$post = get_post( $post_id );

		$this->assertEquals(
			do_shortcode( '[' . $this->shortcode_tag . ']' ),
			apply_filters( 'the_content', $post->post_content ),
			'Failed to assert the shortcode output does not match.'
		);
	}
}

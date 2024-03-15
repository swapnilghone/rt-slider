<?php
/**
 * Slider template for shortcode rt-slider
 *
 * @package rt-slider
 */

if ( ! empty( $rt_slider['images'] ) ) {
	$width  = ! empty( $rt_slider['settings']['width'] ) ? $rt_slider['settings']['width'] . 'px' : '1200px';
	$height = ! empty( $rt_slider['settings']['height'] ) ? $rt_slider['settings']['height'] . 'px' : '600px';

	$theme = ! empty( $rt_slider['settings']['arrows_theme'] ) ? $rt_slider['settings']['arrows_theme'] : 'light';

	printf( '<div class="rt-slider %s" style="width:%s;height:%s">', esc_attr( $theme ), esc_attr( $width ), esc_attr( $height ) );

	foreach ( $rt_slider['images'] as $image_id ) {
		$image_url = wp_get_attachment_image_src( $image_id, 'full' );
		?>
			<div>
				<img src="<?php echo esc_url( $image_url[0] ); ?>" />
			</div>
		<?php
	}

	echo '</div>';
}

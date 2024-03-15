<?php
/**
 * Admin settings image filed
 *
 * @package rt-slider
 */

?>
<button class="button" id="rt_add_slider">
	<span class="dashicons dashicons-plus-alt"></span>
	<?php esc_html_e( 'Add Slide', 'rt-slider' ); ?>
</button>
<p class="image-note">
<?php esc_html_e( '* You can drag images to rearrange them.', 'rt-slider' ); ?>
</p>
<div class="rt-image-section">
	<?php
	if ( ! empty( $images ) ) :
		foreach ( $images as $image_id ) :
			$image_url = wp_get_attachment_image_src( $image_id, 'thumbnail' );
			?>
			<div class="rt-image-wrap">
				<div class="rt-image-inner-wrap">
				<img src="<?php echo esc_url( $image_url[0] ); ?>">
				<input type="hidden" name="__rt_slider[images][]" value="<?php echo esc_attr( $image_id ); ?>">
				<button class="rt-remove-image"><span class="dashicons dashicons-trash"></span></button>
				</div>
			</div>
			<?php
		endforeach;
	endif;
	?>
</div>
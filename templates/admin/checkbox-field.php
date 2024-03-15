<?php
/**
 * Admin settings checkbox filed
 *
 * @package rt-slider
 */

?>
<label for="<?php echo esc_attr( $field_name ); ?>">
	<input <?php checked( $field_value, 'on' ); ?> id="<?php echo esc_attr( $field_name ); ?>" name="<?php echo esc_attr( '__rt_slider[settings][' . $field_name . ']' ); ?>" type="checkbox" />
	<?php if ( ! empty( $field_desc ) ) : ?>
		<span><em><?php echo wp_kses_post( $field_desc ); ?></em></span>
	<?php endif; ?>
</label>
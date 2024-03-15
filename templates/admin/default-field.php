<?php
/**
 * Admin settings default input filed
 *
 * @package rt-slider
 */

?>
<input type="<?php echo esc_attr( $field_type ); ?>" name="<?php echo esc_attr( '__rt_slider[settings][' . $field_name . ']' ); ?>" value="<?php echo esc_attr( $field_value ); ?>" />
<?php if ( ! empty( $field_desc ) ) : ?>
	<span><em><?php echo wp_kses_post( $field_desc ); ?></em></span>
<?php endif; ?>
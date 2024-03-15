<?php
/**
 * Admin settings select filed
 *
 * @package rt-slider
 */

?>
<select name="<?php echo esc_attr( '__rt_slider[settings][' . $field_name . ']' ); ?>">
	<?php
	foreach ( $field_options as $option ) {
		printf( '<option value="%1$s" %2$s>%1$s</option>', esc_attr( $option ), selected( $field_value, $option ) );
	}
	?>
</select>
<?php if ( ! empty( $field_desc ) ) : ?>
	<span><em><?php echo wp_kses_post( $field_desc ); ?></em></span>
<?php endif; ?>
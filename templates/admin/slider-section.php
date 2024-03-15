<?php
/**
 * Slider admin settings section
 *
 * @package rt-slider
 */

?>
<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form action="options.php" method="post">
		<?php
		// output security fields for the registered setting "rt-slider".
		settings_fields( 'rt-slider' );
		// output setting sections and their fields.
		do_settings_sections( 'rt-slider' );
		// output save settings button.
		submit_button( 'Save Settings', 'primary button-hero' );
		?>
	</form>
</div>
<?php
/**
 * Provide a admin area view for the plugin
 *
 * @link       https://buddydevelopers.com
 * @since      1.0.0
 *
 * @package    Geobuddy
 * @subpackage Geobuddy/admin/partials
 */

$active_tab = filter_input( INPUT_GET, 'tab' ) ? filter_input( INPUT_GET, 'tab' ) : 'general';
?>

<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<h2 class="nav-tab-wrapper">
		<a href="?page=geobuddy&tab=general" class="nav-tab <?php echo 'general' === $active_tab ? 'nav-tab-active' : ''; ?>">
			<?php esc_html_e( 'General', 'geobuddy' ); ?>
		</a>
		<a href="?page=geobuddy&tab=stepwise-form" class="nav-tab <?php echo 'stepwise-form' === $active_tab ? 'nav-tab-active' : ''; ?>">
			<?php esc_html_e( 'Stepwise Form', 'geobuddy' ); ?>
		</a>
	</h2>

	<div class="tab-content">
		<?php if ( 'general' === $active_tab ) { ?>
			<div class="general-settings">
				<form method="post" action="options.php">
					<?php
					do_action( 'geobuddy_general_setting_form_before_form_fields' );
					settings_fields( 'geobuddy_options' );
					do_settings_sections( 'geobuddy' );
					do_action( 'geobuddy_general_setting_form_after_form_fields' );
					submit_button();
					?>
				</form>
			</div>
		<?php } elseif ( 'stepwise-form' === $active_tab ) { ?>
			<div class="general-settings">
				<form method="post" action="options.php">
					<?php
					do_action( 'geobuddy_stepwise_form_setting_before_form_fields' );
					settings_fields( 'geobuddy_options' );
					do_settings_sections( 'geobuddy_stepwise_form' );
					do_action( 'geobuddy_stepwise_form_setting_after_form_fields' );
					submit_button();
					?>
				</form>
			</div>
		<?php } ?>
	</div>
</div>

<style>
.form-table th {
	width: 250px;
}
.form-table td label {
	display: flex;
	align-items: center;
	gap: 8px;
}
.geobuddy-settings-section {
	background: #fff;
	padding: 20px;
	margin: 20px 0;
	border: 1px solid #ccd0d4;
}
</style>

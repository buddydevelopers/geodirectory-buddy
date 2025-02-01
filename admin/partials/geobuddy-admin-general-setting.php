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
<div class="geobuddy-admin-welcome-page wrap">
    <h2 style="display: none;"><?php echo esc_html__('Geo', 'geobuddy'); ?><span><?php echo esc_html__('Buddy', 'geobuddy'); ?></span></h2>
    <div class="geobuddy-admin-header">
        <div class="geobuddy-admin-logo">
            <h3><?php echo esc_html__('Geo', 'geobuddy'); ?><span><?php echo esc_html__('Buddy', 'geobuddy'); ?></span></h3>
        </div>
        <div class="geobuddy-admin-user-name">
           <span><?php echo esc_html( geobuddy_get_user_greeting() ); ?></span>
        </div>
        <div class="geobuddy-admin-help-btn">
           <a href="#" target="_blank" class="geobuddy-admin-help-link"><?php echo esc_html__('Need Help', 'geobuddy'); ?></a>
        </div>
    </div>
    <div class="geobuddy-admin-container">
        <div class="geobuddy-admin-sidebar">
            <ul>
                <li><a href="<?php echo esc_url( get_site_url() . '/wp-admin/admin.php?page=geobuddy' ); ?>" class="<?php echo (is_admin() && $_GET['page'] == 'geobuddy') ? 'active' : ''; ?>"><?php echo esc_html__('Welcome', 'geobuddy'); ?></a></li>
                <li><a href="<?php echo esc_url( get_site_url() . '/wp-admin/admin.php?page=geobuddy-setting' ); ?>" class="<?php echo (is_admin() && $_GET['page'] == 'geobuddy-setting' && empty($_GET['tab']) ) ? 'active' : ''; ?>"><?php echo esc_html__('General', 'geobuddy'); ?></a></li>
                <li><a href="<?php echo esc_url( get_site_url() . '/wp-admin/admin.php?page=geobuddy-setting&tab=stepwise-form' ); ?>" class="<?php echo (is_admin() && $_GET['page'] == 'geobuddy-setting' && !empty($_GET['tab']) && $_GET['tab'] == 'stepwise-form') ? 'active' : ''; ?>"><?php echo esc_html__('Stepwise Form', 'geobuddy'); ?></a></li>
                <?php if ( geobuddy_check_gd_announcement_bar_exists() ) : ?>
                    <li>
                        <a href="?page=geobuddy&tab=announcement-bar" class="<?php echo 'announcement-bar' === $active_tab ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Announcement Bar', 'geobuddy' ); ?>
                        </a>
                    </li>
		        <?php endif; ?>   
            </ul>
        </div>
        <div class="geobuddy-admin-sidebar-content-wrapper">
            <div class="geobuddy-admin-main-content">
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
                <?php } elseif ( 'announcement-bar' === $active_tab ) { ?>
                    <div class="general-settings">
                        <form method="post" action="options.php">
                            <?php
                            do_action( 'geobuddy_announcement_bar_setting_before_form_fields' );
                            settings_fields( 'geobuddy_options' );
                            do_settings_sections( 'message_announcement_setting_text' );
                            do_action( 'geobuddy_announcement_bar_setting_after_form_fields' );
                            submit_button();
                            ?>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
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

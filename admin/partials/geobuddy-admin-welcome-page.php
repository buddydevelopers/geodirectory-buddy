<?php
/**
 * Provide a admin welcome area view for the plugin
 *
 * @link       https://buddydevelopers.com
 * @since      1.0.0
 *
 * @package    Geobuddy
 * @subpackage Geobuddy/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="geobuddy-admin-welcome-page wrap">
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
                <li><a href="<?php echo esc_url( get_site_url() . '/wp-admin/admin.php?page=geobuddy-setting' ); ?>" class="<?php echo (is_admin() && $_GET['page'] == 'geobuddy-setting') ? 'active' : ''; ?>"><?php echo esc_html__('Settings', 'geobuddy'); ?></a></li>
                <li><a href="<?php echo esc_url( get_site_url() . '/wp-admin/admin.php?page=geobuddy&tab=stepwise-form' ); ?>" class="<?php echo (is_admin() && $_GET['page'] == 'geobuddy' && isset($_GET['tab']) && $_GET['tab'] == 'stepwise-form') ? 'active' : ''; ?>"><?php echo esc_html__('Stepwise Form', 'geobuddy'); ?></a></li>
            </ul>
        </div>
        <div class="geobuddy-admin-sidebar-content-wrapper">
            <div class="geobuddy-admin-main-content">
                <h2><?php echo esc_html__('Welcome', 'geobuddy'); ?></h2>
                <div class="geobuddy-admin-welcome-grid">
                    <div class="geobuddy-admin-welcome-card">
                        <div class="geobuddy-admin-welcome-card-icon" aria-hidden="true">📄</div>
                        <div class="geobuddy-admin-welcome-card-title"><?php echo esc_html__('Documentation', 'geobuddy'); ?></div>
                        <div class="geobuddy-admin-welcome-card-description"><?php echo esc_html__('Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Donec At Ipsum Quis Ex Commodo Consectetur.', 'geobuddy'); ?></div>
                        <a href="#" target="_blank" class="geobuddy-admin-welcome-card-button"><?php echo esc_html__('View Document', 'geobuddy'); ?></a>
                    </div>
                    <div class="geobuddy-admin-welcome-card">
                        <div class="geobuddy-admin-welcome-card-icon" aria-hidden="true">🐞</div>
                        <div class="geobuddy-admin-welcome-card-title"><?php echo esc_html__('Contribute To GeoBuddy', 'geobuddy'); ?></div>
                        <div class="geobuddy-admin-welcome-card-description"><?php echo esc_html__('Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Donec At Ipsum Quis Ex Commodo Consectetur.', 'geobuddy'); ?></div>
                        <a href="#" target="_blank" class="geobuddy-admin-welcome-card-button"><?php echo esc_html__('Report A Bug', 'geobuddy'); ?></a>
                    </div>
                    <div class="geobuddy-admin-welcome-card">
                        <div class="geobuddy-admin-welcome-card-icon" aria-hidden="true">📩</div>
                        <div class="geobuddy-admin-welcome-card-title"><?php echo esc_html__('Need Help?', 'geobuddy'); ?></div>
                        <div class="geobuddy-admin-welcome-card-description"><?php echo esc_html__('Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Donec At Ipsum Quis Ex Commodo Consectetur.', 'geobuddy'); ?></div>
                        <a href="#" target="_blank" class="geobuddy-admin-welcome-card-button"><?php echo esc_html__('Submit A Ticket', 'geobuddy'); ?></a>
                    </div>
                    <div class="geobuddy-admin-welcome-card">
                        <div class="geobuddy-admin-welcome-card-icon" aria-hidden="true">👥</div>
                        <div class="geobuddy-admin-welcome-card-title"><?php echo esc_html__('Join The Community', 'geobuddy'); ?></div>
                        <div class="geobuddy-admin-welcome-card-description"><?php echo esc_html__('Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Donec At Ipsum Quis Ex Commodo Consectetur.', 'geobuddy'); ?></div>
                        <a href="#" target="_blank" class="geobuddy-admin-welcome-card-button"><?php echo esc_html__('Join Facebook Community', 'geobuddy'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
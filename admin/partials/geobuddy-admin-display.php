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

$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <h2 class="nav-tab-wrapper">
        <a href="?page=geobuddy&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">
            <?php _e('General', 'geobuddy'); ?>
        </a>
        <a href="?page=geobuddy&tab=map" class="nav-tab <?php echo $active_tab == 'map' ? 'nav-tab-active' : ''; ?>">
            <?php _e('Map', 'geobuddy'); ?>
        </a>
    </h2>

    <div class="tab-content">
        <?php if ($active_tab == 'general'): ?>
            <div class="general-settings">
                <form method="post" action="options.php">
                    <?php
                    settings_fields('geobuddy_options');
                    do_settings_sections('geobuddy');
                    submit_button();
                    ?>
                </form>
            </div>
        <?php else: ?>
            <div class="map-settings">
                <p>Map Settings Content</p>
            </div>
        <?php endif; ?>
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

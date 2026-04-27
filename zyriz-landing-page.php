<?php
/**
 * Plugin Name: Zyriz Luxury Landing Page
 * Plugin URI:  https://zyriz.com
 * Description: A premium, mobile-first ecommerce landing page for Zyriz gold-plated earrings with WhatsApp ordering and a full admin control panel.
 * Version:     2.0.0
 * Author:      Zyriz
 * Text Domain: zyriz
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ─────────────────────────────────────────────
 * Constants
 * ───────────────────────────────────────────── */
define( 'ZYRIZ_PATH', plugin_dir_path( __FILE__ ) );
define( 'ZYRIZ_URL',  plugin_dir_url( __FILE__ ) );
define( 'ZYRIZ_VER',  '2.0.0' );

/* ─────────────────────────────────────────────
 * Load Dependencies
 * ───────────────────────────────────────────── */
require_once ZYRIZ_PATH . 'admin/class-zyriz-settings.php';
require_once ZYRIZ_PATH . 'admin/class-zyriz-cpt.php';
require_once ZYRIZ_PATH . 'includes/class-zyriz-dynamic-css.php';
require_once ZYRIZ_PATH . 'includes/class-zyriz-frontend.php';

// Admin files
if ( is_admin() ) {
    require_once ZYRIZ_PATH . 'admin/class-zyriz-admin.php';
}

// REST API file (must be loaded on REST requests, which are not is_admin())
require_once ZYRIZ_PATH . 'admin/class-zyriz-rest-api.php';

/* ─────────────────────────────────────────────
 * Activation & Deactivation
 * ───────────────────────────────────────────── */
register_activation_hook( __FILE__, array( 'Zyriz_Settings', 'activate' ) );

register_deactivation_hook( __FILE__, function () {
    flush_rewrite_rules();
} );

/* ─────────────────────────────────────────────
 * Initialize Components
 * ───────────────────────────────────────────── */
function zyriz_init() {
    // Custom Post Types (always loaded — needed for REST and frontend queries)
    Zyriz_CPT::init();

    // Frontend rendering
    Zyriz_Frontend::init();

    // Admin (only in wp-admin)
    if ( is_admin() ) {
        Zyriz_Admin::init();
    }

    // REST API (loaded on rest_api_init, but we register routes via class init)
    Zyriz_REST_API::init();
}
add_action( 'plugins_loaded', 'zyriz_init' );

/* ─────────────────────────────────────────────
 * Shortcode: [zyriz_landing]
 * ───────────────────────────────────────────── */
function zyriz_landing_shortcode() {
    ob_start();
    if ( file_exists( ZYRIZ_PATH . 'templates/landing-page.php' ) ) {
        include ZYRIZ_PATH . 'templates/landing-page.php';
    }
    return ob_get_clean();
}
add_shortcode( 'zyriz_landing', 'zyriz_landing_shortcode' );

/* ─────────────────────────────────────────────
 * Re-run activation seed if CPTs aren't registered yet
 * This handles the case where the plugin is first activated
 * before CPTs are registered.
 * ───────────────────────────────────────────── */
function zyriz_maybe_seed() {
    if ( get_option( 'zyriz_db_version' ) !== ZYRIZ_VER ) {
        // Ensure CPTs are registered before seeding
        Zyriz_CPT::register_post_types();
        Zyriz_CPT::register_taxonomies();
        Zyriz_Settings::activate();
    }
}
add_action( 'init', 'zyriz_maybe_seed', 20 );

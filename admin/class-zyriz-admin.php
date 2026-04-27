<?php
/**
 * Zyriz Admin
 *
 * Registers admin menu, admin page, and enqueues
 * admin-only assets on the plugin's editor page.
 *
 * @package Zyriz
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Zyriz_Admin {

    /** Admin page hook suffix  */
    private static $hook = '';

    /**
     * Initialize admin hooks
     */
    public static function init() {
        add_action( 'admin_menu',            array( __CLASS__, 'register_menu' ) );
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
        add_action( 'admin_bar_menu',        array( __CLASS__, 'admin_bar_link' ), 100 );
    }

    /* ─────────────────────────────────────────────
     * Register top-level admin menu
     * ───────────────────────────────────────────── */
    public static function register_menu() {

        // Custom SVG icon (gold diamond)
        $icon_svg = 'data:image/svg+xml;base64,' . base64_encode(
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="12,2 22,8.5 12,22 2,8.5"/>
                <line x1="2" y1="8.5" x2="22" y2="8.5"/>
                <line x1="12" y1="2" x2="7" y2="8.5"/>
                <line x1="12" y1="2" x2="17" y2="8.5"/>
                <line x1="7" y1="8.5" x2="12" y2="22"/>
                <line x1="17" y1="8.5" x2="12" y2="22"/>
            </svg>'
        );

        self::$hook = add_menu_page(
            __( 'Zyriz Editor', 'zyriz' ),
            __( 'Zyriz', 'zyriz' ),
            'edit_pages',                     // Admins + Editors
            'zyriz-editor',
            array( __CLASS__, 'render_page' ),
            $icon_svg,
            30
        );

        // Sub-menu: Editor (same page)
        add_submenu_page(
            'zyriz-editor',
            __( 'Editor', 'zyriz' ),
            __( 'Editor', 'zyriz' ),
            'edit_pages',
            'zyriz-editor',
            array( __CLASS__, 'render_page' )
        );

        // Sub-menu: jump directly to Products panel
        add_submenu_page(
            'zyriz-editor',
            __( 'Products', 'zyriz' ),
            __( 'Products', 'zyriz' ),
            'edit_pages',
            'zyriz-editor#products',
            array( __CLASS__, 'render_panel_redirect' )
        );

        // Sub-menu: jump directly to Testimonials panel
        add_submenu_page(
            'zyriz-editor',
            __( 'Testimonials', 'zyriz' ),
            __( 'Testimonials', 'zyriz' ),
            'edit_pages',
            'zyriz-editor#testimonials',
            array( __CLASS__, 'render_panel_redirect' )
        );

        // Sub-menu: jump directly to FAQs panel
        add_submenu_page(
            'zyriz-editor',
            __( 'FAQs', 'zyriz' ),
            __( 'FAQs', 'zyriz' ),
            'edit_pages',
            'zyriz-editor#faqs',
            array( __CLASS__, 'render_panel_redirect' )
        );
    }

    /* ─────────────────────────────────────────────
     * Render the admin page
     * ───────────────────────────────────────────── */
    public static function render_page() {
        // Double-check capability
        if ( ! current_user_can( 'edit_pages' ) ) {
            wp_die( esc_html__( 'You do not have sufficient permissions.', 'zyriz' ) );
        }

        include ZYRIZ_PATH . 'admin/views/admin-page.php';
    }

    /**
     * Sub-menu redirect: send user to the main editor with a hash for the panel.
     * Called when they click Products / Testimonials / FAQs in the WP sidebar.
     */
    public static function render_panel_redirect() {
        // Extract the panel name from the page slug
        $page  = isset( $_GET['page'] ) ? sanitize_key( $_GET['page'] ) : '';
        $panel = str_replace( 'zyriz-editor#', '', $page );
        $url   = admin_url( 'admin.php?page=zyriz-editor' );
        ?>
        <script>
        window.location.href = <?php echo wp_json_encode( $url ); ?> + '#panel=' + <?php echo wp_json_encode( $panel ); ?>;
        </script>
        <?php
    }

    /* ─────────────────────────────────────────────
     * Enqueue admin assets (only on our page)
     * ───────────────────────────────────────────── */
    public static function enqueue_assets( $hook ) {
        if ( $hook !== self::$hook ) {
            return;
        }

        // Google Fonts for the admin UI
        wp_enqueue_style(
            'zyriz-admin-fonts',
            'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap',
            array(),
            null
        );

        // Admin stylesheet
        wp_enqueue_style(
            'zyriz-admin-css',
            ZYRIZ_URL . 'assets/css/admin.css',
            array(),
            ZYRIZ_VER
        );

        // WordPress media uploader
        wp_enqueue_media();

        // WordPress color picker
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );

        // Sortable for drag and drop
        wp_enqueue_script( 'jquery-ui-sortable' );

        // Admin script
        wp_enqueue_script(
            'zyriz-admin-js',
            ZYRIZ_URL . 'assets/js/admin.js',
            array( 'jquery', 'wp-color-picker', 'jquery-ui-sortable' ),
            ZYRIZ_VER,
            true
        );

        // Pass data to JS
        wp_localize_script( 'zyriz-admin-js', 'ZyrizAdmin', array(
            'restBase'    => esc_url_raw( rest_url( 'zyriz/v1/' ) ),
            'nonce'       => wp_create_nonce( 'wp_rest' ),
            'pluginUrl'   => ZYRIZ_URL,
            'siteUrl'     => home_url( '/' ),
            'previewUrl'  => self::get_landing_page_url(),
            'adminUrl'    => admin_url(),
            'version'     => ZYRIZ_VER,
        ) );

        // Remove admin footer text on our page for clean fullscreen experience
        add_filter( 'admin_footer_text', '__return_empty_string' );
        add_filter( 'update_footer',     '__return_empty_string', 99 );
    }

    /**
     * Find the URL of the published page that contains the [zyriz_landing] shortcode.
     * Falls back to the site homepage if no page is found.
     *
     * @return string URL
     */
    private static function get_landing_page_url() {
        // Cache the result to avoid repeated DB queries
        $cached = wp_cache_get( 'zyriz_landing_page_url' );
        if ( $cached !== false ) {
            return $cached;
        }

        global $wpdb;

        // Search for a published page containing our shortcode
        $page_id = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT ID FROM {$wpdb->posts}
                 WHERE post_type = 'page'
                 AND post_status = 'publish'
                 AND post_content LIKE %s
                 LIMIT 1",
                '%[zyriz_landing]%'
            )
        );

        if ( $page_id ) {
            $url = get_permalink( intval( $page_id ) );
        } else {
            // Fallback: use home URL with a preview query param
            $url = add_query_arg( 'zyriz_preview', '1', home_url( '/' ) );
        }

        wp_cache_set( 'zyriz_landing_page_url', $url, '', 300 );
        return esc_url_raw( $url );
    }

    /* ─────────────────────────────────────────────
     * Admin bar quick link
     * ───────────────────────────────────────────── */
    public static function admin_bar_link( $wp_admin_bar ) {
        if ( ! current_user_can( 'edit_pages' ) ) {
            return;
        }

        $wp_admin_bar->add_node( array(
            'id'    => 'zyriz-editor',
            'title' => '✦ Zyriz Editor',
            'href'  => admin_url( 'admin.php?page=zyriz-editor' ),
            'meta'  => array( 'title' => 'Open Zyriz Editor' ),
        ) );
    }
}

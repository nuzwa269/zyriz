<?php
/**
 * Zyriz Custom Post Types
 *
 * Registers products, testimonials, and FAQ custom post types
 * with their taxonomies and meta fields for REST API support.
 *
 * @package Zyriz
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Zyriz_CPT {

    /**
     * Initialize CPT registrations
     */
    public static function init() {
        add_action( 'init', array( __CLASS__, 'register_post_types' ) );
        add_action( 'init', array( __CLASS__, 'register_taxonomies' ) );
        add_action( 'init', array( __CLASS__, 'register_meta_fields' ) );
    }

    /* ─────────────────────────────────────────────
     * Register Custom Post Types
     * ───────────────────────────────────────────── */
    public static function register_post_types() {

        /* ----- Products ----- */
        register_post_type( 'zyriz_product', array(
            'labels' => array(
                'name'               => __( 'Products', 'zyriz' ),
                'singular_name'      => __( 'Product', 'zyriz' ),
                'add_new'            => __( 'Add New Product', 'zyriz' ),
                'add_new_item'       => __( 'Add New Product', 'zyriz' ),
                'edit_item'          => __( 'Edit Product', 'zyriz' ),
                'new_item'           => __( 'New Product', 'zyriz' ),
                'view_item'          => __( 'View Product', 'zyriz' ),
                'search_items'       => __( 'Search Products', 'zyriz' ),
                'not_found'          => __( 'No products found', 'zyriz' ),
                'not_found_in_trash' => __( 'No products found in Trash', 'zyriz' ),
            ),
            'public'              => false,
            'show_ui'             => false,
            'show_in_menu'        => false,
            'show_in_rest'        => true,
            'rest_base'           => 'zyriz-products',
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'has_archive'         => false,
            'rewrite'             => false,
            'menu_icon'           => 'dashicons-cart',
        ) );

        /* ----- Testimonials ----- */
        register_post_type( 'zyriz_testimonial', array(
            'labels' => array(
                'name'               => __( 'Testimonials', 'zyriz' ),
                'singular_name'      => __( 'Testimonial', 'zyriz' ),
                'add_new'            => __( 'Add New Testimonial', 'zyriz' ),
                'add_new_item'       => __( 'Add New Testimonial', 'zyriz' ),
                'edit_item'          => __( 'Edit Testimonial', 'zyriz' ),
            ),
            'public'              => false,
            'show_ui'             => false,
            'show_in_menu'        => false,
            'show_in_rest'        => true,
            'rest_base'           => 'zyriz-testimonials',
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'supports'            => array( 'title', 'editor', 'custom-fields' ),
            'has_archive'         => false,
            'rewrite'             => false,
        ) );

        /* ----- FAQs ----- */
        register_post_type( 'zyriz_faq', array(
            'labels' => array(
                'name'               => __( 'FAQs', 'zyriz' ),
                'singular_name'      => __( 'FAQ', 'zyriz' ),
                'add_new'            => __( 'Add New FAQ', 'zyriz' ),
                'add_new_item'       => __( 'Add New FAQ', 'zyriz' ),
                'edit_item'          => __( 'Edit FAQ', 'zyriz' ),
            ),
            'public'              => false,
            'show_ui'             => false,
            'show_in_menu'        => false,
            'show_in_rest'        => true,
            'rest_base'           => 'zyriz-faqs',
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'supports'            => array( 'title', 'editor', 'custom-fields' ),
            'has_archive'         => false,
            'rewrite'             => false,
        ) );
    }

    /* ─────────────────────────────────────────────
     * Register Taxonomies
     * ───────────────────────────────────────────── */
    public static function register_taxonomies() {

        register_taxonomy( 'zyriz_product_cat', 'zyriz_product', array(
            'labels' => array(
                'name'          => __( 'Product Categories', 'zyriz' ),
                'singular_name' => __( 'Category', 'zyriz' ),
                'add_new_item'  => __( 'Add New Category', 'zyriz' ),
            ),
            'public'            => false,
            'show_in_rest'      => true,
            'rest_base'         => 'zyriz-product-categories',
            'hierarchical'      => true,
            'show_ui'           => false,
            'show_admin_column' => false,
        ) );

        register_taxonomy( 'zyriz_product_tag', 'zyriz_product', array(
            'labels' => array(
                'name'          => __( 'Product Tags', 'zyriz' ),
                'singular_name' => __( 'Tag', 'zyriz' ),
                'add_new_item'  => __( 'Add New Tag', 'zyriz' ),
            ),
            'public'            => false,
            'show_in_rest'      => true,
            'rest_base'         => 'zyriz-product-tags',
            'hierarchical'      => false,
            'show_ui'           => false,
            'show_admin_column' => false,
        ) );
    }

    /* ─────────────────────────────────────────────
     * Register meta fields for REST API access
     * ───────────────────────────────────────────── */
    public static function register_meta_fields() {

        $product_meta = array(
            '_zyriz_subtitle'     => array( 'type' => 'string',  'sanitize' => 'sanitize_text_field' ),
            '_zyriz_price'        => array( 'type' => 'number',  'sanitize' => 'floatval' ),
            '_zyriz_sale_price'   => array( 'type' => 'string',  'sanitize' => 'sanitize_text_field' ),
            '_zyriz_sku'          => array( 'type' => 'string',  'sanitize' => 'sanitize_text_field' ),
            '_zyriz_badge'        => array( 'type' => 'string',  'sanitize' => 'sanitize_text_field' ),
            '_zyriz_stock_status' => array( 'type' => 'string',  'sanitize' => 'sanitize_text_field' ),
            '_zyriz_gallery'      => array( 'type' => 'array',   'sanitize' => null ),
            '_zyriz_featured'     => array( 'type' => 'boolean', 'sanitize' => 'rest_sanitize_boolean' ),
            '_zyriz_order'        => array( 'type' => 'integer', 'sanitize' => 'absint' ),
            '_zyriz_description'  => array( 'type' => 'string',  'sanitize' => 'wp_kses_post' ),
            '_zyriz_image_url'    => array( 'type' => 'string',  'sanitize' => 'esc_url_raw' ),
        );

        foreach ( $product_meta as $key => $config ) {
            register_post_meta( 'zyriz_product', $key, array(
                'show_in_rest'      => true,
                'single'            => true,
                'type'              => $config['type'],
                'sanitize_callback' => $config['sanitize'],
                'auth_callback'     => function() {
                    return current_user_can( 'edit_posts' );
                },
            ) );
        }

        /* Testimonial meta */
        $testimonial_meta = array(
            '_zyriz_author_name'     => 'sanitize_text_field',
            '_zyriz_author_location' => 'sanitize_text_field',
            '_zyriz_rating'          => 'absint',
            '_zyriz_order'           => 'absint',
        );

        foreach ( $testimonial_meta as $key => $sanitize ) {
            register_post_meta( 'zyriz_testimonial', $key, array(
                'show_in_rest'      => true,
                'single'            => true,
                'type'              => ( $sanitize === 'absint' ) ? 'integer' : 'string',
                'sanitize_callback' => $sanitize,
                'auth_callback'     => function() {
                    return current_user_can( 'edit_posts' );
                },
            ) );
        }

        /* FAQ meta */
        $faq_meta = array(
            '_zyriz_answer' => 'wp_kses_post',
            '_zyriz_order'  => 'absint',
        );

        foreach ( $faq_meta as $key => $sanitize ) {
            register_post_meta( 'zyriz_faq', $key, array(
                'show_in_rest'      => true,
                'single'            => true,
                'type'              => ( $sanitize === 'absint' ) ? 'integer' : 'string',
                'sanitize_callback' => $sanitize,
                'auth_callback'     => function() {
                    return current_user_can( 'edit_posts' );
                },
            ) );
        }
    }
}

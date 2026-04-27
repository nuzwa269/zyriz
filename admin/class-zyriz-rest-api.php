<?php
/**
 * Zyriz REST API
 *
 * Handles all CRUD endpoints for settings, sections,
 * products, testimonials, and FAQs.
 *
 * @package Zyriz
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Zyriz_REST_API {

    const NAMESPACE = 'zyriz/v1';

    /**
     * Register all REST routes
     */
    public static function init() {
        add_action( 'rest_api_init', array( __CLASS__, 'register_routes' ) );
    }

    /**
     * Permission callback — admins and editors
     */
    public static function check_permission() {
        return current_user_can( 'edit_pages' );
    }

    /* ═══════════════════════════════════════════════
     * Route Registration
     * ═══════════════════════════════════════════════ */
    public static function register_routes() {

        /* ---- Design Settings ---- */
        register_rest_route( self::NAMESPACE, '/settings/design', array(
            array(
                'methods'             => 'GET',
                'callback'            => array( __CLASS__, 'get_design' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'POST',
                'callback'            => array( __CLASS__, 'save_design' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        /* ---- Checkout Settings ---- */
        register_rest_route( self::NAMESPACE, '/settings/checkout', array(
            array(
                'methods'             => 'GET',
                'callback'            => array( __CLASS__, 'get_checkout' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'POST',
                'callback'            => array( __CLASS__, 'save_checkout' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        /* ---- All Sections ---- */
        register_rest_route( self::NAMESPACE, '/sections', array(
            array(
                'methods'             => 'GET',
                'callback'            => array( __CLASS__, 'get_sections' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'POST',
                'callback'            => array( __CLASS__, 'save_sections' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        /* ---- Single Section ---- */
        register_rest_route( self::NAMESPACE, '/sections/(?P<key>[a-z_]+)', array(
            array(
                'methods'             => 'GET',
                'callback'            => array( __CLASS__, 'get_section' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'PUT',
                'callback'            => array( __CLASS__, 'save_section' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        /* ---- Products CRUD ---- */
        register_rest_route( self::NAMESPACE, '/products', array(
            array(
                'methods'             => 'GET',
                'callback'            => array( __CLASS__, 'get_products' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'POST',
                'callback'            => array( __CLASS__, 'create_product' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        register_rest_route( self::NAMESPACE, '/products/(?P<id>\d+)', array(
            array(
                'methods'             => 'GET',
                'callback'            => array( __CLASS__, 'get_product' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'PUT',
                'callback'            => array( __CLASS__, 'update_product' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'DELETE',
                'callback'            => array( __CLASS__, 'delete_product' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        register_rest_route( self::NAMESPACE, '/products/reorder', array(
            array(
                'methods'             => 'POST',
                'callback'            => array( __CLASS__, 'reorder_products' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        /* ---- Testimonials CRUD ---- */
        register_rest_route( self::NAMESPACE, '/testimonials', array(
            array(
                'methods'             => 'GET',
                'callback'            => array( __CLASS__, 'get_testimonials' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'POST',
                'callback'            => array( __CLASS__, 'create_testimonial' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        register_rest_route( self::NAMESPACE, '/testimonials/(?P<id>\d+)', array(
            array(
                'methods'             => 'GET',
                'callback'            => array( __CLASS__, 'get_testimonial' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'PUT',
                'callback'            => array( __CLASS__, 'update_testimonial' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'DELETE',
                'callback'            => array( __CLASS__, 'delete_testimonial' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        register_rest_route( self::NAMESPACE, '/testimonials/reorder', array(
            array(
                'methods'             => 'POST',
                'callback'            => array( __CLASS__, 'reorder_testimonials' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        /* ---- FAQs CRUD ---- */
        register_rest_route( self::NAMESPACE, '/faqs', array(
            array(
                'methods'             => 'GET',
                'callback'            => array( __CLASS__, 'get_faqs' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'POST',
                'callback'            => array( __CLASS__, 'create_faq' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        register_rest_route( self::NAMESPACE, '/faqs/(?P<id>\d+)', array(
            array(
                'methods'             => 'GET',
                'callback'            => array( __CLASS__, 'get_faq' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'PUT',
                'callback'            => array( __CLASS__, 'update_faq' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
            array(
                'methods'             => 'DELETE',
                'callback'            => array( __CLASS__, 'delete_faq' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        register_rest_route( self::NAMESPACE, '/faqs/reorder', array(
            array(
                'methods'             => 'POST',
                'callback'            => array( __CLASS__, 'reorder_faqs' ),
                'permission_callback' => array( __CLASS__, 'check_permission' ),
            ),
        ) );

        /* ---- Export / Import ---- */
        register_rest_route( self::NAMESPACE, '/export', array(
            array(
                'methods'             => 'GET',
                'callback'            => array( __CLASS__, 'export_all' ),
                'permission_callback' => function() { return current_user_can( 'manage_options' ); },
            ),
        ) );

        register_rest_route( self::NAMESPACE, '/import', array(
            array(
                'methods'             => 'POST',
                'callback'            => array( __CLASS__, 'import_all' ),
                'permission_callback' => function() { return current_user_can( 'manage_options' ); },
            ),
        ) );
    }

    /* ═══════════════════════════════════════════════
     * Settings Endpoints
     * ═══════════════════════════════════════════════ */
    public static function get_design() {
        return rest_ensure_response( Zyriz_Settings::get_design() );
    }

    public static function save_design( $request ) {
        $data = $request->get_json_params();
        Zyriz_Settings::save_design( $data );
        return rest_ensure_response( array(
            'success' => true,
            'data'    => Zyriz_Settings::get_design(),
        ) );
    }

    public static function get_checkout() {
        return rest_ensure_response( Zyriz_Settings::get_checkout() );
    }

    public static function save_checkout( $request ) {
        $data = $request->get_json_params();
        Zyriz_Settings::save_checkout( $data );
        return rest_ensure_response( array(
            'success' => true,
            'data'    => Zyriz_Settings::get_checkout(),
        ) );
    }

    /* ═══════════════════════════════════════════════
     * Sections Endpoints
     * ═══════════════════════════════════════════════ */
    public static function get_sections() {
        return rest_ensure_response( Zyriz_Settings::get_sections() );
    }

    public static function save_sections( $request ) {
        $data = $request->get_json_params();
        Zyriz_Settings::save_sections( $data );
        return rest_ensure_response( array(
            'success' => true,
            'data'    => Zyriz_Settings::get_sections(),
        ) );
    }

    public static function get_section( $request ) {
        $key = sanitize_key( $request['key'] );
        return rest_ensure_response( Zyriz_Settings::get_section( $key ) );
    }

    public static function save_section( $request ) {
        $key  = sanitize_key( $request['key'] );
        $data = $request->get_json_params();
        Zyriz_Settings::save_section( $key, $data );
        return rest_ensure_response( array(
            'success' => true,
            'data'    => Zyriz_Settings::get_section( $key ),
        ) );
    }

    /* ═══════════════════════════════════════════════
     * Products Endpoints
     * ═══════════════════════════════════════════════ */
    public static function get_products() {
        $posts = get_posts( array(
            'post_type'      => 'zyriz_product',
            'posts_per_page' => 100,
            'post_status'    => array( 'publish', 'draft' ),
            'orderby'        => 'meta_value_num',
            'meta_key'       => '_zyriz_order',
            'order'          => 'ASC',
        ) );

        $products = array();
        foreach ( $posts as $post ) {
            $products[] = self::format_product( $post );
        }

        return rest_ensure_response( $products );
    }

    public static function get_product( $request ) {
        $post = get_post( absint( $request['id'] ) );
        if ( ! $post || $post->post_type !== 'zyriz_product' ) {
            return new WP_Error( 'not_found', 'Product not found', array( 'status' => 404 ) );
        }
        return rest_ensure_response( self::format_product( $post ) );
    }

    public static function create_product( $request ) {
        $data = $request->get_json_params();

        $post_id = wp_insert_post( array(
            'post_title'   => sanitize_text_field( $data['title'] ?? 'New Product' ),
            'post_content' => wp_kses_post( $data['description'] ?? '' ),
            'post_type'    => 'zyriz_product',
            'post_status'  => sanitize_text_field( $data['status'] ?? 'publish' ),
        ) );

        if ( is_wp_error( $post_id ) ) {
            return new WP_Error( 'create_failed', $post_id->get_error_message(), array( 'status' => 500 ) );
        }

        self::save_product_meta( $post_id, $data );

        // Handle thumbnail
        if ( ! empty( $data['image_id'] ) ) {
            set_post_thumbnail( $post_id, absint( $data['image_id'] ) );
        }

        return rest_ensure_response( array(
            'success' => true,
            'data'    => self::format_product( get_post( $post_id ) ),
        ) );
    }

    public static function update_product( $request ) {
        $id   = absint( $request['id'] );
        $post = get_post( $id );

        if ( ! $post || $post->post_type !== 'zyriz_product' ) {
            return new WP_Error( 'not_found', 'Product not found', array( 'status' => 404 ) );
        }

        $data = $request->get_json_params();

        $update_args = array( 'ID' => $id );
        if ( isset( $data['title'] ) ) {
            $update_args['post_title'] = sanitize_text_field( $data['title'] );
        }
        if ( isset( $data['description'] ) ) {
            $update_args['post_content'] = wp_kses_post( $data['description'] );
        }
        if ( isset( $data['status'] ) ) {
            $update_args['post_status'] = in_array( $data['status'], array( 'publish', 'draft' ), true ) ? $data['status'] : 'publish';
        }

        wp_update_post( $update_args );
        self::save_product_meta( $id, $data );

        if ( isset( $data['image_id'] ) ) {
            if ( empty( $data['image_id'] ) ) {
                delete_post_thumbnail( $id );
            } else {
                set_post_thumbnail( $id, absint( $data['image_id'] ) );
            }
        }

        return rest_ensure_response( array(
            'success' => true,
            'data'    => self::format_product( get_post( $id ) ),
        ) );
    }

    public static function delete_product( $request ) {
        $id   = absint( $request['id'] );
        $post = get_post( $id );

        if ( ! $post || $post->post_type !== 'zyriz_product' ) {
            return new WP_Error( 'not_found', 'Product not found', array( 'status' => 404 ) );
        }

        wp_delete_post( $id, true );

        return rest_ensure_response( array( 'success' => true, 'id' => $id ) );
    }

    public static function reorder_products( $request ) {
        $data = $request->get_json_params();
        $order = isset( $data['order'] ) ? $data['order'] : array();

        foreach ( $order as $index => $id ) {
            update_post_meta( absint( $id ), '_zyriz_order', $index + 1 );
        }

        return rest_ensure_response( array( 'success' => true ) );
    }

    /**
     * Format a product post for REST response
     */
    private static function format_product( $post ) {
        $thumb_id  = get_post_thumbnail_id( $post->ID );
        $thumb_url = $thumb_id ? wp_get_attachment_url( $thumb_id ) : '';
        $image_url = get_post_meta( $post->ID, '_zyriz_image_url', true );

        return array(
            'id'           => $post->ID,
            'title'        => $post->post_title,
            'slug'         => $post->post_name,
            'description'  => $post->post_content,
            'status'       => $post->post_status,
            'subtitle'     => get_post_meta( $post->ID, '_zyriz_subtitle', true ),
            'price'        => floatval( get_post_meta( $post->ID, '_zyriz_price', true ) ),
            'sale_price'   => get_post_meta( $post->ID, '_zyriz_sale_price', true ),
            'sku'          => get_post_meta( $post->ID, '_zyriz_sku', true ),
            'badge'        => get_post_meta( $post->ID, '_zyriz_badge', true ),
            'stock_status' => get_post_meta( $post->ID, '_zyriz_stock_status', true ) ?: 'in_stock',
            'gallery'      => get_post_meta( $post->ID, '_zyriz_gallery', true ) ?: array(),
            'featured'     => (bool) get_post_meta( $post->ID, '_zyriz_featured', true ),
            'order'        => intval( get_post_meta( $post->ID, '_zyriz_order', true ) ),
            'image_id'     => $thumb_id ? intval( $thumb_id ) : 0,
            'image_url'    => $thumb_url ?: ( $image_url ?: '' ),
            'categories'   => wp_get_post_terms( $post->ID, 'zyriz_product_cat', array( 'fields' => 'names' ) ),
            'tags'         => wp_get_post_terms( $post->ID, 'zyriz_product_tag', array( 'fields' => 'names' ) ),
        );
    }

    /**
     * Save product meta data
     */
    private static function save_product_meta( $post_id, $data ) {
        $meta_map = array(
            'subtitle'     => '_zyriz_subtitle',
            'price'        => '_zyriz_price',
            'sale_price'   => '_zyriz_sale_price',
            'sku'          => '_zyriz_sku',
            'badge'        => '_zyriz_badge',
            'stock_status' => '_zyriz_stock_status',
            'featured'     => '_zyriz_featured',
            'order'        => '_zyriz_order',
            'image_url'    => '_zyriz_image_url',
        );

        foreach ( $meta_map as $data_key => $meta_key ) {
            if ( isset( $data[ $data_key ] ) ) {
                $value = $data[ $data_key ];
                if ( $data_key === 'price' || $data_key === 'sale_price' ) {
                    $value = floatval( $value );
                } elseif ( $data_key === 'order' ) {
                    $value = absint( $value );
                } elseif ( $data_key === 'featured' ) {
                    $value = (bool) $value;
                } elseif ( $data_key === 'stock_status' ) {
                    $value = in_array( $value, array( 'in_stock', 'out_of_stock', 'limited' ), true ) ? $value : 'in_stock';
                } elseif ( $data_key === 'image_url' ) {
                    $value = esc_url_raw( $value );
                } else {
                    $value = sanitize_text_field( $value );
                }
                update_post_meta( $post_id, $meta_key, $value );
            }
        }

        if ( isset( $data['gallery'] ) && is_array( $data['gallery'] ) ) {
            $gallery = array_map( 'absint', $data['gallery'] );
            update_post_meta( $post_id, '_zyriz_gallery', $gallery );
        }

        if ( isset( $data['full_description'] ) ) {
            update_post_meta( $post_id, '_zyriz_description', wp_kses_post( $data['full_description'] ) );
        }

        // Handle categories
        if ( isset( $data['categories'] ) && is_array( $data['categories'] ) ) {
            $cats = array_map( 'sanitize_text_field', $data['categories'] );
            wp_set_object_terms( $post_id, $cats, 'zyriz_product_cat' );
        }

        // Handle tags
        if ( isset( $data['tags'] ) && is_array( $data['tags'] ) ) {
            $tags = array_map( 'sanitize_text_field', $data['tags'] );
            wp_set_object_terms( $post_id, $tags, 'zyriz_product_tag' );
        }
    }

    /* ═══════════════════════════════════════════════
     * Testimonials Endpoints
     * ═══════════════════════════════════════════════ */
    public static function get_testimonials() {
        $posts = get_posts( array(
            'post_type'      => 'zyriz_testimonial',
            'posts_per_page' => 100,
            'post_status'    => array( 'publish', 'draft' ),
            'orderby'        => 'meta_value_num',
            'meta_key'       => '_zyriz_order',
            'order'          => 'ASC',
        ) );

        $items = array();
        foreach ( $posts as $post ) {
            $items[] = self::format_testimonial( $post );
        }

        return rest_ensure_response( $items );
    }

    public static function get_testimonial( $request ) {
        $post = get_post( absint( $request['id'] ) );
        if ( ! $post || $post->post_type !== 'zyriz_testimonial' ) {
            return new WP_Error( 'not_found', 'Testimonial not found', array( 'status' => 404 ) );
        }
        return rest_ensure_response( self::format_testimonial( $post ) );
    }

    public static function create_testimonial( $request ) {
        $data = $request->get_json_params();

        $post_id = wp_insert_post( array(
            'post_title'   => sanitize_text_field( $data['author_name'] ?? 'New Testimonial' ),
            'post_content' => wp_kses_post( $data['content'] ?? '' ),
            'post_type'    => 'zyriz_testimonial',
            'post_status'  => 'publish',
        ) );

        if ( is_wp_error( $post_id ) ) {
            return new WP_Error( 'create_failed', $post_id->get_error_message(), array( 'status' => 500 ) );
        }

        update_post_meta( $post_id, '_zyriz_author_name',     sanitize_text_field( $data['author_name'] ?? '' ) );
        update_post_meta( $post_id, '_zyriz_author_location', sanitize_text_field( $data['author_location'] ?? '' ) );
        update_post_meta( $post_id, '_zyriz_rating',          absint( $data['rating'] ?? 5 ) );
        update_post_meta( $post_id, '_zyriz_order',           absint( $data['order'] ?? 0 ) );

        return rest_ensure_response( array(
            'success' => true,
            'data'    => self::format_testimonial( get_post( $post_id ) ),
        ) );
    }

    public static function update_testimonial( $request ) {
        $id   = absint( $request['id'] );
        $post = get_post( $id );
        if ( ! $post || $post->post_type !== 'zyriz_testimonial' ) {
            return new WP_Error( 'not_found', 'Testimonial not found', array( 'status' => 404 ) );
        }

        $data = $request->get_json_params();

        $args = array( 'ID' => $id );
        if ( isset( $data['content'] ) ) {
            $args['post_content'] = wp_kses_post( $data['content'] );
        }
        if ( isset( $data['author_name'] ) ) {
            $args['post_title'] = sanitize_text_field( $data['author_name'] );
        }
        wp_update_post( $args );

        if ( isset( $data['author_name'] ) ) {
            update_post_meta( $id, '_zyriz_author_name', sanitize_text_field( $data['author_name'] ) );
        }
        if ( isset( $data['author_location'] ) ) {
            update_post_meta( $id, '_zyriz_author_location', sanitize_text_field( $data['author_location'] ) );
        }
        if ( isset( $data['rating'] ) ) {
            update_post_meta( $id, '_zyriz_rating', min( 5, max( 1, absint( $data['rating'] ) ) ) );
        }
        if ( isset( $data['order'] ) ) {
            update_post_meta( $id, '_zyriz_order', absint( $data['order'] ) );
        }

        return rest_ensure_response( array(
            'success' => true,
            'data'    => self::format_testimonial( get_post( $id ) ),
        ) );
    }

    public static function delete_testimonial( $request ) {
        $id   = absint( $request['id'] );
        $post = get_post( $id );
        if ( ! $post || $post->post_type !== 'zyriz_testimonial' ) {
            return new WP_Error( 'not_found', 'Testimonial not found', array( 'status' => 404 ) );
        }

        wp_delete_post( $id, true );
        return rest_ensure_response( array( 'success' => true, 'id' => $id ) );
    }

    public static function reorder_testimonials( $request ) {
        $data  = $request->get_json_params();
        $order = isset( $data['order'] ) ? $data['order'] : array();
        foreach ( $order as $index => $id ) {
            update_post_meta( absint( $id ), '_zyriz_order', $index + 1 );
        }
        return rest_ensure_response( array( 'success' => true ) );
    }

    private static function format_testimonial( $post ) {
        return array(
            'id'              => $post->ID,
            'content'         => $post->post_content,
            'author_name'     => get_post_meta( $post->ID, '_zyriz_author_name', true ),
            'author_location' => get_post_meta( $post->ID, '_zyriz_author_location', true ),
            'rating'          => intval( get_post_meta( $post->ID, '_zyriz_rating', true ) ) ?: 5,
            'order'           => intval( get_post_meta( $post->ID, '_zyriz_order', true ) ),
            'status'          => $post->post_status,
        );
    }

    /* ═══════════════════════════════════════════════
     * FAQ Endpoints
     * ═══════════════════════════════════════════════ */
    public static function get_faqs() {
        $posts = get_posts( array(
            'post_type'      => 'zyriz_faq',
            'posts_per_page' => 100,
            'post_status'    => array( 'publish', 'draft' ),
            'orderby'        => 'meta_value_num',
            'meta_key'       => '_zyriz_order',
            'order'          => 'ASC',
        ) );

        $items = array();
        foreach ( $posts as $post ) {
            $items[] = self::format_faq( $post );
        }

        return rest_ensure_response( $items );
    }

    public static function get_faq( $request ) {
        $post = get_post( absint( $request['id'] ) );
        if ( ! $post || $post->post_type !== 'zyriz_faq' ) {
            return new WP_Error( 'not_found', 'FAQ not found', array( 'status' => 404 ) );
        }
        return rest_ensure_response( self::format_faq( $post ) );
    }

    public static function create_faq( $request ) {
        $data = $request->get_json_params();

        $post_id = wp_insert_post( array(
            'post_title'   => sanitize_text_field( $data['question'] ?? 'New FAQ' ),
            'post_content' => wp_kses_post( $data['answer'] ?? '' ),
            'post_type'    => 'zyriz_faq',
            'post_status'  => 'publish',
        ) );

        if ( is_wp_error( $post_id ) ) {
            return new WP_Error( 'create_failed', $post_id->get_error_message(), array( 'status' => 500 ) );
        }

        update_post_meta( $post_id, '_zyriz_answer', wp_kses_post( $data['answer'] ?? '' ) );
        update_post_meta( $post_id, '_zyriz_order',  absint( $data['order'] ?? 0 ) );

        return rest_ensure_response( array(
            'success' => true,
            'data'    => self::format_faq( get_post( $post_id ) ),
        ) );
    }

    public static function update_faq( $request ) {
        $id   = absint( $request['id'] );
        $post = get_post( $id );
        if ( ! $post || $post->post_type !== 'zyriz_faq' ) {
            return new WP_Error( 'not_found', 'FAQ not found', array( 'status' => 404 ) );
        }

        $data = $request->get_json_params();

        $args = array( 'ID' => $id );
        if ( isset( $data['question'] ) ) {
            $args['post_title'] = sanitize_text_field( $data['question'] );
        }
        if ( isset( $data['answer'] ) ) {
            $args['post_content'] = wp_kses_post( $data['answer'] );
            update_post_meta( $id, '_zyriz_answer', wp_kses_post( $data['answer'] ) );
        }
        wp_update_post( $args );

        if ( isset( $data['order'] ) ) {
            update_post_meta( $id, '_zyriz_order', absint( $data['order'] ) );
        }

        return rest_ensure_response( array(
            'success' => true,
            'data'    => self::format_faq( get_post( $id ) ),
        ) );
    }

    public static function delete_faq( $request ) {
        $id   = absint( $request['id'] );
        $post = get_post( $id );
        if ( ! $post || $post->post_type !== 'zyriz_faq' ) {
            return new WP_Error( 'not_found', 'FAQ not found', array( 'status' => 404 ) );
        }

        wp_delete_post( $id, true );
        return rest_ensure_response( array( 'success' => true, 'id' => $id ) );
    }

    public static function reorder_faqs( $request ) {
        $data  = $request->get_json_params();
        $order = isset( $data['order'] ) ? $data['order'] : array();
        foreach ( $order as $index => $id ) {
            update_post_meta( absint( $id ), '_zyriz_order', $index + 1 );
        }
        return rest_ensure_response( array( 'success' => true ) );
    }

    private static function format_faq( $post ) {
        return array(
            'id'       => $post->ID,
            'question' => $post->post_title,
            'answer'   => get_post_meta( $post->ID, '_zyriz_answer', true ) ?: $post->post_content,
            'order'    => intval( get_post_meta( $post->ID, '_zyriz_order', true ) ),
            'status'   => $post->post_status,
        );
    }

    /* ═══════════════════════════════════════════════
     * Export / Import
     * ═══════════════════════════════════════════════ */
    public static function export_all() {
        $export = array(
            'version'      => ZYRIZ_VER,
            'exported_at'  => current_time( 'mysql' ),
            'design'       => Zyriz_Settings::get_design(),
            'sections'     => Zyriz_Settings::get_sections(),
            'checkout'     => Zyriz_Settings::get_checkout(),
            'products'     => array(),
            'testimonials' => array(),
            'faqs'         => array(),
        );

        // Get all products
        $product_posts = get_posts( array( 'post_type' => 'zyriz_product', 'posts_per_page' => -1, 'post_status' => 'any' ) );
        foreach ( $product_posts as $p ) {
            $export['products'][] = self::format_product( $p );
        }

        // Get all testimonials
        $test_posts = get_posts( array( 'post_type' => 'zyriz_testimonial', 'posts_per_page' => -1, 'post_status' => 'any' ) );
        foreach ( $test_posts as $t ) {
            $export['testimonials'][] = self::format_testimonial( $t );
        }

        // Get all FAQs
        $faq_posts = get_posts( array( 'post_type' => 'zyriz_faq', 'posts_per_page' => -1, 'post_status' => 'any' ) );
        foreach ( $faq_posts as $f ) {
            $export['faqs'][] = self::format_faq( $f );
        }

        return rest_ensure_response( $export );
    }

    public static function import_all( $request ) {
        $data = $request->get_json_params();

        if ( empty( $data ) || ! isset( $data['version'] ) ) {
            return new WP_Error( 'invalid_import', 'Invalid import data', array( 'status' => 400 ) );
        }

        // Import settings
        if ( isset( $data['design'] ) ) {
            Zyriz_Settings::save_design( $data['design'] );
        }
        if ( isset( $data['sections'] ) ) {
            Zyriz_Settings::save_sections( $data['sections'] );
        }
        if ( isset( $data['checkout'] ) ) {
            Zyriz_Settings::save_checkout( $data['checkout'] );
        }

        return rest_ensure_response( array(
            'success' => true,
            'message' => 'Settings imported successfully. Product/Testimonial/FAQ data should be re-created manually or via their individual endpoints.',
        ) );
    }
}

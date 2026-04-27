<?php
/**
 * Zyriz Settings Helper
 *
 * Manages getting/setting all plugin options with defaults,
 * sanitization, and activation seeding.
 *
 * @package Zyriz
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Zyriz_Settings {

    /* ─────────────────────────────────────────────
     * Option keys
     * ───────────────────────────────────────────── */
    const OPT_DESIGN   = 'zyriz_design_settings';
    const OPT_SECTIONS = 'zyriz_sections';
    const OPT_CHECKOUT = 'zyriz_checkout_settings';
    const OPT_VERSION  = 'zyriz_db_version';

    /* ─────────────────────────────────────────────
     * Default: Design Settings
     * ───────────────────────────────────────────── */
    public static function design_defaults() {
        return array(
            'primary_color'    => '#D4AF37',
            'secondary_color'  => '#E8C547',
            'dark_gold'        => '#B8941E',
            'bg_color'         => '#0e0e0e',
            'bg_secondary'     => '#141414',
            'bg_tertiary'      => '#1a1a1a',
            'text_color'       => '#f0ede6',
            'text_muted'       => '#888888',
            'heading_color'    => '#f0ede6',
            'button_bg'        => '#D4AF37',
            'button_text'      => '#000000',
            'button_hover_bg'  => '#E8C547',
            'heading_font'     => 'Cormorant Garamond',
            'body_font'        => 'Montserrat',
            'base_font_size'   => '16',
            'border_radius'    => '4',
            'border_color'     => 'rgba(212,175,55,0.15)',
            'logo_url'         => '',
            'logo_text'        => 'ZYRIZ',
            'favicon_url'      => '',
            'header_layout'    => 'default',
            'footer_layout'    => 'default',
            'global_spacing'   => 'normal',
            'global_preset'    => 'luxury-dark',
        );
    }

    /* ─────────────────────────────────────────────
     * Default: Section Content
     * ───────────────────────────────────────────── */
    public static function sections_defaults() {
        return array(

            /* ----- Navigation ----- */
            'nav' => array(
                'links' => array(
                    array( 'label' => 'Collection', 'url' => '#collection' ),
                    array( 'label' => 'Our Story',  'url' => '#about' ),
                    array( 'label' => 'Why Zyriz',  'url' => '#comparison' ),
                    array( 'label' => 'FAQ',         'url' => '#faq' ),
                ),
                'cta_text' => 'Order Now',
                'cta_url'  => '#checkout',
            ),

            /* ----- Hero ----- */
            'hero' => array(
                'enabled'          => true,
                'order'            => 1,
                'tag'              => 'Zyriz — Where Gold Meets Grace',
                'title_line1'      => 'Elegance',
                'title_line2'      => 'Dipped in Gold.',
                'subtitle'         => 'Discover our signature collection of 18K gold-plated earrings — crafted for women who carry their luxury effortlessly.',
                'cta_primary_text' => '✦ Shop Collection',
                'cta_primary_url'  => '#collection',
                'cta_secondary_text' => 'Our Story',
                'cta_secondary_url'  => '#about',
                'stats' => array(
                    array( 'number' => '5K+',  'label' => 'Happy Customers' ),
                    array( 'number' => '18K',  'label' => 'Gold Plating' ),
                    array( 'number' => '100%', 'label' => 'Skin Safe' ),
                ),
                'image_url'  => '',
                'badge_text' => '✦ Handcrafted Luxury ✦',
            ),

            /* ----- Vision ----- */
            'vision' => array(
                'enabled' => true,
                'order'   => 2,
                'quote'   => '"Traditional jewelry was made for display. <em>Zyriz</em> was made for the woman who wears her story every single day."',
                'body'    => 'Born in the heart of South Asia\'s goldsmith heritage, Zyriz fuses centuries-old craftsmanship with a modern, minimalist spirit. Every piece is designed to be worn — not stored.',
            ),

            /* ----- Features ----- */
            'features' => array(
                'enabled' => true,
                'order'   => 3,
                'tag'     => 'Why We\'re Different',
                'heading' => 'Modern Luxury, Timeless Craft.',
                'items'   => array(
                    array(
                        'icon'        => '✦',
                        'title'       => '18K Gold Plating',
                        'description' => 'Our signature thick-layer gold plating process ensures a rich, luminous finish that lasts far beyond ordinary gold-dipped jewelry.',
                    ),
                    array(
                        'icon'        => '◇',
                        'title'       => 'Nickel-Free & Skin Safe',
                        'description' => 'Crafted for sensitive skin. Every Zyriz piece is hypoallergenic, dermatologist-approved, and wearable from dawn to midnight.',
                    ),
                    array(
                        'icon'        => '◎',
                        'title'       => 'Everlasting Shine',
                        'description' => 'Our anti-tarnish coating and superior base metal selection means your Zyriz earrings stay radiant through every season.',
                    ),
                ),
            ),

            /* ----- Included / Promise ----- */
            'included' => array(
                'enabled'   => true,
                'order'     => 4,
                'tag'       => 'The Zyriz Promise',
                'heading'   => 'Everything You Deserve, Included.',
                'body'      => 'Luxury shouldn\'t come with hidden surprises. Every order includes our complete care package — because you deserve the full experience.',
                'items'     => array(
                    'Premium gift box packaging with silk lining',
                    'Anti-tarnish jewelry pouch for storage',
                    'Jewelry care instruction card',
                    'Nationwide shipping across Pakistan',
                    '7-day quality guarantee',
                    'Direct WhatsApp customer support',
                ),
                'image_url' => '',
            ),

            /* ----- Collection heading  ----- */
            'collection' => array(
                'enabled'    => true,
                'order'      => 5,
                'tag'        => 'Shop Now',
                'heading'    => 'Signature Collection',
                'subheading' => 'Each piece is numbered. Each piece is yours.',
            ),

            /* ----- Comparison ----- */
            'comparison' => array(
                'enabled' => true,
                'order'   => 6,
                'tag'     => 'The Zyriz Difference',
                'heading' => 'Why Choose Zyriz?',
                'rows'    => array(
                    array( 'feature' => '18K Thick Gold Plating',       'zyriz' => true, 'competitor' => false ),
                    array( 'feature' => 'Skin-Safe / Hypoallergenic',   'zyriz' => true, 'competitor' => false ),
                    array( 'feature' => 'Anti-Tarnish Coating',         'zyriz' => true, 'competitor' => false ),
                    array( 'feature' => 'Premium Gift Packaging',       'zyriz' => true, 'competitor' => false ),
                    array( 'feature' => '7-Day Quality Guarantee',      'zyriz' => true, 'competitor' => false ),
                    array( 'feature' => 'Direct WhatsApp Support',      'zyriz' => true, 'competitor' => false ),
                    array( 'feature' => 'Nationwide Pakistan Shipping',  'zyriz' => true, 'competitor' => 'Sometimes' ),
                ),
            ),

            /* ----- Process / Journey ----- */
            'process' => array(
                'enabled' => true,
                'order'   => 7,
                'tag'     => 'The Zyriz Journey',
                'heading' => 'From Vision to Your Ears',
                'steps'   => array(
                    array( 'number' => '01', 'icon' => '✏️', 'title' => 'Design',    'description' => 'Each design starts with a vision — inspired by architecture, nature, and the modern woman\'s lifestyle. Every curve is intentional.' ),
                    array( 'number' => '02', 'icon' => '⚡',  'title' => 'Craft',     'description' => 'Skilled artisans apply our signature 18K gold plating process, layer by layer, ensuring depth, richness, and exceptional durability.' ),
                    array( 'number' => '03', 'icon' => '📦', 'title' => 'Delivered', 'description' => 'Your piece arrives in our luxurious gift box, wrapped in silk, ready to be worn or gifted. Zero compromises, all the way to your door.' ),
                ),
            ),

            /* ----- CTA Banner ----- */
            'cta_banner' => array(
                'enabled'    => true,
                'order'      => 8,
                'title_line1' => 'Stop Waiting.',
                'title_line2' => 'Start Shining.',
                'subtitle'    => 'Your next favourite pair of earrings is just one tap away. Explore the Zyriz Signature Collection now.',
                'cta_text'    => '✦ Shop the Collection',
                'cta_url'     => '#collection',
            ),

            /* ----- Footer ----- */
            'footer' => array(
                'brand_name'  => 'ZYRIZ',
                'description' => 'Premium 18K gold-plated jewellery crafted for the modern woman. Made with love, delivered with luxury.',
                'social_links' => array(
                    array( 'platform' => 'Instagram', 'url' => '#', 'icon' => '📸' ),
                    array( 'platform' => 'Facebook',  'url' => '#', 'icon' => '📘' ),
                    array( 'platform' => 'WhatsApp',  'url' => '#', 'icon' => '💬' ),
                    array( 'platform' => 'TikTok',    'url' => '#', 'icon' => '🎵' ),
                ),
                'columns' => array(
                    array(
                        'title' => 'Shop',
                        'links' => array(
                            array( 'label' => 'All Earrings', 'url' => '#collection' ),
                            array( 'label' => 'Hoops',        'url' => '#collection' ),
                            array( 'label' => 'Studs',        'url' => '#collection' ),
                            array( 'label' => 'Drops',        'url' => '#collection' ),
                        ),
                    ),
                    array(
                        'title' => 'Company',
                        'links' => array(
                            array( 'label' => 'Our Story',      'url' => '#about' ),
                            array( 'label' => 'Craftsmanship',  'url' => '#process' ),
                            array( 'label' => 'Why Zyriz',      'url' => '#comparison' ),
                            array( 'label' => 'FAQ',            'url' => '#faq' ),
                        ),
                    ),
                    array(
                        'title' => 'Contact',
                        'links' => array(
                            array( 'label' => '📧 hello@zyriz.com',    'url' => '#' ),
                            array( 'label' => '📱 +92 300 1234567',    'url' => '#' ),
                            array( 'label' => 'Order via WhatsApp',    'url' => '#checkout' ),
                        ),
                    ),
                ),
                'copyright_line1' => '© {year} Zyriz. All rights reserved. Crafted with ✦',
                'copyright_line2' => 'Designed for elegance. Built for you.',
            ),
        );
    }

    /* ─────────────────────────────────────────────
     * Default: Checkout Settings
     * ───────────────────────────────────────────── */
    public static function checkout_defaults() {
        return array(
            'cart_title'          => 'Your Selection',
            'empty_cart_msg'      => 'Your cart is empty.',
            'proceed_btn_text'    => '✦ Proceed to Order',
            'total_label'         => 'Total',
            'checkout_tag'        => 'Order via WhatsApp',
            'checkout_heading'    => 'Place Your Order, Instantly.',
            'checkout_subheading' => 'No complicated checkout. No accounts required. Add your items to the cart, fill in your details below, and we\'ll receive your full order on WhatsApp — and confirm within hours.',
            'whatsapp_highlight'  => 'Instant WhatsApp Confirmation',
            'no_items_msg'        => 'No items in cart. Browse the collection above!',
            'name_label'          => 'Full Name *',
            'name_placeholder'    => 'Sara Ahmed',
            'phone_label'         => 'Phone Number *',
            'phone_placeholder'   => '+92 300 1234567',
            'email_label'         => 'Email Address (Optional)',
            'email_placeholder'   => 'sara@example.com',
            'address_label'       => 'Shipping Address *',
            'address_placeholder' => 'House No., Street, Area, City',
            'notes_label'         => 'Special Notes (Optional)',
            'notes_placeholder'   => 'Gift wrapping, colour preference, etc.',
            'whatsapp_btn_text'   => 'Order via WhatsApp',
            'whatsapp_footer'     => 'You\'ll be redirected to WhatsApp with your complete order summary.',
            'whatsapp_number'     => '923001234567',
            'currency'            => 'PKR',
            'currency_position'   => 'before',
            'success_message'     => 'Order sent successfully!',
            'error_empty_cart'    => 'Your cart is empty! Please add products first.',
            'error_required'      => 'Please fill in your name, phone, and address.',
        );
    }

    /* ─────────────────────────────────────────────
     * Getters – merge saved with defaults
     * ───────────────────────────────────────────── */
    public static function get_design() {
        $saved = get_option( self::OPT_DESIGN, array() );
        return wp_parse_args( $saved, self::design_defaults() );
    }

    public static function get_sections() {
        $saved = get_option( self::OPT_SECTIONS, array() );
        $defaults = self::sections_defaults();
        // Deep merge each section
        $merged = array();
        foreach ( $defaults as $key => $default_section ) {
            if ( isset( $saved[ $key ] ) && is_array( $saved[ $key ] ) ) {
                $merged[ $key ] = self::array_merge_deep( $default_section, $saved[ $key ] );
            } else {
                $merged[ $key ] = $default_section;
            }
        }
        // Include any extra sections that may have been added
        foreach ( $saved as $key => $val ) {
            if ( ! isset( $merged[ $key ] ) ) {
                $merged[ $key ] = $val;
            }
        }
        return $merged;
    }

    public static function get_section( $key ) {
        $sections = self::get_sections();
        return isset( $sections[ $key ] ) ? $sections[ $key ] : array();
    }

    public static function get_checkout() {
        $saved = get_option( self::OPT_CHECKOUT, array() );
        return wp_parse_args( $saved, self::checkout_defaults() );
    }

    /* ─────────────────────────────────────────────
     * Setters
     * ───────────────────────────────────────────── */
    public static function save_design( $data ) {
        $sanitized = self::sanitize_design( $data );
        return update_option( self::OPT_DESIGN, $sanitized );
    }

    public static function save_sections( $data ) {
        $sanitized = self::sanitize_sections( $data );
        return update_option( self::OPT_SECTIONS, $sanitized );
    }

    public static function save_section( $key, $data ) {
        $sections = get_option( self::OPT_SECTIONS, array() );
        $sections[ sanitize_key( $key ) ] = self::sanitize_section_data( $data );
        return update_option( self::OPT_SECTIONS, $sections );
    }

    public static function save_checkout( $data ) {
        $sanitized = self::sanitize_checkout( $data );
        return update_option( self::OPT_CHECKOUT, $sanitized );
    }

    /* ─────────────────────────────────────────────
     * Sanitization
     * ───────────────────────────────────────────── */
    public static function sanitize_design( $data ) {
        $clean = array();
        $defaults = self::design_defaults();

        foreach ( $defaults as $key => $default ) {
            if ( ! isset( $data[ $key ] ) ) {
                $clean[ $key ] = $default;
                continue;
            }

            // Color fields
            if ( strpos( $key, 'color' ) !== false || $key === 'button_bg' || $key === 'button_hover_bg' || $key === 'button_text' || $key === 'dark_gold' ) {
                $clean[ $key ] = self::sanitize_color( $data[ $key ] );
            }
            // URL fields
            elseif ( strpos( $key, 'url' ) !== false ) {
                $clean[ $key ] = esc_url_raw( $data[ $key ] );
            }
            // Numeric fields
            elseif ( in_array( $key, array( 'base_font_size', 'border_radius' ), true ) ) {
                $clean[ $key ] = strval( absint( $data[ $key ] ) );
            }
            // Choice fields
            elseif ( $key === 'header_layout' ) {
                $clean[ $key ] = in_array( $data[ $key ], array( 'default', 'centered', 'minimal' ), true ) ? $data[ $key ] : 'default';
            }
            elseif ( $key === 'footer_layout' ) {
                $clean[ $key ] = in_array( $data[ $key ], array( 'default', 'minimal', 'centered' ), true ) ? $data[ $key ] : 'default';
            }
            elseif ( $key === 'global_spacing' ) {
                $clean[ $key ] = in_array( $data[ $key ], array( 'compact', 'normal', 'spacious' ), true ) ? $data[ $key ] : 'normal';
            }
            elseif ( $key === 'global_preset' ) {
                $clean[ $key ] = in_array( $data[ $key ], array( 'luxury-dark', 'luxury-light', 'modern', 'classic' ), true ) ? $data[ $key ] : 'luxury-dark';
            }
            // Text fields
            else {
                $clean[ $key ] = sanitize_text_field( $data[ $key ] );
            }
        }

        return $clean;
    }

    public static function sanitize_sections( $data ) {
        $clean = array();
        if ( ! is_array( $data ) ) {
            return self::sections_defaults();
        }
        foreach ( $data as $key => $section ) {
            $clean[ sanitize_key( $key ) ] = self::sanitize_section_data( $section );
        }
        return $clean;
    }

    public static function sanitize_section_data( $data ) {
        if ( ! is_array( $data ) ) {
            return array();
        }
        $clean = array();
        foreach ( $data as $key => $value ) {
            $skey = sanitize_key( $key );
            if ( is_array( $value ) ) {
                $clean[ $skey ] = self::sanitize_section_data( $value );
            } elseif ( is_bool( $value ) ) {
                $clean[ $skey ] = (bool) $value;
            } elseif ( is_numeric( $value ) ) {
                $clean[ $skey ] = is_float( $value + 0 ) ? floatval( $value ) : intval( $value );
            } elseif ( strpos( $skey, 'url' ) !== false ) {
                $clean[ $skey ] = esc_url_raw( $value );
            } elseif ( in_array( $skey, array( 'quote', 'body', 'description', 'subtitle' ), true ) ) {
                $clean[ $skey ] = wp_kses_post( $value );
            } else {
                $clean[ $skey ] = sanitize_text_field( $value );
            }
        }
        return $clean;
    }

    public static function sanitize_checkout( $data ) {
        $clean = array();
        $defaults = self::checkout_defaults();
        foreach ( $defaults as $key => $default ) {
            if ( ! isset( $data[ $key ] ) ) {
                $clean[ $key ] = $default;
                continue;
            }
            if ( $key === 'currency_position' ) {
                $clean[ $key ] = in_array( $data[ $key ], array( 'before', 'after' ), true ) ? $data[ $key ] : 'before';
            } elseif ( $key === 'whatsapp_number' ) {
                $clean[ $key ] = preg_replace( '/[^0-9]/', '', $data[ $key ] );
            } else {
                $clean[ $key ] = sanitize_text_field( $data[ $key ] );
            }
        }
        return $clean;
    }

    /**
     * Sanitize color value (hex, rgb, rgba)
     */
    public static function sanitize_color( $color ) {
        $color = trim( $color );
        // Hex color
        if ( preg_match( '/^#([a-fA-F0-9]{3}){1,2}$/', $color ) ) {
            return $color;
        }
        // rgba
        if ( preg_match( '/^rgba?\([\d\s,.\/%]+\)$/', $color ) ) {
            return $color;
        }
        return '#D4AF37'; // Fallback to gold
    }

    /* ─────────────────────────────────────────────
     * Activation: Seed defaults
     * ───────────────────────────────────────────── */
    public static function activate() {
        if ( ! get_option( self::OPT_DESIGN ) ) {
            add_option( self::OPT_DESIGN, self::design_defaults() );
        }
        if ( ! get_option( self::OPT_SECTIONS ) ) {
            add_option( self::OPT_SECTIONS, self::sections_defaults() );
        }
        if ( ! get_option( self::OPT_CHECKOUT ) ) {
            add_option( self::OPT_CHECKOUT, self::checkout_defaults() );
        }
        update_option( self::OPT_VERSION, ZYRIZ_VER );

        // Seed default products if none exist
        self::seed_default_products();
        // Seed default testimonials
        self::seed_default_testimonials();
        // Seed default FAQs
        self::seed_default_faqs();

        flush_rewrite_rules();
    }

    /**
     * Seed default products from original hardcoded data
     */
    private static function seed_default_products() {
        $existing = get_posts( array( 'post_type' => 'zyriz_product', 'posts_per_page' => 1, 'post_status' => 'any' ) );
        if ( ! empty( $existing ) ) {
            return;
        }

        $products = array(
            array(
                'title'    => 'The Aurelian Hoops',
                'subtitle' => '18K Gold Plated',
                'price'    => 4500,
                'badge'    => 'Best Seller',
                'slug'     => 'aurelian-hoops',
                'order'    => 1,
            ),
            array(
                'title'    => 'Zirconia Star Studs',
                'subtitle' => 'Gold & Crystal',
                'price'    => 3000,
                'badge'    => 'New Arrival',
                'slug'     => 'zirconia-studs',
                'order'    => 2,
            ),
            array(
                'title'    => 'Eternal Gold Drops',
                'subtitle' => 'Drop Earrings',
                'price'    => 5500,
                'badge'    => 'Signature',
                'slug'     => 'eternal-drops',
                'order'    => 3,
            ),
            array(
                'title'    => 'Serpent Twist Hoops',
                'subtitle' => 'Twisted Design',
                'price'    => 4000,
                'badge'    => 'Limited',
                'slug'     => 'serpent-hoops',
                'order'    => 4,
            ),
        );

        foreach ( $products as $p ) {
            $post_id = wp_insert_post( array(
                'post_title'  => $p['title'],
                'post_name'   => $p['slug'],
                'post_type'   => 'zyriz_product',
                'post_status' => 'publish',
            ) );

            if ( ! is_wp_error( $post_id ) ) {
                update_post_meta( $post_id, '_zyriz_subtitle',     $p['subtitle'] );
                update_post_meta( $post_id, '_zyriz_price',        $p['price'] );
                update_post_meta( $post_id, '_zyriz_sale_price',   '' );
                update_post_meta( $post_id, '_zyriz_sku',          '' );
                update_post_meta( $post_id, '_zyriz_badge',        $p['badge'] );
                update_post_meta( $post_id, '_zyriz_stock_status', 'in_stock' );
                update_post_meta( $post_id, '_zyriz_gallery',      array() );
                update_post_meta( $post_id, '_zyriz_featured',     true );
                update_post_meta( $post_id, '_zyriz_order',        $p['order'] );
                update_post_meta( $post_id, '_zyriz_description',  '' );
            }
        }
    }

    /**
     * Seed default testimonials
     */
    private static function seed_default_testimonials() {
        $existing = get_posts( array( 'post_type' => 'zyriz_testimonial', 'posts_per_page' => 1, 'post_status' => 'any' ) );
        if ( ! empty( $existing ) ) {
            return;
        }

        $testimonials = array(
            array(
                'content'  => 'I ordered the Aurelian Hoops and I haven\'t taken them off in three weeks. The quality is genuinely unmatched at this price point.',
                'author'   => 'Sara Ahmed',
                'location' => 'Lahore, Pakistan',
                'rating'   => 5,
                'order'    => 1,
            ),
            array(
                'content'  => 'The packaging alone made me feel like I was opening something from a high-street brand. Zyriz is on another level.',
                'author'   => 'Nadia Khan',
                'location' => 'Karachi, Pakistan',
                'rating'   => 5,
                'order'    => 2,
            ),
            array(
                'content'  => 'Bought the Eternal Gold Drops as a Eid gift and she completely loved them. Ordering again for sure. WhatsApp ordering was so easy!',
                'author'   => 'Amna Butt',
                'location' => 'Islamabad, Pakistan',
                'rating'   => 5,
                'order'    => 3,
            ),
        );

        foreach ( $testimonials as $t ) {
            $post_id = wp_insert_post( array(
                'post_title'   => $t['author'],
                'post_content' => $t['content'],
                'post_type'    => 'zyriz_testimonial',
                'post_status'  => 'publish',
            ) );
            if ( ! is_wp_error( $post_id ) ) {
                update_post_meta( $post_id, '_zyriz_author_name',     $t['author'] );
                update_post_meta( $post_id, '_zyriz_author_location', $t['location'] );
                update_post_meta( $post_id, '_zyriz_rating',          $t['rating'] );
                update_post_meta( $post_id, '_zyriz_order',           $t['order'] );
            }
        }
    }

    /**
     * Seed default FAQs
     */
    private static function seed_default_faqs() {
        $existing = get_posts( array( 'post_type' => 'zyriz_faq', 'posts_per_page' => 1, 'post_status' => 'any' ) );
        if ( ! empty( $existing ) ) {
            return;
        }

        $faqs = array(
            array(
                'question' => 'How long does the gold plating last?',
                'answer'   => 'Our 18K gold plating is applied in multiple thick layers using premium base metal. With proper care — avoiding water, perfumes, and harsh chemicals — your Zyriz piece can maintain its luxurious shine for 1–2 years or more.',
                'order'    => 1,
            ),
            array(
                'question' => 'Are your earrings safe for sensitive skin?',
                'answer'   => 'Yes! All Zyriz earrings are nickel-free and hypoallergenic. We use a high-quality brass or stainless steel base that is safe for sensitive skin and everyday wear.',
                'order'    => 2,
            ),
            array(
                'question' => 'How do I place an order?',
                'answer'   => 'Simply add your favourite pieces to the cart, scroll down to the order section, fill in your name, phone, and address — then click "Order via WhatsApp." Your complete order details will be sent to us instantly on WhatsApp and we\'ll confirm within hours.',
                'order'    => 3,
            ),
            array(
                'question' => 'Do you ship all over Pakistan?',
                'answer'   => 'Yes! We ship nationwide across Pakistan via reliable courier services. Typical delivery time is 3–5 business days. Lahore, Karachi, and Islamabad orders may arrive sooner.',
                'order'    => 4,
            ),
            array(
                'question' => 'What is your return / quality guarantee policy?',
                'answer'   => 'We stand behind every piece we create. If you receive a damaged or defective item, simply contact us on WhatsApp within 7 days of delivery and we will arrange a replacement or refund — no questions asked.',
                'order'    => 5,
            ),
            array(
                'question' => 'Can I order a custom piece or bulk gifting?',
                'answer'   => 'Absolutely! We offer custom bulk orders for weddings, corporate gifting, and events. Message us on WhatsApp with your requirements and we\'ll provide a custom quote within 24 hours.',
                'order'    => 6,
            ),
        );

        foreach ( $faqs as $f ) {
            $post_id = wp_insert_post( array(
                'post_title'   => $f['question'],
                'post_content' => $f['answer'],
                'post_type'    => 'zyriz_faq',
                'post_status'  => 'publish',
            ) );
            if ( ! is_wp_error( $post_id ) ) {
                update_post_meta( $post_id, '_zyriz_answer', $f['answer'] );
                update_post_meta( $post_id, '_zyriz_order',  $f['order'] );
            }
        }
    }

    /* ─────────────────────────────────────────────
     * Utility: Deep merge arrays
     * ───────────────────────────────────────────── */
    public static function array_merge_deep( $defaults, $overrides ) {
        $merged = $defaults;
        foreach ( $overrides as $key => $value ) {
            if ( is_array( $value ) && isset( $defaults[ $key ] ) && is_array( $defaults[ $key ] ) ) {
                // For indexed arrays (items, stats, etc.) replace entirely
                if ( array_values( $value ) === $value ) {
                    $merged[ $key ] = $value;
                } else {
                    $merged[ $key ] = self::array_merge_deep( $defaults[ $key ], $value );
                }
            } else {
                $merged[ $key ] = $value;
            }
        }
        return $merged;
    }
}

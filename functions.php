<?php
/**
 * Zyriz Functions and Definitions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Enqueue luxury styles
function zyriz_scripts() {
    wp_enqueue_style( 'zyriz-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap', false );
    wp_enqueue_style( 'zyriz-main-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'zyriz_scripts' );

// Add Theme Support
function zyriz_setup() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'zyriz_setup' );

/**
 * REDIRECT TO WHATSAPP AFTER CHECKOUT
 * This function intercepts the checkout process and sends details to WhatsApp.
 */
add_action( 'woocommerce_thankyou', 'zyriz_send_to_whatsapp', 10, 1 );

function zyriz_send_to_whatsapp( $order_id ) {
    $order = wc_get_order( $order_id );
    
    // REPLACE THIS WITH YOUR REAL WHATSAPP NUMBER
    $phone_number = '923001234567'; 

    $first_name = $order->get_billing_first_name();
    $city       = $order->get_billing_city();
    $total      = $order->get_total();
    $currency   = $order->get_currency();
    
    // List products
    $items_list = "";
    foreach ( $order->get_items() as $item_id => $item ) {
        $items_list .= "- " . $item->get_name() . " (x" . $item->get_quantity() . ")%0A";
    }

    // Compose Message
    $message = "Assalam-o-Alaikum *Zyriz Jewelry*!%0A%0A";
    $message .= "I would like to confirm my order:%0A";
    $message .= "*Order ID:* " . $order_id . "%0A";
    $message .= "*Customer:* " . $first_name . "%0A";
    $message .= "*Location:* " . $city . "%0A";
    $message .= "*Products:*%0A" . $items_list . "%0A";
    $message .= "*Total Amount:* " . $total . " " . $currency . "%0A%0A";
    $message .= "Please process my order. Thank you!";

    $wa_url = "https://api.whatsapp.com/send?phone=" . $phone_number . "&text=" . $message;

    // Automatic Redirect using JavaScript
    echo '<script type="text/javascript">
            window.location.href = "' . $wa_url . '";
          </script>';
}

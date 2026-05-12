# Zyriz Jewelry - Project Structure

This repository contains the core files for the **Zyriz** Jewelry website.
The website is designed with a **Luxury Black & Gold** theme and features a **WhatsApp-based checkout system**.

## Project Overview
- **Brand:** Zyriz
- **Product Focus:** Turkish Style Gold Plated Earrings, Hoop Earrings with unique stones.
- **Theme:** Modern Black (#000000) and Gold (#D4AF37).
- **Checkout:** WooCommerce order data is redirected to WhatsApp for final confirmation.

## File Structure
- `style.css`: Custom CSS for the Black & Gold luxury aesthetic.
- `functions.php`: PHP logic for WooCommerce integration and WhatsApp redirection.
- `index.php`: Main entry point for the WordPress theme.
- `header.php`: Standard header with brand navigation.

## Setup Instructions
1. Install WordPress on your hosting.
2. Install the **WooCommerce** plugin.
3. Upload these files to your `wp-content/themes/zyriz/` directory.
4. Edit the phone number in `functions.php` to your WhatsApp number.
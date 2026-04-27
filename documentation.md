# Zyriz Luxury Landing Page — Documentation & Walkthrough

Welcome to the **Zyriz Luxury Landing Page** plugin. This document provides a complete guide on how to install, configure, and manage your luxury e-commerce landing page.

---

## 1. Introduction
Zyriz is a premium, mobile-first WordPress plugin designed specifically for high-end boutique stores (focused on gold-plated jewelry, but adaptable). It features a custom, Elementor-inspired management dashboard and a unique **WhatsApp Ordering System** that bypasses complex checkout processes.

## 2. Installation
1. Upload the `zyriz` folder to your `/wp-content/plugins/` directory.
2. In your WordPress Admin, go to **Plugins**.
3. Locate **Zyriz Luxury Landing Page** and click **Activate**.
4. Upon activation, the plugin will automatically seed default luxury products, testimonials, and FAQs so you don't start with a blank screen.

## 3. Creating the Landing Page
The plugin uses a shortcode to render the frontend.
1. Go to **Pages > Add New**.
2. Give your page a title (e.g., "Shop" or "Landing Page").
3. In the editor, simply paste the following shortcode:
   `[zyriz_landing]`
4. **Publish** the page.
5. Once published, the Zyriz Editor will be able to find this page and show it in the Live Preview.

## 4. Using the Zyriz Editor
You can access the editor by clicking the **✦ Zyriz** menu in your WordPress sidebar.

### The Editor Interface
- **Sidebar (Left):** Contains all your control panels (Design, Hero, Products, etc.).
- **Preview (Center/Right):** Shows a live, interactive preview of your site.
- **Top Bar:** 
    - **Device Toggles:** Switch between Desktop, Tablet, and Mobile views.
    - **Save All:** Saves every change you've made across all panels.
    - **Preview:** Opens your published page in a new tab.

### Customizing Design
Go to the **Design** panel to change:
- **Colors:** Primary (Gold), Backgrounds, and Text colors.
- **Typography:** Choose from curated Google Fonts like *Cormorant Garamond* or *Montserrat*.
- **Branding:** Upload your own logo text or image.

## 5. Managing Your Catalog

### Products
1. Click the **Products** icon in the editor.
2. You can **Edit** existing items or click **+ Add New Product**.
3. For each product, you can set:
    - Title & Subtitle.
    - Price & Sale Price.
    - Image (uses the WordPress Media Library).
    - Badge (e.g., "Best Seller").
    - Stock Status (In Stock / Out of Stock).

### Testimonials & FAQs
Managing these works exactly like products. You can edit the content, change the order (via drag and drop), and delete or add new items. Everything updates in the live preview instantly.

## 6. WhatsApp Ordering System
Zyriz does not use a typical "Cart -> Checkout -> Payment" flow. Instead:
1. Customers add items to their **Cart Drawer**.
2. They click **Proceed to Order**.
3. They fill in a simple form (Name, Phone, Address).
4. When they click **Order via WhatsApp**, the plugin generates a formatted message with their order details and total, then opens WhatsApp to send it directly to you.

**To set your phone number:**
1. Go to the **Checkout** panel in the editor.
2. Enter your phone number in the **WhatsApp Number** field (include country code without the `+`, e.g., `923001234567`).

## 7. Troubleshooting
- **Editor shows "Loading...":** This usually means a REST API conflict. Ensure your WordPress permalinks are set to something other than "Plain" (Go to **Settings > Permalinks** and choose **Post Name**).
- **Page Not Found in Preview:** Ensure you have published a page containing the `[zyriz_landing]` shortcode.
- **Design Changes Not Saving:** Make sure to click the **Save All** button in the top bar of the editor.

---
*Thank you for choosing Zyriz. For further assistance, contact your developer.*

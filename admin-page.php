<?php
/**
 * Zyriz Admin Editor – Full-screen SPA shell
 *
 * This is the admin page template that renders the
 * Elementor-inspired editor with sidebar + preview.
 *
 * @package Zyriz
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div id="zyriz-editor-app" class="zyriz-editor-wrap">

  <!-- ===== TOP BAR ===== -->
  <header class="ze-topbar">
    <div class="ze-topbar-left">
      <div class="ze-logo">✦ ZYRIZ</div>
      <span class="ze-version">v<?php echo esc_html( ZYRIZ_VER ); ?></span>
    </div>
    <div class="ze-topbar-center">
      <div class="ze-responsive-toggles">
        <button class="ze-device-btn active" data-device="desktop" title="Desktop Preview">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
        </button>
        <button class="ze-device-btn" data-device="tablet" title="Tablet Preview">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="12" y1="18" x2="12" y2="18"/></svg>
        </button>
        <button class="ze-device-btn" data-device="mobile" title="Mobile Preview">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12" y2="18"/></svg>
        </button>
      </div>
    </div>
    <div class="ze-topbar-right">
      <button class="ze-btn ze-btn-ghost" id="ze-undo-btn" title="Undo" disabled>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
      </button>
      <button class="ze-btn ze-btn-ghost" id="ze-redo-btn" title="Redo" disabled>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.13-9.36L23 10"/></svg>
      </button>
      <div class="ze-separator"></div>
      <button class="ze-btn ze-btn-outline" id="ze-preview-btn">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
        Preview
      </button>
      <button class="ze-btn ze-btn-outline" id="ze-export-btn">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
        Export
      </button>
      <label class="ze-btn ze-btn-outline" id="ze-import-btn">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
        Import
        <input type="file" accept=".json" id="ze-import-file" style="display:none" />
      </label>
      <div class="ze-separator"></div>
      <div class="ze-save-status" id="ze-save-status">
        <span class="ze-status-dot"></span>
        <span class="ze-status-text">Ready</span>
      </div>
      <button class="ze-btn ze-btn-primary" id="ze-save-btn">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Save All
      </button>
    </div>
  </header>

  <!-- ===== MAIN LAYOUT ===== -->
  <div class="ze-main">

    <!-- ===== SIDEBAR ===== -->
    <aside class="ze-sidebar" id="ze-sidebar">

      <!-- Sidebar navigation -->
      <nav class="ze-sidebar-nav">
        <button class="ze-nav-item active" data-panel="design">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83M16.62 12l-5.74 9.94"/></svg>
          <span>Design</span>
        </button>
        <button class="ze-nav-item" data-panel="nav">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
          <span>Nav</span>
        </button>
        <button class="ze-nav-item" data-panel="hero">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          <span>Hero</span>
        </button>
        <button class="ze-nav-item" data-panel="sections">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/></svg>
          <span>Sections</span>
        </button>
        <button class="ze-nav-item" data-panel="products">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
          <span>Products</span>
        </button>
        <button class="ze-nav-item" data-panel="testimonials">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
          <span>Reviews</span>
        </button>
        <button class="ze-nav-item" data-panel="faqs">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          <span>FAQ</span>
        </button>
        <button class="ze-nav-item" data-panel="checkout">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
          <span>Checkout</span>
        </button>
        <button class="ze-nav-item" data-panel="footer">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="15" x2="21" y2="15"/></svg>
          <span>Footer</span>
        </button>
      </nav>

      <!-- Sidebar panel content area -->
      <div class="ze-sidebar-content" id="ze-sidebar-content">
        <!-- Panels are rendered dynamically by admin.js -->
        <div class="ze-loading-state">
          <div class="ze-spinner"></div>
          <p>Loading editor...</p>
        </div>
      </div>

    </aside>

    <!-- ===== PREVIEW AREA ===== -->
    <main class="ze-preview-area" id="ze-preview-area">
      <div class="ze-preview-frame-wrap" id="ze-preview-frame-wrap">
        <iframe
          id="ze-preview-iframe"
          src="about:blank"
          title="Site Preview"
          class="ze-preview-iframe"
        ></iframe>
      </div>
    </main>

  </div>

  <!-- ===== TOAST NOTIFICATIONS ===== -->
  <div class="ze-toast-container" id="ze-toast-container"></div>

  <!-- ===== DELETE CONFIRMATION MODAL ===== -->
  <div class="ze-modal-overlay" id="ze-modal-overlay" style="display:none;">
    <div class="ze-modal">
      <div class="ze-modal-header">
        <h3 id="ze-modal-title">Confirm Delete</h3>
        <button class="ze-modal-close" id="ze-modal-close">&times;</button>
      </div>
      <div class="ze-modal-body">
        <p id="ze-modal-message">Are you sure you want to delete this item? This action cannot be undone.</p>
      </div>
      <div class="ze-modal-footer">
        <button class="ze-btn ze-btn-ghost" id="ze-modal-cancel">Cancel</button>
        <button class="ze-btn ze-btn-danger" id="ze-modal-confirm">Delete</button>
      </div>
    </div>
  </div>

</div>

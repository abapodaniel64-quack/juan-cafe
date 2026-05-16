<?php
/**
 * JUAN CAFÉ - User Cart Page
 * File: app/views/user/cart.php
 *
 * Frontend UI only. Cart state managed by cart.js
 */
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="dashboard-layout" style="display: flex; min-height: 100vh;">

  <?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>

  <main class="dashboard-main" style="
    margin-left: var(--sidebar-width);
    flex: 1;
    background: var(--bg-admin);
    padding: var(--space-8);
    padding-top: calc(var(--space-8) + 16px);
  ">

    <!-- Page Header -->
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-8);">
      <button class="mobile-menu-btn btn btn-secondary btn-sm" style="display: none;">
        <i class="fas fa-bars"></i>
      </button>
      <div class="page-header">
        <h1 style="font-family: var(--font-heading); font-size: var(--text-2xl); color: var(--color-espresso);">
          🛒 My Cart
        </h1>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: 4px;">Review your items before placing an order.</p>
      </div>
      <button class="btn btn-secondary btn-sm" onclick="clearCart()">
        <i class="fas fa-trash"></i> Clear Cart
      </button>
    </div>

    <!-- Cart Layout: Items + Summary -->
    <div class="cart-layout" style="display: grid; grid-template-columns: 1fr 360px; gap: var(--space-6); align-items: start;">

      <!-- Cart Items Panel -->
      <div style="background: white; border-radius: var(--border-radius-lg); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: var(--space-6);">
        <h3 style="font-family: var(--font-heading); font-size: var(--text-lg); color: var(--color-espresso); margin-bottom: var(--space-6); padding-bottom: var(--space-4); border-bottom: 1px solid var(--border-light);">
          Cart Items
        </h3>

        <!-- Cart items rendered by cart.js -->
        <div id="cart-items-list">
          <!-- cart.js will render items here on page load -->
          <div style="text-align: center; padding: 60px 0; color: var(--text-muted);">
            <div class="spinner"></div>
            <p style="margin-top: var(--space-4);">Loading cart...</p>
          </div>
        </div>

        <!-- Continue Shopping Link -->
        <div style="margin-top: var(--space-6); padding-top: var(--space-5); border-top: 1px solid var(--border-light);">
          <a href="/app/views/products/products.php" style="font-size: var(--text-sm); color: var(--color-coffee);">
            <i class="fas fa-arrow-left"></i> Continue Shopping
          </a>
        </div>
      </div><!-- /cart items panel -->

      <!-- Order Summary Panel -->
      <div class="cart-summary">
        <div class="summary-title">Order Summary</div>

        <!-- Summary Rows -->
        <div class="summary-row">
          <span>Subtotal</span>
          <span id="cart-subtotal">₱0.00</span>
        </div>
        <div class="summary-row">
          <span>Delivery Fee</span>
          <span id="cart-delivery">₱0.00</span>
        </div>
        <div class="summary-row">
          <span>Discount</span>
          <span id="cart-discount" style="color: var(--color-success);">−₱0.00</span>
        </div>
        <div class="summary-row total">
          <span>Total</span>
          <span id="cart-total">₱0.00</span>
        </div>

        <!-- Promo Code -->
        <div style="margin: var(--space-5) 0;">
          <label style="display: block; font-size: var(--text-xs); font-weight: var(--font-weight-semibold); color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--space-2);">
            Promo Code
          </label>
          <div style="display: flex; gap: var(--space-2);">
            <input
              type="text"
              placeholder="Enter code"
              style="flex: 1; padding: var(--space-2) var(--space-3); border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm);"
            />
            <button
              class="btn btn-secondary btn-sm"
              onclick="showToast('Promo code feature coming soon!', '')"
            >Apply</button>
          </div>
        </div>

        <!-- Place Order Button -->
        <button
          id="checkout-btn"
          class="btn btn-primary btn-lg btn-block"
          onclick="proceedToCheckout()"
          style="margin-top: var(--space-4);"
        >
          <i class="fas fa-check-circle"></i> Place Order
        </button>

        <!-- Note -->
        <p style="font-size: var(--text-xs); color: var(--text-muted); text-align: center; margin-top: var(--space-4); line-height: 1.7;">
          <i class="fas fa-shield-alt" style="color: var(--color-success);"></i>
          Secure order processing. No payment required in this demo.
        </p>
      </div><!-- /cart-summary -->

    </div><!-- /cart-layout -->

  </main>
</div>

<script src="/public/assets/js/app.js"></script>
<script src="/public/assets/js/cart.js"></script>
<script src="/public/assets/js/notifications.js"></script>

<style>
  @media (max-width: 1024px) {
    .mobile-menu-btn { display: flex !important; }
    .cart-layout { grid-template-columns: 1fr !important; }
  }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
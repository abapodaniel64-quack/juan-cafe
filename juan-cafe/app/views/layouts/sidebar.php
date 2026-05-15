<?php
/**
 * JUAN CAFÉ - User Dashboard Sidebar
 * File: app/views/layouts/sidebar.php
 *
 * Include this in all user dashboard pages.
 * Usage: require_once __DIR__ . '/../layouts/sidebar.php';
 */

// Get current page filename for active link highlighting
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- ================================================
     USER SIDEBAR
     ================================================ -->
<aside class="sidebar" id="user-sidebar">

  <!-- Sidebar Profile -->
  <div class="sidebar-profile">
    <div class="sidebar-avatar">👤</div>
    <div>
      <div class="sidebar-user-name">Juan dela Cruz</div>
      <div class="sidebar-user-role">Member</div>
    </div>
  </div>

  <!-- Sidebar Navigation -->
  <nav class="sidebar-nav">

    <!-- Main Section -->
    <div class="sidebar-section">
      <div class="sidebar-section-label">Main</div>

      <a href="/app/views/user/dashboard.php"
         class="sidebar-link <?= $currentPage === 'dashboard.php' ? 'active' : '' ?>">
        <i class="fas fa-home"></i>
        <span class="sidebar-link-text">Dashboard</span>
      </a>

      <a href="/app/views/products/products.php"
         class="sidebar-link <?= $currentPage === 'products.php' ? 'active' : '' ?>">
        <i class="fas fa-coffee"></i>
        <span class="sidebar-link-text">Browse Menu</span>
      </a>

      <a href="/app/views/user/cart.php"
         class="sidebar-link <?= $currentPage === 'cart.php' ? 'active' : '' ?>">
        <i class="fas fa-shopping-bag"></i>
        <span class="sidebar-link-text">My Cart</span>
        <!-- Badge: cart item count (update via JS) -->
        <span class="sidebar-badge cart-badge">3</span>
      </a>

    </div><!-- /Main Section -->

    <!-- Orders Section -->
    <div class="sidebar-section">
      <div class="sidebar-section-label">Orders</div>

      <a href="/app/views/user/order-history.php"
         class="sidebar-link <?= $currentPage === 'order-history.php' ? 'active' : '' ?>">
        <i class="fas fa-receipt"></i>
        <span class="sidebar-link-text">Order History</span>
      </a>

    </div><!-- /Orders Section -->

    <!-- Account Section -->
    <div class="sidebar-section">
      <div class="sidebar-section-label">Account</div>

      <a href="/app/views/user/profile.php"
         class="sidebar-link <?= $currentPage === 'profile.php' ? 'active' : '' ?>">
        <i class="fas fa-user"></i>
        <span class="sidebar-link-text">My Profile</span>
      </a>

      <a href="/app/views/user/notifications.php"
         class="sidebar-link <?= $currentPage === 'notifications.php' ? 'active' : '' ?>">
        <i class="fas fa-bell"></i>
        <span class="sidebar-link-text">Notifications</span>
        <!-- Badge: unread count (updated via notifications.js) -->
        <span class="sidebar-badge notif-badge" style="background: var(--color-danger);">2</span>
      </a>

      <a href="/app/views/user/support.php"
         class="sidebar-link <?= $currentPage === 'support.php' ? 'active' : '' ?>">
        <i class="fas fa-headset"></i>
        <span class="sidebar-link-text">Support</span>
      </a>

    </div><!-- /Account Section -->

  </nav><!-- /sidebar-nav -->

  <!-- Sidebar Footer: Back to Website + Logout -->
  <div class="sidebar-footer">
    <a href="/app/views/home/index.php" class="sidebar-link" style="margin-bottom: 6px;">
      <i class="fas fa-globe"></i>
      <span class="sidebar-link-text">Back to Website</span>
    </a>
    <button class="sidebar-logout-btn" onclick="showToast('Logged out successfully.', 'success')">
      <i class="fas fa-sign-out-alt"></i>
      <span class="sidebar-link-text">Log Out</span>
    </button>
  </div>

  <!-- Collapse Toggle Button (desktop only) -->
  <button class="sidebar-toggle sidebar-toggle-btn" title="Collapse sidebar">
    <i class="fas fa-chevron-left"></i>
  </button>

</aside><!-- /sidebar -->

<!-- Dark overlay shown on mobile when sidebar is open -->
<div class="sidebar-overlay" id="sidebar-overlay"></div>
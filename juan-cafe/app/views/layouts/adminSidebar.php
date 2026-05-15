<?php
/**
 * JUAN CAFÉ - Admin Sidebar
 * File: app/views/layouts/adminSidebar.php
 *
 * Include this in all admin dashboard pages.
 * Usage: require_once __DIR__ . '/../layouts/adminSidebar.php';
 */

// Get current page filename for active link highlighting
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- ================================================
     ADMIN SIDEBAR
     ================================================ -->
<aside class="admin-sidebar" id="admin-sidebar">

  <!-- Sidebar Brand -->
  <div class="admin-sidebar-brand">
    <div class="admin-brand-logo">☕</div>
    <div>
      <div class="admin-brand-name">Juan Café</div>
      <span class="admin-brand-tag">Admin Panel</span>
    </div>
  </div>

  <!-- Admin Navigation -->
  <nav class="admin-nav">

    <!-- Overview Section -->
    <div class="admin-nav-section">
      <div class="admin-nav-label">Overview</div>

      <a href="/app/views/admin/dashboard.php"
         class="admin-nav-link <?= $currentPage === 'dashboard.php' ? 'active' : '' ?>">
        <i class="fas fa-tachometer-alt"></i>
        <span class="admin-nav-link-text">Dashboard</span>
      </a>

    </div><!-- /Overview -->

    <!-- Manage Section -->
    <div class="admin-nav-section">
      <div class="admin-nav-label">Manage</div>

      <a href="/app/views/admin/products.php"
         class="admin-nav-link <?= $currentPage === 'products.php' ? 'active' : '' ?>">
        <i class="fas fa-coffee"></i>
        <span class="admin-nav-link-text">Products</span>
      </a>

      <a href="/app/views/admin/orders.php"
         class="admin-nav-link <?= $currentPage === 'orders.php' ? 'active' : '' ?>">
        <i class="fas fa-receipt"></i>
        <span class="admin-nav-link-text">Orders</span>
        <!-- Badge: pending orders count -->
        <span class="admin-nav-badge">5</span>
      </a>

      <a href="/app/views/admin/users.php"
         class="admin-nav-link <?= $currentPage === 'users.php' ? 'active' : '' ?>">
        <i class="fas fa-users"></i>
        <span class="admin-nav-link-text">Users</span>
      </a>

      <a href="/app/views/admin/inventory.php"
         class="admin-nav-link <?= $currentPage === 'inventory.php' ? 'active' : '' ?>">
        <i class="fas fa-boxes"></i>
        <span class="admin-nav-link-text">Inventory</span>
      </a>

    </div><!-- /Manage -->

    <!-- Analytics Section -->
    <div class="admin-nav-section">
      <div class="admin-nav-label">Analytics</div>

      <a href="/app/views/admin/reports.php"
         class="admin-nav-link <?= $currentPage === 'reports.php' ? 'active' : '' ?>">
        <i class="fas fa-chart-bar"></i>
        <span class="admin-nav-link-text">Reports</span>
      </a>

    </div><!-- /Analytics -->

    <!-- System Section -->
    <div class="admin-nav-section">
      <div class="admin-nav-label">System</div>

      <a href="/app/views/admin/notifications.php"
         class="admin-nav-link <?= $currentPage === 'notifications.php' ? 'active' : '' ?>">
        <i class="fas fa-bell"></i>
        <span class="admin-nav-link-text">Notifications</span>
        <!-- Badge: unread notifications -->
        <span class="admin-nav-badge">2</span>
      </a>

    </div><!-- /System -->

  </nav><!-- /admin-nav -->

  <!-- Sidebar Footer -->
  <div class="admin-sidebar-footer">
    <!-- Back to website link -->
    <a href="/app/views/home/index.php"
       class="admin-nav-link"
       style="margin-bottom: 6px; border-left: none; padding-left: var(--space-3);">
      <i class="fas fa-globe"></i>
      <span class="admin-nav-link-text">View Website</span>
    </a>

    <!-- Logout button -->
    <button class="admin-logout-btn" onclick="showToast('Logged out successfully.', 'success')">
      <i class="fas fa-sign-out-alt"></i>
      <span>Log Out</span>
    </button>
  </div>

</aside><!-- /admin-sidebar -->

<!-- Dark overlay for mobile sidebar -->
<div class="sidebar-overlay" id="admin-sidebar-overlay"></div>
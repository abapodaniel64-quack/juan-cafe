<?php
/**
 * JUAN CAFÉ - User Notifications Page
 * File: app/views/user/notifications.php
 *
 * Frontend only - no backend logic
 */
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<!-- ================================================
     DASHBOARD WRAPPER
     ================================================ -->
<div class="dashboard-wrapper">

  <!-- Mobile Top Bar -->
  <div class="dashboard-topbar">
    <button class="mobile-menu-btn" title="Open menu">
      <i class="fas fa-bars"></i>
    </button>
    <h1 class="dashboard-page-title">Notifications</h1>
  </div>

  <!-- ================================================
       MAIN CONTENT AREA
       ================================================ -->
  <main class="dashboard-main">
    <div class="dashboard-content">

      <!-- Page Header -->
      <div class="page-header" style="display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: var(--space-4); margin-bottom: var(--space-6);">
        <div>
          <h2 style="font-family: var(--font-heading); font-size: var(--text-2xl); color: var(--color-espresso); margin-bottom: var(--space-1);">
            Notifications
            <!-- Badge showing unread count -->
            <span class="notif-badge" style="
              display: inline-flex;
              align-items: center;
              justify-content: center;
              background: var(--color-danger);
              color: white;
              font-size: var(--text-xs);
              font-family: var(--font-body);
              font-weight: 700;
              min-width: 22px;
              height: 22px;
              border-radius: var(--border-radius-full);
              padding: 0 6px;
              margin-left: var(--space-2);
              vertical-align: middle;
            ">2</span>
          </h2>
          <p style="color: var(--text-muted); font-size: var(--text-sm);">
            Stay updated on your orders, promos, and account activity.
          </p>
        </div>

        <!-- Mark All Read Button -->
        <button class="btn btn-secondary btn-sm" onclick="markAllAsRead()">
          <i class="fas fa-check-double"></i> Mark All as Read
        </button>
      </div>

      <!-- ================================================
           FILTER TABS
           ================================================ -->
      <div style="display: flex; gap: var(--space-2); flex-wrap: wrap; margin-bottom: var(--space-6);">

        <button class="btn notif-filter-btn active" data-filter="all"
          style="border-radius: var(--border-radius-full); font-size: var(--text-xs); padding: var(--space-2) var(--space-4);">
          All
        </button>

        <button class="btn notif-filter-btn" data-filter="unread"
          style="border-radius: var(--border-radius-full); font-size: var(--text-xs); padding: var(--space-2) var(--space-4);">
          Unread
        </button>

        <button class="btn notif-filter-btn" data-filter="order"
          style="border-radius: var(--border-radius-full); font-size: var(--text-xs); padding: var(--space-2) var(--space-4);">
          <i class="fas fa-receipt"></i> Orders
        </button>

        <button class="btn notif-filter-btn" data-filter="promo"
          style="border-radius: var(--border-radius-full); font-size: var(--text-xs); padding: var(--space-2) var(--space-4);">
          <i class="fas fa-tag"></i> Promos
        </button>

        <button class="btn notif-filter-btn" data-filter="payment"
          style="border-radius: var(--border-radius-full); font-size: var(--text-xs); padding: var(--space-2) var(--space-4);">
          <i class="fas fa-credit-card"></i> Payments
        </button>

        <button class="btn notif-filter-btn" data-filter="system"
          style="border-radius: var(--border-radius-full); font-size: var(--text-xs); padding: var(--space-2) var(--space-4);">
          <i class="fas fa-cog"></i> System
        </button>

      </div><!-- /filter tabs -->

      <!-- ================================================
           NOTIFICATIONS LIST (rendered by notifications.js)
           ================================================ -->
      <div id="notifications-list">
        <!-- Notifications are injected here by notifications.js -->

        <!-- Static fallback / loading state -->
        <div style="text-align: center; padding: var(--space-12) 0; color: var(--text-muted);">
          <div class="spinner"></div>
          <p style="font-size: var(--text-sm); margin-top: var(--space-4);">Loading notifications...</p>
        </div>
      </div>

      <!-- ================================================
           EMPTY STATE (shown if no notifications)
           (This is an example – notifications.js handles real empty states)
           ================================================ -->
      <!--
      <div id="notif-empty-state" style="text-align: center; padding: 60px 0; display: none;">
        <div style="font-size: 3.5rem; margin-bottom: var(--space-4); opacity: 0.35;">🔔</div>
        <h4 style="font-family: var(--font-heading); font-size: var(--text-xl); color: var(--color-espresso); margin-bottom: var(--space-2);">
          No Notifications Yet
        </h4>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-bottom: var(--space-6);">
          When you place orders or receive promos, you'll see them here.
        </p>
        <a href="/app/views/products/products.php" class="btn btn-primary">
          <i class="fas fa-coffee"></i> Browse Menu
        </a>
      </div>
      -->

    </div><!-- /dashboard-content -->
  </main><!-- /dashboard-main -->

</div><!-- /dashboard-wrapper -->

<!-- Filter button active state styling -->
<style>
  .notif-filter-btn {
    background: transparent;
    color: var(--text-secondary);
    border: 1.5px solid var(--border-light);
    transition: var(--transition-fast);
  }

  .notif-filter-btn:hover,
  .notif-filter-btn.active {
    background: var(--color-coffee);
    color: white;
    border-color: var(--color-coffee);
  }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
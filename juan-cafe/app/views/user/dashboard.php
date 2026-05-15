<?php
/**
 * JUAN CAFÉ - User Dashboard
 * File: app/views/user/dashboard.php
 *
 * Frontend UI only — no backend yet.
 */
require_once __DIR__ . '/../layouts/header.php';
?>

<!-- ================================================
     DASHBOARD LAYOUT
     ================================================ -->
<div class="dashboard-layout" style="display: flex; min-height: 100vh;">

  <!-- Sidebar -->
  <?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>

  <!-- Main Content Area -->
  <main class="dashboard-main" style="
    margin-left: var(--sidebar-width);
    flex: 1;
    background: var(--bg-admin);
    min-height: 100vh;
    padding: var(--space-8);
    padding-top: calc(var(--space-8) + 16px);
    transition: var(--transition-normal);
  ">

    <!-- Top Bar (mobile menu toggle) -->
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-8);">
      <!-- Mobile sidebar toggle -->
      <button class="mobile-menu-btn btn btn-secondary btn-sm" style="display: none;">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Page Title -->
      <div class="page-header">
        <h1 style="font-family: var(--font-heading); font-size: var(--text-2xl); color: var(--color-espresso);">
          Welcome back, Juan! 👋
        </h1>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: 4px;">
          Here's what's happening with your account today.
        </p>
      </div>

      <!-- Quick Order Button -->
      <a href="/app/views/products/products.php" class="btn btn-primary">
        <i class="fas fa-coffee"></i> Order Now
      </a>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--space-5); margin-bottom: var(--space-8);">

      <div class="admin-stat-card">
        <div class="admin-stat-icon">📦</div>
        <div class="admin-stat-number">12</div>
        <div class="admin-stat-label">Total Orders</div>
        <div class="admin-stat-change up"><i class="fas fa-arrow-up"></i> 2 this month</div>
      </div>

      <div class="admin-stat-card">
        <div class="admin-stat-icon">⏳</div>
        <div class="admin-stat-number">1</div>
        <div class="admin-stat-label">Pending Order</div>
        <div class="admin-stat-change" style="color: var(--color-warning);">In progress</div>
      </div>

      <div class="admin-stat-card">
        <div class="admin-stat-icon">🛒</div>
        <div class="admin-stat-number">3</div>
        <div class="admin-stat-label">Cart Items</div>
        <div class="admin-stat-change" style="color: var(--text-muted);">₱250 total</div>
      </div>

      <div class="admin-stat-card">
        <div class="admin-stat-icon">💳</div>
        <div class="admin-stat-number">₱1,245</div>
        <div class="admin-stat-label">Total Spent</div>
        <div class="admin-stat-change up"><i class="fas fa-arrow-up"></i> +₱220 this month</div>
      </div>

    </div><!-- /stats-grid -->

    <!-- Recent Orders + Notifications (2-col grid) -->
    <div class="panels-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: var(--space-6);">

      <!-- Recent Orders Table -->
      <div style="background: white; border-radius: var(--border-radius-lg); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); overflow: hidden;">
        <div style="padding: var(--space-5) var(--space-6); border-bottom: 1px solid var(--border-light); display: flex; align-items: center; justify-content: space-between;">
          <h3 style="font-family: var(--font-heading); font-size: var(--text-lg); color: var(--color-espresso);">Recent Orders</h3>
          <a href="/app/views/user/order-history.php" style="font-size: var(--text-sm); color: var(--color-coffee);">View All →</a>
        </div>
        <div class="table-wrap">
          <table class="data-table" style="width: 100%; border-collapse: collapse;">
            <thead>
              <tr style="background: var(--bg-secondary);">
                <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Order #</th>
                <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Items</th>
                <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Total</th>
                <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Status</th>
                <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $orders = [
                ['id'=>'JC-00124', 'items'=>'Classic Milk Tea, Mocha Frappe', 'total'=>'₱185', 'status'=>'Confirmed', 'status_color'=>'var(--color-info)', 'date'=>'May 15, 2024'],
                ['id'=>'JC-00123', 'items'=>'Brown Sugar Coffee', 'total'=>'₱95', 'status'=>'Ready', 'status_color'=>'var(--color-success)', 'date'=>'May 14, 2024'],
                ['id'=>'JC-00122', 'items'=>'Lychee Fruit Tea × 2', 'total'=>'₱160', 'status'=>'Completed', 'status_color'=>'var(--color-coffee)', 'date'=>'May 12, 2024'],
                ['id'=>'JC-00121', 'items'=>'Matcha Latte', 'total'=>'₱100', 'status'=>'Completed', 'status_color'=>'var(--color-coffee)', 'date'=>'May 10, 2024'],
              ];
              foreach ($orders as $order): ?>
                <tr style="border-bottom: 1px solid var(--border-light);">
                  <td style="padding: var(--space-4); font-size: var(--text-sm); font-weight: var(--font-weight-semibold); color: var(--color-coffee);">
                    <?= $order['id'] ?>
                  </td>
                  <td style="padding: var(--space-4); font-size: var(--text-sm); color: var(--text-secondary); max-width: 200px;">
                    <?= htmlspecialchars($order['items']) ?>
                  </td>
                  <td style="padding: var(--space-4); font-size: var(--text-sm); font-weight: var(--font-weight-semibold);">
                    <?= $order['total'] ?>
                  </td>
                  <td style="padding: var(--space-4);">
                    <span style="font-size: var(--text-xs); font-weight: var(--font-weight-semibold); color: <?= $order['status_color'] ?>; background: <?= $order['status_color'] ?>22; padding: 3px 10px; border-radius: var(--border-radius-full);">
                      <?= $order['status'] ?>
                    </span>
                  </td>
                  <td style="padding: var(--space-4); font-size: var(--text-xs); color: var(--text-muted);">
                    <?= $order['date'] ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div><!-- /orders panel -->

      <!-- Recent Notifications -->
      <div style="background: white; border-radius: var(--border-radius-lg); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); overflow: hidden;">
        <div style="padding: var(--space-5) var(--space-6); border-bottom: 1px solid var(--border-light); display: flex; align-items: center; justify-content: space-between;">
          <h3 style="font-family: var(--font-heading); font-size: var(--text-lg); color: var(--color-espresso);">Notifications</h3>
          <a href="/app/views/user/notifications.php" style="font-size: var(--text-sm); color: var(--color-coffee);">View All →</a>
        </div>
        <!-- Notifications rendered by notifications.js -->
        <div id="notifications-list" style="padding: var(--space-4);"></div>
      </div>

    </div><!-- /panels-grid -->

    <!-- Quick Links -->
    <div style="margin-top: var(--space-8); display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: var(--space-4);">
      <?php
      $quickLinks = [
        ['href'=>'/app/views/products/products.php', 'icon'=>'fas fa-coffee', 'label'=>'Browse Menu'],
        ['href'=>'/app/views/user/cart.php',          'icon'=>'fas fa-shopping-bag', 'label'=>'My Cart'],
        ['href'=>'/app/views/user/order-history.php', 'icon'=>'fas fa-receipt', 'label'=>'Order History'],
        ['href'=>'/app/views/user/profile.php',       'icon'=>'fas fa-user', 'label'=>'My Profile'],
      ];
      foreach ($quickLinks as $link): ?>
        <a href="<?= $link['href'] ?>" style="
          background: white;
          border-radius: var(--border-radius-lg);
          padding: var(--space-5);
          border: 1px solid var(--border-light);
          box-shadow: var(--shadow-sm);
          text-align: center;
          transition: var(--transition-normal);
          display: block;
          color: var(--color-espresso);
        " onmouseover="this.style.boxShadow='var(--shadow-md)'; this.style.transform='translateY(-2px)'"
           onmouseout="this.style.boxShadow='var(--shadow-sm)'; this.style.transform=''">
          <i class="<?= $link['icon'] ?>" style="font-size: 1.5rem; color: var(--color-coffee); margin-bottom: var(--space-3); display: block;"></i>
          <span style="font-size: var(--text-sm); font-weight: var(--font-weight-medium);"><?= $link['label'] ?></span>
        </a>
      <?php endforeach; ?>
    </div>

  </main><!-- /dashboard-main -->
</div><!-- /dashboard-layout -->

<!-- JS -->
<script src="/public/assets/js/app.js"></script>
<script src="/public/assets/js/cart.js"></script>
<script src="/public/assets/js/notifications.js"></script>

<!-- Show mobile menu button on small screens -->
<style>
  @media (max-width: 1024px) {
    .mobile-menu-btn { display: flex !important; }
    .stats-grid { grid-template-columns: repeat(2, 1fr) !important; }
    .panels-grid { grid-template-columns: 1fr !important; }
  }
  @media (max-width: 480px) {
    .stats-grid { grid-template-columns: 1fr !important; }
  }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
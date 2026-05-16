<?php
/**
 * JUAN CAFÉ - Admin Dashboard
 * File: app/views/admin/dashboard.php
 *
 * Frontend UI only — no backend yet.
 * Shows overview stats, recent orders, charts, and quick actions.
 */

// Include header (loads CSS, Google Fonts, Font Awesome)
require_once __DIR__ . '/../layouts/header.php';

// Load admin CSS
echo '<link rel="stylesheet" href="/public/assets/css/admin.css" />';
?>

<!-- ================================================
     ADMIN LAYOUT WRAPPER
     ================================================ -->
<div class="admin-layout">

  <!-- Admin Sidebar -->
  <?php require_once __DIR__ . '/../layouts/adminSidebar.php'; ?>

  <!-- Admin Main Area -->
  <div class="admin-main" id="admin-main">

    <!-- Top Bar -->
    <div class="admin-topbar" id="admin-topbar">
      <div class="topbar-left">
        <!-- Mobile: Sidebar toggle button -->
        <button class="hamburger" id="admin-menu-btn" aria-label="Toggle sidebar">
          <span></span><span></span><span></span>
        </button>
        <div class="topbar-title">Dashboard</div>
      </div>
      <div class="topbar-right">
        <!-- Notifications Bell -->
        <button class="nav-icon-btn" title="Notifications"
                onclick="window.location.href='/app/views/admin/notifications.php'">
          <i class="fas fa-bell"></i>
          <span class="cart-badge" style="background: var(--color-danger);">2</span>
        </button>
        <!-- Admin User Info -->
        <div class="topbar-user">
          <div class="topbar-avatar">A</div>
          <div class="topbar-user-info">
            <span>Admin</span>
            <small>Administrator</small>
          </div>
        </div>
      </div>
    </div><!-- /admin-topbar -->

    <!-- Page Content -->
    <div class="admin-content">

      <!-- Page Header -->
      <div class="page-header">
        <h1 class="page-title">Dashboard Overview</h1>
        <div class="page-breadcrumb">
          <i class="fas fa-home"></i> Admin &rsaquo; <span>Dashboard</span>
        </div>
      </div>

      <!-- ============================================
           STATS CARDS
           ============================================ -->
      <div class="admin-stats-grid">

        <!-- Total Revenue -->
        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(200,148,42,0.12); color: var(--color-gold);">
            <i class="fas fa-peso-sign"></i>
          </div>
          <div>
            <div class="admin-stat-number">₱ 48,250</div>
            <div class="admin-stat-label">Total Revenue</div>
            <div class="admin-stat-change up">
              <i class="fas fa-arrow-up"></i> +12.5% this month
            </div>
          </div>
        </div>

        <!-- Total Orders -->
        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(33,150,243,0.1); color: var(--color-info);">
            <i class="fas fa-receipt"></i>
          </div>
          <div>
            <div class="admin-stat-number">324</div>
            <div class="admin-stat-label">Total Orders</div>
            <div class="admin-stat-change up">
              <i class="fas fa-arrow-up"></i> +8 today
            </div>
          </div>
        </div>

        <!-- Pending Orders -->
        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(255,152,0,0.1); color: var(--color-warning);">
            <i class="fas fa-clock"></i>
          </div>
          <div>
            <div class="admin-stat-number">5</div>
            <div class="admin-stat-label">Pending Orders</div>
            <div class="admin-stat-change down">
              <i class="fas fa-exclamation-circle"></i> Needs attention
            </div>
          </div>
        </div>

        <!-- Total Users -->
        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(76,175,80,0.1); color: var(--color-success);">
            <i class="fas fa-users"></i>
          </div>
          <div>
            <div class="admin-stat-number">1,042</div>
            <div class="admin-stat-label">Registered Users</div>
            <div class="admin-stat-change up">
              <i class="fas fa-arrow-up"></i> +15 this week
            </div>
          </div>
        </div>

        <!-- Total Products -->
        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(111,78,55,0.1); color: var(--color-coffee);">
            <i class="fas fa-coffee"></i>
          </div>
          <div>
            <div class="admin-stat-number">48</div>
            <div class="admin-stat-label">Active Products</div>
            <div class="admin-stat-change up">
              <i class="fas fa-check-circle"></i> All in stock
            </div>
          </div>
        </div>

        <!-- Low Stock -->
        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(229,57,53,0.1); color: var(--color-danger);">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
          <div>
            <div class="admin-stat-number">3</div>
            <div class="admin-stat-label">Low Stock Items</div>
            <div class="admin-stat-change down">
              <i class="fas fa-arrow-down"></i> Restock needed
            </div>
          </div>
        </div>

      </div><!-- /admin-stats-grid -->

      <!-- ============================================
           CHARTS ROW
           ============================================ -->
      <div class="charts-grid">

        <!-- Bar Chart: Weekly Sales -->
        <div class="chart-card">
          <div class="chart-header">
            <div class="chart-title">
              <i class="fas fa-chart-bar" style="color: var(--color-coffee);"></i>
              Weekly Sales
            </div>
            <span class="badge badge-coffee">This Week</span>
          </div>
          <div class="chart-placeholder">
            <!-- Placeholder bar chart mockup -->
            <div class="bar-chart-mockup">
              <div class="bar-item"><div class="bar-fill" style="height: 55%;"></div><div class="bar-label">Mon</div></div>
              <div class="bar-item"><div class="bar-fill" style="height: 75%;"></div><div class="bar-label">Tue</div></div>
              <div class="bar-item"><div class="bar-fill" style="height: 60%;"></div><div class="bar-label">Wed</div></div>
              <div class="bar-item"><div class="bar-fill" style="height: 90%;"></div><div class="bar-label">Thu</div></div>
              <div class="bar-item"><div class="bar-fill" style="height: 80%;"></div><div class="bar-label">Fri</div></div>
              <div class="bar-item"><div class="bar-fill" style="height: 95%;"></div><div class="bar-label">Sat</div></div>
              <div class="bar-item"><div class="bar-fill" style="height: 70%;"></div><div class="bar-label">Sun</div></div>
            </div>
            <p style="text-align:center; color: var(--text-muted); font-size: var(--text-xs); margin-top: var(--space-2);">
              Chart placeholder — connect to real data later
            </p>
          </div>
        </div>

        <!-- Donut Chart: Sales by Category -->
        <div class="chart-card">
          <div class="chart-header">
            <div class="chart-title">
              <i class="fas fa-chart-pie" style="color: var(--color-gold);"></i>
              Sales by Category
            </div>
            <span class="badge badge-coffee">This Month</span>
          </div>
          <div class="chart-placeholder">
            <div class="donut-mockup">
              <div class="donut-circle">
                <div class="donut-hole">
                  <div class="donut-center-number">324</div>
                  <div class="donut-center-label">Orders</div>
                </div>
              </div>
              <div class="donut-legend">
                <div class="legend-item"><div class="legend-dot" style="background: var(--color-coffee);"></div> Milk Tea (35%)</div>
                <div class="legend-item"><div class="legend-dot" style="background: var(--color-gold);"></div> Coffee (28%)</div>
                <div class="legend-item"><div class="legend-dot" style="background: var(--color-latte);"></div> Frappe (20%)</div>
                <div class="legend-item"><div class="legend-dot" style="background: var(--color-success);"></div> Fruit Tea (17%)</div>
              </div>
            </div>
            <p style="text-align:center; color: var(--text-muted); font-size: var(--text-xs); margin-top: var(--space-2);">
              Chart placeholder — connect to real data later
            </p>
          </div>
        </div>

      </div><!-- /charts-grid -->

      <!-- ============================================
           RECENT ORDERS TABLE
           ============================================ -->
      <div class="dashboard-panel">
        <div class="panel-header">
          <div class="panel-title">
            <i class="fas fa-receipt" style="color: var(--color-coffee);"></i>
            Recent Orders
          </div>
          <a href="/app/views/admin/orders.php" class="btn btn-sm btn-secondary">
            View All <i class="fas fa-arrow-right"></i>
          </a>
        </div>
        <div class="panel-body">
          <div class="table-wrap">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Customer</th>
                  <th>Items</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>#ORD-001</strong></td>
                  <td>Maria Santos</td>
                  <td>Milk Tea x2, Frappe x1</td>
                  <td>₱ 285.00</td>
                  <td><span class="badge badge-pending">Pending</span></td>
                  <td>May 15, 2026</td>
                  <td class="table-actions">
                    <button class="action-btn view" title="View"><i class="fas fa-eye"></i></button>
                    <button class="action-btn edit" title="Edit"><i class="fas fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td><strong>#ORD-002</strong></td>
                  <td>Jose Reyes</td>
                  <td>Coffee x1, Latte x1</td>
                  <td>₱ 190.00</td>
                  <td><span class="badge badge-active">Processing</span></td>
                  <td>May 15, 2026</td>
                  <td class="table-actions">
                    <button class="action-btn view" title="View"><i class="fas fa-eye"></i></button>
                    <button class="action-btn edit" title="Edit"><i class="fas fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td><strong>#ORD-003</strong></td>
                  <td>Ana Cruz</td>
                  <td>Fruit Tea x3</td>
                  <td>₱ 225.00</td>
                  <td><span class="badge badge-success">Completed</span></td>
                  <td>May 14, 2026</td>
                  <td class="table-actions">
                    <button class="action-btn view" title="View"><i class="fas fa-eye"></i></button>
                    <button class="action-btn edit" title="Edit"><i class="fas fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td><strong>#ORD-004</strong></td>
                  <td>Pedro Lim</td>
                  <td>Premium Drink x2</td>
                  <td>₱ 360.00</td>
                  <td><span class="badge badge-success">Completed</span></td>
                  <td>May 14, 2026</td>
                  <td class="table-actions">
                    <button class="action-btn view" title="View"><i class="fas fa-eye"></i></button>
                    <button class="action-btn edit" title="Edit"><i class="fas fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td><strong>#ORD-005</strong></td>
                  <td>Rosa Garcia</td>
                  <td>Frappe x2, Hot Drink x1</td>
                  <td>₱ 310.00</td>
                  <td><span class="badge badge-danger">Cancelled</span></td>
                  <td>May 13, 2026</td>
                  <td class="table-actions">
                    <button class="action-btn view" title="View"><i class="fas fa-eye"></i></button>
                    <button class="action-btn edit" title="Edit"><i class="fas fa-edit"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div><!-- /table-wrap -->
        </div>
      </div><!-- /dashboard-panel -->

      <!-- ============================================
           BOTTOM ROW: Top Products + Quick Actions
           ============================================ -->
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-6); margin-top: var(--space-6);">

        <!-- Top Selling Products -->
        <div class="dashboard-panel">
          <div class="panel-header">
            <div class="panel-title">
              <i class="fas fa-star" style="color: var(--color-gold);"></i>
              Top Selling Products
            </div>
          </div>
          <div class="panel-body">
            <?php
            // Placeholder top products data
            $topProducts = [
              ['name' => 'Classic Milk Tea',   'cat' => 'Milk Tea',  'sold' => 86, 'pct' => 90],
              ['name' => 'Hazelnut Latte',     'cat' => 'Latte',     'sold' => 72, 'pct' => 75],
              ['name' => 'Mango Fruit Tea',    'cat' => 'Fruit Tea', 'sold' => 65, 'pct' => 68],
              ['name' => 'Caramel Frappe',     'cat' => 'Frappe',    'sold' => 58, 'pct' => 60],
              ['name' => 'Spanish Latte',      'cat' => 'Latte',     'sold' => 50, 'pct' => 52],
            ];
            foreach ($topProducts as $p):
            ?>
            <div style="margin-bottom: var(--space-4);">
              <div class="flex-between" style="margin-bottom: var(--space-1);">
                <div>
                  <strong style="font-size: var(--text-sm);"><?= $p['name'] ?></strong>
                  <span class="badge badge-coffee" style="margin-left: 6px; font-size: 0.65rem;"><?= $p['cat'] ?></span>
                </div>
                <span style="font-size: var(--text-xs); color: var(--text-muted);"><?= $p['sold'] ?> sold</span>
              </div>
              <div class="stock-bar-wrap">
                <div class="stock-bar" style="width: <?= $p['pct'] ?>%;"></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="dashboard-panel">
          <div class="panel-header">
            <div class="panel-title">
              <i class="fas fa-bolt" style="color: var(--color-gold);"></i>
              Quick Actions
            </div>
          </div>
          <div class="panel-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-3);">
              <a href="/app/views/admin/products.php" class="btn btn-secondary" style="justify-content: center; flex-direction: column; gap: 6px; padding: var(--space-4); border-radius: var(--border-radius-md);">
                <i class="fas fa-plus-circle" style="font-size: 1.4rem; color: var(--color-coffee);"></i>
                <span style="font-size: var(--text-xs);">Add Product</span>
              </a>
              <a href="/app/views/admin/orders.php" class="btn btn-secondary" style="justify-content: center; flex-direction: column; gap: 6px; padding: var(--space-4); border-radius: var(--border-radius-md);">
                <i class="fas fa-clipboard-list" style="font-size: 1.4rem; color: var(--color-info);"></i>
                <span style="font-size: var(--text-xs);">View Orders</span>
              </a>
              <a href="/app/views/admin/users.php" class="btn btn-secondary" style="justify-content: center; flex-direction: column; gap: 6px; padding: var(--space-4); border-radius: var(--border-radius-md);">
                <i class="fas fa-users" style="font-size: 1.4rem; color: var(--color-success);"></i>
                <span style="font-size: var(--text-xs);">Manage Users</span>
              </a>
              <a href="/app/views/admin/inventory.php" class="btn btn-secondary" style="justify-content: center; flex-direction: column; gap: 6px; padding: var(--space-4); border-radius: var(--border-radius-md);">
                <i class="fas fa-boxes" style="font-size: 1.4rem; color: var(--color-warning);"></i>
                <span style="font-size: var(--text-xs);">Inventory</span>
              </a>
              <a href="/app/views/admin/reports.php" class="btn btn-secondary" style="justify-content: center; flex-direction: column; gap: 6px; padding: var(--space-4); border-radius: var(--border-radius-md);">
                <i class="fas fa-chart-bar" style="font-size: 1.4rem; color: var(--color-danger);"></i>
                <span style="font-size: var(--text-xs);">View Reports</span>
              </a>
              <a href="/app/views/admin/notifications.php" class="btn btn-secondary" style="justify-content: center; flex-direction: column; gap: 6px; padding: var(--space-4); border-radius: var(--border-radius-md);">
                <i class="fas fa-bell" style="font-size: 1.4rem; color: var(--color-gold);"></i>
                <span style="font-size: var(--text-xs);">Notifications</span>
              </a>
            </div>
          </div>
        </div>

      </div><!-- /bottom row -->

    </div><!-- /admin-content -->
  </div><!-- /admin-main -->
</div><!-- /admin-layout -->

<!-- Admin JS -->
<script src="/public/assets/js/admin.js"></script>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
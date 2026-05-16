<?php
/**
 * JUAN CAFÉ - Admin Orders Page
 * File: app/views/admin/orders.php
 *
 * Frontend UI only — no backend yet.
 * Displays a table of all orders with status filters and actions.
 */

require_once __DIR__ . '/../layouts/header.php';
echo '<link rel="stylesheet" href="/public/assets/css/admin.css" />';

// Placeholder orders data — replace with database query later
$orders = [
  ['id'=>'#JC-0025', 'customer'=>'Maria Santos',   'items'=>3, 'total'=>275, 'status'=>'pending',    'date'=>'May 15, 2025 · 10:32 AM'],
  ['id'=>'#JC-0024', 'customer'=>'Jose Reyes',      'items'=>2, 'total'=>190, 'status'=>'processing', 'date'=>'May 15, 2025 · 10:15 AM'],
  ['id'=>'#JC-0023', 'customer'=>'Ana Cruz',         'items'=>5, 'total'=>450, 'status'=>'completed',  'date'=>'May 15, 2025 · 09:50 AM'],
  ['id'=>'#JC-0022', 'customer'=>'Pedro Dela Cruz',  'items'=>1, 'total'=>85,  'status'=>'completed',  'date'=>'May 15, 2025 · 09:30 AM'],
  ['id'=>'#JC-0021', 'customer'=>'Luz Villanueva',   'items'=>4, 'total'=>380, 'status'=>'cancelled',  'date'=>'May 14, 2025 · 08:10 PM'],
  ['id'=>'#JC-0020', 'customer'=>'Ramon Bautista',   'items'=>2, 'total'=>220, 'status'=>'completed',  'date'=>'May 14, 2025 · 06:45 PM'],
  ['id'=>'#JC-0019', 'customer'=>'Carmen Torres',    'items'=>3, 'total'=>315, 'status'=>'pending',    'date'=>'May 14, 2025 · 05:20 PM'],
  ['id'=>'#JC-0018', 'customer'=>'Miguel Lim',       'items'=>1, 'total'=>130, 'status'=>'processing', 'date'=>'May 14, 2025 · 04:55 PM'],
];

// Status badge colors helper
function getStatusStyle($status) {
  return match($status) {
    'pending'    => 'background:#FFF3E0; color:#E65100;',
    'processing' => 'background:#E3F2FD; color:#1565C0;',
    'completed'  => 'background:#E8F5E9; color:#2E7D32;',
    'cancelled'  => 'background:#FFEBEE; color:#C62828;',
    default      => 'background:#F5F5F5; color:#616161;',
  };
}
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
        <button class="hamburger" id="admin-menu-btn" aria-label="Toggle sidebar">
          <span></span><span></span><span></span>
        </button>
        <div class="topbar-title">Orders</div>
      </div>
      <div class="topbar-right">
        <button class="nav-icon-btn" title="Notifications"
                onclick="window.location.href='/app/views/admin/notifications.php'">
          <i class="fas fa-bell"></i>
          <span class="cart-badge" style="background: var(--color-danger);">2</span>
        </button>
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
        <h1 class="page-title">Manage Orders</h1>
        <div class="page-breadcrumb">
          <i class="fas fa-home"></i> Admin &rsaquo; <span>Orders</span>
        </div>
      </div>

      <!-- ============================================
           STATS ROW
           ============================================ -->
      <div class="admin-stats-grid" style="grid-template-columns: repeat(4, 1fr);">

        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(255,152,0,0.12); color: #E65100;">
            <i class="fas fa-clock"></i>
          </div>
          <div>
            <div class="admin-stat-number">5</div>
            <div class="admin-stat-label">Pending</div>
          </div>
        </div>

        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(33,150,243,0.12); color: #1565C0;">
            <i class="fas fa-spinner"></i>
          </div>
          <div>
            <div class="admin-stat-number">3</div>
            <div class="admin-stat-label">Processing</div>
          </div>
        </div>

        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(76,175,80,0.12); color: #2E7D32;">
            <i class="fas fa-check-circle"></i>
          </div>
          <div>
            <div class="admin-stat-number">42</div>
            <div class="admin-stat-label">Completed</div>
          </div>
        </div>

        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(229,57,53,0.12); color: var(--color-danger);">
            <i class="fas fa-times-circle"></i>
          </div>
          <div>
            <div class="admin-stat-number">2</div>
            <div class="admin-stat-label">Cancelled</div>
          </div>
        </div>

      </div><!-- /stats -->

      <!-- ============================================
           FILTER + SEARCH BAR
           ============================================ -->
      <div class="admin-card" style="padding: var(--space-5);">
        <div style="display: flex; gap: var(--space-4); flex-wrap: wrap; align-items: center;">

          <!-- Search -->
          <div style="position: relative; flex: 1; min-width: 200px;">
            <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            <input type="text" placeholder="Search by order ID or customer..."
              style="width: 100%; padding: var(--space-3) var(--space-4) var(--space-3) 38px;
                     border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md);
                     font-size: var(--text-sm); background: var(--bg-primary);" />
          </div>

          <!-- Status Filter -->
          <select style="padding: var(--space-3) var(--space-5) var(--space-3) var(--space-4);
                         border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md);
                         font-size: var(--text-sm); background: var(--bg-primary); cursor: pointer;">
            <option value="">All Statuses</option>
            <option>Pending</option>
            <option>Processing</option>
            <option>Completed</option>
            <option>Cancelled</option>
          </select>

          <!-- Date Filter -->
          <input type="date"
            style="padding: var(--space-3) var(--space-4); border: 1.5px solid var(--border-light);
                   border-radius: var(--border-radius-md); font-size: var(--text-sm); background: var(--bg-primary);" />

        </div>
      </div><!-- /filter bar -->

      <!-- ============================================
           ORDERS TABLE
           ============================================ -->
      <div class="admin-card" style="padding: 0; overflow: hidden;">

        <!-- Table Header -->
        <div style="padding: var(--space-5) var(--space-6); border-bottom: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center;">
          <h3 style="font-family: var(--font-heading); font-size: var(--text-md); color: var(--text-primary); margin: 0;">
            All Orders
          </h3>
          <span style="font-size: var(--text-sm); color: var(--text-muted);">
            Showing <?= count($orders) ?> records
          </span>
        </div>

        <!-- Scrollable Table -->
        <div style="overflow-x: auto;">
          <table style="width: 100%; border-collapse: collapse; font-size: var(--text-sm);">

            <!-- Table Head -->
            <thead style="background: var(--bg-secondary);">
              <tr>
                <th style="padding: var(--space-4) var(--space-6); text-align: left; font-weight: 600; color: var(--text-secondary); white-space: nowrap;">Order ID</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: left; font-weight: 600; color: var(--text-secondary); white-space: nowrap;">Customer</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: center; font-weight: 600; color: var(--text-secondary); white-space: nowrap;">Items</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: right; font-weight: 600; color: var(--text-secondary); white-space: nowrap;">Total</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: center; font-weight: 600; color: var(--text-secondary); white-space: nowrap;">Status</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: left; font-weight: 600; color: var(--text-secondary); white-space: nowrap;">Date</th>
                <th style="padding: var(--space-4) var(--space-6); text-align: center; font-weight: 600; color: var(--text-secondary); white-space: nowrap;">Actions</th>
              </tr>
            </thead>

            <!-- Table Body -->
            <tbody>
              <?php foreach ($orders as $i => $order): ?>
              <tr style="border-bottom: 1px solid var(--border-light); <?= $i % 2 === 0 ? '' : 'background: var(--bg-secondary);' ?>">

                <!-- Order ID -->
                <td style="padding: var(--space-4) var(--space-6); font-weight: 600; color: var(--color-coffee);">
                  <?= htmlspecialchars($order['id']) ?>
                </td>

                <!-- Customer -->
                <td style="padding: var(--space-4);">
                  <div style="display: flex; align-items: center; gap: var(--space-3);">
                    <div style="width: 34px; height: 34px; border-radius: 50%; background: var(--color-cream); display: flex; align-items: center; justify-content: center; font-size: var(--text-sm); font-weight: 700; color: var(--color-coffee); flex-shrink: 0;">
                      <?= strtoupper(substr($order['customer'], 0, 1)) ?>
                    </div>
                    <span style="color: var(--text-primary);"><?= htmlspecialchars($order['customer']) ?></span>
                  </div>
                </td>

                <!-- Items -->
                <td style="padding: var(--space-4); text-align: center; color: var(--text-secondary);">
                  <?= $order['items'] ?> item<?= $order['items'] > 1 ? 's' : '' ?>
                </td>

                <!-- Total -->
                <td style="padding: var(--space-4); text-align: right; font-weight: 600; color: var(--color-gold);">
                  ₱<?= number_format($order['total']) ?>
                </td>

                <!-- Status Badge -->
                <td style="padding: var(--space-4); text-align: center;">
                  <span style="<?= getStatusStyle($order['status']) ?> padding: 4px 12px; border-radius: var(--border-radius-full); font-size: var(--text-xs); font-weight: 600; text-transform: capitalize; white-space: nowrap;">
                    <?= htmlspecialchars($order['status']) ?>
                  </span>
                </td>

                <!-- Date -->
                <td style="padding: var(--space-4); color: var(--text-muted); font-size: var(--text-xs); white-space: nowrap;">
                  <?= htmlspecialchars($order['date']) ?>
                </td>

                <!-- Actions -->
                <td style="padding: var(--space-4) var(--space-6); text-align: center;">
                  <div style="display: flex; gap: var(--space-2); justify-content: center;">
                    <!-- View -->
                    <button class="btn btn-secondary btn-sm" title="View order details" style="padding: 6px 10px;">
                      <i class="fas fa-eye"></i>
                    </button>
                    <!-- Update Status -->
                    <button class="btn btn-primary btn-sm" title="Update status" style="padding: 6px 10px;">
                      <i class="fas fa-edit"></i>
                    </button>
                  </div>
                </td>

              </tr>
              <?php endforeach; ?>
            </tbody>

          </table>
        </div><!-- /overflow-x -->

        <!-- Pagination -->
        <div style="padding: var(--space-5) var(--space-6); display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-light); flex-wrap: wrap; gap: var(--space-3);">
          <span style="font-size: var(--text-sm); color: var(--text-muted);">Page 1 of 5</span>
          <div style="display: flex; gap: var(--space-2);">
            <button class="btn btn-secondary btn-sm" disabled><i class="fas fa-chevron-left"></i></button>
            <button class="btn btn-primary btn-sm">1</button>
            <button class="btn btn-secondary btn-sm">2</button>
            <button class="btn btn-secondary btn-sm">3</button>
            <button class="btn btn-secondary btn-sm"><i class="fas fa-chevron-right"></i></button>
          </div>
        </div>

      </div><!-- /orders table card -->

    </div><!-- /admin-content -->
  </div><!-- /admin-main -->
</div><!-- /admin-layout -->

<?php
// Load admin JS
echo '<script src="/public/assets/js/admin.js"></script>';

// Include footer (loads app.js etc.)
require_once __DIR__ . '/../layouts/footer.php';
?>
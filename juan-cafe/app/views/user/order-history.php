<?php
/**
 * JUAN CAFÉ - Order History Page
 * File: app/views/user/order-history.php
 * Frontend UI only.
 */
require_once __DIR__ . '/../layouts/header.php';

// Placeholder order data
$orders = [
  ['id'=>'JC-00124', 'items'=>'Classic Milk Tea, Mocha Frappe', 'total'=>185, 'status'=>'Confirmed',  'status_color'=>'var(--color-info)',    'date'=>'May 15, 2024', 'payment'=>'Cash on Delivery'],
  ['id'=>'JC-00123', 'items'=>'Brown Sugar Coffee',             'total'=>95,  'status'=>'Ready',       'status_color'=>'var(--color-success)', 'date'=>'May 14, 2024', 'payment'=>'Cash on Delivery'],
  ['id'=>'JC-00122', 'items'=>'Lychee Fruit Tea × 2',          'total'=>160, 'status'=>'Completed',   'status_color'=>'var(--color-coffee)',  'date'=>'May 12, 2024', 'payment'=>'GCash'],
  ['id'=>'JC-00121', 'items'=>'Matcha Latte',                  'total'=>100, 'status'=>'Completed',   'status_color'=>'var(--color-coffee)',  'date'=>'May 10, 2024', 'payment'=>'Cash on Delivery'],
  ['id'=>'JC-00120', 'items'=>'Caramel Frappe, Blueberry Soda','total'=>185, 'status'=>'Completed',   'status_color'=>'var(--color-coffee)',  'date'=>'May 8, 2024',  'payment'=>'GCash'],
  ['id'=>'JC-00119', 'items'=>'Taro Milk Tea × 3',             'total'=>240, 'status'=>'Cancelled',   'status_color'=>'var(--color-danger)',  'date'=>'May 5, 2024',  'payment'=>'Cash on Delivery'],
];
?>

<div class="dashboard-layout" style="display: flex; min-height: 100vh;">
  <?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>

  <main class="dashboard-main" style="margin-left: var(--sidebar-width); flex: 1; background: var(--bg-admin); padding: var(--space-8); padding-top: calc(var(--space-8) + 16px);">

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-8);">
      <button class="mobile-menu-btn btn btn-secondary btn-sm" style="display: none;"><i class="fas fa-bars"></i></button>
      <div class="page-header">
        <h1 style="font-family: var(--font-heading); font-size: var(--text-2xl); color: var(--color-espresso);">📋 Order History</h1>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: 4px;">Track all your past and current orders.</p>
      </div>
      <a href="/app/views/products/products.php" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> New Order
      </a>
    </div>

    <!-- Filter Tabs -->
    <div style="display: flex; gap: var(--space-3); margin-bottom: var(--space-6); flex-wrap: wrap;">
      <?php foreach (['All', 'Confirmed', 'Ready', 'Completed', 'Cancelled'] as $i => $tab): ?>
        <button class="btn btn-sm <?= $i === 0 ? 'btn-primary' : 'btn-secondary' ?>" style="<?= $i !== 0 ? 'border-color: var(--border-medium); color: var(--text-secondary);' : '' ?>">
          <?= $tab ?>
        </button>
      <?php endforeach; ?>
    </div>

    <!-- Orders Table -->
    <div style="background: white; border-radius: var(--border-radius-lg); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); overflow: hidden;">
      <div class="table-wrap">
        <table class="data-table" style="width: 100%; border-collapse: collapse;">
          <thead>
            <tr style="background: var(--bg-secondary);">
              <th style="padding: var(--space-4); text-align: left; font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Order #</th>
              <th style="padding: var(--space-4); text-align: left; font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Items</th>
              <th style="padding: var(--space-4); text-align: left; font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Total</th>
              <th style="padding: var(--space-4); text-align: left; font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Payment</th>
              <th style="padding: var(--space-4); text-align: left; font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Status</th>
              <th style="padding: var(--space-4); text-align: left; font-size: var(--text-xs); text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);">Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $order): ?>
              <tr style="border-bottom: 1px solid var(--border-light);">
                <td style="padding: var(--space-4); font-size: var(--text-sm); font-weight: var(--font-weight-semibold); color: var(--color-coffee);">
                  <?= $order['id'] ?>
                </td>
                <td style="padding: var(--space-4); font-size: var(--text-sm); color: var(--text-secondary);">
                  <?= htmlspecialchars($order['items']) ?>
                </td>
                <td style="padding: var(--space-4); font-size: var(--text-sm); font-weight: var(--font-weight-semibold); color: var(--color-espresso);">
                  ₱<?= number_format($order['total']) ?>
                </td>
                <td style="padding: var(--space-4); font-size: var(--text-sm); color: var(--text-muted);">
                  <?= htmlspecialchars($order['payment']) ?>
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

      <!-- Pagination -->
      <div class="pagination">
        <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
        <button class="page-btn active">1</button>
        <button class="page-btn">2</button>
        <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
      </div>
    </div>

  </main>
</div>

<script src="/public/assets/js/app.js"></script>
<script src="/public/assets/js/cart.js"></script>
<script src="/public/assets/js/notifications.js"></script>
<style>
  @media (max-width: 1024px) { .mobile-menu-btn { display: flex !important; } }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
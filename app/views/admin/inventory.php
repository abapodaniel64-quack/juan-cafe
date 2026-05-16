<?php
/**
 * JUAN CAFÉ - Admin Inventory Page
 * File: app/views/admin/inventory.php
 *
 * Frontend UI only — no backend yet.
 * Shows stock levels for all products with status indicators.
 */

require_once __DIR__ . '/../layouts/header.php';
echo '<link rel="stylesheet" href="/public/assets/css/admin.css" />';

// Placeholder inventory data — replace with database query later
$inventory = [
  ['id'=>1,  'name'=>'Classic Milk Tea',     'category'=>'Milk Tea',     'sku'=>'JC-MT-001', 'stock'=>48, 'low_threshold'=>10, 'unit'=>'cups',       'last_updated'=>'May 15, 2025'],
  ['id'=>2,  'name'=>'Brown Sugar Milk Tea', 'category'=>'Milk Tea',     'sku'=>'JC-MT-002', 'stock'=>35, 'low_threshold'=>10, 'unit'=>'cups',       'last_updated'=>'May 15, 2025'],
  ['id'=>3,  'name'=>'Taro Milk Tea',        'category'=>'Milk Tea',     'sku'=>'JC-MT-003', 'stock'=>7,  'low_threshold'=>10, 'unit'=>'cups',       'last_updated'=>'May 14, 2025'],
  ['id'=>4,  'name'=>'Brown Sugar Coffee',   'category'=>'Coffee',       'sku'=>'JC-CF-001', 'stock'=>22, 'low_threshold'=>10, 'unit'=>'cups',       'last_updated'=>'May 15, 2025'],
  ['id'=>5,  'name'=>'Iced Americano',       'category'=>'Coffee',       'sku'=>'JC-CF-002', 'stock'=>30, 'low_threshold'=>10, 'unit'=>'cups',       'last_updated'=>'May 15, 2025'],
  ['id'=>6,  'name'=>'Lychee Fruit Tea',     'category'=>'Fruit Tea',    'sku'=>'JC-FT-001', 'stock'=>0,  'low_threshold'=>10, 'unit'=>'cups',       'last_updated'=>'May 13, 2025'],
  ['id'=>7,  'name'=>'Mango Green Tea',      'category'=>'Fruit Tea',    'sku'=>'JC-FT-002', 'stock'=>18, 'low_threshold'=>10, 'unit'=>'cups',       'last_updated'=>'May 15, 2025'],
  ['id'=>8,  'name'=>'Mocha Frappe',         'category'=>'Frappe',       'sku'=>'JC-FR-001', 'stock'=>15, 'low_threshold'=>10, 'unit'=>'cups',       'last_updated'=>'May 14, 2025'],
  ['id'=>9,  'name'=>'Caramel Frappe',       'category'=>'Frappe',       'sku'=>'JC-FR-002', 'stock'=>5,  'low_threshold'=>10, 'unit'=>'cups',       'last_updated'=>'May 14, 2025'],
  ['id'=>10, 'name'=>'Matcha Latte',         'category'=>'Latte',        'sku'=>'JC-LT-001', 'stock'=>24, 'low_threshold'=>10, 'unit'=>'cups',       'last_updated'=>'May 15, 2025'],
  ['id'=>11, 'name'=>'Hot Chocolate',        'category'=>'Hot Drinks',   'sku'=>'JC-HD-001', 'stock'=>40, 'low_threshold'=>10, 'unit'=>'cups',       'last_updated'=>'May 15, 2025'],
  ['id'=>12, 'name'=>'Blueberry Soda',       'category'=>'Fruity Soda',  'sku'=>'JC-FS-001', 'stock'=>3,  'low_threshold'=>10, 'unit'=>'cups',       'last_updated'=>'May 13, 2025'],
  ['id'=>13, 'name'=>'Premium Milk Tea',     'category'=>'Premium',      'sku'=>'JC-PM-001', 'stock'=>20, 'low_threshold'=>5,  'unit'=>'cups',       'last_updated'=>'May 15, 2025'],
];

// Helper: get stock status
function stockStatus($stock, $low) {
  if ($stock === 0)        return ['label' => 'Out of Stock', 'color' => '#FFEBEE', 'text' => '#C62828'];
  if ($stock <= $low)      return ['label' => 'Low Stock',    'color' => '#FFF3E0', 'text' => '#E65100'];
  return                          ['label' => 'In Stock',     'color' => '#E8F5E9', 'text' => '#2E7D32'];
}

// Stock summary counts
$outOfStock = count(array_filter($inventory, fn($i) => $i['stock'] === 0));
$lowStock   = count(array_filter($inventory, fn($i) => $i['stock'] > 0 && $i['stock'] <= $i['low_threshold']));
$inStock    = count($inventory) - $outOfStock - $lowStock;
?>

<!-- ================================================
     ADMIN LAYOUT WRAPPER
     ================================================ -->
<div class="admin-layout">

  <?php require_once __DIR__ . '/../layouts/adminSidebar.php'; ?>

  <div class="admin-main" id="admin-main">

    <!-- Top Bar -->
    <div class="admin-topbar" id="admin-topbar">
      <div class="topbar-left">
        <button class="hamburger" id="admin-menu-btn" aria-label="Toggle sidebar">
          <span></span><span></span><span></span>
        </button>
        <div class="topbar-title">Inventory</div>
      </div>
      <div class="topbar-right">
        <button class="nav-icon-btn" title="Notifications"
                onclick="window.location.href='/app/views/admin/notifications.php'">
          <i class="fas fa-bell"></i>
          <span class="cart-badge" style="background: var(--color-danger);">2</span>
        </button>
        <div class="topbar-user">
          <div class="topbar-avatar">A</div>
          <div class="topbar-user-info"><span>Admin</span><small>Administrator</small></div>
        </div>
      </div>
    </div>

    <!-- Page Content -->
    <div class="admin-content">

      <!-- Page Header -->
      <div class="page-header">
        <h1 class="page-title">Inventory Management</h1>
        <div class="page-breadcrumb">
          <i class="fas fa-home"></i> Admin &rsaquo; <span>Inventory</span>
        </div>
      </div>

      <!-- ============================================
           STATS ROW
           ============================================ -->
      <div class="admin-stats-grid" style="grid-template-columns: repeat(4, 1fr);">

        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(111,78,55,0.12); color: var(--color-coffee);">
            <i class="fas fa-boxes"></i>
          </div>
          <div>
            <div class="admin-stat-number"><?= count($inventory) ?></div>
            <div class="admin-stat-label">Total Products</div>
          </div>
        </div>

        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(76,175,80,0.12); color: #2E7D32;">
            <i class="fas fa-check-circle"></i>
          </div>
          <div>
            <div class="admin-stat-number"><?= $inStock ?></div>
            <div class="admin-stat-label">In Stock</div>
          </div>
        </div>

        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(255,152,0,0.12); color: #E65100;">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
          <div>
            <div class="admin-stat-number"><?= $lowStock ?></div>
            <div class="admin-stat-label">Low Stock</div>
          </div>
        </div>

        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(229,57,53,0.12); color: var(--color-danger);">
            <i class="fas fa-times-circle"></i>
          </div>
          <div>
            <div class="admin-stat-number"><?= $outOfStock ?></div>
            <div class="admin-stat-label">Out of Stock</div>
          </div>
        </div>

      </div><!-- /stats -->

      <!-- ============================================
           FILTER BAR
           ============================================ -->
      <div class="admin-card" style="padding: var(--space-5);">
        <div style="display: flex; gap: var(--space-4); flex-wrap: wrap; align-items: center;">
          <div style="position: relative; flex: 1; min-width: 200px;">
            <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            <input type="text" placeholder="Search product..."
              style="width: 100%; padding: var(--space-3) var(--space-4) var(--space-3) 38px;
                     border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md);
                     font-size: var(--text-sm); background: var(--bg-primary);" />
          </div>
          <select style="padding: var(--space-3) var(--space-5) var(--space-3) var(--space-4);
                         border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md);
                         font-size: var(--text-sm); background: var(--bg-primary); cursor: pointer;">
            <option>All Categories</option>
            <option>Milk Tea</option>
            <option>Coffee</option>
            <option>Fruit Tea</option>
            <option>Frappe</option>
            <option>Latte</option>
            <option>Hot Drinks</option>
            <option>Fruity Soda</option>
            <option>Premium</option>
          </select>
          <select style="padding: var(--space-3) var(--space-5) var(--space-3) var(--space-4);
                         border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md);
                         font-size: var(--text-sm); background: var(--bg-primary); cursor: pointer;">
            <option>All Stock Levels</option>
            <option>In Stock</option>
            <option>Low Stock</option>
            <option>Out of Stock</option>
          </select>
          <!-- Add Restock Button -->
          <button class="btn btn-primary btn-sm" style="white-space: nowrap;">
            <i class="fas fa-plus"></i> Restock Item
          </button>
        </div>
      </div>

      <!-- ============================================
           INVENTORY TABLE
           ============================================ -->
      <div class="admin-card" style="padding: 0; overflow: hidden;">

        <div style="padding: var(--space-5) var(--space-6); border-bottom: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center;">
          <h3 style="font-family: var(--font-heading); font-size: var(--text-md); color: var(--text-primary); margin: 0;">
            Stock Levels
          </h3>
          <span style="font-size: var(--text-sm); color: var(--text-muted);"><?= count($inventory) ?> products tracked</span>
        </div>

        <div style="overflow-x: auto;">
          <table style="width: 100%; border-collapse: collapse; font-size: var(--text-sm);">

            <thead style="background: var(--bg-secondary);">
              <tr>
                <th style="padding: var(--space-4) var(--space-6); text-align: left; font-weight: 600; color: var(--text-secondary);">Product</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: left; font-weight: 600; color: var(--text-secondary);">SKU</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: left; font-weight: 600; color: var(--text-secondary);">Category</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: center; font-weight: 600; color: var(--text-secondary);">Stock</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: left; font-weight: 600; color: var(--text-secondary); min-width: 150px;">Stock Level</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: center; font-weight: 600; color: var(--text-secondary);">Status</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: left; font-weight: 600; color: var(--text-secondary);">Last Updated</th>
                <th style="padding: var(--space-4) var(--space-6); text-align: center; font-weight: 600; color: var(--text-secondary);">Actions</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($inventory as $i => $item):
                $status = stockStatus($item['stock'], $item['low_threshold']);
                // Stock bar percentage (cap at 100 for display)
                $maxDisplay = max($item['stock'], $item['low_threshold'] * 2, 50);
                $pct        = min(100, ($item['stock'] / $maxDisplay) * 100);
                $barColor   = $item['stock'] === 0 ? '#E53935' : ($item['stock'] <= $item['low_threshold'] ? '#FF9800' : '#4CAF50');
              ?>
              <tr style="border-bottom: 1px solid var(--border-light); <?= $i % 2 === 0 ? '' : 'background: var(--bg-secondary);' ?>">

                <!-- Product Name -->
                <td style="padding: var(--space-4) var(--space-6);">
                  <div style="display: flex; align-items: center; gap: var(--space-3);">
                    <div class="img-placeholder" style="width: 38px; height: 38px; border-radius: var(--border-radius-sm); flex-shrink: 0; font-size: var(--text-xs);">
                      ☕
                    </div>
                    <span style="font-weight: 600; color: var(--text-primary);"><?= htmlspecialchars($item['name']) ?></span>
                  </div>
                </td>

                <!-- SKU -->
                <td style="padding: var(--space-4); color: var(--text-muted); font-family: monospace; font-size: var(--text-xs);">
                  <?= htmlspecialchars($item['sku']) ?>
                </td>

                <!-- Category -->
                <td style="padding: var(--space-4); color: var(--text-secondary);">
                  <?= htmlspecialchars($item['category']) ?>
                </td>

                <!-- Stock Count -->
                <td style="padding: var(--space-4); text-align: center; font-weight: 700; color: <?= $barColor ?>;">
                  <?= $item['stock'] ?> <span style="font-weight: 400; color: var(--text-muted); font-size: var(--text-xs);"><?= $item['unit'] ?></span>
                </td>

                <!-- Stock Bar -->
                <td style="padding: var(--space-4);">
                  <div style="background: var(--border-light); border-radius: var(--border-radius-full); height: 8px; overflow: hidden;">
                    <div style="width: <?= $pct ?>%; height: 100%; background: <?= $barColor ?>; border-radius: var(--border-radius-full); transition: width 0.4s ease;"></div>
                  </div>
                </td>

                <!-- Status Badge -->
                <td style="padding: var(--space-4); text-align: center;">
                  <span style="background: <?= $status['color'] ?>; color: <?= $status['text'] ?>; padding: 4px 12px; border-radius: var(--border-radius-full); font-size: var(--text-xs); font-weight: 600; white-space: nowrap;">
                    <?= $status['label'] ?>
                  </span>
                </td>

                <!-- Last Updated -->
                <td style="padding: var(--space-4); color: var(--text-muted); font-size: var(--text-xs);">
                  <?= htmlspecialchars($item['last_updated']) ?>
                </td>

                <!-- Actions -->
                <td style="padding: var(--space-4) var(--space-6); text-align: center;">
                  <div style="display: flex; gap: var(--space-2); justify-content: center;">
                    <button class="btn btn-primary btn-sm" title="Restock" style="padding: 6px 10px;">
                      <i class="fas fa-plus"></i>
                    </button>
                    <button class="btn btn-secondary btn-sm" title="Edit" style="padding: 6px 10px;">
                      <i class="fas fa-edit"></i>
                    </button>
                  </div>
                </td>

              </tr>
              <?php endforeach; ?>
            </tbody>

          </table>
        </div><!-- /overflow-x -->

      </div><!-- /inventory table card -->

      <!-- Low Stock Alert Notice -->
      <?php if ($lowStock > 0 || $outOfStock > 0): ?>
      <div style="background: #FFF8E1; border: 1px solid #FFD54F; border-radius: var(--border-radius-md); padding: var(--space-4) var(--space-5); display: flex; gap: var(--space-3); align-items: flex-start; margin-top: var(--space-4);">
        <i class="fas fa-exclamation-triangle" style="color: #F57C00; margin-top: 2px;"></i>
        <p style="margin: 0; font-size: var(--text-sm); color: #5D4037;">
          <strong><?= $outOfStock ?> product(s) are out of stock</strong> and
          <strong><?= $lowStock ?> product(s) are running low.</strong>
          Please restock to avoid order fulfillment issues.
        </p>
      </div>
      <?php endif; ?>

    </div><!-- /admin-content -->
  </div><!-- /admin-main -->
</div><!-- /admin-layout -->

<?php
echo '<script src="/public/assets/js/admin.js"></script>';
require_once __DIR__ . '/../layouts/footer.php';
?>
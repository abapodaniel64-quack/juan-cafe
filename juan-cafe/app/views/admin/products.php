<?php
/**
 * JUAN CAFÉ - Admin Products Management
 * File: app/views/admin/products.php
 *
 * Frontend UI only — no backend yet.
 * Allows admin to view, add, edit, and delete products.
 */

require_once __DIR__ . '/../layouts/header.php';
echo '<link rel="stylesheet" href="/public/assets/css/admin.css" />';
?>

<!-- ================================================
     ADMIN LAYOUT
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
        <div class="topbar-title">Products</div>
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
    </div>

    <!-- Page Content -->
    <div class="admin-content">

      <!-- Page Header -->
      <div class="page-header">
        <h1 class="page-title">Manage Products</h1>
        <div class="page-breadcrumb">
          <i class="fas fa-home"></i> Admin &rsaquo;
          <a href="/app/views/admin/dashboard.php">Dashboard</a> &rsaquo;
          <span>Products</span>
        </div>
      </div>

      <!-- Toolbar: Search + Filter + Add Button -->
      <div class="admin-toolbar">
        <!-- Search -->
        <div class="search-wrap" style="max-width: 320px;">
          <input type="text" class="search-input" placeholder="Search products..." />
          <i class="fas fa-search search-icon"></i>
        </div>

        <!-- Category Filter -->
        <select style="
          padding: var(--space-2) var(--space-4);
          border: 1.5px solid var(--border-light);
          border-radius: var(--border-radius-full);
          font-family: var(--font-body);
          font-size: var(--text-sm);
          background: white;
          color: var(--text-primary);
          cursor: pointer;
        ">
          <option value="">All Categories</option>
          <option value="milk-tea">Milk Tea</option>
          <option value="coffee">Coffee</option>
          <option value="fruit-tea">Fruit Tea</option>
          <option value="frappe">Frappe</option>
          <option value="latte">Latte</option>
          <option value="hot-drinks">Hot Drinks</option>
          <option value="fruity-soda">Fruity Soda</option>
          <option value="premium">Premium Drinks</option>
        </select>

        <!-- Add Product Button (opens modal) -->
        <button class="btn btn-primary" onclick="openModal('add-product-modal')">
          <i class="fas fa-plus"></i> Add Product
        </button>
      </div>

      <!-- ============================================
           PRODUCTS TABLE
           ============================================ -->
      <div class="dashboard-panel">
        <div class="panel-header">
          <div class="panel-title">
            <i class="fas fa-coffee" style="color: var(--color-coffee);"></i>
            Product List
            <span class="badge badge-coffee" style="margin-left: 8px;">48 products</span>
          </div>
        </div>
        <div class="panel-body">
          <div class="table-wrap">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Price (S/M/L)</th>
                  <th>Stock</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>

                <?php
                // Placeholder product data — replace with DB query later
                $products = [
                  ['name' => 'Classic Milk Tea',       'cat' => 'Milk Tea',      'price' => '₱75 / ₱85 / ₱95',  'stock' => 50, 'status' => 'active'],
                  ['name' => 'Taro Milk Tea',           'cat' => 'Milk Tea',      'price' => '₱80 / ₱90 / ₱100', 'stock' => 40, 'status' => 'active'],
                  ['name' => 'Brown Sugar Milk Tea',    'cat' => 'Milk Tea',      'price' => '₱85 / ₱95 / ₱105', 'stock' => 3,  'status' => 'low'],
                  ['name' => 'Americano',               'cat' => 'Coffee',        'price' => '₱70 / ₱80 / ₱90',  'stock' => 35, 'status' => 'active'],
                  ['name' => 'Caramel Macchiato',       'cat' => 'Coffee',        'price' => '₱90 / ₱100 / ₱110','stock' => 28, 'status' => 'active'],
                  ['name' => 'Mango Fruit Tea',         'cat' => 'Fruit Tea',     'price' => '₱65 / ₱75 / ₱85',  'stock' => 60, 'status' => 'active'],
                  ['name' => 'Strawberry Fruit Tea',    'cat' => 'Fruit Tea',     'price' => '₱65 / ₱75 / ₱85',  'stock' => 55, 'status' => 'active'],
                  ['name' => 'Caramel Frappe',          'cat' => 'Frappe',        'price' => '₱95 / ₱105 / ₱115','stock' => 0,  'status' => 'out'],
                  ['name' => 'Hazelnut Latte',          'cat' => 'Latte',         'price' => '₱85 / ₱95 / ₱105', 'stock' => 45, 'status' => 'active'],
                  ['name' => 'Spanish Latte',           'cat' => 'Latte',         'price' => '₱90 / ₱100 / ₱110','stock' => 38, 'status' => 'active'],
                  ['name' => 'Blueberry Lemonade Soda', 'cat' => 'Fruity Soda',   'price' => '₱70 / ₱80 / ₱90',  'stock' => 30, 'status' => 'active'],
                  ['name' => 'Premium Matcha Latte',    'cat' => 'Premium Drinks','price' => '₱110 / ₱120 / ₱130','stock' => 20, 'status' => 'active'],
                ];

                foreach ($products as $p):
                  // Determine stock badge style
                  if ($p['status'] === 'out') {
                    $stockBadge = '<span class="badge badge-danger">Out of Stock</span>';
                  } elseif ($p['status'] === 'low') {
                    $stockBadge = '<span class="badge badge-pending">Low Stock</span>';
                  } else {
                    $stockBadge = '<span class="badge badge-success">In Stock</span>';
                  }
                ?>
                <tr>
                  <!-- Product name + placeholder image -->
                  <td>
                    <div style="display: flex; align-items: center; gap: var(--space-3);">
                      <div class="admin-product-img">
                        <i class="fas fa-coffee" style="color: var(--color-latte);"></i>
                      </div>
                      <strong><?= $p['name'] ?></strong>
                    </div>
                  </td>
                  <td><span class="badge badge-coffee"><?= $p['cat'] ?></span></td>
                  <td style="font-size: var(--text-sm);"><?= $p['price'] ?></td>
                  <td><?= $p['stock'] ?> units</td>
                  <td><?= $stockBadge ?></td>
                  <td class="table-actions">
                    <button class="action-btn view"   title="View"   onclick="showToast('Viewing product details.', 'info')">
                      <i class="fas fa-eye"></i>
                    </button>
                    <button class="action-btn edit"   title="Edit"   onclick="openModal('edit-product-modal')">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button class="action-btn delete" title="Delete" onclick="showToast('Product deleted.', 'danger')">
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div><!-- /table-wrap -->

          <!-- Pagination -->
          <div class="pagination">
            <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
          </div>

        </div>
      </div><!-- /dashboard-panel -->

    </div><!-- /admin-content -->
  </div><!-- /admin-main -->
</div><!-- /admin-layout -->

<!-- ================================================
     ADD PRODUCT MODAL
     ================================================ -->
<div class="modal-overlay" id="add-product-modal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Add New Product</div>
      <button class="modal-close" onclick="closeModal('add-product-modal')">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="modal-body">
      <!-- Product Image Placeholder -->
      <div style="
        width: 100%;
        height: 160px;
        background: var(--bg-secondary);
        border: 2px dashed var(--border-medium);
        border-radius: var(--border-radius-md);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        cursor: pointer;
        margin-bottom: var(--space-4);
      ">
        <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; margin-bottom: 8px;"></i>
        <span style="font-size: var(--text-sm);">Click to upload product image</span>
      </div>

      <!-- Form Fields -->
      <div style="display: grid; gap: var(--space-4);">

        <div>
          <label style="font-size: var(--text-sm); font-weight: 600; color: var(--text-primary); margin-bottom: 4px; display: block;">
            Product Name *
          </label>
          <input type="text" placeholder="e.g. Classic Milk Tea" style="
            width: 100%; padding: var(--space-3) var(--space-4);
            border: 1.5px solid var(--border-light); border-radius: var(--border-radius-sm);
            font-family: var(--font-body); font-size: var(--text-sm);
          " />
        </div>

        <div>
          <label style="font-size: var(--text-sm); font-weight: 600; color: var(--text-primary); margin-bottom: 4px; display: block;">
            Category *
          </label>
          <select style="
            width: 100%; padding: var(--space-3) var(--space-4);
            border: 1.5px solid var(--border-light); border-radius: var(--border-radius-sm);
            font-family: var(--font-body); font-size: var(--text-sm); background: white;
          ">
            <option value="">Select category</option>
            <option>Milk Tea</option>
            <option>Coffee</option>
            <option>Fruit Tea</option>
            <option>Frappe</option>
            <option>Latte</option>
            <option>Hot Drinks</option>
            <option>Fruity Soda</option>
            <option>Premium Drinks</option>
          </select>
        </div>

        <!-- Size Pricing -->
        <div>
          <label style="font-size: var(--text-sm); font-weight: 600; color: var(--text-primary); margin-bottom: 8px; display: block;">
            Pricing (by Size)
          </label>
          <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: var(--space-2);">
            <div>
              <label style="font-size: 0.7rem; color: var(--text-muted); display: block; margin-bottom: 3px;">Small (₱)</label>
              <input type="number" placeholder="75" style="
                width: 100%; padding: var(--space-2) var(--space-3);
                border: 1.5px solid var(--border-light); border-radius: var(--border-radius-sm);
                font-family: var(--font-body); font-size: var(--text-sm);
              " />
            </div>
            <div>
              <label style="font-size: 0.7rem; color: var(--text-muted); display: block; margin-bottom: 3px;">Medium (₱)</label>
              <input type="number" placeholder="85" style="
                width: 100%; padding: var(--space-2) var(--space-3);
                border: 1.5px solid var(--border-light); border-radius: var(--border-radius-sm);
                font-family: var(--font-body); font-size: var(--text-sm);
              " />
            </div>
            <div>
              <label style="font-size: 0.7rem; color: var(--text-muted); display: block; margin-bottom: 3px;">Large (₱)</label>
              <input type="number" placeholder="95" style="
                width: 100%; padding: var(--space-2) var(--space-3);
                border: 1.5px solid var(--border-light); border-radius: var(--border-radius-sm);
                font-family: var(--font-body); font-size: var(--text-sm);
              " />
            </div>
          </div>
        </div>

        <div>
          <label style="font-size: var(--text-sm); font-weight: 600; color: var(--text-primary); margin-bottom: 4px; display: block;">
            Description
          </label>
          <textarea rows="3" placeholder="Short product description..." style="
            width: 100%; padding: var(--space-3) var(--space-4);
            border: 1.5px solid var(--border-light); border-radius: var(--border-radius-sm);
            font-family: var(--font-body); font-size: var(--text-sm); resize: vertical;
          "></textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-3);">
          <div>
            <label style="font-size: var(--text-sm); font-weight: 600; color: var(--text-primary); margin-bottom: 4px; display: block;">
              Stock Quantity
            </label>
            <input type="number" placeholder="50" style="
              width: 100%; padding: var(--space-3) var(--space-4);
              border: 1.5px solid var(--border-light); border-radius: var(--border-radius-sm);
              font-family: var(--font-body); font-size: var(--text-sm);
            " />
          </div>
          <div>
            <label style="font-size: var(--text-sm); font-weight: 600; color: var(--text-primary); margin-bottom: 4px; display: block;">
              Status
            </label>
            <select style="
              width: 100%; padding: var(--space-3) var(--space-4);
              border: 1.5px solid var(--border-light); border-radius: var(--border-radius-sm);
              font-family: var(--font-body); font-size: var(--text-sm); background: white;
            ">
              <option>Active</option>
              <option>Inactive</option>
              <option>Out of Stock</option>
            </select>
          </div>
        </div>

      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" onclick="closeModal('add-product-modal')">Cancel</button>
      <button class="btn btn-primary" onclick="showToast('Product added successfully!', 'success'); closeModal('add-product-modal');">
        <i class="fas fa-plus"></i> Add Product
      </button>
    </div>
  </div>
</div>

<!-- Edit Product Modal (same structure, different title) -->
<div class="modal-overlay" id="edit-product-modal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Edit Product</div>
      <button class="modal-close" onclick="closeModal('edit-product-modal')">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="modal-body">
      <p style="color: var(--text-muted); font-size: var(--text-sm);">
        Edit product form — same fields as Add Product, pre-filled with existing data.
      </p>
      <!-- Fields would be identical to Add Product modal, pre-filled via JS/PHP -->
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" onclick="closeModal('edit-product-modal')">Cancel</button>
      <button class="btn btn-primary" onclick="showToast('Product updated!', 'success'); closeModal('edit-product-modal');">
        <i class="fas fa-save"></i> Save Changes
      </button>
    </div>
  </div>
</div>

<script>
  // Simple modal open/close helpers
  function openModal(id) {
    document.getElementById(id).classList.add('open');
  }
  function closeModal(id) {
    document.getElementById(id).classList.remove('open');
  }
  // Close modal when clicking outside
  document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', function(e) {
      if (e.target === this) this.classList.remove('open');
    });
  });
</script>

<script src="/public/assets/js/admin.js"></script>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
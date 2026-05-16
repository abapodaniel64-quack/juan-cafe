<?php
/**
 * JUAN CAFÉ - Admin Users Page
 * File: app/views/admin/users.php
 *
 * Frontend UI only — no backend yet.
 * Displays a list of registered customers with basic management actions.
 */

require_once __DIR__ . '/../layouts/header.php';
echo '<link rel="stylesheet" href="/public/assets/css/admin.css" />';

// Placeholder users — replace with database query later
$users = [
  ['id'=>1, 'name'=>'Maria Santos',   'email'=>'maria@example.com',   'phone'=>'+63 912 345 6789', 'orders'=>8,  'spent'=>1240, 'status'=>'active',   'joined'=>'Jan 10, 2025'],
  ['id'=>2, 'name'=>'Jose Reyes',     'email'=>'jose@example.com',    'phone'=>'+63 917 234 5678', 'orders'=>3,  'spent'=>415,  'status'=>'active',   'joined'=>'Feb 4, 2025'],
  ['id'=>3, 'name'=>'Ana Cruz',       'email'=>'ana@example.com',     'phone'=>'+63 920 111 2233', 'orders'=>15, 'spent'=>2350, 'status'=>'active',   'joined'=>'Dec 22, 2024'],
  ['id'=>4, 'name'=>'Pedro Dela Cruz','email'=>'pedro@example.com',   'phone'=>'+63 933 444 5566', 'orders'=>1,  'spent'=>85,   'status'=>'active',   'joined'=>'May 1, 2025'],
  ['id'=>5, 'name'=>'Luz Villanueva', 'email'=>'luz@example.com',     'phone'=>'+63 945 667 8890', 'orders'=>6,  'spent'=>890,  'status'=>'inactive', 'joined'=>'Mar 14, 2025'],
  ['id'=>6, 'name'=>'Ramon Bautista', 'email'=>'ramon@example.com',   'phone'=>'+63 919 888 0011', 'orders'=>11, 'spent'=>1760, 'status'=>'active',   'joined'=>'Nov 5, 2024'],
  ['id'=>7, 'name'=>'Carmen Torres',  'email'=>'carmen@example.com',  'phone'=>'+63 956 321 4455', 'orders'=>4,  'spent'=>530,  'status'=>'active',   'joined'=>'Apr 20, 2025'],
  ['id'=>8, 'name'=>'Miguel Lim',     'email'=>'miguel@example.com',  'phone'=>'+63 927 990 1122', 'orders'=>0,  'spent'=>0,    'status'=>'inactive', 'joined'=>'May 12, 2025'],
];
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
        <div class="topbar-title">Users</div>
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
        <h1 class="page-title">Manage Users</h1>
        <div class="page-breadcrumb">
          <i class="fas fa-home"></i> Admin &rsaquo; <span>Users</span>
        </div>
      </div>

      <!-- ============================================
           STATS ROW
           ============================================ -->
      <div class="admin-stats-grid" style="grid-template-columns: repeat(3, 1fr);">

        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(111,78,55,0.12); color: var(--color-coffee);">
            <i class="fas fa-users"></i>
          </div>
          <div>
            <div class="admin-stat-number"><?= count($users) ?></div>
            <div class="admin-stat-label">Total Users</div>
          </div>
        </div>

        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(76,175,80,0.12); color: #2E7D32;">
            <i class="fas fa-user-check"></i>
          </div>
          <div>
            <div class="admin-stat-number"><?= count(array_filter($users, fn($u) => $u['status'] === 'active')) ?></div>
            <div class="admin-stat-label">Active Users</div>
          </div>
        </div>

        <div class="admin-stat-card">
          <div class="admin-stat-icon" style="background: rgba(200,148,42,0.12); color: var(--color-gold);">
            <i class="fas fa-user-plus"></i>
          </div>
          <div>
            <div class="admin-stat-number">3</div>
            <div class="admin-stat-label">New This Month</div>
          </div>
        </div>

      </div><!-- /stats -->

      <!-- ============================================
           SEARCH + FILTER BAR
           ============================================ -->
      <div class="admin-card" style="padding: var(--space-5);">
        <div style="display: flex; gap: var(--space-4); flex-wrap: wrap; align-items: center;">

          <!-- Search -->
          <div style="position: relative; flex: 1; min-width: 200px;">
            <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            <input type="text" placeholder="Search by name or email..."
              style="width: 100%; padding: var(--space-3) var(--space-4) var(--space-3) 38px;
                     border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md);
                     font-size: var(--text-sm); background: var(--bg-primary);" />
          </div>

          <!-- Status Filter -->
          <select style="padding: var(--space-3) var(--space-5) var(--space-3) var(--space-4);
                         border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md);
                         font-size: var(--text-sm); background: var(--bg-primary); cursor: pointer;">
            <option value="">All Users</option>
            <option>Active</option>
            <option>Inactive</option>
          </select>

        </div>
      </div>

      <!-- ============================================
           USERS TABLE
           ============================================ -->
      <div class="admin-card" style="padding: 0; overflow: hidden;">

        <!-- Table Header -->
        <div style="padding: var(--space-5) var(--space-6); border-bottom: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center;">
          <h3 style="font-family: var(--font-heading); font-size: var(--text-md); color: var(--text-primary); margin: 0;">
            Registered Customers
          </h3>
          <span style="font-size: var(--text-sm); color: var(--text-muted);">
            <?= count($users) ?> total users
          </span>
        </div>

        <!-- Scrollable Table -->
        <div style="overflow-x: auto;">
          <table style="width: 100%; border-collapse: collapse; font-size: var(--text-sm);">

            <thead style="background: var(--bg-secondary);">
              <tr>
                <th style="padding: var(--space-4) var(--space-6); text-align: left; font-weight: 600; color: var(--text-secondary);">#</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: left; font-weight: 600; color: var(--text-secondary);">Customer</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: left; font-weight: 600; color: var(--text-secondary);">Contact</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: center; font-weight: 600; color: var(--text-secondary);">Orders</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: right; font-weight: 600; color: var(--text-secondary);">Total Spent</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: center; font-weight: 600; color: var(--text-secondary);">Status</th>
                <th style="padding: var(--space-4) var(--space-4); text-align: left; font-weight: 600; color: var(--text-secondary);">Joined</th>
                <th style="padding: var(--space-4) var(--space-6); text-align: center; font-weight: 600; color: var(--text-secondary);">Actions</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($users as $i => $user): ?>
              <tr style="border-bottom: 1px solid var(--border-light); <?= $i % 2 === 0 ? '' : 'background: var(--bg-secondary);' ?>">

                <td style="padding: var(--space-4) var(--space-6); color: var(--text-muted);"><?= $user['id'] ?></td>

                <!-- User Info -->
                <td style="padding: var(--space-4);">
                  <div style="display: flex; align-items: center; gap: var(--space-3);">
                    <!-- Avatar Placeholder -->
                    <div class="img-placeholder" style="width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: var(--text-sm); font-weight: 700;">
                      <?= strtoupper(substr($user['name'], 0, 1)) ?>
                    </div>
                    <div>
                      <div style="font-weight: 600; color: var(--text-primary);"><?= htmlspecialchars($user['name']) ?></div>
                      <div style="font-size: var(--text-xs); color: var(--text-muted);"><?= htmlspecialchars($user['email']) ?></div>
                    </div>
                  </div>
                </td>

                <!-- Contact -->
                <td style="padding: var(--space-4); color: var(--text-secondary); font-size: var(--text-xs);">
                  <?= htmlspecialchars($user['phone']) ?>
                </td>

                <!-- Orders Count -->
                <td style="padding: var(--space-4); text-align: center; color: var(--text-secondary);">
                  <?= $user['orders'] ?>
                </td>

                <!-- Total Spent -->
                <td style="padding: var(--space-4); text-align: right; font-weight: 600; color: var(--color-gold);">
                  ₱<?= number_format($user['spent']) ?>
                </td>

                <!-- Status -->
                <td style="padding: var(--space-4); text-align: center;">
                  <?php if ($user['status'] === 'active'): ?>
                    <span style="background: #E8F5E9; color: #2E7D32; padding: 4px 12px; border-radius: var(--border-radius-full); font-size: var(--text-xs); font-weight: 600;">Active</span>
                  <?php else: ?>
                    <span style="background: #F5F5F5; color: #616161; padding: 4px 12px; border-radius: var(--border-radius-full); font-size: var(--text-xs); font-weight: 600;">Inactive</span>
                  <?php endif; ?>
                </td>

                <!-- Join Date -->
                <td style="padding: var(--space-4); color: var(--text-muted); font-size: var(--text-xs);">
                  <?= htmlspecialchars($user['joined']) ?>
                </td>

                <!-- Actions -->
                <td style="padding: var(--space-4) var(--space-6); text-align: center;">
                  <div style="display: flex; gap: var(--space-2); justify-content: center;">
                    <button class="btn btn-secondary btn-sm" title="View profile" style="padding: 6px 10px;">
                      <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" title="Edit user" style="padding: 6px 10px;">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm" title="Disable user"
                      style="padding: 6px 10px; background: #FFEBEE; color: var(--color-danger); border: 1px solid #FFCDD2;">
                      <i class="fas fa-ban"></i>
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
          <span style="font-size: var(--text-sm); color: var(--text-muted);">Page 1 of 2</span>
          <div style="display: flex; gap: var(--space-2);">
            <button class="btn btn-secondary btn-sm" disabled><i class="fas fa-chevron-left"></i></button>
            <button class="btn btn-primary btn-sm">1</button>
            <button class="btn btn-secondary btn-sm">2</button>
            <button class="btn btn-secondary btn-sm"><i class="fas fa-chevron-right"></i></button>
          </div>
        </div>

      </div><!-- /users table card -->

    </div><!-- /admin-content -->
  </div><!-- /admin-main -->
</div><!-- /admin-layout -->

<?php
echo '<script src="/public/assets/js/admin.js"></script>';
require_once __DIR__ . '/../layouts/footer.php';
?>
<?php
/**
 * JUAN CAFÉ - User Dashboard Sidebar
 * File: app/views/layouts/sidebar.php
 *
 * Session-aware: shows the logged-in user's real name.
 * Logout hits the real PHP logout route instead of a fake JS toast.
 *
 * Usage: require_once __DIR__ . '/../layouts/sidebar.php';
 */

// Ensure session is running
if (session_status() === PHP_SESSION_NONE) {
    session_name('juancafe_session');
    session_start();
}

// Redirect guests away from dashboard pages
if (empty($_SESSION['user_id'])) {
    $_SESSION['intended_url'] = $_SERVER['REQUEST_URI'] ?? '/app/views/user/dashboard.php';
    header('Location: /app/views/auth/login.php');
    exit;
}

$userName   = htmlspecialchars($_SESSION['user_name']  ?? 'User',   ENT_QUOTES, 'UTF-8');
$userEmail  = htmlspecialchars($_SESSION['user_email'] ?? '',        ENT_QUOTES, 'UTF-8');

// Cart count from session (updated by CartController after each add/remove)
$cartCount  = (int) ($_SESSION['cart_count'] ?? 0);

// Unread notification count
$notifCount = 0;
try {
    require_once __DIR__ . '/../../config/database.php';
    $pdo  = Database::getInstance();
    $stmt = $pdo->prepare(
        'SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0'
    );
    $stmt->execute([$_SESSION['user_id']]);
    $notifCount = (int) $stmt->fetchColumn();
} catch (Exception $e) {
    // Non-fatal
}

// Current page for active link highlighting
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
      <div class="sidebar-user-name"><?= $userName ?></div>
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
        <?php if ($cartCount > 0): ?>
          <span class="sidebar-badge cart-badge"><?= $cartCount ?></span>
        <?php endif; ?>
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
        <?php if ($notifCount > 0): ?>
          <span class="sidebar-badge notif-badge"
                style="background: var(--color-danger);"><?= $notifCount ?></span>
        <?php endif; ?>
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

    <!-- Real PHP logout — no more fake JS toast -->
    <a href="/public/index.php?action=auth.logout"
       class="sidebar-logout-btn"
       style="text-decoration: none; display: flex; align-items: center; gap: 8px;"
       onclick="return confirm('Log out of Juan Café?')">
      <i class="fas fa-sign-out-alt"></i>
      <span class="sidebar-link-text">Log Out</span>
    </a>
  </div>

  <!-- Collapse Toggle Button (desktop only) -->
  <button class="sidebar-toggle sidebar-toggle-btn" title="Collapse sidebar">
    <i class="fas fa-chevron-left"></i>
  </button>

</aside><!-- /sidebar -->

<!-- Dark overlay shown on mobile when sidebar is open -->
<div class="sidebar-overlay" id="sidebar-overlay"></div>
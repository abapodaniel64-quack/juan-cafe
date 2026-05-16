<?php
/**
 * JUAN CAFÉ - Main Navigation Bar
 * File: app/views/layouts/navbar.php
 *
 * Session-aware: shows Login/Sign Up for guests,
 * account menu for logged-in users, and admin link for admins.
 *
 * Include AFTER header.php (session is started in header or the calling view).
 */

// Ensure session is active so we can read auth state
if (session_status() === PHP_SESSION_NONE) {
    session_name('juancafe_session');
    session_start();
}

$isLoggedIn  = !empty($_SESSION['user_id']);
$isAdmin     = !empty($_SESSION['admin_id']);
$userName    = $_SESSION['user_name'] ?? '';
$adminName   = $_SESSION['admin_name'] ?? '';

// Cart count — read from session-stored value updated by CartController
// (falls back to 0 if no backend cart sync has run yet)
$cartCount   = $_SESSION['cart_count'] ?? 0;
$notifCount  = 0;

// If a user is logged in, fetch unread notification count cheaply
if ($isLoggedIn) {
    try {
        require_once __DIR__ . '/../../config/database.php';
        $pdo  = Database::getInstance();
        $stmt = $pdo->prepare(
            'SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0'
        );
        $stmt->execute([$_SESSION['user_id']]);
        $notifCount = (int) $stmt->fetchColumn();
    } catch (Exception $e) {
        // Non-fatal — badge just shows 0
    }
}
?>

<!-- ================================================
     MAIN NAVIGATION BAR
     ================================================ -->
<nav class="navbar" id="main-navbar">
  <div class="navbar-container">

    <!-- Brand / Logo -->
    <a href="/app/views/home/index.php" class="navbar-brand">
      <div class="navbar-logo">☕</div>
      <div>
        <span class="navbar-brand-text">Juan Café</span>
        <span class="navbar-brand-tagline">Brewed with love</span>
      </div>
    </a>

    <!-- Desktop Navigation Links -->
    <ul class="navbar-nav">
      <li><a href="/app/views/home/index.php"        class="nav-link">Home</a></li>
      <li><a href="/app/views/products/products.php"  class="nav-link">Menu</a></li>
      <li><a href="/app/views/home/about.php"         class="nav-link">About</a></li>
      <li><a href="/app/views/home/contact.php"       class="nav-link">Contact</a></li>
    </ul>

    <!-- Right Side Actions -->
    <div class="navbar-actions">

      <?php if ($isLoggedIn || $isAdmin): ?>

        <!-- Cart Icon (users only) -->
        <?php if ($isLoggedIn && !$isAdmin): ?>
        <button class="nav-icon-btn" title="Cart"
                onclick="window.location.href='/app/views/user/cart.php'">
          <i class="fas fa-shopping-bag"></i>
          <span class="cart-badge" style="<?= $cartCount === 0 ? 'display:none;' : '' ?>">
            <?= $cartCount ?>
          </span>
        </button>

        <!-- Notification Bell (users) -->
        <button class="nav-icon-btn" title="Notifications"
                onclick="window.location.href='/app/views/user/notifications.php'">
          <i class="fas fa-bell"></i>
          <?php if ($notifCount > 0): ?>
            <span class="cart-badge notif-badge" style="background: var(--color-danger);">
              <?= $notifCount ?>
            </span>
          <?php endif; ?>
        </button>
        <?php endif; ?>

        <!-- Admin link (if admin is logged in) -->
        <?php if ($isAdmin): ?>
        <a href="/app/views/admin/dashboard.php" class="btn btn-secondary btn-sm">
          <i class="fas fa-tachometer-alt"></i> Admin Panel
        </a>
        <?php endif; ?>

        <!-- User / Admin Name + Dropdown -->
        <div class="navbar-user-menu" style="position: relative; display: inline-flex; align-items: center; gap: 8px;">
          <span style="font-size: 0.85rem; color: var(--color-espresso); font-weight: 600;">
            👤 <?= htmlspecialchars($isAdmin ? $adminName : $userName, ENT_QUOTES, 'UTF-8') ?>
          </span>

          <!-- Profile link -->
          <?php if ($isLoggedIn): ?>
          <a href="/app/views/user/profile.php" class="btn btn-secondary btn-sm">Profile</a>
          <?php endif; ?>

          <!-- Logout -->
          <a href="/public/index.php?action=auth.logout" class="btn btn-sm"
             style="border: 1px solid var(--border-light); color: var(--text-muted);"
             onclick="return confirm('Log out of Juan Café?')">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>

      <?php else: ?>

        <!-- Guest: show Login and Sign Up -->
        <a href="/app/views/auth/login.php"  class="btn btn-secondary btn-sm">Login</a>
        <a href="/app/views/auth/signup.php" class="btn btn-primary  btn-sm">Sign Up</a>

      <?php endif; ?>

      <!-- Mobile Hamburger -->
      <button class="hamburger" id="hamburger-btn" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

    </div>

  </div><!-- /navbar-container -->
</nav>

<!-- Mobile Navigation Dropdown -->
<div class="mobile-nav" id="mobile-nav">
  <a href="/app/views/home/index.php"        class="nav-link">🏠 Home</a>
  <a href="/app/views/products/products.php"  class="nav-link">☕ Menu</a>
  <a href="/app/views/home/about.php"         class="nav-link">👥 About Us</a>
  <a href="/app/views/home/contact.php"       class="nav-link">📍 Contact</a>
  <hr style="border-color: var(--border-light); margin: 8px 0;" />

  <?php if ($isLoggedIn || $isAdmin): ?>
    <?php if ($isLoggedIn): ?>
    <a href="/app/views/user/dashboard.php" class="btn btn-secondary btn-block" style="margin-bottom: 8px;">
      My Dashboard
    </a>
    <?php endif; ?>
    <a href="/public/index.php?action=auth.logout" class="btn btn-primary btn-block"
       onclick="return confirm('Log out?')">
      Log Out
    </a>
  <?php else: ?>
    <a href="/app/views/auth/login.php"  class="btn btn-secondary btn-block" style="margin-bottom: 8px;">Login</a>
    <a href="/app/views/auth/signup.php" class="btn btn-primary  btn-block">Sign Up</a>
  <?php endif; ?>
</div>
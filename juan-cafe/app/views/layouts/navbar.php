<!-- ================================================
     JUAN CAFÉ - Main Navigation Bar
     ================================================ -->
<nav class="navbar" id="main-navbar">
  <div class="navbar-container">

    <!-- Brand / Logo -->
    <a href="/app/views/home/index.php" class="navbar-brand">
      <div class="navbar-logo">
        <!-- Replace with actual logo image: <img src="/public/assets/images/logo/logo.png" alt="Juan Café Logo" /> -->
        ☕
      </div>
      <div>
        <span class="navbar-brand-text">Juan Café</span>
        <span class="navbar-brand-tagline">Brewed with love</span>
      </div>
    </a>

    <!-- Desktop Navigation Links -->
    <ul class="navbar-nav">
      <li><a href="/app/views/home/index.php"       class="nav-link">Home</a></li>
      <li><a href="/app/views/products/products.php" class="nav-link">Menu</a></li>
      <li><a href="/app/views/home/about.php"        class="nav-link">About</a></li>
      <li><a href="/app/views/home/contact.php"      class="nav-link">Contact</a></li>
    </ul>

    <!-- Right Side Actions -->
    <div class="navbar-actions">
      <!-- Cart Icon -->
      <button class="nav-icon-btn" title="Cart" onclick="window.location.href='/app/views/user/cart.php'">
        <i class="fas fa-shopping-bag"></i>
        <span class="cart-badge">3</span>
      </button>

      <!-- Notification Icon -->
      <button class="nav-icon-btn" title="Notifications" onclick="window.location.href='/app/views/user/notifications.php'">
        <i class="fas fa-bell"></i>
        <span class="cart-badge notif-badge" style="background: var(--color-danger);">2</span>
      </button>

      <!-- Login Button (shown when not logged in) -->
      <a href="/app/views/auth/login.php" class="btn btn-secondary btn-sm">Login</a>
      <a href="/app/views/auth/signup.php" class="btn btn-primary btn-sm">Sign Up</a>

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
  <a href="/app/views/home/index.php"       class="nav-link">🏠 Home</a>
  <a href="/app/views/products/products.php" class="nav-link">☕ Menu</a>
  <a href="/app/views/home/about.php"        class="nav-link">👥 About Us</a>
  <a href="/app/views/home/contact.php"      class="nav-link">📍 Contact</a>
  <hr style="border-color: var(--border-light); margin: 8px 0;" />
  <a href="/app/views/auth/login.php"  class="btn btn-secondary btn-block" style="margin-bottom: 8px;">Login</a>
  <a href="/app/views/auth/signup.php" class="btn btn-primary  btn-block">Sign Up</a>
</div>
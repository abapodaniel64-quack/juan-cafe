<?php
/**
 * JUAN CAFÉ - Login Page
 * File: app/views/auth/login.php
 *
 * UI only — no backend authentication yet.
 * Form validation and submit handled by auth.js
 */
require_once __DIR__ . '/../layouts/header.php';
// No navbar on auth pages — cleaner UX
?>

<!-- ================================================
     LOGIN PAGE LAYOUT
     ================================================ -->
<div class="auth-page" style="
  min-height: 100vh;
  display: grid;
  grid-template-columns: 1fr 1fr;
  background: var(--bg-primary);
">

  <!-- Left Panel: Branding -->
  <div class="auth-brand-panel" style="
    background: linear-gradient(145deg, var(--color-espresso) 0%, var(--color-coffee) 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: var(--space-12);
    text-align: center;
    position: relative;
    overflow: hidden;
  ">
    <!-- Decorative background circles -->
    <div style="position: absolute; width: 300px; height: 300px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.05); top: -100px; right: -100px;"></div>
    <div style="position: absolute; width: 200px; height: 200px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.07); bottom: 60px; left: -60px;"></div>

    <!-- Logo Placeholder -->
    <div style="
      width: 90px; height: 90px;
      background: rgba(255,255,255,0.12);
      border-radius: var(--border-radius-full);
      display: flex; align-items: center; justify-content: center;
      font-size: 2.8rem;
      margin-bottom: var(--space-6);
      border: 2px solid rgba(255,255,255,0.2);
    ">
      ☕
    </div>

    <h1 style="font-family: var(--font-heading); font-size: var(--text-4xl); color: white; margin-bottom: var(--space-4);">
      Juan Café
    </h1>
    <p style="font-family: var(--font-accent); font-size: var(--text-xl); color: var(--color-latte); margin-bottom: var(--space-8);">
      Brewed with love
    </p>
    <p style="color: rgba(255,255,255,0.65); max-width: 340px; line-height: 1.8; font-size: var(--text-sm);">
      Premium quality beverages with a classy vibe at an affordable price — for every Filipino.
    </p>

    <!-- Decorative divider -->
    <div style="width: 40px; height: 2px; background: var(--color-gold); margin: var(--space-8) auto;"></div>

    <p style="color: rgba(255,255,255,0.4); font-size: var(--text-xs);">
      &copy; 2024 Juan Café · Top Juan Franchising Inc.
    </p>
  </div>

  <!-- Right Panel: Login Form -->
  <div style="
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--space-12) var(--space-8);
    background: var(--bg-primary);
  ">
    <div class="auth-card" style="width: 100%; max-width: 420px;">

      <!-- Heading -->
      <div style="margin-bottom: var(--space-8);">
        <h2 style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--color-espresso); margin-bottom: var(--space-2);">
          Welcome back!
        </h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm);">
          Sign in to your Juan Café account
        </p>
      </div>

      <!-- Login Form -->
      <!-- auth.js handles validation and submit -->
      <div id="login-form">

        <!-- Email -->
        <div class="form-group" style="margin-bottom: var(--space-5);">
          <label style="display: block; font-weight: var(--font-weight-medium); color: var(--color-espresso); margin-bottom: var(--space-2); font-size: var(--text-sm);">
            Email Address
          </label>
          <div class="form-control-wrap" style="position: relative;">
            <i class="fas fa-envelope" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.9rem;"></i>
            <input
              type="email"
              id="login-email"
              placeholder="your@email.com"
              style="width: 100%; padding: var(--space-3) var(--space-4) var(--space-3) 40px; border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: white; transition: var(--transition-fast);"
            />
          </div>
        </div>

        <!-- Password -->
        <div class="form-group" style="margin-bottom: var(--space-2);">
          <label style="display: block; font-weight: var(--font-weight-medium); color: var(--color-espresso); margin-bottom: var(--space-2); font-size: var(--text-sm);">
            Password
          </label>
          <div class="form-control-wrap" style="position: relative;">
            <i class="fas fa-lock" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.9rem;"></i>
            <input
              type="password"
              id="login-password"
              placeholder="Enter your password"
              style="width: 100%; padding: var(--space-3) 42px var(--space-3) 40px; border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: white; transition: var(--transition-fast);"
            />
            <!-- Show/Hide Password Toggle (handled by auth.js) -->
            <button
              type="button"
              class="toggle-password"
              data-target="login-password"
              style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; font-size: 1rem; color: var(--text-muted);"
              title="Show/hide password"
            >👁️</button>
          </div>
        </div>

        <!-- Forgot Password Link -->
        <div style="text-align: right; margin-bottom: var(--space-6);">
          <a href="#" style="font-size: var(--text-xs); color: var(--color-coffee);">Forgot password?</a>
        </div>

        <!-- Submit Button -->
        <button
          type="button"
          class="btn btn-primary btn-lg btn-block"
          onclick="document.getElementById('login-form').dispatchEvent(new Event('submit'))"
          style="margin-bottom: var(--space-5);"
        >
          <i class="fas fa-sign-in-alt"></i> Log In
        </button>

        <!-- Divider -->
        <div style="text-align: center; color: var(--text-muted); font-size: var(--text-sm); margin-bottom: var(--space-5); position: relative;">
          <span style="background: var(--bg-primary); padding: 0 var(--space-3);">or</span>
          <div style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: var(--border-light); z-index: -1;"></div>
        </div>

        <!-- Sign Up Link -->
        <p style="text-align: center; font-size: var(--text-sm); color: var(--text-muted);">
          Don't have an account?
          <a href="/app/views/auth/signup.php" style="color: var(--color-coffee); font-weight: var(--font-weight-semibold);">Sign up here</a>
        </p>

      </div><!-- /login-form -->

      <!-- Back to Home -->
      <div style="text-align: center; margin-top: var(--space-6);">
        <a href="/app/views/home/index.php" style="font-size: var(--text-xs); color: var(--text-muted);">
          <i class="fas fa-arrow-left"></i> Back to Home
        </a>
      </div>

    </div><!-- /auth-card -->
  </div><!-- /right panel -->

</div><!-- /auth-page -->

<!-- Toast container for notifications -->
<div class="toast-container" id="toast-container"></div>

<!-- Required JS files -->
<!-- app.js must load before auth.js (showToast dependency) -->
<script src="/public/assets/js/app.js"></script>
<script src="/public/assets/js/auth.js"></script>

<!-- Responsive fix: stack panels on mobile -->
<style>
  @media (max-width: 768px) {
    .auth-page  { grid-template-columns: 1fr !important; }
    .auth-brand-panel { display: none !important; }
  }
</style>

</body>
</html>
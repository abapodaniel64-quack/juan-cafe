<?php
/**
 * JUAN CAFÉ - Sign Up Page
 * File: app/views/auth/signup.php
 *
 * UI only — no backend authentication yet.
 * Form validation and submit handled by auth.js
 */
require_once __DIR__ . '/../layouts/header.php';
// No navbar on auth pages
?>

<!-- ================================================
     SIGNUP PAGE LAYOUT
     ================================================ -->
<div class="auth-page" style="
  min-height: 100vh;
  display: grid;
  grid-template-columns: 1fr 1fr;
  background: var(--bg-primary);
">

  <!-- Left Panel: Branding -->
  <div class="auth-brand-panel" style="
    background: linear-gradient(145deg, var(--color-espresso) 0%, var(--color-mocha) 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: var(--space-12);
    text-align: center;
    position: relative;
    overflow: hidden;
  ">
    <!-- Decorative circles -->
    <div style="position: absolute; width: 350px; height: 350px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.04); top: -120px; right: -100px;"></div>
    <div style="position: absolute; width: 250px; height: 250px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.06); bottom: 40px; left: -80px;"></div>

    <!-- Logo placeholder -->
    <div style="
      width: 90px; height: 90px;
      background: rgba(255,255,255,0.1);
      border-radius: var(--border-radius-full);
      display: flex; align-items: center; justify-content: center;
      font-size: 2.8rem;
      margin-bottom: var(--space-6);
      border: 2px solid rgba(255,255,255,0.18);
    ">☕</div>

    <h1 style="font-family: var(--font-heading); font-size: var(--text-4xl); color: white; margin-bottom: var(--space-4);">
      Join Juan Café
    </h1>
    <p style="font-family: var(--font-accent); font-size: var(--text-xl); color: var(--color-latte); margin-bottom: var(--space-8);">
      For every Juan
    </p>

    <!-- Benefits list -->
    <div style="text-align: left; max-width: 300px;">
      <?php
      $benefits = [
        ['icon' => '☕', 'text' => 'Order premium beverages online'],
        ['icon' => '📦', 'text' => 'Track your orders in real time'],
        ['icon' => '🔔', 'text' => 'Get exclusive promos and updates'],
        ['icon' => '💳', 'text' => 'Easy and secure checkout'],
      ];
      foreach ($benefits as $b): ?>
        <div style="display: flex; align-items: center; gap: var(--space-3); margin-bottom: var(--space-4);">
          <span style="font-size: 1.2rem;"><?= $b['icon'] ?></span>
          <span style="color: rgba(255,255,255,0.75); font-size: var(--text-sm);"><?= $b['text'] ?></span>
        </div>
      <?php endforeach; ?>
    </div>

    <div style="width: 40px; height: 2px; background: var(--color-gold); margin: var(--space-6) auto 0;"></div>
  </div>

  <!-- Right Panel: Sign Up Form -->
  <div style="
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--space-10) var(--space-8);
    background: var(--bg-primary);
    overflow-y: auto;
  ">
    <div class="auth-card" style="width: 100%; max-width: 420px;">

      <!-- Heading -->
      <div style="margin-bottom: var(--space-7);">
        <h2 style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--color-espresso); margin-bottom: var(--space-2);">
          Create an Account
        </h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm);">
          Fill in the details below to get started.
        </p>
      </div>

      <!-- Sign Up Form -->
      <!-- auth.js handles validation and submit -->
      <div id="signup-form">

        <!-- Full Name -->
        <div class="form-group" style="margin-bottom: var(--space-4);">
          <label style="display: block; font-weight: var(--font-weight-medium); color: var(--color-espresso); margin-bottom: var(--space-2); font-size: var(--text-sm);">
            Full Name <span style="color: var(--color-danger);">*</span>
          </label>
          <div class="form-control-wrap" style="position: relative;">
            <i class="fas fa-user" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.9rem;"></i>
            <input
              type="text"
              id="signup-name"
              placeholder="e.g. Juan dela Cruz"
              style="width: 100%; padding: var(--space-3) var(--space-4) var(--space-3) 40px; border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: white; transition: var(--transition-fast);"
            />
          </div>
        </div>

        <!-- Email -->
        <div class="form-group" style="margin-bottom: var(--space-4);">
          <label style="display: block; font-weight: var(--font-weight-medium); color: var(--color-espresso); margin-bottom: var(--space-2); font-size: var(--text-sm);">
            Email Address <span style="color: var(--color-danger);">*</span>
          </label>
          <div class="form-control-wrap" style="position: relative;">
            <i class="fas fa-envelope" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.9rem;"></i>
            <input
              type="email"
              id="signup-email"
              placeholder="your@email.com"
              style="width: 100%; padding: var(--space-3) var(--space-4) var(--space-3) 40px; border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: white; transition: var(--transition-fast);"
            />
          </div>
        </div>

        <!-- Password -->
        <div class="form-group" style="margin-bottom: var(--space-4);">
          <label style="display: block; font-weight: var(--font-weight-medium); color: var(--color-espresso); margin-bottom: var(--space-2); font-size: var(--text-sm);">
            Password <span style="color: var(--color-danger);">*</span>
          </label>
          <div class="form-control-wrap" style="position: relative;">
            <i class="fas fa-lock" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.9rem;"></i>
            <input
              type="password"
              id="signup-password"
              placeholder="At least 6 characters"
              style="width: 100%; padding: var(--space-3) 42px var(--space-3) 40px; border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: white; transition: var(--transition-fast);"
            />
            <button type="button" class="toggle-password" data-target="signup-password"
              style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; font-size: 1rem; color: var(--text-muted);"
              title="Show/hide password">👁️</button>
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group" style="margin-bottom: var(--space-5);">
          <label style="display: block; font-weight: var(--font-weight-medium); color: var(--color-espresso); margin-bottom: var(--space-2); font-size: var(--text-sm);">
            Confirm Password <span style="color: var(--color-danger);">*</span>
          </label>
          <div class="form-control-wrap" style="position: relative;">
            <i class="fas fa-lock" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.9rem;"></i>
            <input
              type="password"
              id="signup-confirm"
              placeholder="Re-enter your password"
              style="width: 100%; padding: var(--space-3) 42px var(--space-3) 40px; border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: white; transition: var(--transition-fast);"
            />
            <button type="button" class="toggle-password" data-target="signup-confirm"
              style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; font-size: 1rem; color: var(--text-muted);"
              title="Show/hide password">👁️</button>
          </div>
        </div>

        <!-- Terms & Conditions -->
        <div style="margin-bottom: var(--space-6); display: flex; align-items: flex-start; gap: var(--space-3);">
          <input type="checkbox" id="agree-terms" style="margin-top: 3px; accent-color: var(--color-coffee); flex-shrink: 0;" />
          <label for="agree-terms" style="font-size: var(--text-xs); color: var(--text-muted); cursor: pointer; line-height: 1.6;">
            I agree to the <a href="/app/views/home/privacy-policy.php" style="color: var(--color-coffee);">Privacy Policy</a>
            and consent to Juan Café storing my information for service and marketing purposes.
          </label>
        </div>

        <!-- Submit Button -->
        <button
          type="button"
          class="btn btn-primary btn-lg btn-block"
          onclick="document.getElementById('signup-form').dispatchEvent(new Event('submit'))"
          style="margin-bottom: var(--space-5);"
        >
          <i class="fas fa-user-plus"></i> Create Account
        </button>

        <!-- Login Link -->
        <p style="text-align: center; font-size: var(--text-sm); color: var(--text-muted);">
          Already have an account?
          <a href="/app/views/auth/login.php" style="color: var(--color-coffee); font-weight: var(--font-weight-semibold);">Log in here</a>
        </p>

      </div><!-- /signup-form -->

      <!-- Back to Home -->
      <div style="text-align: center; margin-top: var(--space-5);">
        <a href="/app/views/home/index.php" style="font-size: var(--text-xs); color: var(--text-muted);">
          <i class="fas fa-arrow-left"></i> Back to Home
        </a>
      </div>

    </div><!-- /auth-card -->
  </div><!-- /right panel -->

</div><!-- /auth-page -->

<!-- Toast container -->
<div class="toast-container" id="toast-container"></div>

<!-- JS files -->
<script src="/public/assets/js/app.js"></script>
<script src="/public/assets/js/auth.js"></script>

<!-- Mobile responsive fix -->
<style>
  @media (max-width: 768px) {
    .auth-page { grid-template-columns: 1fr !important; }
    .auth-brand-panel { display: none !important; }
  }
</style>

</body>
</html>
<?php
/**
 * JUAN CAFÉ - User Profile Page
 * File: app/views/user/profile.php
 * Frontend UI only.
 */
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="dashboard-layout" style="display: flex; min-height: 100vh;">
  <?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>

  <main class="dashboard-main" style="margin-left: var(--sidebar-width); flex: 1; background: var(--bg-admin); padding: var(--space-8); padding-top: calc(var(--space-8) + 16px);">

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-6);">
      <button class="mobile-menu-btn btn btn-secondary btn-sm" style="display: none;"><i class="fas fa-bars"></i></button>
      <div class="page-header">
        <h1 style="font-family: var(--font-heading); font-size: var(--text-2xl); color: var(--color-espresso);">👤 My Profile</h1>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: 4px;">Manage your personal information and preferences.</p>
      </div>
    </div>

    <!-- Profile Header Card -->
    <div class="profile-header-card" style="margin-bottom: var(--space-6);">
      <!-- Avatar Placeholder -->
      <div class="profile-avatar-large">👤</div>
      <div>
        <div class="profile-name">Juan dela Cruz</div>
        <div class="profile-email">juan@email.com</div>
        <div class="profile-since">Member since January 2024</div>
      </div>
      <button class="btn btn-secondary btn-sm" style="margin-left: auto; border-color: rgba(255,255,255,0.4); color: white;" onclick="showToast('Photo upload coming soon!', '')">
        <i class="fas fa-camera"></i> Change Photo
      </button>
    </div>

    <!-- Profile Form & Stats Grid -->
    <div class="panels-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: var(--space-6);">

      <!-- Edit Profile Form -->
      <div style="background: white; border-radius: var(--border-radius-lg); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: var(--space-6);">
        <h3 style="font-family: var(--font-heading); font-size: var(--text-lg); color: var(--color-espresso); margin-bottom: var(--space-6); padding-bottom: var(--space-4); border-bottom: 1px solid var(--border-light);">
          Personal Information
        </h3>

        <?php
        $fields = [
          ['label'=>'Full Name',    'id'=>'prof-name',    'type'=>'text',  'value'=>'Juan dela Cruz',     'icon'=>'fa-user'],
          ['label'=>'Email Address','id'=>'prof-email',   'type'=>'email', 'value'=>'juan@email.com',     'icon'=>'fa-envelope'],
          ['label'=>'Phone Number', 'id'=>'prof-phone',   'type'=>'tel',   'value'=>'+63 912 345 6789',   'icon'=>'fa-phone'],
          ['label'=>'Address',      'id'=>'prof-address', 'type'=>'text',  'value'=>'Manila, Philippines', 'icon'=>'fa-map-marker-alt'],
        ];
        foreach ($fields as $f): ?>
          <div class="form-group" style="margin-bottom: var(--space-5);">
            <label style="display: block; font-weight: var(--font-weight-medium); color: var(--color-espresso); margin-bottom: var(--space-2); font-size: var(--text-sm);">
              <?= $f['label'] ?>
            </label>
            <div style="position: relative;">
              <i class="fas <?= $f['icon'] ?>" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.85rem;"></i>
              <input type="<?= $f['type'] ?>" id="<?= $f['id'] ?>" value="<?= $f['value'] ?>"
                style="width: 100%; padding: var(--space-3) var(--space-4) var(--space-3) 40px; border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: var(--bg-primary); transition: var(--transition-fast);"
              />
            </div>
          </div>
        <?php endforeach; ?>

        <button class="btn btn-primary" onclick="showToast('Profile updated successfully! ✅', 'success')">
          <i class="fas fa-save"></i> Save Changes
        </button>
      </div>

      <!-- Right Column -->
      <div>

        <!-- Change Password -->
        <div style="background: white; border-radius: var(--border-radius-lg); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: var(--space-6); margin-bottom: var(--space-6);">
          <h3 style="font-family: var(--font-heading); font-size: var(--text-lg); color: var(--color-espresso); margin-bottom: var(--space-5);">
            Change Password
          </h3>

          <?php foreach (['Current Password', 'New Password', 'Confirm New Password'] as $i => $label): ?>
            <div class="form-group" style="margin-bottom: var(--space-4);">
              <label style="display: block; font-weight: var(--font-weight-medium); color: var(--color-espresso); margin-bottom: var(--space-2); font-size: var(--text-sm);">
                <?= $label ?>
              </label>
              <input type="password" placeholder="••••••••"
                style="width: 100%; padding: var(--space-3) var(--space-4); border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: var(--bg-primary);"
              />
            </div>
          <?php endforeach; ?>

          <button class="btn btn-secondary btn-sm btn-block" onclick="showToast('Password updated! 🔒', 'success')">
            Update Password
          </button>
        </div>

        <!-- Account Stats -->
        <div style="background: white; border-radius: var(--border-radius-lg); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: var(--space-6);">
          <h3 style="font-family: var(--font-heading); font-size: var(--text-lg); color: var(--color-espresso); margin-bottom: var(--space-5);">
            Account Stats
          </h3>
          <?php foreach ([
            ['label'=>'Total Orders',    'value'=>'12'],
            ['label'=>'Total Spent',     'value'=>'₱1,245'],
            ['label'=>'Favorite Drink',  'value'=>'Milk Tea'],
            ['label'=>'Member Since',    'value'=>'Jan 2024'],
          ] as $stat): ?>
            <div style="display: flex; justify-content: space-between; padding: var(--space-3) 0; border-bottom: 1px solid var(--border-light); font-size: var(--text-sm);">
              <span style="color: var(--text-muted);"><?= $stat['label'] ?></span>
              <strong style="color: var(--color-espresso);"><?= $stat['value'] ?></strong>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div><!-- /panels-grid -->

  </main>
</div>

<script src="/public/assets/js/app.js"></script>
<script src="/public/assets/js/cart.js"></script>
<script src="/public/assets/js/notifications.js"></script>
<style>
  @media (max-width: 1024px) {
    .mobile-menu-btn { display: flex !important; }
    .panels-grid { grid-template-columns: 1fr !important; }
  }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
<?php
/**
 * JUAN CAFÉ - About Us Page
 * File: app/views/home/about.php
 */
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
?>

<!-- ================================================
     PAGE HERO BANNER
     ================================================ -->
<section class="page-hero" style="
  background: linear-gradient(135deg, var(--color-espresso) 0%, var(--color-coffee) 100%);
  padding: calc(var(--navbar-height) + var(--space-16)) 0 var(--space-16);
  text-align: center;
  color: white;
">
  <div class="container">
    <span class="section-badge" style="color: var(--color-gold-light);">Get to Know Us</span>
    <h1 class="section-title" style="color: white; font-size: var(--text-4xl);">About Juan Café</h1>
    <div class="divider"></div>
    <p style="color: rgba(255,255,255,0.75); max-width: 550px; margin: 0 auto;">
      A Filipino brand committed to serving premium beverages at an affordable price with a classy vibe.
    </p>
  </div>
</section>

<!-- ================================================
     WHO WE ARE SECTION
     ================================================ -->
<section class="section-padding">
  <div class="container">
    <div class="about-grid">

      <!-- Image Placeholder -->
      <div class="about-img-wrap">
        <div class="img-placeholder" style="height: 380px; border-radius: var(--border-radius-lg);">
          <span>About Photo</span>
        </div>
      </div>

      <!-- Text Content -->
      <div class="about-text">
        <span class="section-badge">Our Story</span>
        <h2 class="section-title">Who We Are</h2>
        <div class="divider divider-left"></div>
        <p style="color: var(--text-secondary); line-height: 1.9; margin-bottom: var(--space-5);">
          Juan Café is a brand created in 2022, owned by <strong>Top Juan Franchising Inc.</strong>,
          with an objective to serve milk tea, coffee, frappe and fruit tea to every Filipino who deserves
          a premium experience without breaking the bank.
        </p>
        <p style="color: var(--text-secondary); line-height: 1.9;">
          We believe that quality beverages should be accessible to everyone. That's why we've carefully
          crafted every item on our menu to balance excellence with affordability — bringing a classy café
          experience right to your neighborhood.
        </p>
      </div>

    </div><!-- /about-grid -->
  </div>
</section>

<!-- ================================================
     VISION & MISSION SECTION
     ================================================ -->
<section class="section-padding" style="background: var(--bg-secondary);">
  <div class="container">
    <div class="text-center" style="margin-bottom: var(--space-12);">
      <span class="section-badge">Our Purpose</span>
      <h2 class="section-title">Vision & Mission</h2>
      <div class="divider"></div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-8);" class="panels-grid">

      <!-- Vision Card -->
      <div style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-8); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
        <div style="width: 56px; height: 56px; background: rgba(200, 148, 42, 0.15); border-radius: var(--border-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin-bottom: var(--space-5);">
          🔭
        </div>
        <h3 style="font-family: var(--font-heading); font-size: var(--text-xl); color: var(--color-espresso); margin-bottom: var(--space-4);">Our Vision</h3>
        <p style="color: var(--text-secondary); line-height: 1.9;">
          To serve premium quality beverages with a classy vibe on a very affordable price to all our
          Filipino countrymen.
        </p>
      </div>

      <!-- Mission Card -->
      <div style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-8); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm);">
        <div style="width: 56px; height: 56px; background: rgba(111, 78, 55, 0.12); border-radius: var(--border-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin-bottom: var(--space-5);">
          🎯
        </div>
        <h3 style="font-family: var(--font-heading); font-size: var(--text-xl); color: var(--color-espresso); margin-bottom: var(--space-4);">Our Mission</h3>
        <p style="color: var(--text-secondary); line-height: 1.9;">
          In order for the vision to materialize, we have to be committed in replicating this advocacy
          through the franchise business model.
        </p>
      </div>

    </div><!-- /panels-grid -->
  </div>
</section>

<!-- ================================================
     VALUES SECTION
     ================================================ -->
<section class="section-padding">
  <div class="container">
    <div class="text-center" style="margin-bottom: var(--space-12);">
      <span class="section-badge">What We Stand For</span>
      <h2 class="section-title">Our Core Values</h2>
      <div class="divider"></div>
    </div>

    <div class="value-cards" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: var(--space-6);">

      <div style="text-align: center; padding: var(--space-8);">
        <div style="font-size: 2.5rem; margin-bottom: var(--space-4);">💎</div>
        <h4 style="font-family: var(--font-heading); font-size: var(--text-lg); color: var(--color-espresso); margin-bottom: var(--space-3);">Quality</h4>
        <p style="color: var(--text-muted); font-size: var(--text-sm);">Premium ingredients in every cup, every time.</p>
      </div>

      <div style="text-align: center; padding: var(--space-8);">
        <div style="font-size: 2.5rem; margin-bottom: var(--space-4);">🤝</div>
        <h4 style="font-family: var(--font-heading); font-size: var(--text-lg); color: var(--color-espresso); margin-bottom: var(--space-3);">Commitment</h4>
        <p style="color: var(--text-muted); font-size: var(--text-sm);">Dedicated to delivering the best experience always.</p>
      </div>

      <div style="text-align: center; padding: var(--space-8);">
        <div style="font-size: 2.5rem; margin-bottom: var(--space-4);">💰</div>
        <h4 style="font-family: var(--font-heading); font-size: var(--text-lg); color: var(--color-espresso); margin-bottom: var(--space-3);">Affordability</h4>
        <p style="color: var(--text-muted); font-size: var(--text-sm);">Classy beverages at prices every Filipino can enjoy.</p>
      </div>

      <div style="text-align: center; padding: var(--space-8);">
        <div style="font-size: 2.5rem; margin-bottom: var(--space-4);">🇵🇭</div>
        <h4 style="font-family: var(--font-heading); font-size: var(--text-lg); color: var(--color-espresso); margin-bottom: var(--space-3);">Filipino Pride</h4>
        <p style="color: var(--text-muted); font-size: var(--text-sm);">A proudly Filipino brand for every Juan.</p>
      </div>

    </div><!-- /value-cards -->
  </div>
</section>

<!-- ================================================
     FRANCHISING CTA
     ================================================ -->
<section class="section-padding" style="background: linear-gradient(135deg, var(--color-coffee), var(--color-espresso)); text-align: center;">
  <div class="container">
    <span class="section-badge" style="color: var(--color-gold-light);">Grow with Us</span>
    <h2 class="section-title" style="color: white; margin-bottom: var(--space-4);">Interested in Franchising?</h2>
    <p style="color: rgba(255,255,255,0.75); max-width: 500px; margin: 0 auto var(--space-8);">
      Join the Juan Café family and bring premium beverages to your community through our
      proven franchise business model.
    </p>
    <a href="/app/views/home/contact.php" class="btn btn-gold btn-lg">
      <i class="fas fa-envelope"></i> Contact Us
    </a>
  </div>
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
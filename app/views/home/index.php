<?php
/**
 * JUAN CAFÉ - Homepage
 * File: app/views/home/index.php
 */
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
?>

<!-- ================================================
     HERO SECTION
     ================================================ -->
<section class="hero" id="hero">
  <div class="container">
    <div class="hero-content">

      <!-- Hero Text -->
      <div class="hero-text">
        <span class="section-badge">Brewed with love ☕</span>
        <h1 class="hero-title">
          Premium Drinks,<br>
          <span style="color: var(--color-gold);">Affordable Price</span>
        </h1>
        <p class="hero-desc">
          Experience the finest milk tea, coffee, frappe, and fruit tea crafted for every Filipino.
          Juan Café – where every sip feels like home.
        </p>
        <div class="hero-cta">
          <a href="/app/views/products/products.php" class="btn btn-primary btn-lg">
            <i class="fas fa-coffee"></i> Browse Our Menu
          </a>
          <a href="/app/views/home/about.php" class="btn btn-secondary btn-lg">
            Learn More
          </a>
        </div>

        <!-- Stats Row -->
        <div class="hero-stats">
          <div class="hero-stat">
            <span class="hero-stat-number">8+</span>
            <span class="hero-stat-label">Categories</span>
          </div>
          <div class="hero-stat">
            <span class="hero-stat-number">2022</span>
            <span class="hero-stat-label">Est. Year</span>
          </div>
          <div class="hero-stat">
            <span class="hero-stat-number">100%</span>
            <span class="hero-stat-label">Filipino Brand</span>
          </div>
        </div>
      </div><!-- /hero-text -->

      <!-- Hero Image Placeholder -->
      <div class="hero-image-area">
        <div class="hero-img-placeholder img-placeholder">
          <!-- Replace with actual hero image -->
          <span>Hero Image</span>
        </div>
      </div>

    </div><!-- /hero-content -->
  </div>
</section>

<!-- ================================================
     CATEGORIES SECTION
     ================================================ -->
<section class="section-padding" style="background: var(--bg-secondary);">
  <div class="container">
    <div class="text-center">
      <span class="section-badge">What We Serve</span>
      <h2 class="section-title">Our Drink Categories</h2>
      <div class="divider"></div>
    </div>

    <div class="categories-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: var(--space-4); margin-top: var(--space-10);">

      <!-- Category Card: Milk Tea -->
      <a href="/app/views/products/products.php?cat=milk-tea" class="category-card" style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-6); text-align: center; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); transition: var(--transition-normal); display: block;">
        <div style="font-size: 2.2rem; margin-bottom: var(--space-3);">🧋</div>
        <div style="font-weight: var(--font-weight-semibold); color: var(--color-espresso); font-size: var(--text-sm);">Milk Tea</div>
      </a>

      <!-- Category Card: Coffee -->
      <a href="/app/views/products/products.php?cat=coffee" class="category-card" style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-6); text-align: center; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); transition: var(--transition-normal); display: block;">
        <div style="font-size: 2.2rem; margin-bottom: var(--space-3);">☕</div>
        <div style="font-weight: var(--font-weight-semibold); color: var(--color-espresso); font-size: var(--text-sm);">Coffee</div>
      </a>

      <!-- Category Card: Fruit Tea -->
      <a href="/app/views/products/products.php?cat=fruit-tea" class="category-card" style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-6); text-align: center; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); transition: var(--transition-normal); display: block;">
        <div style="font-size: 2.2rem; margin-bottom: var(--space-3);">🍵</div>
        <div style="font-weight: var(--font-weight-semibold); color: var(--color-espresso); font-size: var(--text-sm);">Fruit Tea</div>
      </a>

      <!-- Category Card: Frappe -->
      <a href="/app/views/products/products.php?cat=frappe" class="category-card" style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-6); text-align: center; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); transition: var(--transition-normal); display: block;">
        <div style="font-size: 2.2rem; margin-bottom: var(--space-3);">🥤</div>
        <div style="font-weight: var(--font-weight-semibold); color: var(--color-espresso); font-size: var(--text-sm);">Frappe</div>
      </a>

      <!-- Category Card: Latte -->
      <a href="/app/views/products/products.php?cat=latte" class="category-card" style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-6); text-align: center; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); transition: var(--transition-normal); display: block;">
        <div style="font-size: 2.2rem; margin-bottom: var(--space-3);">🍶</div>
        <div style="font-weight: var(--font-weight-semibold); color: var(--color-espresso); font-size: var(--text-sm);">Latte</div>
      </a>

      <!-- Category Card: Hot Drinks -->
      <a href="/app/views/products/products.php?cat=hot-drinks" class="category-card" style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-6); text-align: center; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); transition: var(--transition-normal); display: block;">
        <div style="font-size: 2.2rem; margin-bottom: var(--space-3);">♨️</div>
        <div style="font-weight: var(--font-weight-semibold); color: var(--color-espresso); font-size: var(--text-sm);">Hot Drinks</div>
      </a>

      <!-- Category Card: Fruity Soda -->
      <a href="/app/views/products/products.php?cat=fruity-soda" class="category-card" style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-6); text-align: center; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); transition: var(--transition-normal); display: block;">
        <div style="font-size: 2.2rem; margin-bottom: var(--space-3);">🍹</div>
        <div style="font-weight: var(--font-weight-semibold); color: var(--color-espresso); font-size: var(--text-sm);">Fruity Soda</div>
      </a>

      <!-- Category Card: Premium Drinks -->
      <a href="/app/views/products/products.php?cat=premium" class="category-card" style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-6); text-align: center; border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); transition: var(--transition-normal); display: block;">
        <div style="font-size: 2.2rem; margin-bottom: var(--space-3);">✨</div>
        <div style="font-weight: var(--font-weight-semibold); color: var(--color-espresso); font-size: var(--text-sm);">Premium</div>
      </a>

    </div><!-- /categories-grid -->
  </div>
</section>

<!-- ================================================
     FEATURED PRODUCTS SECTION
     ================================================ -->
<section class="section-padding">
  <div class="container">
    <div class="text-center">
      <span class="section-badge">Customer Favorites</span>
      <h2 class="section-title">Featured Drinks</h2>
      <div class="divider"></div>
      <p class="section-subtitle">Handpicked bestsellers loved by our customers</p>
    </div>

    <div class="products-grid">

      <!-- Featured Product 1 -->
      <div class="product-card" data-category="milk-tea" data-product-id="1">
        <div class="product-img img-placeholder" style="height: 200px;">
          <span>Product Image</span>
        </div>
        <div class="product-info">
          <span class="product-category-badge">Milk Tea</span>
          <h3 class="product-name">Classic Milk Tea</h3>
          <p class="product-desc">Our signature creamy milk tea with tapioca pearls.</p>
          <div class="product-footer">
            <span class="product-price">₱75</span>
            <button class="btn btn-primary btn-sm add-to-cart-btn">
              <i class="fas fa-plus"></i> Add
            </button>
          </div>
        </div>
      </div>

      <!-- Featured Product 2 -->
      <div class="product-card" data-category="coffee" data-product-id="2">
        <div class="product-img img-placeholder" style="height: 200px;">
          <span>Product Image</span>
        </div>
        <div class="product-info">
          <span class="product-category-badge">Coffee</span>
          <h3 class="product-name">Brown Sugar Coffee</h3>
          <p class="product-desc">Rich coffee topped with brown sugar drizzle.</p>
          <div class="product-footer">
            <span class="product-price">₱95</span>
            <button class="btn btn-primary btn-sm add-to-cart-btn">
              <i class="fas fa-plus"></i> Add
            </button>
          </div>
        </div>
      </div>

      <!-- Featured Product 3 -->
      <div class="product-card" data-category="frappe" data-product-id="3">
        <div class="product-img img-placeholder" style="height: 200px;">
          <span>Product Image</span>
        </div>
        <div class="product-info">
          <span class="product-category-badge">Frappe</span>
          <h3 class="product-name">Mocha Frappe</h3>
          <p class="product-desc">Blended mocha frappe with whipped cream topping.</p>
          <div class="product-footer">
            <span class="product-price">₱110</span>
            <button class="btn btn-primary btn-sm add-to-cart-btn">
              <i class="fas fa-plus"></i> Add
            </button>
          </div>
        </div>
      </div>

      <!-- Featured Product 4 -->
      <div class="product-card" data-category="fruit-tea" data-product-id="4">
        <div class="product-img img-placeholder" style="height: 200px;">
          <span>Product Image</span>
        </div>
        <div class="product-info">
          <span class="product-category-badge">Fruit Tea</span>
          <h3 class="product-name">Lychee Fruit Tea</h3>
          <p class="product-desc">Refreshing lychee-infused fruit tea with real lychee bits.</p>
          <div class="product-footer">
            <span class="product-price">₱80</span>
            <button class="btn btn-primary btn-sm add-to-cart-btn">
              <i class="fas fa-plus"></i> Add
            </button>
          </div>
        </div>
      </div>

    </div><!-- /products-grid -->

    <!-- View All Button -->
    <div class="text-center" style="margin-top: var(--space-10);">
      <a href="/app/views/products/products.php" class="btn btn-secondary btn-lg">
        View Full Menu <i class="fas fa-arrow-right"></i>
      </a>
    </div>

  </div>
</section>

<!-- ================================================
     ABOUT SNIPPET SECTION
     ================================================ -->
<section class="section-padding" style="background: var(--bg-dark); color: var(--text-on-dark);">
  <div class="container">
    <div class="about-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-16); align-items: center;">

      <!-- Image Placeholder -->
      <div>
        <div class="img-placeholder" style="height: 340px; border-radius: var(--border-radius-lg);">
          <span>About Image</span>
        </div>
      </div>

      <!-- Text Content -->
      <div>
        <span class="section-badge">Our Story</span>
        <h2 class="section-title" style="color: white;">Who We Are</h2>
        <div class="divider divider-left"></div>
        <p style="color: rgba(255,255,255,0.75); line-height: 1.9; margin-bottom: var(--space-6);">
          Juan Café is a brand created in 2022, owned by <strong style="color: var(--color-latte);">Top Juan Franchising Inc.</strong>,
          with an objective to serve milk tea, coffee, frappe and fruit tea — premium quality beverages
          at a very affordable price for all Filipinos.
        </p>
        <a href="/app/views/home/about.php" class="btn btn-gold">
          Read Our Story <i class="fas fa-arrow-right"></i>
        </a>
      </div>

    </div>
  </div>
</section>

<!-- ================================================
     CTA SECTION
     ================================================ -->
<section class="section-padding" style="background: linear-gradient(135deg, var(--color-coffee), var(--color-espresso));">
  <div class="container text-center">
    <span class="section-badge" style="color: var(--color-gold-light);">Ready to Order?</span>
    <h2 class="section-title" style="color: white; margin-bottom: var(--space-4);">Order Your Favorite Drinks Today</h2>
    <p style="color: rgba(255,255,255,0.75); margin-bottom: var(--space-8); max-width: 500px; margin-left: auto; margin-right: auto;">
      Sign up for an account and start ordering premium beverages at your fingertips.
    </p>
    <div style="display: flex; gap: var(--space-4); justify-content: center; flex-wrap: wrap;">
      <a href="/app/views/auth/signup.php" class="btn btn-gold btn-lg">
        <i class="fas fa-user-plus"></i> Create Account
      </a>
      <a href="/app/views/products/products.php" class="btn btn-secondary btn-lg" style="border-color: white; color: white;">
        <i class="fas fa-coffee"></i> View Menu
      </a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
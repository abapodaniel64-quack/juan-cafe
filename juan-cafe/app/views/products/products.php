<?php
/**
 * JUAN CAFÉ - Products / Menu Page
 * File: app/views/products/products.php
 *
 * Displays all products with category filter and search.
 * Uses placeholder products — replace with real data later.
 */
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';

/**
 * Placeholder product data.
 * Replace this array with database queries when backend is ready.
 */
$products = [
  // Milk Tea
  ['id'=>1,  'name'=>'Classic Milk Tea',        'category'=>'milk-tea',    'price'=>75,  'desc'=>'Our signature creamy milk tea with tapioca pearls.'],
  ['id'=>2,  'name'=>'Brown Sugar Milk Tea',    'category'=>'milk-tea',    'price'=>85,  'desc'=>'Sweet brown sugar milk tea with golden boba.'],
  ['id'=>3,  'name'=>'Taro Milk Tea',           'category'=>'milk-tea',    'price'=>80,  'desc'=>'Smooth taro-flavored milk tea, rich and creamy.'],
  // Coffee
  ['id'=>4,  'name'=>'Brown Sugar Coffee',      'category'=>'coffee',      'price'=>95,  'desc'=>'Rich coffee topped with a brown sugar drizzle.'],
  ['id'=>5,  'name'=>'Iced Americano',          'category'=>'coffee',      'price'=>85,  'desc'=>'Bold espresso over ice, refreshing and strong.'],
  ['id'=>6,  'name'=>'Caramel Macchiato',       'category'=>'coffee',      'price'=>110, 'desc'=>'Espresso with vanilla syrup and caramel drizzle.'],
  // Fruit Tea
  ['id'=>7,  'name'=>'Lychee Fruit Tea',        'category'=>'fruit-tea',   'price'=>80,  'desc'=>'Refreshing lychee-infused tea with real lychee bits.'],
  ['id'=>8,  'name'=>'Mango Green Tea',         'category'=>'fruit-tea',   'price'=>75,  'desc'=>'Sweet mango blended with crisp green tea.'],
  ['id'=>9,  'name'=>'Strawberry Fruit Tea',    'category'=>'fruit-tea',   'price'=>80,  'desc'=>'Bright strawberry tea bursting with fruity flavor.'],
  // Frappe
  ['id'=>10, 'name'=>'Mocha Frappe',            'category'=>'frappe',      'price'=>110, 'desc'=>'Blended mocha frappe with whipped cream topping.'],
  ['id'=>11, 'name'=>'Caramel Frappe',          'category'=>'frappe',      'price'=>115, 'desc'=>'Creamy caramel frappe, sweet and indulgent.'],
  ['id'=>12, 'name'=>'Vanilla Frappe',          'category'=>'frappe',      'price'=>105, 'desc'=>'Classic vanilla frappe, smooth and velvety.'],
  // Latte
  ['id'=>13, 'name'=>'Matcha Latte',            'category'=>'latte',       'price'=>100, 'desc'=>'Japanese matcha with steamed milk, earthy and sweet.'],
  ['id'=>14, 'name'=>'Brown Sugar Latte',       'category'=>'latte',       'price'=>105, 'desc'=>'Espresso latte swirled with rich brown sugar.'],
  // Hot Drinks
  ['id'=>15, 'name'=>'Hot Chocolate',           'category'=>'hot-drinks',  'price'=>85,  'desc'=>'Warm and comforting rich hot chocolate.'],
  ['id'=>16, 'name'=>'Hot Matcha',              'category'=>'hot-drinks',  'price'=>90,  'desc'=>'Classic hot matcha, perfect for a cozy afternoon.'],
  // Fruity Soda
  ['id'=>17, 'name'=>'Blueberry Soda',          'category'=>'fruity-soda', 'price'=>75,  'desc'=>'Fizzy blueberry soda, refreshing and fun.'],
  ['id'=>18, 'name'=>'Lemon Soda',              'category'=>'fruity-soda', 'price'=>70,  'desc'=>'Tangy lemon soda with a sparkling twist.'],
  // Premium
  ['id'=>19, 'name'=>'Premium Milk Tea',        'category'=>'premium',     'price'=>130, 'desc'=>'Luxury-grade tea blend with premium toppings.'],
  ['id'=>20, 'name'=>'Signature Frappe',        'category'=>'premium',     'price'=>145, 'desc'=>'Our exclusive signature frappe — a must-try.'],
];

// Category filter tabs data
$categories = [
  'all'        => ['label' => 'All', 'icon' => '☕'],
  'milk-tea'   => ['label' => 'Milk Tea', 'icon' => '🧋'],
  'coffee'     => ['label' => 'Coffee', 'icon' => '☕'],
  'fruit-tea'  => ['label' => 'Fruit Tea', 'icon' => '🍵'],
  'frappe'     => ['label' => 'Frappe', 'icon' => '🥤'],
  'latte'      => ['label' => 'Latte', 'icon' => '🍶'],
  'hot-drinks' => ['label' => 'Hot Drinks', 'icon' => '♨️'],
  'fruity-soda'=> ['label' => 'Fruity Soda', 'icon' => '🍹'],
  'premium'    => ['label' => 'Premium', 'icon' => '✨'],
];
?>

<!-- ================================================
     PAGE HERO
     ================================================ -->
<section style="
  background: linear-gradient(135deg, var(--color-espresso), var(--color-coffee));
  padding: calc(var(--navbar-height) + var(--space-12)) 0 var(--space-12);
  text-align: center;
  color: white;
">
  <div class="container">
    <span class="section-badge" style="color: var(--color-gold-light);">What We Offer</span>
    <h1 class="section-title" style="color: white; font-size: var(--text-4xl);">Our Menu</h1>
    <div class="divider"></div>
    <p style="color: rgba(255,255,255,0.75); max-width: 520px; margin: 0 auto;">
      Premium beverages crafted with quality ingredients. Available for dine-in and order online.
    </p>
  </div>
</section>

<!-- ================================================
     PRODUCTS SECTION
     ================================================ -->
<section class="section-padding" style="padding-top: var(--space-10);">
  <div class="container">

    <!-- Search Bar -->
    <div style="max-width: 480px; margin: 0 auto var(--space-8); position: relative;">
      <i class="fas fa-search" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
      <input
        type="text"
        id="product-search"
        placeholder="Search drinks..."
        style="width: 100%; padding: var(--space-4) var(--space-4) var(--space-4) 44px; border: 1.5px solid var(--border-light); border-radius: var(--border-radius-full); font-size: var(--text-sm); background: white; box-shadow: var(--shadow-sm); transition: var(--transition-fast);"
      />
    </div>

    <!-- Category Filter Tabs -->
    <div class="filter-tabs" style="display: flex; gap: var(--space-2); justify-content: center; margin-bottom: var(--space-8); flex-wrap: wrap;">
      <?php foreach ($categories as $key => $cat): ?>
        <button
          class="filter-tab btn btn-sm <?= $key === 'all' ? 'btn-primary active' : 'btn-secondary' ?>"
          data-category="<?= $key ?>"
          style="<?= $key !== 'all' ? 'border-color: var(--border-medium); color: var(--text-secondary);' : '' ?>"
        >
          <?= $cat['icon'] ?> <?= $cat['label'] ?>
        </button>
      <?php endforeach; ?>
    </div>

    <!-- Products Grid -->
    <div class="products-grid">
      <?php foreach ($products as $product): ?>
        <div
          class="product-card"
          data-category="<?= htmlspecialchars($product['category']) ?>"
          data-product-id="<?= $product['id'] ?>"
        >
          <!-- Product Image Placeholder -->
          <div class="product-img img-placeholder" style="height: 180px;">
            <span>Product Image</span>
          </div>

          <!-- Product Info -->
          <div class="product-info">
            <!-- Category Badge -->
            <span class="product-category-badge">
              <?= htmlspecialchars($categories[$product['category']]['label'] ?? $product['category']) ?>
            </span>

            <!-- Name -->
            <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>

            <!-- Description -->
            <p class="product-desc"><?= htmlspecialchars($product['desc']) ?></p>

            <!-- Price + Add to Cart -->
            <div class="product-footer">
              <span class="product-price">₱<?= $product['price'] ?></span>
              <div style="display: flex; gap: var(--space-2);">
                <!-- View Details -->
                <a
                  href="/app/views/products/product-details.php?id=<?= $product['id'] ?>"
                  class="btn btn-secondary btn-sm"
                  title="View details"
                >
                  <i class="fas fa-eye"></i>
                </a>
                <!-- Add to Cart -->
                <button class="btn btn-primary btn-sm add-to-cart-btn" title="Add to cart">
                  <i class="fas fa-plus"></i> Add
                </button>
              </div>
            </div>
          </div><!-- /product-info -->
        </div><!-- /product-card -->
      <?php endforeach; ?>
    </div><!-- /products-grid -->

    <!-- Allergen Notice -->
    <div class="allergen-notice">
      <span style="font-size: 1.3rem; flex-shrink: 0;">⚠️</span>
      <p>
        <strong>Allergen Notice:</strong>
        We cannot guarantee that any of our products are free from allergens as we use
        shared equipment to store, prepare, and serve them.
      </p>
    </div>

  </div><!-- /container -->
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
<?php
/**
 * JUAN CAFÉ - Product Details Page
 * File: app/views/products/product-details.php
 *
 * Shows details of a single product.
 * Placeholder data — connect to DB when backend is ready.
 * URL parameter: ?id=<product_id>
 */
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';

/**
 * Placeholder product lookup.
 * In a real app, this would be a DB query by $_GET['id'].
 */
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Sample product data (replace with DB fetch later)
$product = [
  'id'          => $productId,
  'name'        => 'Classic Milk Tea',
  'category'    => 'Milk Tea',
  'price'       => 75,
  'desc'        => 'Our signature creamy milk tea made with premium tea leaves and fresh milk, topped with chewy tapioca pearls. A timeless classic that never disappoints.',
  'ingredients' => ['Premium tea leaves', 'Fresh milk', 'Tapioca pearls', 'Brown sugar syrup'],
  'sizes'       => [
    ['label' => 'Regular (16oz)', 'price' => 75],
    ['label' => 'Large (22oz)',   'price' => 95],
  ],
  'toppings'    => [
    ['label' => 'Tapioca Pearls', 'price' => 10],
    ['label' => 'Nata de Coco',   'price' => 10],
    ['label' => 'Pudding',        'price' => 15],
    ['label' => 'Grass Jelly',    'price' => 10],
  ],
  'related'     => [
    ['id' => 2, 'name' => 'Brown Sugar Milk Tea', 'price' => 85, 'category' => 'Milk Tea'],
    ['id' => 3, 'name' => 'Taro Milk Tea',        'price' => 80, 'category' => 'Milk Tea'],
    ['id' => 4, 'name' => 'Brown Sugar Coffee',   'price' => 95, 'category' => 'Coffee'],
  ],
];
?>

<!-- ================================================
     BREADCRUMB
     ================================================ -->
<div style="padding-top: calc(var(--navbar-height) + var(--space-6)); padding-bottom: var(--space-4); background: var(--bg-secondary);">
  <div class="container">
    <nav style="font-size: var(--text-sm); color: var(--text-muted);">
      <a href="/app/views/home/index.php" style="color: var(--color-coffee);">Home</a>
      <span style="margin: 0 var(--space-2);">/</span>
      <a href="/app/views/products/products.php" style="color: var(--color-coffee);">Menu</a>
      <span style="margin: 0 var(--space-2);">/</span>
      <span><?= htmlspecialchars($product['name']) ?></span>
    </nav>
  </div>
</div>

<!-- ================================================
     PRODUCT DETAIL GRID
     ================================================ -->
<section class="section-padding" style="padding-top: var(--space-10);">
  <div class="container">
    <div class="product-detail-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-12); align-items: start;">

      <!-- Left: Product Images -->
      <div>
        <!-- Main Image Placeholder -->
        <div class="img-placeholder" style="height: 380px; border-radius: var(--border-radius-lg); margin-bottom: var(--space-4);">
          <span>Product Image</span>
        </div>

        <!-- Thumbnail Row (placeholders) -->
        <div style="display: flex; gap: var(--space-3);">
          <?php for ($i = 0; $i < 4; $i++): ?>
            <div class="img-placeholder" style="flex: 1; height: 80px; border-radius: var(--border-radius-md); cursor: pointer; border: 2px solid <?= $i === 0 ? 'var(--color-coffee)' : 'transparent' ?>;">
            </div>
          <?php endfor; ?>
        </div>
      </div>

      <!-- Right: Product Info -->
      <div>
        <!-- Category Badge -->
        <span class="product-category-badge" style="margin-bottom: var(--space-3); display: inline-block;">
          <?= htmlspecialchars($product['category']) ?>
        </span>

        <!-- Product Name -->
        <h1 style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--color-espresso); margin-bottom: var(--space-3); line-height: 1.2;">
          <?= htmlspecialchars($product['name']) ?>
        </h1>

        <!-- Price -->
        <div style="font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--color-coffee); font-weight: 700; margin-bottom: var(--space-5);">
          ₱<?= $product['price'] ?>
        </div>

        <!-- Description -->
        <p style="color: var(--text-secondary); line-height: 1.8; margin-bottom: var(--space-6);">
          <?= htmlspecialchars($product['desc']) ?>
        </p>

        <!-- Size Selector -->
        <div style="margin-bottom: var(--space-6);">
          <label style="display: block; font-weight: var(--font-weight-semibold); color: var(--color-espresso); margin-bottom: var(--space-3); font-size: var(--text-sm);">
            Choose Size
          </label>
          <div style="display: flex; gap: var(--space-3);">
            <?php foreach ($product['sizes'] as $i => $size): ?>
              <label style="flex: 1; cursor: pointer;">
                <input type="radio" name="size" value="<?= $i ?>" <?= $i === 0 ? 'checked' : '' ?> style="display: none;" />
                <div class="size-option" style="
                  padding: var(--space-3) var(--space-4);
                  border: 2px solid <?= $i === 0 ? 'var(--color-coffee)' : 'var(--border-light)' ?>;
                  border-radius: var(--border-radius-md);
                  text-align: center;
                  transition: var(--transition-fast);
                  background: <?= $i === 0 ? 'rgba(111,78,55,0.06)' : 'white' ?>;
                ">
                  <div style="font-weight: var(--font-weight-semibold); font-size: var(--text-sm); color: var(--color-espresso);">
                    <?= htmlspecialchars($size['label']) ?>
                  </div>
                  <div style="font-size: var(--text-xs); color: var(--text-muted);">₱<?= $size['price'] ?></div>
                </div>
              </label>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Toppings -->
        <div style="margin-bottom: var(--space-6);">
          <label style="display: block; font-weight: var(--font-weight-semibold); color: var(--color-espresso); margin-bottom: var(--space-3); font-size: var(--text-sm);">
            Add Toppings <span style="color: var(--text-muted); font-weight: normal;">(optional)</span>
          </label>
          <div style="display: flex; flex-wrap: wrap; gap: var(--space-2);">
            <?php foreach ($product['toppings'] as $topping): ?>
              <label style="cursor: pointer;">
                <input type="checkbox" name="topping[]" value="<?= htmlspecialchars($topping['label']) ?>" style="display: none;" />
                <span class="topping-chip" style="
                  display: inline-flex;
                  align-items: center;
                  gap: 4px;
                  padding: var(--space-2) var(--space-3);
                  border: 1.5px solid var(--border-medium);
                  border-radius: var(--border-radius-full);
                  font-size: var(--text-xs);
                  color: var(--text-secondary);
                  transition: var(--transition-fast);
                  background: white;
                ">
                  <?= htmlspecialchars($topping['label']) ?> <span style="color: var(--text-muted);">+₱<?= $topping['price'] ?></span>
                </span>
              </label>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Quantity + Add to Cart -->
        <div style="display: flex; gap: var(--space-4); align-items: center; margin-bottom: var(--space-6);">
          <!-- Qty Control -->
          <div class="qty-control" style="display: flex; align-items: center; border: 1.5px solid var(--border-medium); border-radius: var(--border-radius-full); overflow: hidden;">
            <button class="qty-btn" onclick="this.nextElementSibling.textContent = Math.max(1, parseInt(this.nextElementSibling.textContent)-1)" style="width: 38px; height: 38px; background: var(--bg-secondary); font-size: 1.1rem; font-weight: bold; border: none; cursor: pointer; color: var(--color-coffee);">−</button>
            <span class="qty-display" style="min-width: 36px; text-align: center; font-weight: var(--font-weight-semibold); font-size: var(--text-sm);">1</span>
            <button class="qty-btn" onclick="this.previousElementSibling.textContent = parseInt(this.previousElementSibling.textContent)+1" style="width: 38px; height: 38px; background: var(--bg-secondary); font-size: 1.1rem; font-weight: bold; border: none; cursor: pointer; color: var(--color-coffee);">+</button>
          </div>

          <!-- Add to Cart Button -->
          <button
            class="btn btn-primary btn-lg add-to-cart-btn"
            style="flex: 1;"
            onclick="addToCart(<?= $product['id'] ?>, '<?= addslashes($product['name']) ?>', '<?= addslashes($product['category']) ?>', <?= $product['price'] ?>)"
          >
            <i class="fas fa-shopping-bag"></i> Add to Cart
          </button>
        </div>

        <!-- Ingredients List -->
        <div style="background: var(--bg-secondary); border-radius: var(--border-radius-md); padding: var(--space-4) var(--space-5);">
          <strong style="color: var(--color-espresso); font-size: var(--text-sm); display: block; margin-bottom: var(--space-3);">
            <i class="fas fa-list-ul" style="color: var(--color-coffee); margin-right: 6px;"></i>
            Ingredients
          </strong>
          <div style="display: flex; flex-wrap: wrap; gap: var(--space-2);">
            <?php foreach ($product['ingredients'] as $ing): ?>
              <span style="background: white; border: 1px solid var(--border-light); border-radius: var(--border-radius-full); padding: var(--space-1) var(--space-3); font-size: var(--text-xs); color: var(--text-secondary);">
                <?= htmlspecialchars($ing) ?>
              </span>
            <?php endforeach; ?>
          </div>
        </div>

      </div><!-- /right column -->
    </div><!-- /product-detail-grid -->

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

<!-- ================================================
     RELATED PRODUCTS
     ================================================ -->
<section class="section-padding" style="background: var(--bg-secondary); padding-top: var(--space-10);">
  <div class="container">
    <h2 style="font-family: var(--font-heading); font-size: var(--text-2xl); color: var(--color-espresso); margin-bottom: var(--space-8);">
      You May Also Like
    </h2>
    <div class="products-grid">
      <?php foreach ($product['related'] as $rel): ?>
        <div class="product-card" data-category="<?= htmlspecialchars(strtolower(str_replace(' ', '-', $rel['category']))) ?>" data-product-id="<?= $rel['id'] ?>">
          <div class="product-img img-placeholder" style="height: 160px;"><span>Product Image</span></div>
          <div class="product-info">
            <span class="product-category-badge"><?= htmlspecialchars($rel['category']) ?></span>
            <h3 class="product-name"><?= htmlspecialchars($rel['name']) ?></h3>
            <div class="product-footer">
              <span class="product-price">₱<?= $rel['price'] ?></span>
              <a href="/app/views/products/product-details.php?id=<?= $rel['id'] ?>" class="btn btn-primary btn-sm">
                View
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
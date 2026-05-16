<?php
/**
 * JUAN CAFÉ - Cart Controller
 * File: app/controllers/cartController.php
 *
 * Manages server-side cart operations.
 * Most cart interactions happen via AJAX (public/ajax/add-to-cart.php, etc.)
 * but this controller holds the shared logic.
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../models/cart.php';
require_once __DIR__ . '/../models/product.php';

class CartController
{
    private Cart    $cartModel;
    private Product $productModel;

    public function __construct()
    {
        $this->cartModel    = new Cart();
        $this->productModel = new Product();
    }

    // ── Add to Cart ────────────────────────────────────────────────────────────

    /**
     * Add a product to the cart (AJAX-safe).
     * Expected POST: product_id, quantity (optional, default 1)
     */
    public function add(): void
    {
        startSession();
        if (!isLoggedIn()) {
            jsonResponse(['success' => false, 'message' => 'Please log in to add items to your cart.'], 401);
        }

        $productId = (int) ($_POST['product_id'] ?? 0);
        $quantity  = max(1, (int) ($_POST['quantity'] ?? 1));

        $product = $this->productModel->findById($productId);
        if (!$product || !$product['is_available']) {
            jsonResponse(['success' => false, 'message' => 'Product not available.'], 404);
        }

        if ($product['stock'] < $quantity) {
            jsonResponse(['success' => false, 'message' => 'Not enough stock available.'], 400);
        }

        $this->cartModel->addItem(currentUserId(), $productId, $quantity);

        $cartCount = $this->cartModel->countItems(currentUserId());
        jsonResponse([
            'success'    => true,
            'message'    => e($product['name']) . ' added to cart!',
            'cart_count' => $cartCount,
        ]);
    }

    // ── Update Quantity ────────────────────────────────────────────────────────

    /**
     * Update quantity of a cart item.
     * Expected POST: product_id, quantity
     */
    public function update(): void
    {
        startSession();
        if (!isLoggedIn()) {
            jsonResponse(['success' => false, 'message' => 'Not authenticated.'], 401);
        }

        $productId = (int) ($_POST['product_id'] ?? 0);
        $quantity  = max(0, (int) ($_POST['quantity'] ?? 0));

        $this->cartModel->updateQuantity(currentUserId(), $productId, $quantity);

        $subtotal = $this->cartModel->getSubtotal(currentUserId());
        $count    = $this->cartModel->countItems(currentUserId());

        jsonResponse([
            'success'  => true,
            'subtotal' => formatPrice($subtotal),
            'cart_count' => $count,
        ]);
    }

    // ── Remove Item ────────────────────────────────────────────────────────────

    /**
     * Remove one product from the cart.
     * Expected POST: product_id
     */
    public function remove(): void
    {
        startSession();
        if (!isLoggedIn()) {
            jsonResponse(['success' => false, 'message' => 'Not authenticated.'], 401);
        }

        $productId = (int) ($_POST['product_id'] ?? 0);
        $this->cartModel->removeItem(currentUserId(), $productId);

        $count = $this->cartModel->countItems(currentUserId());
        jsonResponse(['success' => true, 'cart_count' => $count]);
    }

    // ── Get Cart Data ──────────────────────────────────────────────────────────

    /**
     * Return the full cart as JSON (for cart page re-rendering or sync).
     */
    public function getCart(): void
    {
        startSession();
        if (!isLoggedIn()) {
            jsonResponse(['success' => false, 'items' => [], 'subtotal' => '₱0.00']);
        }

        $items    = $this->cartModel->getByUser(currentUserId());
        $subtotal = $this->cartModel->getSubtotal(currentUserId());

        jsonResponse([
            'success'  => true,
            'items'    => $items,
            'subtotal' => formatPrice($subtotal),
            'count'    => $this->cartModel->countItems(currentUserId()),
        ]);
    }

    // ── Clear Cart ─────────────────────────────────────────────────────────────

    public function clear(): void
    {
        startSession();
        if (!isLoggedIn()) {
            jsonResponse(['success' => false, 'message' => 'Not authenticated.'], 401);
        }
        $this->cartModel->clearCart(currentUserId());
        jsonResponse(['success' => true, 'message' => 'Cart cleared.']);
    }
}
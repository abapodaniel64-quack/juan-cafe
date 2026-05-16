<?php
/**
 * JUAN CAFÉ - Cart Service
 * File: app/services/cartService.php
 *
 * Business logic layer between CartController and Cart model.
 * Handles pricing rules, validation, and sync between JS cart and DB cart.
 */

require_once __DIR__ . '/../models/cart.php';
require_once __DIR__ . '/../models/product.php';
require_once __DIR__ . '/../helpers/functions.php';

class CartService
{
    private Cart    $cartModel;
    private Product $productModel;

    // Delivery fee thresholds (₱)
    private const FREE_DELIVERY_THRESHOLD = 300.00;
    private const DELIVERY_FEE            = 50.00;

    public function __construct()
    {
        $this->cartModel    = new Cart();
        $this->productModel = new Product();
    }

    /**
     * Get a formatted cart summary for a user.
     *
     * @return array{items, subtotal, delivery_fee, discount, total, count, formatted}
     */
    public function getSummary(int $userId): array
    {
        $items    = $this->cartModel->getByUser($userId);
        $subtotal = (float) array_sum(array_map(
            fn($i) => $i['price'] * $i['quantity'],
            $items
        ));

        $deliveryFee = $subtotal >= self::FREE_DELIVERY_THRESHOLD ? 0.00 : self::DELIVERY_FEE;
        $discount    = 0.00;   // extend here for promo code logic
        $total       = $subtotal + $deliveryFee - $discount;
        $count       = (int) array_sum(array_column($items, 'quantity'));

        return [
            'items'        => $items,
            'subtotal'     => $subtotal,
            'delivery_fee' => $deliveryFee,
            'discount'     => $discount,
            'total'        => $total,
            'count'        => $count,
            'formatted'    => [
                'subtotal'     => formatPrice($subtotal),
                'delivery_fee' => $deliveryFee > 0 ? formatPrice($deliveryFee) : 'FREE',
                'discount'     => '−' . formatPrice($discount),
                'total'        => formatPrice($total),
            ],
        ];
    }

    /**
     * Sync a JS cart array into the database cart.
     * Called during checkout when items come from the JS-only cart.
     *
     * @param int   $userId
     * @param array $jsItems  [['id'=>productId, 'qty'=>n], ...]
     */
    public function syncFromJs(int $userId, array $jsItems): void
    {
        // Clear existing DB cart, then re-populate
        $this->cartModel->clearCart($userId);

        foreach ($jsItems as $item) {
            $productId = (int) ($item['id'] ?? 0);
            $quantity  = max(1, (int) ($item['qty'] ?? $item['quantity'] ?? 1));

            $product = $this->productModel->findById($productId);
            if ($product && $product['is_available']) {
                $this->cartModel->addItem($userId, $productId, $quantity);
            }
        }
    }

    /**
     * Validate that all items in the DB cart are still in stock.
     * Returns an array of issues (empty = all good).
     */
    public function validateStock(int $userId): array
    {
        $issues = [];
        $items  = $this->cartModel->getByUser($userId);

        foreach ($items as $item) {
            $product = $this->productModel->findById((int) $item['product_id']);
            if (!$product) {
                $issues[] = $item['name'] . ' is no longer available.';
            } elseif ($product['stock'] < $item['quantity']) {
                $issues[] = $item['name'] . ' only has ' . $product['stock'] . ' left in stock.';
            }
        }

        return $issues;
    }
}
<?php
/**
 * JUAN CAFÉ - Cart Model
 * File: app/models/cart.php
 *
 * Server-side cart stored in the `cart` table.
 * Complements the JS-based cart (cart.js) with persistence.
 */

require_once __DIR__ . '/../config/database.php';

class Cart
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // ── Read ───────────────────────────────────────────────────────────────────

    /** Get all cart items for a user with product details. */
    public function getByUser(int $userId): array
    {
        $stmt = $this->db->prepare(
            'SELECT c.id, c.quantity, c.added_at,
                    p.id AS product_id, p.name, p.price, p.image,
                    cat.name AS category_name,
                    (p.price * c.quantity) AS item_total
             FROM cart c
             JOIN products p   ON c.product_id = p.id
             JOIN categories cat ON p.category_id = cat.id
             WHERE c.user_id = ?
             ORDER BY c.added_at DESC'
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    /** Count total items in a user's cart. */
    public function countItems(int $userId): int
    {
        $stmt = $this->db->prepare(
            'SELECT COALESCE(SUM(quantity), 0) FROM cart WHERE user_id = ?'
        );
        $stmt->execute([$userId]);
        return (int) $stmt->fetchColumn();
    }

    /** Calculate cart subtotal for a user. */
    public function getSubtotal(int $userId): float
    {
        $stmt = $this->db->prepare(
            'SELECT COALESCE(SUM(p.price * c.quantity), 0)
             FROM cart c
             JOIN products p ON c.product_id = p.id
             WHERE c.user_id = ?'
        );
        $stmt->execute([$userId]);
        return (float) $stmt->fetchColumn();
    }

    // ── Write ──────────────────────────────────────────────────────────────────

    /**
     * Add a product to the cart. If it already exists, increment quantity.
     */
    public function addItem(int $userId, int $productId, int $quantity = 1): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO cart (user_id, product_id, quantity)
             VALUES (:uid, :pid, :qty)
             ON DUPLICATE KEY UPDATE quantity = quantity + :qty2'
        );
        return $stmt->execute([
            ':uid'  => $userId,
            ':pid'  => $productId,
            ':qty'  => $quantity,
            ':qty2' => $quantity,
        ]);
    }

    /**
     * Set an exact quantity for a cart item.
     */
    public function updateQuantity(int $userId, int $productId, int $quantity): bool
    {
        if ($quantity <= 0) {
            return $this->removeItem($userId, $productId);
        }
        $stmt = $this->db->prepare(
            'UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?'
        );
        return $stmt->execute([$quantity, $userId, $productId]);
    }

    /** Remove a single product from the cart. */
    public function removeItem(int $userId, int $productId): bool
    {
        $stmt = $this->db->prepare('DELETE FROM cart WHERE user_id = ? AND product_id = ?');
        return $stmt->execute([$userId, $productId]);
    }

    /** Empty the entire cart for a user (called after successful checkout). */
    public function clearCart(int $userId): bool
    {
        $stmt = $this->db->prepare('DELETE FROM cart WHERE user_id = ?');
        return $stmt->execute([$userId]);
    }
}
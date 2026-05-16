<?php
/**
 * JUAN CAFÉ - Order Model
 * File: app/models/order.php
 *
 * Handles all database operations for `orders` and `order_items`.
 */

require_once __DIR__ . '/../config/database.php';

class Order
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // ── Create ─────────────────────────────────────────────────────────────────

    /**
     * Place a new order with its line items in a single transaction.
     *
     * @param int   $userId
     * @param array $items   [['product_id', 'product_name', 'price', 'quantity'], ...]
     * @param array $totals  ['subtotal', 'delivery_fee', 'discount', 'total']
     * @param string|null $notes
     * @return int  New order ID
     */
    public function create(int $userId, array $items, array $totals, ?string $notes = null): int
    {
        $this->db->beginTransaction();
        try {
            // Insert order header
            $stmt = $this->db->prepare(
                'INSERT INTO orders (user_id, order_number, status, subtotal, delivery_fee, discount, total, notes)
                 VALUES (:uid, :num, :status, :sub, :del, :disc, :total, :notes)'
            );
            $stmt->execute([
                ':uid'    => $userId,
                ':num'    => generateOrderNumber(),
                ':status' => 'pending',
                ':sub'    => $totals['subtotal'],
                ':del'    => $totals['delivery_fee'] ?? 0,
                ':disc'   => $totals['discount']     ?? 0,
                ':total'  => $totals['total'],
                ':notes'  => $notes,
            ]);
            $orderId = (int) $this->db->lastInsertId();

            // Insert line items
            $itemStmt = $this->db->prepare(
                'INSERT INTO order_items (order_id, product_id, product_name, price, quantity, subtotal)
                 VALUES (?, ?, ?, ?, ?, ?)'
            );
            foreach ($items as $item) {
                $itemSubtotal = $item['price'] * $item['quantity'];
                $itemStmt->execute([
                    $orderId,
                    $item['product_id'],
                    $item['product_name'],
                    $item['price'],
                    $item['quantity'],
                    $itemSubtotal,
                ]);
            }

            $this->db->commit();
            return $orderId;

        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    // ── Read ───────────────────────────────────────────────────────────────────

    /** Find an order by ID (with its items). */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT o.*, u.name AS user_name, u.email AS user_email
             FROM orders o
             JOIN users u ON o.user_id = u.id
             WHERE o.id = ? LIMIT 1'
        );
        $stmt->execute([$id]);
        $order = $stmt->fetch();
        if (!$order) return null;

        $order['items'] = $this->getItems($id);
        return $order;
    }

    /** Get all orders for a specific user (order history). */
    public function getByUser(int $userId, int $page = 1, int $perPage = ITEMS_PER_PAGE): array
    {
        $offset = paginationOffset($page, $perPage);
        $stmt   = $this->db->prepare(
            'SELECT * FROM orders WHERE user_id = ?
             ORDER BY created_at DESC
             LIMIT :limit OFFSET :offset'
        );
        $stmt->bindValue(1, $userId, PDO::PARAM_INT);
        $stmt->bindValue(':limit',  $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset,  PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /** Get all orders for admin panel with optional status filter. */
    public function getAll(?string $status = null, int $page = 1, int $perPage = ITEMS_PER_PAGE): array
    {
        $offset = paginationOffset($page, $perPage);

        $where  = $status ? 'WHERE o.status = :status' : '';
        $stmt   = $this->db->prepare(
            "SELECT o.*, u.name AS user_name
             FROM orders o
             JOIN users u ON o.user_id = u.id
             {$where}
             ORDER BY o.created_at DESC
             LIMIT :limit OFFSET :offset"
        );
        if ($status) $stmt->bindValue(':status', $status);
        $stmt->bindValue(':limit',  $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset,  PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /** Get line items for an order. */
    public function getItems(int $orderId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM order_items WHERE order_id = ?');
        $stmt->execute([$orderId]);
        return $stmt->fetchAll();
    }

    /** Count all orders (for pagination). */
    public function countAll(?string $status = null): int
    {
        if ($status) {
            $stmt = $this->db->prepare('SELECT COUNT(*) FROM orders WHERE status = ?');
            $stmt->execute([$status]);
        } else {
            $stmt = $this->db->query('SELECT COUNT(*) FROM orders');
        }
        return (int) $stmt->fetchColumn();
    }

    // ── Update ─────────────────────────────────────────────────────────────────

    /** Update the status of an order. */
    public function updateStatus(int $orderId, string $status): bool
    {
        $allowed = ['pending', 'confirmed', 'preparing', 'ready', 'completed', 'cancelled'];
        if (!in_array($status, $allowed, true)) return false;

        $stmt = $this->db->prepare('UPDATE orders SET status = ? WHERE id = ?');
        return $stmt->execute([$status, $orderId]);
    }

    // ── Stats ──────────────────────────────────────────────────────────────────

    /** Recent orders for admin dashboard (last N). */
    public function getRecent(int $limit = 10): array
    {
        $stmt = $this->db->prepare(
            'SELECT o.*, u.name AS user_name
             FROM orders o
             JOIN users u ON o.user_id = u.id
             ORDER BY o.created_at DESC
             LIMIT ?'
        );
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }

    /** Revenue summary: today, this week, this month, all time. */
    public function getRevenueSummary(): array
    {
        $pdo = $this->db;
        $base = "SELECT COALESCE(SUM(total), 0) FROM orders WHERE status = 'completed'";
        return [
            'today'     => (float) $pdo->query($base . " AND DATE(created_at) = CURDATE()")->fetchColumn(),
            'this_week' => (float) $pdo->query($base . " AND YEARWEEK(created_at,1) = YEARWEEK(NOW(),1)")->fetchColumn(),
            'this_month'=> (float) $pdo->query($base . " AND MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW())")->fetchColumn(),
            'all_time'  => (float) $pdo->query($base)->fetchColumn(),
        ];
    }
}
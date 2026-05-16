<?php
/**
 * JUAN CAFÉ - Order Service
 * File: app/services/orderService.php
 *
 * Business logic for order processing, status transitions, and reporting.
 */

require_once __DIR__ . '/../models/order.php';
require_once __DIR__ . '/../models/product.php';
require_once __DIR__ . '/../helpers/notification.php';
require_once __DIR__ . '/../helpers/functions.php';

class OrderService
{
    private Order   $orderModel;
    private Product $productModel;

    /** Valid status flow: each status maps to allowed next statuses. */
    private const STATUS_FLOW = [
        'pending'   => ['confirmed', 'cancelled'],
        'confirmed' => ['preparing', 'cancelled'],
        'preparing' => ['ready'],
        'ready'     => ['completed'],
        'completed' => [],
        'cancelled' => [],
    ];

    public function __construct()
    {
        $this->orderModel   = new Order();
        $this->productModel = new Product();
    }

    /**
     * Validate and apply a status transition.
     *
     * @return array{success: bool, message: string}
     */
    public function transition(int $orderId, string $newStatus): array
    {
        $order = $this->orderModel->findById($orderId);
        if (!$order) {
            return ['success' => false, 'message' => 'Order not found.'];
        }

        $current = $order['status'];
        $allowed = self::STATUS_FLOW[$current] ?? [];

        if (!in_array($newStatus, $allowed, true)) {
            return [
                'success' => false,
                'message' => "Cannot move order from '{$current}' to '{$newStatus}'.",
            ];
        }

        $this->orderModel->updateStatus($orderId, $newStatus);

        // Notify the user
        $labels = [
            'confirmed' => 'confirmed ✅',
            'preparing' => 'being prepared 🍵',
            'ready'     => 'ready for pick-up 🎉',
            'completed' => 'completed ☕',
            'cancelled' => 'cancelled ❌',
        ];
        NotificationHelper::send(
            (int) $order['user_id'],
            'order',
            'Order Update: ' . $order['order_number'],
            'Your order ' . $order['order_number'] . ' is now ' . ($labels[$newStatus] ?? $newStatus) . '.'
        );

        return ['success' => true, 'message' => 'Status updated to ' . $newStatus . '.'];
    }

    /**
     * Build a monthly revenue report for the current year.
     *
     * @return array  [['month'=>'January', 'revenue'=>1234.56], ...]
     */
    public function monthlyRevenue(): array
    {
        $pdo  = \Database::getInstance();
        $stmt = $pdo->prepare(
            "SELECT MONTH(created_at) AS m, SUM(total) AS revenue
             FROM orders
             WHERE status = 'completed' AND YEAR(created_at) = YEAR(NOW())
             GROUP BY m
             ORDER BY m ASC"
        );
        $stmt->execute();
        $rows = $stmt->fetchAll();

        // Map month numbers to names
        $months = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                       'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $report = [];
        foreach ($rows as $row) {
            $report[] = [
                'month'   => $months[(int) $row['m']],
                'revenue' => (float) $row['revenue'],
            ];
        }
        return $report;
    }
}
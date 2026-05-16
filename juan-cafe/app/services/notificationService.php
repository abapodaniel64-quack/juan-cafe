<?php
/**
 * JUAN CAFÉ - Notification Service
 * File: app/services/notificationService.php
 *
 * Higher-level notification logic (broadcast to multiple users, system alerts, etc.)
 * Individual send() calls go through NotificationHelper for convenience.
 */

require_once __DIR__ . '/../models/notification.php';
require_once __DIR__ . '/../helpers/notification.php';
require_once __DIR__ . '/../config/database.php';

class NotificationService
{
    private Notification $notifModel;

    public function __construct()
    {
        $this->notifModel = new Notification();
    }

    /**
     * Broadcast a notification to all active users.
     * Useful for system announcements or promotions.
     *
     * @param string $type    info | success | warning | order
     * @param string $title
     * @param string $message
     */
    public function broadcast(string $type, string $title, string $message): void
    {
        $pdo   = Database::getInstance();
        $users = $pdo->query('SELECT id FROM users WHERE is_active = 1')->fetchAll();

        foreach ($users as $user) {
            $this->notifModel->create((int) $user['id'], $type, $title, $message);
        }
    }

    /**
     * Send an order-status notification to a specific user.
     */
    public function orderUpdate(int $userId, string $orderNumber, string $status): void
    {
        $labels = [
            'confirmed' => 'confirmed ✅',
            'preparing' => 'being prepared 🍵',
            'ready'     => 'ready for pick-up! 🎉',
            'completed' => 'completed ☕',
            'cancelled' => 'cancelled ❌',
        ];
        $label = $labels[$status] ?? $status;

        $this->notifModel->create(
            $userId,
            'order',
            'Order Update: ' . $orderNumber,
            'Your order ' . $orderNumber . ' is now ' . $label . '.'
        );
    }

    /**
     * Send a low-stock alert to all admin users.
     * Called from a cron job or after each order.
     */
    public function alertLowStock(string $productName, int $remainingStock): void
    {
        $pdo    = Database::getInstance();
        $admins = $pdo->query('SELECT id FROM admins WHERE is_active = 1')->fetchAll();

        // Admins use a separate table; notifications table is keyed by users.id
        // Adjust if you add admin notifications support later.
        // For now, log to the error log.
        error_log("[LowStock] {$productName} has only {$remainingStock} unit(s) left.");
    }

    /**
     * Get unread count for the navbar badge.
     */
    public function unreadCount(int $userId): int
    {
        return $this->notifModel->countUnread($userId);
    }
}
<?php
/**
 * JUAN CAFÉ - Notification Helper
 * File: app/helpers/notification.php
 *
 * Thin wrapper to insert notifications into the database.
 * The NotificationService (app/services/notificationService.php) contains
 * the heavier logic; this helper is for quick inline calls anywhere.
 *
 * Usage:
 *   NotificationHelper::send($userId, 'order', 'Order Confirmed', 'Your order JC-00124 is confirmed.');
 */

require_once __DIR__ . '/../config/database.php';

class NotificationHelper
{
    /**
     * Insert a notification row for a user.
     *
     * @param int    $userId  Target user ID
     * @param string $type    info | success | warning | order
     * @param string $title   Short heading
     * @param string $message Full body text
     */
    public static function send(int $userId, string $type, string $title, string $message): bool
    {
        try {
            $pdo  = Database::getInstance();
            $stmt = $pdo->prepare(
                'INSERT INTO notifications (user_id, type, title, message) VALUES (?, ?, ?, ?)'
            );
            return $stmt->execute([$userId, $type, $title, $message]);
        } catch (PDOException $e) {
            // Non-fatal — log but don't crash the request
            error_log('[NotificationHelper] ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Count unread notifications for a user.
     */
    public static function unreadCount(int $userId): int
    {
        try {
            $pdo  = Database::getInstance();
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0');
            $stmt->execute([$userId]);
            return (int) $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log('[NotificationHelper] ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Mark all notifications as read for a user.
     */
    public static function markAllRead(int $userId): void
    {
        try {
            $pdo  = Database::getInstance();
            $stmt = $pdo->prepare('UPDATE notifications SET is_read = 1 WHERE user_id = ?');
            $stmt->execute([$userId]);
        } catch (PDOException $e) {
            error_log('[NotificationHelper] ' . $e->getMessage());
        }
    }
}
<?php
/**
 * JUAN CAFÉ - Notification Model
 * File: app/models/notification.php
 *
 * CRUD for the `notifications` table.
 */

require_once __DIR__ . '/../config/database.php';

class Notification
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /** Get notifications for a user (latest first). */
    public function getByUser(int $userId, int $limit = 20): array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM notifications WHERE user_id = ?
             ORDER BY created_at DESC LIMIT ?'
        );
        $stmt->execute([$userId, $limit]);
        return $stmt->fetchAll();
    }

    /** Get only unread notifications. */
    public function getUnread(int $userId): array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM notifications WHERE user_id = ? AND is_read = 0
             ORDER BY created_at DESC'
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    /** Count unread notifications. */
    public function countUnread(int $userId): int
    {
        $stmt = $this->db->prepare(
            'SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0'
        );
        $stmt->execute([$userId]);
        return (int) $stmt->fetchColumn();
    }

    /** Create a new notification. */
    public function create(int $userId, string $type, string $title, string $message): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO notifications (user_id, type, title, message)
             VALUES (?, ?, ?, ?)'
        );
        return $stmt->execute([$userId, $type, $title, $message]);
    }

    /** Mark a single notification as read. */
    public function markRead(int $notifId, int $userId): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE notifications SET is_read = 1 WHERE id = ? AND user_id = ?'
        );
        return $stmt->execute([$notifId, $userId]);
    }

    /** Mark all notifications as read for a user. */
    public function markAllRead(int $userId): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE notifications SET is_read = 1 WHERE user_id = ?'
        );
        return $stmt->execute([$userId]);
    }

    /** Delete a notification. */
    public function delete(int $notifId, int $userId): bool
    {
        $stmt = $this->db->prepare(
            'DELETE FROM notifications WHERE id = ? AND user_id = ?'
        );
        return $stmt->execute([$notifId, $userId]);
    }
}
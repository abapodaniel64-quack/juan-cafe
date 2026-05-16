<?php
/**
 * JUAN CAFÉ - Notification Controller
 * File: app/controllers/notificationController.php
 *
 * Handles fetching, marking-read, and deleting notifications (via AJAX).
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../models/notification.php';

class NotificationController
{
    private Notification $notifModel;

    public function __construct()
    {
        $this->notifModel = new Notification();
    }

    /** GET: return notifications as JSON (AJAX). */
    public function index(): void
    {
        startSession();
        if (!isLoggedIn()) {
            jsonResponse(['success' => false, 'notifications' => []], 401);
        }

        $userId        = currentUserId();
        $notifications = $this->notifModel->getByUser($userId, 20);
        $unreadCount   = $this->notifModel->countUnread($userId);

        jsonResponse([
            'success'       => true,
            'notifications' => $notifications,
            'unread_count'  => $unreadCount,
        ]);
    }

    /** POST: mark all notifications as read. */
    public function markAllRead(): void
    {
        startSession();
        if (!isLoggedIn()) {
            jsonResponse(['success' => false], 401);
        }
        $this->notifModel->markAllRead(currentUserId());
        jsonResponse(['success' => true]);
    }

    /** POST: mark a single notification as read. */
    public function markRead(): void
    {
        startSession();
        if (!isLoggedIn()) {
            jsonResponse(['success' => false], 401);
        }
        $notifId = (int) ($_POST['id'] ?? 0);
        $this->notifModel->markRead($notifId, currentUserId());
        jsonResponse(['success' => true]);
    }

    /** POST: delete a notification. */
    public function delete(): void
    {
        startSession();
        if (!isLoggedIn()) {
            jsonResponse(['success' => false], 401);
        }
        $notifId = (int) ($_POST['id'] ?? 0);
        $this->notifModel->delete($notifId, currentUserId());
        jsonResponse(['success' => true]);
    }
}
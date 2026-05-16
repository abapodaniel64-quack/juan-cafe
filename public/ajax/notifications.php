<?php
/**
 * JUAN CAFÉ - AJAX: Notifications
 * File: public/ajax/notifications.php
 *
 * Handles fetching, marking-read, and deleting notifications.
 * Used by notifications.js.
 *
 * GET  ?action=list     → index()
 * POST ?action=readAll  → markAllRead()
 * POST ?action=read     → markRead()   (POST: id)
 * POST ?action=delete   → delete()     (POST: id)
 */

define('APP_ROOT', dirname(__DIR__, 2));
require_once APP_ROOT . '/app/config/config.php';
require_once APP_ROOT . '/app/helpers/functions.php';
require_once APP_ROOT . '/app/controllers/notificationController.php';

header('Content-Type: application/json');

$action     = $_GET['action'] ?? $_POST['action'] ?? 'list';
$controller = new NotificationController();

match ($action) {
    'list'    => $controller->index(),
    'readAll' => $controller->markAllRead(),
    'read'    => $controller->markRead(),
    'delete'  => $controller->delete(),
    default   => jsonResponse(['success' => false, 'message' => 'Unknown action.'], 400),
};
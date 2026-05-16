<?php
/**
 * JUAN CAFÉ - AJAX: Update Cart
 * File: public/ajax/update-cart.php
 *
 * POST params: product_id, quantity
 * Returns: JSON {success, subtotal, cart_count}
 */

define('APP_ROOT', dirname(__DIR__, 2));
require_once APP_ROOT . '/app/config/config.php';
require_once APP_ROOT . '/app/helpers/functions.php';
require_once APP_ROOT . '/app/controllers/cartController.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed.'], 405);
}

$controller = new CartController();

// Support both update-quantity and remove-item via this endpoint
$action = $_POST['action'] ?? 'update';

if ($action === 'remove') {
    $controller->remove();
} else {
    $controller->update();
}
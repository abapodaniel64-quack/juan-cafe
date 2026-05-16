<?php
/**
 * JUAN CAFÉ - AJAX: Remove from Cart
 * File: public/ajax/remove-from-cart.php
 *
 * Dedicated endpoint for removing a single product from the cart.
 * Called by cart.js when the user clicks the remove/trash icon on a cart item.
 *
 * Complements public/ajax/update-cart.php (which also handles removes via
 * ?action=remove, but a dedicated file keeps JS fetch URLs clean).
 *
 * Method : POST
 * Params : product_id  (int, required)
 * Returns: JSON { success: bool, cart_count: int, message?: string }
 *
 * Auth   : User must be logged in (enforced by CartController::remove()).
 */

define('APP_ROOT', dirname(__DIR__, 2));
require_once APP_ROOT . '/app/config/config.php';
require_once APP_ROOT . '/app/helpers/functions.php';
require_once APP_ROOT . '/app/controllers/cartController.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed.'], 405);
}

$controller = new CartController();
$controller->remove();
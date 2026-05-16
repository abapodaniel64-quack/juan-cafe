<?php
/**
 * JUAN CAFÉ - AJAX: Add to Cart
 * File: public/ajax/add-to-cart.php
 *
 * Called by cart.js when a user clicks "Add to Cart".
 * Requires the user to be logged in.
 *
 * POST params: product_id, quantity (optional)
 * Returns: JSON
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
$controller->add();
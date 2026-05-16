<?php
/**
 * JUAN CAFÉ - AJAX: Checkout
 * File: public/ajax/checkout.php
 *
 * Called by cart.js → proceedToCheckout() when the user places an order.
 *
 * Accepts JSON body: { items: [{product_id, product_name, price, quantity}], notes }
 * OR standard POST body (form fallback).
 *
 * Returns: JSON {success, message, order_number, total}
 */

define('APP_ROOT', dirname(__DIR__, 2));
require_once APP_ROOT . '/app/config/config.php';
require_once APP_ROOT . '/app/helpers/functions.php';
require_once APP_ROOT . '/app/controllers/orderConttroller.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed.'], 405);
}

$controller = new OrderController();
$controller->checkout();
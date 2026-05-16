<?php
/**
 * JUAN CAFÉ - AJAX: Product Search
 * File: public/ajax/search-products.php
 *
 * Live search endpoint called by app.js as the user types in the search bar.
 *
 * GET  ?q=search+term  → returns matching products as JSON
 */

define('APP_ROOT', dirname(__DIR__, 2));
require_once APP_ROOT . '/app/config/config.php';
require_once APP_ROOT . '/app/helpers/functions.php';
require_once APP_ROOT . '/app/models/product.php';

header('Content-Type: application/json');

$query   = trim($_GET['q'] ?? '');
$results = [];

if (mb_strlen($query) >= 2) {
    $productModel = new Product();
    $products     = $productModel->search($query, 10);

    $results = array_map(fn($p) => [
        'id'            => $p['id'],
        'name'          => e($p['name']),
        'category_name' => e($p['category_name']),
        'price'         => formatPrice((float) $p['price']),
        'price_raw'     => (float) $p['price'],
        'image'         => $p['image'] ?: null,
        'slug'          => $p['slug'],
        'url'           => '/app/views/products/product-details.php?id=' . $p['id'],
    ], $products);
}

jsonResponse(['success' => true, 'results' => $results, 'count' => count($results)]);
<?php
/**
 * JUAN CAFÉ – 404 Not Found
 * File: app/views/errors/404.php
 *
 * Displayed when a product, page, or route cannot be found.
 * ProductController::show() calls:
 *   http_response_code(404); exit('<h2>Product not found.</h2>');
 * Replace that exit() call with:
 *   http_response_code(404); require __DIR__ . '/../errors/404.php'; exit;
 */

define('APP_ROOT', dirname(__DIR__, 3));
require_once APP_ROOT . '/app/config/config.php';
require_once APP_ROOT . '/app/helpers/functions.php';

startSession();
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 – Page Not Found | <?= e(APP_NAME) ?></title>
    <link rel="stylesheet" href="/public/assets/css/variables.css">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <style>
        /* ── Error page styles ── */
        .error-page {
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
        }
        .error-code {
            font-size: 8rem;
            font-weight: 900;
            line-height: 1;
            color: var(--color-primary, #7c3f00);
            opacity: 0.15;
            margin-bottom: -1.5rem;
        }
        .error-emoji {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        .error-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--color-text, #1a1a1a);
            margin-bottom: 0.5rem;
        }
        .error-message {
            color: var(--color-muted, #6b7280);
            font-size: 1rem;
            max-width: 400px;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .error-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }
        .btn-primary {
            background: var(--color-primary, #7c3f00);
            color: #fff;
            padding: 0.75rem 1.75rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: opacity 0.2s;
        }
        .btn-primary:hover { opacity: 0.85; }
        .btn-outline {
            border: 2px solid var(--color-primary, #7c3f00);
            color: var(--color-primary, #7c3f00);
            padding: 0.75rem 1.75rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
        }
        .btn-outline:hover {
            background: var(--color-primary, #7c3f00);
            color: #fff;
        }
    </style>
</head>
<body>
    <?php require_once APP_ROOT . '/app/views/layouts/navbar.php'; ?>

    <main class="error-page">
        <div class="error-code">404</div>
        <div class="error-emoji">☕</div>
        <h1 class="error-title">Oops! This page isn't on the menu.</h1>
        <p class="error-message">
            The page or product you're looking for doesn't exist or may have been moved.
            Head back and keep browsing — we have plenty of great drinks waiting!
        </p>
        <div class="error-actions">
            <a href="/app/views/home/index.php" class="btn-primary">Go Home</a>
            <a href="/app/views/products/products.php" class="btn-outline">Browse Menu</a>
        </div>
    </main>

    <?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
</body>
</html>
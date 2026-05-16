<?php
/**
 * JUAN CAFÉ – 403 Forbidden
 * File: app/views/errors/403.php
 *
 * Displayed when:
 *  - A CSRF token mismatch occurs (verifyCsrf() in helpers/functions.php)
 *  - A user tries to access an admin-only page without privileges
 *
 * To use instead of the bare exit() in verifyCsrf(), replace:
 *   exit('403 – Invalid or missing CSRF token.');
 * with:
 *   http_response_code(403); require __DIR__ . '/../views/errors/403.php'; exit;
 */

define('APP_ROOT', dirname(__DIR__, 3));
require_once APP_ROOT . '/app/config/config.php';
require_once APP_ROOT . '/app/helpers/functions.php';

startSession();
http_response_code(403);

// Determine if this was a CSRF failure or auth failure
$reason = $_GET['reason'] ?? 'access';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 – Forbidden | <?= e(APP_NAME) ?></title>
    <link rel="stylesheet" href="/public/assets/css/variables.css">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <style>
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
        .error-emoji { font-size: 4rem; margin-bottom: 1rem; }
        .error-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--color-text, #1a1a1a);
            margin-bottom: 0.5rem;
        }
        .error-message {
            color: var(--color-muted, #6b7280);
            font-size: 1rem;
            max-width: 420px;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .error-actions { display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center; }
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
    </style>
</head>
<body>
    <?php require_once APP_ROOT . '/app/views/layouts/navbar.php'; ?>

    <main class="error-page">
        <div class="error-code">403</div>
        <div class="error-emoji">🚫</div>

        <?php if ($reason === 'csrf'): ?>
            <h1 class="error-title">Security check failed.</h1>
            <p class="error-message">
                Your form submission could not be verified. This usually happens if you
                left the page open too long or submitted from an external source.
                Please go back and try again.
            </p>
        <?php else: ?>
            <h1 class="error-title">Access denied.</h1>
            <p class="error-message">
                You don't have permission to view this page.
                Please log in with the correct account or return to the homepage.
            </p>
        <?php endif; ?>

        <div class="error-actions">
            <a href="javascript:history.back()" class="btn-primary">Go Back</a>
        </div>
    </main>

    <?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
</body>
</html>
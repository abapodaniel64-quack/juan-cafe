<?php
/**
 * JUAN CAFÉ - Application Configuration
 * File: app/config/config.php
 *
 * Central config constants used across the app.
 * Loaded once via public/index.php or required at the top of controllers.
 */

// ── Environment ──────────────────────────────────────────────────────────────
define('APP_ENV',  'development');   // 'development' | 'production'
define('APP_NAME', 'Juan Café');
define('APP_URL',  'http://localhost');   // change in production
if (!defined('APP_ROOT')) {
    define('APP_ROOT', 'C:/xampp/htdocs/juan-cafe');
}

// ── Session ───────────────────────────────────────────────────────────────────
define('SESSION_NAME',     'juancafe_session');
define('SESSION_LIFETIME', 86400);   // 24 hours in seconds

// ── Security ──────────────────────────────────────────────────────────────────
define('BCRYPT_COST', 12);           // bcrypt work factor
define('CSRF_TOKEN_NAME', '_csrf');

// ── File Uploads ──────────────────────────────────────────────────────────────
define('UPLOAD_DIR',      APP_ROOT . '/public/assets/images/products/');
define('UPLOAD_URL',      '/public/assets/images/products/');
define('MAX_UPLOAD_SIZE', 2 * 1024 * 1024);  // 2 MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/webp']);

// ── Pagination ─────────────────────────────────────────────────────────────────
define('ITEMS_PER_PAGE', 12);

// ── Display errors (development only) ─────────────────────────────────────────
if (APP_ENV === 'development') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}
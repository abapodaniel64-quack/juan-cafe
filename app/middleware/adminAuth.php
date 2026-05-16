<?php
/**
 * JUAN CAFÉ - Admin Auth Middleware
 * File: app/middleware/adminAuth.php
 *
 * Ensures only authenticated admins can access the admin panel.
 *
 * Usage:
 *   require_once __DIR__ . '/../../app/middleware/adminAuth.php';
 *   AdminAuthMiddleware::protect();
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helpers/functions.php';

class AdminAuthMiddleware
{
    /**
     * Redirect to admin login if not authenticated as an admin.
     */
    public static function protect(): void
    {
        startSession();

        if (!isAdminLoggedIn()) {
            setFlash('error', 'Admin access required. Please log in.');
            redirect('/app/views/auth/login.php');
        }
    }
}

AdminAuthMiddleware::protect();
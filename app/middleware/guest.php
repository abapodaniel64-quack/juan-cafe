<?php
/**
 * JUAN CAFÉ - Guest Middleware
 * File: app/middleware/guest.php
 *
 * Redirects already-authenticated users away from login/signup pages.
 *
 * Usage:
 *   require_once __DIR__ . '/../../app/middleware/guest.php';
 *   GuestMiddleware::only();
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helpers/functions.php';

class GuestMiddleware
{
    /**
     * If a user is already logged in, send them to their dashboard.
     * If an admin is logged in, send them to the admin dashboard.
     */
    public static function only(): void
    {
        startSession();

        if (isAdminLoggedIn()) {
            redirect('/app/views/admin/dashboard.php');
        }

        if (isLoggedIn()) {
            redirect('/app/views/user/dashboard.php');
        }
    }
}

GuestMiddleware::only();
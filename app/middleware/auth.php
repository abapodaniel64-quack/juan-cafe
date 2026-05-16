<?php
/**
 * JUAN CAFÉ - User Auth Middleware
 * File: app/middleware/auth.php
 *
 * Ensures only authenticated users can access protected pages.
 * Require this at the very top of any user-only controller or view.
 *
 * Usage:
 *   require_once __DIR__ . '/../../app/middleware/auth.php';
 *   AuthMiddleware::protect();
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helpers/functions.php';

class AuthMiddleware
{
    /**
     * Redirect to login if the user is not authenticated.
     * Stores the intended URL in session so login can redirect back.
     */
    public static function protect(): void
    {
        startSession();

        if (!isLoggedIn()) {
            $_SESSION['intended_url'] = $_SERVER['REQUEST_URI'] ?? '/';
            setFlash('error', 'Please log in to access that page.');
            redirect('/app/views/auth/login.php');
        }
    }
}

// Auto-protect on require — call protect() so controllers only need one line.
// If you prefer manual control, remove the line below and call ::protect() explicitly.
AuthMiddleware::protect();
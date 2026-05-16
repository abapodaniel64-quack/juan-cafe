<?php
/**
 * JUAN CAFÉ - Auth Routes
 * File: routes/auth.php
 *
 * Authentication-related routes.
 *
 * POST /public/index.php?action=auth.login   → AuthController::loginAction()
 * POST /public/index.php?action=auth.signup  → AuthController::signupAction()
 * GET  /public/index.php?action=auth.logout  → AuthController::logoutAction()
 *
 * Views:
 *   GET  /app/views/auth/login.php   (protected by GuestMiddleware)
 *   GET  /app/views/auth/signup.php  (protected by GuestMiddleware)
 *
 * To protect a view with GuestMiddleware, add at the top of the view file:
 *   <?php require_once __DIR__ . '/../../app/middleware/guest.php'; ?>
 */

return [
    'auth.login'  => ['authController.php', 'AuthController', 'loginAction'],
    'auth.signup' => ['authController.php', 'AuthController', 'signupAction'],
    'auth.logout' => ['authController.php', 'AuthController', 'logoutAction'],
];
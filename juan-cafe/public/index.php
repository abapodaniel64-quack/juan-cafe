<?php
/**
 * JUAN CAFÉ - Front Controller
 * File: public/index.php
 *
 * Single entry point for the application when using a URL-based router.
 * For the current project (direct file includes), this acts as a
 * bootstrap loader and simple action dispatcher for AJAX/form POSTs.
 *
 * HOW IT WORKS:
 *  - Direct view includes (e.g. /app/views/home/index.php) continue to work
 *    unchanged via Apache/Nginx file access.
 *  - Form actions and AJAX calls POST to /public/index.php?action=auth.login
 *    so all controller logic stays out of the views.
 *
 * EXAMPLE FORM ACTION:
 *   <form method="POST" action="/public/index.php?action=auth.login">
 *
 * EXAMPLE FETCH:
 *   fetch('/public/index.php?action=cart.add', { method:'POST', body: formData })
 */

// ── Bootstrap ─────────────────────────────────────────────────────────────────
define('APP_ROOT', dirname(__DIR__));

require_once APP_ROOT . '/app/config/config.php';
require_once APP_ROOT . '/app/helpers/functions.php';

// ── Routing Map ────────────────────────────────────────────────────────────────
// Format: 'group.action' => [ControllerFile, ControllerClass, method]
$routes = [
    // Auth
    'auth.login'    => ['authController.php', 'AuthController', 'loginAction'],
    'auth.signup'   => ['authController.php', 'AuthController', 'signupAction'],
    'auth.logout'   => ['authController.php', 'AuthController', 'logoutAction'],

    // Cart (AJAX)
    'cart.add'      => ['cartController.php',  'CartController',  'add'],
    'cart.update'   => ['cartController.php',  'CartController',  'update'],
    'cart.remove'   => ['cartController.php',  'CartController',  'remove'],
    'cart.get'      => ['cartController.php',  'CartController',  'getCart'],
    'cart.clear'    => ['cartController.php',  'CartController',  'clear'],

    // Orders
    'order.checkout'=> ['orderConttroller.php','OrderController', 'checkout'],
    'order.history' => ['orderConttroller.php','OrderController', 'history'],

    // User Profile
    'user.profile'  => ['userController.php',  'UserController',  'updateProfile'],
    'user.password' => ['userController.php',  'UserController',  'changePassword'],

    // Notifications (AJAX)
    'notif.index'   => ['notificationController.php','NotificationController','index'],
    'notif.read'    => ['notificationController.php','NotificationController','markRead'],
    'notif.readAll' => ['notificationController.php','NotificationController','markAllRead'],
    'notif.delete'  => ['notificationController.php','NotificationController','delete'],

    // Admin
    'admin.toggleUser'   => ['adminController.php',  'AdminController',  'toggleUser'],
    'admin.deleteUser'   => ['adminController.php',  'AdminController',  'deleteUser'],
    'admin.updateStock'  => ['adminController.php',  'AdminController',  'updateStock'],
    'admin.orderStatus'  => ['orderConttroller.php', 'OrderController',  'adminUpdateStatus'],
    'admin.addProduct'   => ['productController.php','ProductController','adminCreate'],
    'admin.editProduct'  => ['productController.php','ProductController','adminUpdate'],
    'admin.deleteProduct'=> ['productController.php','ProductController','adminDelete'],
];

// ── Dispatch ────────────────────────────────────────────────────────────────────
$action = $_GET['action'] ?? '';

if ($action && isset($routes[$action])) {
    [$file, $class, $method] = $routes[$action];

    require_once APP_ROOT . '/app/controllers/' . $file;

    $controller = new $class();
    $controller->$method();
    exit;
}

// ── Fallback: redirect to homepage ──────────────────────────────────────────────
redirect('/juan-cafe/app/views/home/index.php');
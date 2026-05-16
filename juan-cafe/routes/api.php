<?php
/**
 * JUAN CAFÉ - API Routes
 * File: routes/api.php
 *
 * Defines all AJAX/JSON API endpoints consumed by the front-end JavaScript.
 * These routes are dispatched by public/index.php when ?action= is present,
 * or called directly from the public/ajax/ endpoint files.
 *
 * Format:
 *   'action.key' => [ControllerFile, ControllerClass, method]
 *
 * All endpoints return JSON. Authentication is enforced inside each controller.
 *
 * ─────────────────────────────────────────────────────────────
 * CART endpoints  (called by public/assets/js/cart.js)
 * ─────────────────────────────────────────────────────────────
 * POST /public/ajax/add-to-cart.php          → CartController::add()
 * POST /public/ajax/update-cart.php          → CartController::update()
 * POST /public/ajax/update-cart.php?remove   → CartController::remove()
 * POST /public/ajax/remove-from-cart.php     → CartController::remove()
 * GET  /public/index.php?action=cart.get     → CartController::getCart()
 * POST /public/index.php?action=cart.clear   → CartController::clear()
 *
 * ─────────────────────────────────────────────────────────────
 * ORDER endpoints  (called by public/assets/js/cart.js)
 * ─────────────────────────────────────────────────────────────
 * POST /public/ajax/checkout.php             → OrderController::checkout()
 * GET  /public/index.php?action=order.history → OrderController::history()
 *
 * ─────────────────────────────────────────────────────────────
 * PRODUCT endpoints  (called by public/assets/js/app.js)
 * ─────────────────────────────────────────────────────────────
 * GET  /public/ajax/search-products.php?q=   → Product::search()   (model direct)
 *
 * ─────────────────────────────────────────────────────────────
 * NOTIFICATION endpoints  (called by public/assets/js/notifications.js)
 * ─────────────────────────────────────────────────────────────
 * GET  /public/ajax/notifications.php?action=list    → NotificationController::index()
 * POST /public/ajax/notifications.php?action=readAll → NotificationController::markAllRead()
 * POST /public/ajax/notifications.php?action=read    → NotificationController::markRead()
 * POST /public/ajax/notifications.php?action=delete  → NotificationController::delete()
 */

// Route table used by public/index.php dispatcher for ?action= calls.
// Direct-file AJAX endpoints (public/ajax/*.php) are self-routing and
// do not need entries here, but they are documented above for clarity.

return [
    // ── Cart ──────────────────────────────────────────────────────────────────
    'cart.add'    => ['cartController.php', 'CartController', 'add'],
    'cart.update' => ['cartController.php', 'CartController', 'update'],
    'cart.remove' => ['cartController.php', 'CartController', 'remove'],
    'cart.get'    => ['cartController.php', 'CartController', 'getCart'],
    'cart.clear'  => ['cartController.php', 'CartController', 'clear'],

    // ── Orders ────────────────────────────────────────────────────────────────
    'order.checkout' => ['orderConttroller.php', 'OrderController', 'checkout'],
    'order.history'  => ['orderConttroller.php', 'OrderController', 'history'],

    // ── Notifications ─────────────────────────────────────────────────────────
    'notif.index'   => ['notificationController.php', 'NotificationController', 'index'],
    'notif.read'    => ['notificationController.php', 'NotificationController', 'markRead'],
    'notif.readAll' => ['notificationController.php', 'NotificationController', 'markAllRead'],
    'notif.delete'  => ['notificationController.php', 'NotificationController', 'delete'],
];
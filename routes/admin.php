<?php
/**
 * JUAN CAFÉ - Admin Routes
 * File: routes/admin.php
 *
 * All admin panel routes. Every action requires AdminAuthMiddleware.
 *
 * Views (direct file access, protected by adminAuth.php at top of each view):
 *   GET /app/views/admin/dashboard.php
 *   GET /app/views/admin/products.php
 *   GET /app/views/admin/orders.php
 *   GET /app/views/admin/users.php
 *   GET /app/views/admin/inventory.php
 *
 * Action routes (POST via public/index.php?action=admin.X):
 *   admin.toggleUser    → AdminController::toggleUser()
 *   admin.deleteUser    → AdminController::deleteUser()
 *   admin.updateStock   → AdminController::updateStock()
 *   admin.orderStatus   → OrderController::adminUpdateStatus()
 *   admin.addProduct    → ProductController::adminCreate()
 *   admin.editProduct   → ProductController::adminUpdate()
 *   admin.deleteProduct → ProductController::adminDelete()
 */

return [
    'admin.toggleUser'    => ['adminController.php',   'AdminController',   'toggleUser'],
    'admin.deleteUser'    => ['adminController.php',   'AdminController',   'deleteUser'],
    'admin.updateStock'   => ['adminController.php',   'AdminController',   'updateStock'],
    'admin.orderStatus'   => ['orderConttroller.php',  'OrderController',   'adminUpdateStatus'],
    'admin.addProduct'    => ['productController.php', 'ProductController', 'adminCreate'],
    'admin.editProduct'   => ['productController.php', 'ProductController', 'adminUpdate'],
    'admin.deleteProduct' => ['productController.php', 'ProductController', 'adminDelete'],
];
<?php
/**
 * JUAN CAFÉ - Web Routes
 * File: routes/web.php
 *
 * Maps URL patterns to controller actions for the main web interface.
 * Loaded by public/index.php when ?action= routing is used.
 *
 * This file serves as documentation for the routing table defined in
 * public/index.php. The actual dispatch happens there; add new routes
 * to both files when extending the app.
 *
 * Route format:
 *   METHOD  /path   →  Controller::method()
 */

// ── Home ──────────────────────────────────────────────────────────────────────
// GET  /                        → app/views/home/index.php  (direct file)
// GET  /app/views/home/about    → app/views/home/about.php  (direct file)
// GET  /app/views/home/contact  → app/views/home/contact.php (direct file)

// ── Products ──────────────────────────────────────────────────────────────────
// GET  /app/views/products/products.php         → ProductController::index()
// GET  /app/views/products/product-details.php  → ProductController::show()

// ── Cart (dispatched via public/index.php?action=cart.X) ─────────────────────
// POST ?action=cart.add     → CartController::add()
// POST ?action=cart.update  → CartController::update()
// POST ?action=cart.remove  → CartController::remove()
// GET  ?action=cart.get     → CartController::getCart()
// POST ?action=cart.clear   → CartController::clear()

// ── Orders ────────────────────────────────────────────────────────────────────
// POST ?action=order.checkout → OrderController::checkout()
// GET  ?action=order.history  → OrderController::history()

// ── User ──────────────────────────────────────────────────────────────────────
// POST ?action=user.profile   → UserController::updateProfile()
// POST ?action=user.password  → UserController::changePassword()

// ── Notifications ─────────────────────────────────────────────────────────────
// Handled by public/ajax/notifications.php

return []; // Route array consumed by public/index.php
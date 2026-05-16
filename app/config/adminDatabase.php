<?php
/**
 * JUAN CAFÉ - Admin Database Configuration
 * File: app/config/adminDatabase.php
 *
 * The admin panel uses the same database as the main app.
 * This file simply aliases the shared Database class so
 * adminController.php can require it independently.
 *
 * If you ever need a separate admin DB, change the credentials here.
 */

require_once __DIR__ . '/database.php';

/**
 * AdminDatabase — thin wrapper around the shared Database singleton.
 * Controllers can call AdminDatabase::getInstance() for clarity.
 */
class AdminDatabase extends Database {}
<?php
/**
 * JUAN CAFÉ - User Database Connection
 * File: app/config/database.php
 *
 * Returns a singleton PDO instance for the main juan_cafe database.
 * Uses the same credentials for regular users and admins unless
 * a separate admin DB is configured in adminDatabase.php.
 *
 * Usage:
 *   require_once __DIR__ . '/../config/database.php';
 *   $pdo = Database::getInstance();
 */

class Database
{
    // ── Credentials (edit to match your phpMyAdmin / MySQL setup) ──────────────
    private static string $host     = '127.0.0.1';
    private static string $dbName   = 'juan_cafe';
    private static string $username = 'root';
    private static string $password = '';          // empty for local XAMPP/WAMP
    private static string $charset  = 'utf8mb4';

    private static ?PDO $instance = null;

    /**
     * Returns the shared PDO connection.
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                self::$host,
                self::$dbName,
                self::$charset
            );

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$instance = new PDO($dsn, self::$username, self::$password, $options);
            } catch (PDOException $e) {
                // Show a clean error page rather than leaking credentials
                http_response_code(500);
                exit('<h2>Database connection failed. Please check your configuration.</h2>'
                    . (APP_ENV === 'development' ? '<pre>' . $e->getMessage() . '</pre>' : ''));
            }
        }

        return self::$instance;
    }

    /** Prevent cloning of the singleton */
    private function __clone() {}
}
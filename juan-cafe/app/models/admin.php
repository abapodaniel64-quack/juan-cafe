<?php
/**
 * JUAN CAFÉ - Admin Model
 * File: app/models/admin.php
 *
 * Handles database operations for the `admins` table.
 */

require_once __DIR__ . '/../config/database.php';

class Admin
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /** Find an admin by email. */
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM admins WHERE email = ? AND is_active = 1 LIMIT 1');
        $stmt->execute([strtolower(trim($email))]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Find an admin by ID. */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT id, name, email, is_active, created_at FROM admins WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Authenticate an admin login.
     * Returns the admin row on success or null on failure.
     */
    public function authenticate(string $email, string $password): ?array
    {
        $admin = $this->findByEmail($email);

        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }

        return null;
    }

    /** Get dashboard overview stats. */
    public function getDashboardStats(): array
    {
        $pdo = $this->db;

        return [
            'total_users'    => (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn(),
            'total_products' => (int) $pdo->query('SELECT COUNT(*) FROM products')->fetchColumn(),
            'total_orders'   => (int) $pdo->query('SELECT COUNT(*) FROM orders')->fetchColumn(),
            'pending_orders' => (int) $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")->fetchColumn(),
            'total_revenue'  => (float) $pdo->query("SELECT COALESCE(SUM(total),0) FROM orders WHERE status = 'completed'")->fetchColumn(),
        ];
    }
}
<?php
/**
 * JUAN CAFÉ - User Model
 * File: app/models/user.php
 *
 * Handles all database operations related to the `users` table.
 */

require_once __DIR__ . '/../config/database.php';

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // ── Create ─────────────────────────────────────────────────────────────────

    /**
     * Register a new user.
     *
     * @param array $data  ['name', 'email', 'password' (plain), 'phone'?]
     * @return int  New user ID
     */
    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO users (name, email, password, phone)
             VALUES (:name, :email, :password, :phone)'
        );
        $stmt->execute([
            ':name'     => trim($data['name']),
            ':email'    => strtolower(trim($data['email'])),
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => BCRYPT_COST]),
            ':phone'    => $data['phone'] ?? null,
        ]);
        return (int) $this->db->lastInsertId();
    }

    // ── Read ───────────────────────────────────────────────────────────────────

    /** Find a user by ID. Returns array or null. */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Find a user by email. Returns array or null. */
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([strtolower(trim($email))]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Get all users (for admin panel). */
    public function getAll(int $page = 1, int $perPage = ITEMS_PER_PAGE): array
    {
        $offset = paginationOffset($page, $perPage);
        $stmt   = $this->db->prepare(
            'SELECT id, name, email, phone, role, is_active, created_at
             FROM users
             ORDER BY created_at DESC
             LIMIT :limit OFFSET :offset'
        );
        $stmt->bindValue(':limit',  $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset,  PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /** Total number of users (for pagination). */
    public function countAll(): int
    {
        return (int) $this->db->query('SELECT COUNT(*) FROM users')->fetchColumn();
    }

    // ── Auth ───────────────────────────────────────────────────────────────────

    /**
     * Verify login credentials.
     * Returns the user array on success, or null on failure.
     */
    public function authenticate(string $email, string $password): ?array
    {
        $user = $this->findByEmail($email);

        if ($user && $user['is_active'] && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }

    /** Check if an email already exists in the database. */
    public function emailExists(string $email): bool
    {
        $stmt = $this->db->prepare('SELECT 1 FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([strtolower(trim($email))]);
        return (bool) $stmt->fetchColumn();
    }

    // ── Update ─────────────────────────────────────────────────────────────────

    /** Update basic profile info. */
    public function updateProfile(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE users SET name = :name, phone = :phone, address = :address
             WHERE id = :id'
        );
        return $stmt->execute([
            ':name'    => trim($data['name']),
            ':phone'   => $data['phone']   ?? null,
            ':address' => $data['address'] ?? null,
            ':id'      => $id,
        ]);
    }

    /** Change a user's password (provide already-validated plain password). */
    public function updatePassword(int $id, string $plainPassword): bool
    {
        $stmt = $this->db->prepare('UPDATE users SET password = ? WHERE id = ?');
        return $stmt->execute([
            password_hash($plainPassword, PASSWORD_BCRYPT, ['cost' => BCRYPT_COST]),
            $id,
        ]);
    }

    /** Toggle active/inactive status (admin action). */
    public function setActive(int $id, bool $active): bool
    {
        $stmt = $this->db->prepare('UPDATE users SET is_active = ? WHERE id = ?');
        return $stmt->execute([(int) $active, $id]);
    }

    // ── Delete ─────────────────────────────────────────────────────────────────

    /** Soft-delete by deactivating, or hard-delete if needed. */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
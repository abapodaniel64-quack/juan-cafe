<?php
/**
 * JUAN CAFÉ - Product Model
 * File: app/models/product.php
 *
 * Handles all database operations related to the `products` table.
 */

require_once __DIR__ . '/../config/database.php';

class Product
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // ── Read ───────────────────────────────────────────────────────────────────

    /** Get all available products, optionally filtered by category slug. */
    public function getAll(?string $categorySlug = null, int $page = 1, int $perPage = ITEMS_PER_PAGE): array
    {
        $offset = paginationOffset($page, $perPage);

        if ($categorySlug) {
            $stmt = $this->db->prepare(
                'SELECT p.*, c.name AS category_name, c.slug AS category_slug
                 FROM products p
                 JOIN categories c ON p.category_id = c.id
                 WHERE p.is_available = 1 AND c.slug = :slug
                 ORDER BY p.name ASC
                 LIMIT :limit OFFSET :offset'
            );
            $stmt->bindValue(':slug',   $categorySlug);
            $stmt->bindValue(':limit',  $perPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset,  PDO::PARAM_INT);
        } else {
            $stmt = $this->db->prepare(
                'SELECT p.*, c.name AS category_name, c.slug AS category_slug
                 FROM products p
                 JOIN categories c ON p.category_id = c.id
                 WHERE p.is_available = 1
                 ORDER BY p.name ASC
                 LIMIT :limit OFFSET :offset'
            );
            $stmt->bindValue(':limit',  $perPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset,  PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    /** Get all products for admin (includes unavailable). */
    public function getAllAdmin(int $page = 1, int $perPage = ITEMS_PER_PAGE): array
    {
        $offset = paginationOffset($page, $perPage);
        $stmt   = $this->db->prepare(
            'SELECT p.*, c.name AS category_name
             FROM products p
             JOIN categories c ON p.category_id = c.id
             ORDER BY p.created_at DESC
             LIMIT :limit OFFSET :offset'
        );
        $stmt->bindValue(':limit',  $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset,  PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /** Find a product by ID. */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT p.*, c.name AS category_name, c.slug AS category_slug
             FROM products p
             JOIN categories c ON p.category_id = c.id
             WHERE p.id = ? LIMIT 1'
        );
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Find a product by slug. */
    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT p.*, c.name AS category_name, c.slug AS category_slug
             FROM products p
             JOIN categories c ON p.category_id = c.id
             WHERE p.slug = ? AND p.is_available = 1 LIMIT 1'
        );
        $stmt->execute([$slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** Get featured products (homepage). */
    public function getFeatured(int $limit = 4): array
    {
        $stmt = $this->db->prepare(
            'SELECT p.*, c.name AS category_name
             FROM products p
             JOIN categories c ON p.category_id = c.id
             WHERE p.is_featured = 1 AND p.is_available = 1
             ORDER BY p.id DESC
             LIMIT ?'
        );
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }

    /** Search products by name or description. */
    public function search(string $query, int $limit = 20): array
    {
        $like = '%' . $query . '%';
        $stmt = $this->db->prepare(
            'SELECT p.*, c.name AS category_name
             FROM products p
             JOIN categories c ON p.category_id = c.id
             WHERE p.is_available = 1 AND (p.name LIKE ? OR p.description LIKE ?)
             ORDER BY p.name ASC
             LIMIT ?'
        );
        $stmt->execute([$like, $like, $limit]);
        return $stmt->fetchAll();
    }

    /** Count products (for pagination). */
    public function countAll(?string $categorySlug = null): int
    {
        if ($categorySlug) {
            $stmt = $this->db->prepare(
                'SELECT COUNT(*) FROM products p
                 JOIN categories c ON p.category_id = c.id
                 WHERE p.is_available = 1 AND c.slug = ?'
            );
            $stmt->execute([$categorySlug]);
        } else {
            $stmt = $this->db->query('SELECT COUNT(*) FROM products WHERE is_available = 1');
        }
        return (int) $stmt->fetchColumn();
    }

    // ── Create / Update / Delete ───────────────────────────────────────────────

    /** Insert a new product. */
    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO products (category_id, name, slug, description, price, stock, image, is_available, is_featured)
             VALUES (:cat, :name, :slug, :desc, :price, :stock, :image, :avail, :featured)'
        );
        $stmt->execute([
            ':cat'      => (int) $data['category_id'],
            ':name'     => trim($data['name']),
            ':slug'     => slugify($data['name']),
            ':desc'     => $data['description'] ?? null,
            ':price'    => (float) $data['price'],
            ':stock'    => (int) ($data['stock'] ?? 0),
            ':image'    => $data['image'] ?? null,
            ':avail'    => (int) ($data['is_available'] ?? 1),
            ':featured' => (int) ($data['is_featured'] ?? 0),
        ]);
        return (int) $this->db->lastInsertId();
    }

    /** Update an existing product. */
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE products
             SET category_id = :cat, name = :name, description = :desc,
                 price = :price, stock = :stock, is_available = :avail, is_featured = :featured
                 ' . (isset($data['image']) ? ', image = :image' : '') . '
             WHERE id = :id'
        );
        $params = [
            ':cat'      => (int) $data['category_id'],
            ':name'     => trim($data['name']),
            ':desc'     => $data['description'] ?? null,
            ':price'    => (float) $data['price'],
            ':stock'    => (int) ($data['stock'] ?? 0),
            ':avail'    => (int) ($data['is_available'] ?? 1),
            ':featured' => (int) ($data['is_featured'] ?? 0),
            ':id'       => $id,
        ];
        if (isset($data['image'])) {
            $params[':image'] = $data['image'];
        }
        return $stmt->execute($params);
    }

    /** Update only the stock quantity. */
    public function updateStock(int $id, int $quantity): bool
    {
        $stmt = $this->db->prepare('UPDATE products SET stock = ? WHERE id = ?');
        return $stmt->execute([$quantity, $id]);
    }

    /** Decrement stock by a given amount (used after order). */
    public function decrementStock(int $id, int $amount): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE products SET stock = GREATEST(stock - ?, 0) WHERE id = ?'
        );
        return $stmt->execute([$amount, $id]);
    }

    /** Delete a product. */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM products WHERE id = ?');
        return $stmt->execute([$id]);
    }

    // ── Categories ─────────────────────────────────────────────────────────────

    /** Get all categories. */
    public function getCategories(): array
    {
        return $this->db->query(
            'SELECT * FROM categories WHERE is_active = 1 ORDER BY sort_order ASC'
        )->fetchAll();
    }
}
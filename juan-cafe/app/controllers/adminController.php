<?php
/**
 * JUAN CAFÉ - Admin Controller
 * File: app/controllers/adminController.php
 *
 * Handles admin dashboard data and user management.
 * Product/order management logic lives in productController and orderController.
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/adminDatabase.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../models/admin.php';
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../models/order.php';
require_once __DIR__ . '/../models/product.php';

class AdminController
{
    private Admin   $adminModel;
    private User    $userModel;
    private Order   $orderModel;
    private Product $productModel;

    public function __construct()
    {
        $this->adminModel   = new Admin();
        $this->userModel    = new User();
        $this->orderModel   = new Order();
        $this->productModel = new Product();
    }

    // ── Dashboard ──────────────────────────────────────────────────────────────

    /**
     * Returns data for app/views/admin/dashboard.php.
     */
    public function dashboard(): array
    {
        $stats         = $this->adminModel->getDashboardStats();
        $recentOrders  = $this->orderModel->getRecent(8);
        $revenueSummary= $this->orderModel->getRevenueSummary();
        $lowStock      = $this->getLowStockProducts(5);

        return compact('stats', 'recentOrders', 'revenueSummary', 'lowStock');
    }

    // ── Users ──────────────────────────────────────────────────────────────────

    /**
     * Returns paginated user list for app/views/admin/users.php.
     */
    public function users(): array
    {
        $page  = max(1, (int) ($_GET['page'] ?? 1));
        $users = $this->userModel->getAll($page);
        $total = $this->userModel->countAll();
        return compact('users', 'page', 'total');
    }

    /**
     * Toggle user active/inactive status (POST from admin/users.php).
     */
    public function toggleUser(): void
    {
        require_once __DIR__ . '/../middleware/adminAuth.php';
        verifyCsrf();

        $userId = (int) ($_POST['user_id'] ?? 0);
        $active = (int) ($_POST['is_active'] ?? 0);

        $this->userModel->setActive($userId, (bool) $active);
        setFlash('success', 'User status updated.');
        redirect('/app/views/admin/users.php');
    }

    /**
     * Delete a user (POST from admin/users.php). Irreversible!
     */
    public function deleteUser(): void
    {
        require_once __DIR__ . '/../middleware/adminAuth.php';
        verifyCsrf();

        $userId = (int) ($_POST['user_id'] ?? 0);
        $this->userModel->delete($userId);
        setFlash('success', 'User deleted.');
        redirect('/app/views/admin/users.php');
    }

    // ── Inventory ──────────────────────────────────────────────────────────────

    /**
     * Returns data for app/views/admin/inventory.php.
     */
    public function inventory(): array
    {
        $page     = max(1, (int) ($_GET['page'] ?? 1));
        $products = $this->productModel->getAllAdmin($page);
        $total    = $this->productModel->countAll();
        return compact('products', 'page', 'total');
    }

    /**
     * Update only the stock for a product (quick-edit from inventory page).
     */
    public function updateStock(): void
    {
        require_once __DIR__ . '/../middleware/adminAuth.php';
        verifyCsrf();

        $productId = (int) ($_POST['product_id'] ?? 0);
        $stock     = max(0, (int) ($_POST['stock'] ?? 0));

        $this->productModel->updateStock($productId, $stock);
        setFlash('success', 'Stock updated.');
        redirect('/app/views/admin/inventory.php');
    }

    // ── Private Helpers ────────────────────────────────────────────────────────

    /**
     * Get products with stock at or below a threshold.
     */
    private function getLowStockProducts(int $threshold = 5): array
    {
        $pdo  = Database::getInstance();
        $stmt = $pdo->prepare(
            'SELECT p.id, p.name, p.stock, c.name AS category_name
             FROM products p
             JOIN categories c ON p.category_id = c.id
             WHERE p.stock <= ? AND p.is_available = 1
             ORDER BY p.stock ASC
             LIMIT 10'
        );
        $stmt->execute([$threshold]);
        return $stmt->fetchAll();
    }
}
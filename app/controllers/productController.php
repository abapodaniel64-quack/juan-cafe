<?php
/**
 * JUAN CAFÉ - Product Controller
 * File: app/controllers/productController.php
 *
 * Handles product listing, details, and admin CRUD.
 *
 * GET  /products              → index()       → products.php view
 * GET  /products/details?id=  → show()        → product-details.php view
 * POST /admin/products/create → adminCreate()
 * POST /admin/products/update → adminUpdate()
 * POST /admin/products/delete → adminDelete()
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/validation.php';
require_once __DIR__ . '/../models/product.php';

class ProductController
{
    private Product $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    // ── Public ─────────────────────────────────────────────────────────────────

    /**
     * Prepare data for app/views/products/products.php.
     * Returns variables for the view via extract().
     */
    public function index(): array
    {
        $category = $_GET['cat']  ?? null;
        $page     = max(1, (int) ($_GET['page'] ?? 1));
        $search   = trim($_GET['search'] ?? '');

        if ($search !== '') {
            $products = $this->productModel->search($search);
            $total    = count($products);
        } else {
            $products = $this->productModel->getAll($category, $page);
            $total    = $this->productModel->countAll($category);
        }

        $categories = $this->productModel->getCategories();

        return compact('products', 'categories', 'total', 'page', 'category', 'search');
    }

    /**
     * Prepare data for app/views/products/product-details.php.
     */
    public function show(): array
    {
        $id   = (int) ($_GET['id'] ?? 0);
        $slug = $_GET['slug'] ?? '';

        $product = $id
            ? $this->productModel->findById($id)
            : ($slug ? $this->productModel->findBySlug($slug) : null);

        if (!$product) {
            http_response_code(404);
            exit('<h2>Product not found.</h2>');
        }

        return compact('product');
    }

    // ── Admin CRUD ─────────────────────────────────────────────────────────────

    /** Handle admin product creation (POST). */
    public function adminCreate(): void
    {
        require_once __DIR__ . '/../middleware/adminAuth.php';
        verifyCsrf();

        $data = [
            'category_id' => $_POST['category_id'] ?? '',
            'name'        => trim($_POST['name']    ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'price'       => $_POST['price']       ?? '',
            'stock'       => $_POST['stock']       ?? 0,
            'is_available'=> isset($_POST['is_available']) ? 1 : 0,
            'is_featured' => isset($_POST['is_featured'])  ? 1 : 0,
        ];

        $v = new Validator($data);
        $v->required('name')->required('price')->numeric('price')->required('category_id');

        if ($v->fails()) {
            setFlash('error', implode(' ', $v->allErrors()));
            redirect('/app/views/admin/products.php');
        }

        // Handle optional image upload
        if (!empty($_FILES['image']['name'])) {
            $data['image'] = $this->handleImageUpload($_FILES['image']);
            if (!$data['image']) {
                setFlash('error', 'Invalid image file. JPG, PNG, or WEBP only (max 2 MB).');
                redirect('/app/views/admin/products.php');
            }
        }

        $this->productModel->create($data);
        setFlash('success', 'Product created successfully.');
        redirect('/app/views/admin/products.php');
    }

    /** Handle admin product update (POST). */
    public function adminUpdate(): void
    {
        require_once __DIR__ . '/../middleware/adminAuth.php';
        verifyCsrf();

        $id   = (int) ($_POST['id'] ?? 0);
        $data = [
            'category_id' => $_POST['category_id'] ?? '',
            'name'        => trim($_POST['name']    ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'price'       => $_POST['price']       ?? '',
            'stock'       => $_POST['stock']       ?? 0,
            'is_available'=> isset($_POST['is_available']) ? 1 : 0,
            'is_featured' => isset($_POST['is_featured'])  ? 1 : 0,
        ];

        if (!empty($_FILES['image']['name'])) {
            $uploaded = $this->handleImageUpload($_FILES['image']);
            if ($uploaded) $data['image'] = $uploaded;
        }

        $this->productModel->update($id, $data);
        setFlash('success', 'Product updated successfully.');
        redirect('/app/views/admin/products.php');
    }

    /** Handle admin product delete (POST). */
    public function adminDelete(): void
    {
        require_once __DIR__ . '/../middleware/adminAuth.php';
        verifyCsrf();

        $id = (int) ($_POST['id'] ?? 0);
        $this->productModel->delete($id);
        setFlash('success', 'Product deleted.');
        redirect('/app/views/admin/products.php');
    }

    // ── Private ────────────────────────────────────────────────────────────────

    /**
     * Upload a product image and return the relative path, or false on failure.
     */
    private function handleImageUpload(array $file): string|false
    {
        if ($file['error'] !== UPLOAD_ERR_OK) return false;
        if ($file['size'] > MAX_UPLOAD_SIZE)  return false;

        $finfo    = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);

        if (!in_array($mimeType, ALLOWED_IMAGE_TYPES, true)) return false;

        $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('product_', true) . '.' . strtolower($ext);
        $destPath = UPLOAD_DIR . $filename;

        if (!is_dir(UPLOAD_DIR)) {
            mkdir(UPLOAD_DIR, 0755, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $destPath)) return false;

        return UPLOAD_URL . $filename;
    }
}
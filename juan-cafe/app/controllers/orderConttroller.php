<?php
/**
 * JUAN CAFÉ - Order Controller
 * File: app/controllers/orderConttroller.php   (matches existing filename)
 *
 * Handles checkout, order status updates, and order history.
 *
 * POST /order/checkout     → checkout()
 * GET  /order/history      → history()
 * POST /admin/order/update → adminUpdateStatus()
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/validation.php';
require_once __DIR__ . '/../helpers/notification.php';
require_once __DIR__ . '/../models/order.php';
require_once __DIR__ . '/../models/cart.php';
require_once __DIR__ . '/../models/product.php';

class OrderController
{
    private Order   $orderModel;
    private Cart    $cartModel;
    private Product $productModel;

    public function __construct()
    {
        $this->orderModel   = new Order();
        $this->cartModel    = new Cart();
        $this->productModel = new Product();
    }

    // ── Checkout ───────────────────────────────────────────────────────────────

    /**
     * Process checkout from the cart page (AJAX or form POST).
     * Accepts JSON body from cart.js (proceedToCheckout) or form POST.
     */
    public function checkout(): void
    {
        startSession();

        if (!isLoggedIn()) {
            jsonResponse(['success' => false, 'message' => 'Please log in to place an order.'], 401);
        }

        $userId = currentUserId();

        // Support both JSON body (fetch) and form POST
        $isJson = str_contains($_SERVER['CONTENT_TYPE'] ?? '', 'application/json');
        if ($isJson) {
            $body  = json_decode(file_get_contents('php://input'), true) ?? [];
            $items = $body['items'] ?? [];
            $notes = trim($body['notes'] ?? '');
        } else {
            $items = $_POST['items'] ?? [];
            $notes = trim($_POST['notes'] ?? '');
        }

        // If items were sent from the JS cart, use them; otherwise pull from DB cart
        if (empty($items)) {
            $dbItems = $this->cartModel->getByUser($userId);
            if (empty($dbItems)) {
                jsonResponse(['success' => false, 'message' => 'Your cart is empty.'], 400);
            }
            $items = array_map(fn($i) => [
                'product_id'   => $i['product_id'],
                'product_name' => $i['name'],
                'price'        => (float) $i['price'],
                'quantity'     => (int) $i['quantity'],
            ], $dbItems);
        }

        // Calculate totals
        $subtotal    = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $items));
        $deliveryFee = $subtotal > 0 ? 0.00 : 0.00;   // free delivery for demo
        $discount    = 0.00;
        $total       = $subtotal + $deliveryFee - $discount;

        $totals = [
            'subtotal'     => $subtotal,
            'delivery_fee' => $deliveryFee,
            'discount'     => $discount,
            'total'        => $total,
        ];

        try {
            $orderId = $this->orderModel->create($userId, $items, $totals, $notes);

            // Get the order number for the notification
            $order = $this->orderModel->findById($orderId);

            // Decrement stock for each ordered product
            foreach ($items as $item) {
                $this->productModel->decrementStock((int) $item['product_id'], (int) $item['quantity']);
            }

            // Clear the DB cart
            $this->cartModel->clearCart($userId);

            // Notify the user
            NotificationHelper::send(
                $userId,
                'order',
                'Order Placed! 🎉',
                'Your order ' . $order['order_number'] . ' has been received and is now pending confirmation.'
            );

            jsonResponse([
                'success'      => true,
                'message'      => 'Order placed successfully!',
                'order_number' => $order['order_number'],
                'total'        => formatPrice($total),
            ]);

        } catch (Exception $e) {
            error_log('[OrderController::checkout] ' . $e->getMessage());
            jsonResponse(['success' => false, 'message' => 'Order failed. Please try again.'], 500);
        }
    }

    // ── Order History ──────────────────────────────────────────────────────────

    /**
     * Prepare data for app/views/user/order-history.php.
     */
    public function history(): array
    {
        startSession();
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $orders = $this->orderModel->getByUser(currentUserId(), $page);
        $total  = count($orders); // simplified; could add countByUser()
        return compact('orders', 'page', 'total');
    }

    // ── Admin: Update Order Status ─────────────────────────────────────────────

    /**
     * Admin POST: update order status and notify the customer.
     */
    public function adminUpdateStatus(): void
    {
        require_once __DIR__ . '/../middleware/adminAuth.php';
        verifyCsrf();

        $orderId = (int) ($_POST['order_id'] ?? 0);
        $status  = $_POST['status'] ?? '';

        if (!$orderId || !$status) {
            setFlash('error', 'Invalid order or status.');
            redirect('/app/views/admin/orders.php');
        }

        $this->orderModel->updateStatus($orderId, $status);

        // Notify the customer about the status change
        $order = $this->orderModel->findById($orderId);
        if ($order) {
            $statusLabels = [
                'confirmed'  => 'confirmed ✅',
                'preparing'  => 'being prepared 🍵',
                'ready'      => 'ready for pick-up 🎉',
                'completed'  => 'completed ☕',
                'cancelled'  => 'cancelled ❌',
            ];
            $label = $statusLabels[$status] ?? $status;
            NotificationHelper::send(
                (int) $order['user_id'],
                'order',
                'Order Update: ' . $order['order_number'],
                'Your order ' . $order['order_number'] . ' is now ' . $label . '.'
            );
        }

        setFlash('success', 'Order status updated to: ' . ucfirst($status) . '.');
        redirect('/app/views/admin/orders.php');
    }
}
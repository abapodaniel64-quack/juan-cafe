<?php
/**
 * JUAN CAFÉ - User Controller
 * File: app/controllers/userController.php
 *
 * Handles user profile, dashboard data, and password changes.
 *
 * GET  /user/dashboard  → dashboard()
 * POST /user/profile    → updateProfile()
 * POST /user/password   → changePassword()
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/validation.php';
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../models/order.php';
require_once __DIR__ . '/../models/cart.php';
require_once __DIR__ . '/../models/notification.php';

class UserController
{
    private User         $userModel;
    private Order        $orderModel;
    private Cart         $cartModel;
    private Notification $notifModel;

    public function __construct()
    {
        $this->userModel  = new User();
        $this->orderModel = new Order();
        $this->cartModel  = new Cart();
        $this->notifModel = new Notification();
    }

    // ── Dashboard ──────────────────────────────────────────────────────────────

    /**
     * Prepare data for app/views/user/dashboard.php.
     */
    public function dashboard(): array
    {
        startSession();
        $userId = currentUserId();

        $user          = $this->userModel->findById($userId);
        $recentOrders  = $this->orderModel->getByUser($userId, 1, 5);
        $cartCount     = $this->cartModel->countItems($userId);
        $notifications = $this->notifModel->getUnread($userId);
        $totalSpent    = array_sum(array_column(
            $this->orderModel->getByUser($userId, 1, 999), 'total'
        ));

        return compact('user', 'recentOrders', 'cartCount', 'notifications', 'totalSpent');
    }

    // ── Profile Update ─────────────────────────────────────────────────────────

    /**
     * Handle POST from profile form.
     */
    public function updateProfile(): void
    {
        startSession();
        require_once __DIR__ . '/../middleware/auth.php';
        verifyCsrf();

        $data = [
            'name'    => trim($_POST['name']    ?? ''),
            'phone'   => trim($_POST['phone']   ?? ''),
            'address' => trim($_POST['address'] ?? ''),
        ];

        $v = new Validator($data);
        $v->required('name')->maxLength('name', 100);

        if ($v->fails()) {
            setFlash('error', implode(' ', $v->allErrors()));
            redirect('/app/views/user/profile.php');
        }

        $this->userModel->updateProfile(currentUserId(), $data);

        // Refresh session name
        $_SESSION['user_name'] = $data['name'];

        setFlash('success', 'Profile updated successfully!');
        redirect('/app/views/user/profile.php');
    }

    // ── Password Change ────────────────────────────────────────────────────────

    /**
     * Handle POST from change-password form.
     */
    public function changePassword(): void
    {
        startSession();
        require_once __DIR__ . '/../middleware/auth.php';
        verifyCsrf();

        $current  = $_POST['current_password']  ?? '';
        $new      = $_POST['new_password']       ?? '';
        $confirm  = $_POST['confirm_password']   ?? '';

        $v = new Validator(['new' => $new, 'confirm' => $confirm]);
        $v->required('new')->minLength('new', 6, 'New password')
          ->matches('confirm', 'new', 'Confirm password');

        if ($v->fails()) {
            setFlash('error', implode(' ', $v->allErrors()));
            redirect('/app/views/user/profile.php');
        }

        $user = $this->userModel->findById(currentUserId());

        if (!password_verify($current, $user['password'])) {
            setFlash('error', 'Current password is incorrect.');
            redirect('/app/views/user/profile.php');
        }

        $this->userModel->updatePassword(currentUserId(), $new);
        setFlash('success', 'Password changed successfully!');
        redirect('/app/views/user/profile.php');
    }
}
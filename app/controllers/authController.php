<?php
/**
 * JUAN CAFÉ - Auth Controller
 * File: app/controllers/authController.php
 *
 * Handles: login (user + admin), signup, logout.
 * Called from routes/auth.php or directly by the public/index.php router.
 *
 * POST /auth/login    → loginAction()
 * POST /auth/signup   → signupAction()
 * GET  /auth/logout   → logoutAction()
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/validation.php';
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../models/admin.php';
require_once __DIR__ . '/../helpers/notification.php';

class AuthController
{
    private User  $userModel;
    private Admin $adminModel;

    public function __construct()
    {
        $this->userModel  = new User();
        $this->adminModel = new Admin();
    }

    // ── Login ──────────────────────────────────────────────────────────────────

    /**
     * Handle POST login form.
     * Checks admins table first, then users table.
     */
    public function loginAction(): void
    {
        startSession();
        verifyCsrf();

        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');

        // Validate inputs
        $v = new Validator(['email' => $email, 'password' => $password]);
        $v->required('email')->email('email')->required('password');

        if ($v->fails()) {
            setFlash('error', implode(' ', $v->allErrors()));
            redirect('/app/views/auth/login.php');
        }

        // 1. Try admin login
        $admin = $this->adminModel->authenticate($email, $password);
        if ($admin) {
            session_regenerate_id(true);
            $_SESSION['admin_id']   = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            redirect('/app/views/admin/dashboard.php');
        }

        // 2. Try user login
        $user = $this->userModel->authenticate($email, $password);
        if ($user) {
            session_regenerate_id(true);
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email']= $user['email'];

            // Redirect to originally intended URL if stored
            $intended = $_SESSION['intended_url'] ?? '/app/views/user/dashboard.php';
            unset($_SESSION['intended_url']);
            redirect($intended);
        }

        // Both failed
        setFlash('error', 'Invalid email or password. Please try again.');
        redirect('/app/views/auth/login.php');
    }

    // ── Signup ─────────────────────────────────────────────────────────────────

    /**
     * Handle POST signup form.
     */
    public function signupAction(): void
    {
        startSession();
        verifyCsrf();

        $data = [
            'name'             => trim($_POST['name']             ?? ''),
            'email'            => trim($_POST['email']            ?? ''),
            'password'         => $_POST['password']              ?? '',
            'confirm_password' => $_POST['confirm_password']      ?? '',
            'phone'            => trim($_POST['phone']            ?? ''),
        ];

        // Validation
        $v = new Validator($data);
        $v->required('name')
          ->maxLength('name', 100)
          ->required('email')
          ->email('email')
          ->required('password')
          ->minLength('password', 6)
          ->matches('confirm_password', 'password', 'Confirm Password');

        if ($v->fails()) {
            setFlash('error', implode(' ', $v->allErrors()));
            redirect('/app/views/auth/signup.php');
        }

        // Check duplicate email
        if ($this->userModel->emailExists($data['email'])) {
            setFlash('error', 'That email is already registered. Please login or use a different email.');
            redirect('/app/views/auth/signup.php');
        }

        // Create the user
        $userId = $this->userModel->create($data);

        // Send a welcome notification
        NotificationHelper::send(
            $userId,
            'success',
            'Welcome to Juan Café! ☕',
            'Hi ' . e($data['name']) . ', your account has been created. Start browsing our menu!'
        );

        // Auto-login after signup
        session_regenerate_id(true);
        $_SESSION['user_id']    = $userId;
        $_SESSION['user_name']  = $data['name'];
        $_SESSION['user_email'] = $data['email'];

        setFlash('success', 'Account created! Welcome to Juan Café, ' . e($data['name']) . '!');
        redirect('/app/views/user/dashboard.php');
    }

    // ── Logout ─────────────────────────────────────────────────────────────────

    /**
     * Destroy session and redirect to home.
     */
    public function logoutAction(): void
    {
        startSession();
        session_unset();
        session_destroy();
        redirect('/app/views/home/index.php');
    }
}
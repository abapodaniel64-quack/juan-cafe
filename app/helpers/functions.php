<?php
/**
 * JUAN CAFÉ - Global Helper Functions
 * File: app/helpers/functions.php
 *
 * Autoloaded early; no class — just plain functions available everywhere.
 */

// ── Session Helpers ────────────────────────────────────────────────────────────

/** Start the session if not already active. */
function startSession(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_name(SESSION_NAME ?? 'juancafe_session');
        session_start();
    }
}

/** Store a flash message (shown once on the next request). */
function setFlash(string $key, string $message): void
{
    startSession();
    $_SESSION['flash'][$key] = $message;
}

/** Retrieve and clear a flash message. */
function getFlash(string $key): ?string
{
    startSession();
    if (isset($_SESSION['flash'][$key])) {
        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $msg;
    }
    return null;
}

// ── Auth Helpers ───────────────────────────────────────────────────────────────

/** Returns true if a regular user is logged in. */
function isLoggedIn(): bool
{
    startSession();
    return !empty($_SESSION['user_id']);
}

/** Returns the current user's ID or null. */
function currentUserId(): ?int
{
    startSession();
    return $_SESSION['user_id'] ?? null;
}

/** Returns the current user's name or null. */
function currentUserName(): ?string
{
    startSession();
    return $_SESSION['user_name'] ?? null;
}

/** Returns true if an admin is logged in. */
function isAdminLoggedIn(): bool
{
    startSession();
    return !empty($_SESSION['admin_id']);
}

// ── CSRF Helpers ───────────────────────────────────────────────────────────────

/** Generate (or return existing) CSRF token stored in session. */
function csrfToken(): string
{
    startSession();
    if (empty($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_TOKEN_NAME];
}

/** Render a hidden CSRF input field. */
function csrfField(): string
{
    return '<input type="hidden" name="' . CSRF_TOKEN_NAME . '" value="' . csrfToken() . '">';
}

/** Validate the submitted CSRF token. Exits with 403 on failure. */
function verifyCsrf(): void
{
    $submitted = $_POST[CSRF_TOKEN_NAME] ?? '';
    if (!hash_equals(csrfToken(), $submitted)) {
        http_response_code(403);
        exit('403 – Invalid or missing CSRF token.');
    }
    // Regenerate token after each validated request (double-submit pattern)
    unset($_SESSION[CSRF_TOKEN_NAME]);
}

// ── URL / Redirect Helpers ─────────────────────────────────────────────────────

/** Redirect to a given path and exit. */
function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}

/** Redirect back to the referring page (or a fallback). */
function redirectBack(string $fallback = '/'): never
{
    $ref = $_SERVER['HTTP_REFERER'] ?? $fallback;
    redirect($ref);
}

// ── String Helpers ─────────────────────────────────────────────────────────────

/** Sanitize a string for safe HTML output. */
function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Convert a string to a URL-safe slug. */
function slugify(string $text): string
{
    $text = mb_strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

/** Format a price as Philippine Peso. */
function formatPrice(float $amount): string
{
    return '₱' . number_format($amount, 2);
}

/** Generate a unique order number: JC-XXXXX */
function generateOrderNumber(): string
{
    return 'JC-' . strtoupper(substr(uniqid(), -5));
}

// ── JSON Response Helper (for AJAX endpoints) ──────────────────────────────────

/** Send a JSON response and exit. */
function jsonResponse(array $data, int $statusCode = 200): never
{
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// ── Pagination Helper ──────────────────────────────────────────────────────────

/** Return offset from page number. */
function paginationOffset(int $page, int $perPage = ITEMS_PER_PAGE): int
{
    return max(0, ($page - 1) * $perPage);
}
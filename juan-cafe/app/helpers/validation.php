<?php
/**
 * JUAN CAFÉ - Validation Helper
 * File: app/helpers/validation.php
 *
 * Simple rule-based validator.
 *
 * Usage:
 *   $v = new Validator($_POST);
 *   $v->required('email')->email('email')->minLength('password', 6);
 *   if ($v->fails()) { print_r($v->errors()); }
 */

class Validator
{
    private array $data;
    private array $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    // ── Rules ──────────────────────────────────────────────────────────────────

    /** Field must be present and not empty. */
    public function required(string $field, string $label = ''): static
    {
        $label = $label ?: ucfirst(str_replace('_', ' ', $field));
        if (!isset($this->data[$field]) || trim((string) $this->data[$field]) === '') {
            $this->errors[$field][] = "{$label} is required.";
        }
        return $this;
    }

    /** Field must be a valid email address. */
    public function email(string $field, string $label = ''): static
    {
        $label = $label ?: ucfirst($field);
        if (!empty($this->data[$field]) && !filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "{$label} must be a valid email address.";
        }
        return $this;
    }

    /** Field value must be at least $min characters. */
    public function minLength(string $field, int $min, string $label = ''): static
    {
        $label = $label ?: ucfirst(str_replace('_', ' ', $field));
        $value = $this->data[$field] ?? '';
        if (!empty($value) && mb_strlen((string) $value) < $min) {
            $this->errors[$field][] = "{$label} must be at least {$min} characters.";
        }
        return $this;
    }

    /** Field value must not exceed $max characters. */
    public function maxLength(string $field, int $max, string $label = ''): static
    {
        $label = $label ?: ucfirst(str_replace('_', ' ', $field));
        $value = $this->data[$field] ?? '';
        if (!empty($value) && mb_strlen((string) $value) > $max) {
            $this->errors[$field][] = "{$label} must not exceed {$max} characters.";
        }
        return $this;
    }

    /** Field must be a positive numeric value. */
    public function numeric(string $field, string $label = ''): static
    {
        $label = $label ?: ucfirst($field);
        $value = $this->data[$field] ?? '';
        if (!empty($value) && (!is_numeric($value) || (float)$value < 0)) {
            $this->errors[$field][] = "{$label} must be a valid positive number.";
        }
        return $this;
    }

    /** Field value must match the value of another field. */
    public function matches(string $field, string $otherField, string $label = ''): static
    {
        $label = $label ?: ucfirst(str_replace('_', ' ', $field));
        if (($this->data[$field] ?? '') !== ($this->data[$otherField] ?? '')) {
            $this->errors[$field][] = "{$label} does not match.";
        }
        return $this;
    }

    /** Field must be one of the allowed values. */
    public function in(string $field, array $allowed, string $label = ''): static
    {
        $label = $label ?: ucfirst($field);
        if (!empty($this->data[$field]) && !in_array($this->data[$field], $allowed, true)) {
            $this->errors[$field][] = "{$label} contains an invalid value.";
        }
        return $this;
    }

    // ── Results ────────────────────────────────────────────────────────────────

    /** Returns true if any validation errors were found. */
    public function fails(): bool
    {
        return !empty($this->errors);
    }

    /** Returns true when all rules passed. */
    public function passes(): bool
    {
        return empty($this->errors);
    }

    /** Returns the full errors array. */
    public function errors(): array
    {
        return $this->errors;
    }

    /** Returns the first error for a specific field, or null. */
    public function firstError(string $field): ?string
    {
        return $this->errors[$field][0] ?? null;
    }

    /** Returns all errors flattened into a single array. */
    public function allErrors(): array
    {
        return array_merge(...array_values($this->errors));
    }
}
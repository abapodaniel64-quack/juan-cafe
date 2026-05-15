/* ================================================
   JUAN CAFÉ - Auth JavaScript (auth.js)
   Frontend-only login/signup UI interactions
   ================================================ */

/* ================================================
   SHOW / HIDE PASSWORD TOGGLE
   ================================================ */

function initPasswordToggles() {
  // Find all password toggle icons
  const toggleButtons = document.querySelectorAll('.toggle-password');

  toggleButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      // Find the associated input (the previous sibling or specified target)
      const targetId = btn.dataset.target;
      const input = targetId
        ? document.getElementById(targetId)
        : btn.closest('.form-control-wrap')?.querySelector('input');

      if (!input) return;

      // Toggle input type
      if (input.type === 'password') {
        input.type = 'text';
        btn.textContent = '🙈'; // or use FontAwesome: 'fa-eye-slash'
      } else {
        input.type = 'password';
        btn.textContent = '👁️';
      }
    });
  });
}

/* ================================================
   FORM VALIDATION HELPERS
   ================================================ */

/**
 * Validate email format
 * @param {string} email
 * @returns {boolean}
 */
function isValidEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email.trim());
}

/**
 * Show field error
 * @param {HTMLElement} input
 * @param {string} message
 */
function showFieldError(input, message) {
  input.style.borderColor = 'var(--color-danger)';

  // Remove old error if exists
  const existing = input.parentElement.querySelector('.field-error');
  if (existing) existing.remove();

  const error = document.createElement('span');
  error.className = 'field-error';
  error.style.cssText = 'color: var(--color-danger); font-size: 0.75rem; display: block; margin-top: 4px;';
  error.textContent = message;
  input.parentElement.appendChild(error);
}

/**
 * Clear field error
 * @param {HTMLElement} input
 */
function clearFieldError(input) {
  input.style.borderColor = '';
  const existing = input.parentElement.querySelector('.field-error');
  if (existing) existing.remove();
}

/* ================================================
   LOGIN FORM VALIDATION (Frontend only)
   ================================================ */

const loginForm = document.getElementById('login-form');

if (loginForm) {
  loginForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const emailInput = document.getElementById('login-email');
    const passwordInput = document.getElementById('login-password');
    let valid = true;

    // Clear previous errors
    clearFieldError(emailInput);
    clearFieldError(passwordInput);

    // Validate email
    if (!emailInput.value.trim()) {
      showFieldError(emailInput, 'Email is required.');
      valid = false;
    } else if (!isValidEmail(emailInput.value)) {
      showFieldError(emailInput, 'Please enter a valid email address.');
      valid = false;
    }

    // Validate password
    if (!passwordInput.value.trim()) {
      showFieldError(passwordInput, 'Password is required.');
      valid = false;
    } else if (passwordInput.value.length < 6) {
      showFieldError(passwordInput, 'Password must be at least 6 characters.');
      valid = false;
    }

    if (!valid) return;

    // Simulate login (frontend demo only)
    const submitBtn = loginForm.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Logging in...';

    setTimeout(function () {
      // Fake successful login for UI demo
      showToast('Login successful! Redirecting...', 'success', 3000);

      setTimeout(function () {
        // Redirect to user dashboard (demo)
        window.location.href = '../user/dashboard.php';
      }, 1500);
    }, 1200);
  });

  // Clear error on input
  loginForm.querySelectorAll('input').forEach(function (input) {
    input.addEventListener('input', function () {
      clearFieldError(input);
    });
  });
}

/* ================================================
   SIGNUP FORM VALIDATION (Frontend only)
   ================================================ */

const signupForm = document.getElementById('signup-form');

if (signupForm) {
  signupForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const nameInput     = document.getElementById('signup-name');
    const emailInput    = document.getElementById('signup-email');
    const passwordInput = document.getElementById('signup-password');
    const confirmInput  = document.getElementById('signup-confirm');
    let valid = true;

    // Clear all errors
    [nameInput, emailInput, passwordInput, confirmInput].forEach(clearFieldError);

    // Validate full name
    if (!nameInput.value.trim()) {
      showFieldError(nameInput, 'Full name is required.');
      valid = false;
    } else if (nameInput.value.trim().length < 2) {
      showFieldError(nameInput, 'Please enter your full name.');
      valid = false;
    }

    // Validate email
    if (!emailInput.value.trim()) {
      showFieldError(emailInput, 'Email is required.');
      valid = false;
    } else if (!isValidEmail(emailInput.value)) {
      showFieldError(emailInput, 'Please enter a valid email address.');
      valid = false;
    }

    // Validate password
    if (!passwordInput.value.trim()) {
      showFieldError(passwordInput, 'Password is required.');
      valid = false;
    } else if (passwordInput.value.length < 6) {
      showFieldError(passwordInput, 'Password must be at least 6 characters.');
      valid = false;
    }

    // Validate confirm password
    if (!confirmInput.value.trim()) {
      showFieldError(confirmInput, 'Please confirm your password.');
      valid = false;
    } else if (confirmInput.value !== passwordInput.value) {
      showFieldError(confirmInput, 'Passwords do not match.');
      valid = false;
    }

    if (!valid) return;

    // Simulate signup
    const submitBtn = signupForm.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Creating Account...';

    setTimeout(function () {
      showToast('Account created successfully! Please log in.', 'success', 4000);

      setTimeout(function () {
        window.location.href = 'login.php';
      }, 2000);
    }, 1500);
  });

  // Live password match feedback
  const confirmInput = document.getElementById('signup-confirm');
  const passwordInput = document.getElementById('signup-password');

  if (confirmInput && passwordInput) {
    confirmInput.addEventListener('input', function () {
      if (confirmInput.value && confirmInput.value !== passwordInput.value) {
        showFieldError(confirmInput, 'Passwords do not match.');
      } else {
        clearFieldError(confirmInput);
      }
    });
  }

  // Clear errors on input
  signupForm.querySelectorAll('input').forEach(function (input) {
    input.addEventListener('input', function () {
      clearFieldError(input);
    });
  });
}

/* ================================================
   INIT
   ================================================ */

document.addEventListener('DOMContentLoaded', function () {
  initPasswordToggles();
});
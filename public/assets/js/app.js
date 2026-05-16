/* ================================================
   JUAN CAFÉ - Main App JavaScript (app.js)
   General UI interactions and utilities
   ================================================ */

/* ================================================
   NAVBAR - Scroll behavior & hamburger
   ================================================ */

const navbar = document.querySelector('.navbar');
const hamburger = document.querySelector('.hamburger');
const mobileNav = document.querySelector('.mobile-nav');

// Add shadow to navbar on scroll
window.addEventListener('scroll', function () {
  if (window.scrollY > 30) {
    navbar?.classList.add('scrolled');
  } else {
    navbar?.classList.remove('scrolled');
  }

  // Show / hide back-to-top button
  const backToTop = document.querySelector('.back-to-top');
  if (backToTop) {
    if (window.scrollY > 400) {
      backToTop.classList.add('show');
    } else {
      backToTop.classList.remove('show');
    }
  }
});

// Hamburger toggle for mobile nav
if (hamburger) {
  hamburger.addEventListener('click', function () {
    hamburger.classList.toggle('open');
    mobileNav?.classList.toggle('open');
  });
}

// Close mobile nav when a link is clicked
document.querySelectorAll('.mobile-nav .nav-link').forEach(function (link) {
  link.addEventListener('click', function () {
    hamburger?.classList.remove('open');
    mobileNav?.classList.remove('open');
  });
});

/* ================================================
   BACK TO TOP BUTTON
   ================================================ */

const backToTopBtn = document.querySelector('.back-to-top');
if (backToTopBtn) {
  backToTopBtn.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

/* ================================================
   ACTIVE NAV LINK
   Highlights the correct link based on current page
   ================================================ */

function setActiveNavLink() {
  const currentPage = window.location.pathname.split('/').pop() || 'index.php';
  const navLinks = document.querySelectorAll('.nav-link, .mobile-nav .nav-link');

  navLinks.forEach(function (link) {
    const href = link.getAttribute('href');
    if (href && href.includes(currentPage)) {
      link.classList.add('active');
    }
  });
}

setActiveNavLink();

/* ================================================
   SIDEBAR TOGGLE (User Dashboard)
   ================================================ */

const sidebarToggleBtn = document.querySelector('.sidebar-toggle-btn');
const sidebar = document.querySelector('.sidebar');
const dashboardMain = document.querySelector('.dashboard-main');

if (sidebarToggleBtn && sidebar) {
  sidebarToggleBtn.addEventListener('click', function () {
    sidebar.classList.toggle('collapsed');
    // Update toggle icon direction
    const icon = sidebarToggleBtn.querySelector('i');
    if (icon) {
      icon.className = sidebar.classList.contains('collapsed')
        ? 'fas fa-chevron-right'
        : 'fas fa-chevron-left';
    }
  });
}

/* ================================================
   SIDEBAR MOBILE OVERLAY
   ================================================ */

const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const sidebarOverlay = document.querySelector('.sidebar-overlay');

if (mobileMenuBtn) {
  mobileMenuBtn.addEventListener('click', function () {
    sidebar?.classList.toggle('mobile-open');
    sidebarOverlay?.classList.toggle('show');
  });
}

if (sidebarOverlay) {
  sidebarOverlay.addEventListener('click', function () {
    sidebar?.classList.remove('mobile-open');
    document.querySelector('.admin-sidebar')?.classList.remove('mobile-open');
    sidebarOverlay.classList.remove('show');
  });
}

/* ================================================
   ADMIN SIDEBAR TOGGLE
   ================================================ */

const adminSidebarToggle = document.querySelector('.admin-sidebar-toggle');
const adminSidebar = document.querySelector('.admin-sidebar');
const adminMain = document.querySelector('.admin-main');
const adminTopbar = document.querySelector('.admin-topbar');

if (adminSidebarToggle) {
  adminSidebarToggle.addEventListener('click', function () {
    adminSidebar?.classList.toggle('collapsed');
    adminMain?.classList.toggle('expanded');
    adminTopbar?.classList.toggle('expanded');
  });
}

/* ================================================
   PRODUCT SEARCH & FILTER
   ================================================ */

const searchInput = document.querySelector('#product-search');
const productCards = document.querySelectorAll('.product-card');
const filterTabs = document.querySelectorAll('.filter-tab');

// Live search filter
if (searchInput) {
  searchInput.addEventListener('input', function () {
    const query = searchInput.value.toLowerCase().trim();
    const activeCategory = document.querySelector('.filter-tab.active')?.dataset.category || 'all';

    productCards.forEach(function (card) {
      const name = card.querySelector('.product-name')?.textContent.toLowerCase() || '';
      const category = card.dataset.category || '';
      const matchesSearch = name.includes(query);
      const matchesCategory = activeCategory === 'all' || category === activeCategory;

      card.style.display = matchesSearch && matchesCategory ? '' : 'none';
    });
  });
}

// Category filter tabs
filterTabs.forEach(function (tab) {
  tab.addEventListener('click', function () {
    // Remove active from all tabs
    filterTabs.forEach(t => t.classList.remove('active'));
    tab.classList.add('active');

    const selectedCategory = tab.dataset.category || 'all';
    const searchQuery = searchInput?.value.toLowerCase().trim() || '';

    productCards.forEach(function (card) {
      const name = card.querySelector('.product-name')?.textContent.toLowerCase() || '';
      const category = card.dataset.category || '';
      const matchesSearch = !searchQuery || name.includes(searchQuery);
      const matchesCategory = selectedCategory === 'all' || category === selectedCategory;

      card.style.display = matchesSearch && matchesCategory ? '' : 'none';
    });
  });
});

/* ================================================
   FAQ ACCORDION
   ================================================ */

const faqItems = document.querySelectorAll('.faq-item');

faqItems.forEach(function (item) {
  const question = item.querySelector('.faq-question');
  const answer = item.querySelector('.faq-answer');
  const icon = question?.querySelector('.faq-icon');

  if (question && answer) {
    question.addEventListener('click', function () {
      const isOpen = answer.classList.contains('open');

      // Close all others
      document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
      document.querySelectorAll('.faq-icon').forEach(i => {
        if (i) i.textContent = '+';
      });

      // Toggle this one
      if (!isOpen) {
        answer.classList.add('open');
        if (icon) icon.textContent = '−';
      }
    });
  }
});

/* ================================================
   MODAL UTILITY
   ================================================ */

/**
 * Open a modal by its ID
 * @param {string} modalId - The ID of the modal overlay
 */
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
}

/**
 * Close a modal by its ID
 * @param {string} modalId - The ID of the modal overlay
 */
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('open');
    document.body.style.overflow = '';
  }
}

// Close modal on overlay click
document.querySelectorAll('.modal-overlay').forEach(function (overlay) {
  overlay.addEventListener('click', function (e) {
    if (e.target === overlay) {
      overlay.classList.remove('open');
      document.body.style.overflow = '';
    }
  });
});

// Close modal buttons
document.querySelectorAll('.modal-close').forEach(function (btn) {
  btn.addEventListener('click', function () {
    const overlay = btn.closest('.modal-overlay');
    if (overlay) {
      overlay.classList.remove('open');
      document.body.style.overflow = '';
    }
  });
});

/* ================================================
   TOAST NOTIFICATION UTILITY
   ================================================ */

/**
 * Show a toast notification
 * @param {string} message  - Main message text
 * @param {string} type     - 'success' | 'warning' | 'danger' | '' (default)
 * @param {number} duration - Duration in ms (default 3500)
 */
function showToast(message, type = '', duration = 3500) {
  let container = document.querySelector('.toast-container');
  if (!container) {
    container = document.createElement('div');
    container.className = 'toast-container';
    document.body.appendChild(container);
  }

  const icons = {
    success: '✅',
    warning: '⚠️',
    danger: '❌',
    '': '☕'
  };

  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  toast.innerHTML = `
    <div class="toast-icon">${icons[type] || '☕'}</div>
    <div class="toast-content">
      <p>${message}</p>
      <span>Juan Café</span>
    </div>
    <button class="toast-close" onclick="this.closest('.toast').remove()">✕</button>
  `;

  container.appendChild(toast);

  // Auto remove after duration
  setTimeout(function () {
    toast.style.animation = 'none';
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(100%)';
    toast.style.transition = 'all 0.3s ease';
    setTimeout(() => toast.remove(), 300);
  }, duration);
}

/* ================================================
   SMOOTH SCROLL for anchor links
   ================================================ */

document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
  anchor.addEventListener('click', function (e) {
    const target = document.querySelector(anchor.getAttribute('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

/* ================================================
   DEMO: Show a welcome toast on homepage load
   ================================================ */

window.addEventListener('load', function () {
  const isHome = window.location.pathname.endsWith('index.php')
    || window.location.pathname.endsWith('/')
    || window.location.pathname === '';

  if (isHome) {
    setTimeout(function () {
      showToast('Welcome to Juan Café! ☕ Browse our menu.', '', 4000);
    }, 1500);
  }
});
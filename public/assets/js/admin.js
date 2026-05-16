/* ================================================
   JUAN CAFÉ - Admin JavaScript (admin.js)
   Frontend-only admin dashboard interactions
   ================================================ */

/* ================================================
   ADMIN SIDEBAR TOGGLE
   ================================================ */

document.addEventListener('DOMContentLoaded', function () {

  const adminSidebar = document.querySelector('.admin-sidebar');
  const adminMain    = document.querySelector('.admin-main');
  const adminTopbar  = document.querySelector('.admin-topbar');
  const toggleBtn    = document.querySelector('.admin-sidebar-toggle');
  const overlay      = document.querySelector('.sidebar-overlay');

  // Desktop: collapse/expand sidebar
  if (toggleBtn) {
    toggleBtn.addEventListener('click', function () {
      adminSidebar?.classList.toggle('collapsed');
      adminMain?.classList.toggle('expanded');
      adminTopbar?.classList.toggle('expanded');
    });
  }

  // Mobile: open sidebar
  const mobileToggle = document.querySelector('.mobile-menu-btn');
  if (mobileToggle) {
    mobileToggle.addEventListener('click', function () {
      adminSidebar?.classList.toggle('mobile-open');
      overlay?.classList.toggle('show');
    });
  }

  // Close on overlay click
  if (overlay) {
    overlay.addEventListener('click', function () {
      adminSidebar?.classList.remove('mobile-open');
      overlay.classList.remove('show');
    });
  }

  /* ================================================
     PRODUCT SEARCH - Admin Products Table
     ================================================ */

  const adminProductSearch = document.getElementById('admin-product-search');
  const adminTableRows = document.querySelectorAll('#admin-products-table tbody tr');

  if (adminProductSearch) {
    adminProductSearch.addEventListener('input', function () {
      const query = adminProductSearch.value.toLowerCase().trim();

      adminTableRows.forEach(function (row) {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? '' : 'none';
      });
    });
  }

  /* ================================================
     ORDERS SEARCH - Admin Orders Table
     ================================================ */

  const adminOrderSearch = document.getElementById('admin-order-search');
  const adminOrderRows = document.querySelectorAll('#admin-orders-table tbody tr');

  if (adminOrderSearch) {
    adminOrderSearch.addEventListener('input', function () {
      const query = adminOrderSearch.value.toLowerCase().trim();

      adminOrderRows.forEach(function (row) {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? '' : 'none';
      });
    });
  }

  /* ================================================
     USERS SEARCH - Admin Users Table
     ================================================ */

  const adminUserSearch = document.getElementById('admin-user-search');
  const adminUserRows = document.querySelectorAll('#admin-users-table tbody tr');

  if (adminUserSearch) {
    adminUserSearch.addEventListener('input', function () {
      const query = adminUserSearch.value.toLowerCase().trim();

      adminUserRows.forEach(function (row) {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? '' : 'none';
      });
    });
  }

  /* ================================================
     ADD PRODUCT MODAL
     ================================================ */

  const addProductBtn = document.getElementById('add-product-btn');
  if (addProductBtn) {
    addProductBtn.addEventListener('click', function () {
      openModal('add-product-modal');
    });
  }

  // Add product form (demo only)
  const addProductForm = document.getElementById('add-product-form');
  if (addProductForm) {
    addProductForm.addEventListener('submit', function (e) {
      e.preventDefault();
      closeModal('add-product-modal');
      showToast('Product added successfully! ✅', 'success');
      addProductForm.reset();
    });
  }

  /* ================================================
     ORDER STATUS QUICK UPDATE
     ================================================ */

  document.querySelectorAll('.order-status-select').forEach(function (select) {
    select.addEventListener('change', function () {
      const orderId = select.dataset.orderId;
      const status = select.value;
      showToast(`Order #${orderId} status updated to "${status}".`, 'success');
    });
  });

  /* ================================================
     CONFIRM DELETE
     ================================================ */

  document.querySelectorAll('.delete-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      const itemType = btn.dataset.type || 'item';
      const itemName = btn.dataset.name || '';
      const confirmed = confirm(`Are you sure you want to delete ${itemName ? '"' + itemName + '"' : 'this ' + itemType}? This cannot be undone.`);

      if (confirmed) {
        // In a real app, this would send a DELETE request
        const row = btn.closest('tr') || btn.closest('.inventory-card');
        if (row) {
          row.style.opacity = '0.4';
          row.style.transition = 'opacity 0.3s ease';
          setTimeout(() => row.remove(), 300);
        }
        showToast(`${itemType.charAt(0).toUpperCase() + itemType.slice(1)} deleted.`, 'danger');
      }
    });
  });

  /* ================================================
     INVENTORY LOW STOCK HIGHLIGHTS
     ================================================ */

  document.querySelectorAll('.stock-bar').forEach(function (bar) {
    const pct = parseInt(bar.style.width || bar.dataset.pct || '100');

    if (pct <= 15) {
      bar.classList.add('empty');
    } else if (pct <= 35) {
      bar.classList.add('low');
    }
  });

  /* ================================================
     REPORTS DATE RANGE FILTER (Demo)
     ================================================ */

  const dateRangeSelect = document.getElementById('report-date-range');
  if (dateRangeSelect) {
    dateRangeSelect.addEventListener('change', function () {
      showToast(`Report data filtered: ${dateRangeSelect.value}`, '', 2000);
    });
  }

  /* ================================================
     ANIMATE BAR CHART
     ================================================ */

  const barFills = document.querySelectorAll('.bar-fill');
  barFills.forEach(function (bar) {
    const targetHeight = bar.dataset.height || '50%';
    bar.style.height = '0';
    setTimeout(function () {
      bar.style.height = targetHeight;
    }, 300);
  });

  /* ================================================
     ADMIN ACTIVE NAV LINK
     ================================================ */

  const currentPage = window.location.pathname.split('/').pop();
  document.querySelectorAll('.admin-nav-link').forEach(function (link) {
    const href = link.getAttribute('href');
    if (href && href.includes(currentPage)) {
      link.classList.add('active');
    }
  });

});

/* ================================================
   EXPORT: openModal / closeModal / showToast
   (These are defined in app.js — ensure app.js loads first)
   ================================================ */
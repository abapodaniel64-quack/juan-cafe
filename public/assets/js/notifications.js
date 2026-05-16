/* ================================================
   JUAN CAFÉ - Notifications JavaScript (notifications.js)
   Frontend-only notification interactions
   ================================================ */

/* ================================================
   DUMMY NOTIFICATION DATA
   Replace with real API data later
   ================================================ */

const dummyNotifications = [
  {
    id: 1,
    title: 'Order Confirmed! 🎉',
    body: 'Your order #JC-00124 has been confirmed and is being prepared.',
    time: '2 minutes ago',
    type: 'order',
    icon: '☕',
    iconBg: 'rgba(111, 78, 55, 0.1)',
    iconColor: 'var(--color-coffee)',
    unread: true
  },
  {
    id: 2,
    title: 'Order is Ready!',
    body: 'Your order #JC-00123 is ready for pickup at the counter.',
    time: '15 minutes ago',
    type: 'order',
    icon: '✅',
    iconBg: 'rgba(76, 175, 80, 0.1)',
    iconColor: 'var(--color-success)',
    unread: true
  },
  {
    id: 3,
    title: 'Special Promo Today!',
    body: 'Buy 2 Milk Teas and get a free cookie. Valid today only!',
    time: '1 hour ago',
    type: 'promo',
    icon: '🎁',
    iconBg: 'rgba(200, 148, 42, 0.1)',
    iconColor: 'var(--color-gold)',
    unread: false
  },
  {
    id: 4,
    title: 'Payment Received',
    body: 'Your payment of ₱220.00 for order #JC-00122 was received.',
    time: '2 hours ago',
    type: 'payment',
    icon: '💳',
    iconBg: 'rgba(33, 150, 243, 0.1)',
    iconColor: 'var(--color-info)',
    unread: false
  },
  {
    id: 5,
    title: 'Welcome to Juan Café!',
    body: 'Thanks for signing up! Start exploring our menu and earn rewards.',
    time: '3 days ago',
    type: 'system',
    icon: '🏠',
    iconBg: 'rgba(111, 78, 55, 0.1)',
    iconColor: 'var(--color-coffee)',
    unread: false
  }
];

/* ================================================
   UNREAD COUNT
   ================================================ */

function getUnreadCount() {
  return dummyNotifications.filter(n => n.unread).length;
}

/* ================================================
   UPDATE NOTIFICATION BADGE
   ================================================ */

function updateNotifBadge() {
  const badges = document.querySelectorAll('.notif-badge');
  const count = getUnreadCount();

  badges.forEach(function (badge) {
    badge.textContent = count;
    badge.style.display = count > 0 ? 'flex' : 'none';
  });
}

/* ================================================
   RENDER NOTIFICATION LIST
   Used on the notifications.php page
   ================================================ */

function renderNotifications(filter = 'all') {
  const container = document.getElementById('notifications-list');
  if (!container) return;

  let items = dummyNotifications;

  // Apply filter
  if (filter === 'unread') {
    items = items.filter(n => n.unread);
  } else if (filter !== 'all') {
    items = items.filter(n => n.type === filter);
  }

  if (items.length === 0) {
    container.innerHTML = `
      <div style="text-align: center; padding: 60px 0; color: var(--text-muted);">
        <div style="font-size: 3rem; margin-bottom: 16px; opacity: 0.4;">🔔</div>
        <p>No notifications found.</p>
      </div>
    `;
    return;
  }

  container.innerHTML = items.map(function (notif) {
    return `
      <div class="notification-card ${notif.unread ? 'unread' : ''}" data-id="${notif.id}">
        <div class="notif-icon" style="background: ${notif.iconBg}; color: ${notif.iconColor};">
          ${notif.icon}
        </div>
        <div class="notif-content" style="flex: 1;">
          <div class="notif-title">${notif.title}</div>
          <div class="notif-body">${notif.body}</div>
          <div class="notif-time">🕐 ${notif.time}</div>
        </div>
        ${notif.unread ? '<div class="unread-dot"></div>' : ''}
        <button
          onclick="markAsRead(${notif.id})"
          style="background: none; border: none; color: var(--text-muted); cursor: pointer; font-size: 0.8rem; padding: 4px 8px; border-radius: 4px; white-space: nowrap;"
          title="Mark as read"
        >
          ${notif.unread ? '✓ Read' : ''}
        </button>
      </div>
    `;
  }).join('');
}

/* ================================================
   MARK AS READ
   ================================================ */

function markAsRead(notifId) {
  const notif = dummyNotifications.find(n => n.id === notifId);
  if (notif && notif.unread) {
    notif.unread = false;
    renderNotifications(getCurrentFilter());
    updateNotifBadge();
    showToast('Notification marked as read.', 'success');
  }
}

/* ================================================
   MARK ALL AS READ
   ================================================ */

function markAllAsRead() {
  dummyNotifications.forEach(n => n.unread = false);
  renderNotifications(getCurrentFilter());
  updateNotifBadge();
  showToast('All notifications marked as read.', 'success');
}

/* ================================================
   GET CURRENT FILTER
   Reads the active filter tab
   ================================================ */

function getCurrentFilter() {
  return document.querySelector('.notif-filter-btn.active')?.dataset.filter || 'all';
}

/* ================================================
   FILTER BUTTONS
   ================================================ */

function initNotifFilters() {
  const filterBtns = document.querySelectorAll('.notif-filter-btn');

  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      renderNotifications(btn.dataset.filter || 'all');
    });
  });
}

/* ================================================
   NOTIFICATION DROPDOWN (in navbar)
   Shows a small popup with recent notifications
   ================================================ */

function renderNotifDropdown() {
  const dropdown = document.getElementById('notif-dropdown');
  if (!dropdown) return;

  const recent = dummyNotifications.slice(0, 3);

  dropdown.innerHTML = `
    <div style="padding: 16px; border-bottom: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center;">
      <strong style="font-size: 0.9rem; color: var(--color-espresso);">Notifications</strong>
      <button onclick="markAllAsRead()" style="font-size: 0.75rem; color: var(--color-coffee); background: none; border: none; cursor: pointer;">Mark all read</button>
    </div>
    ${recent.map(n => `
      <div style="padding: 12px 16px; border-bottom: 1px solid var(--border-light); background: ${n.unread ? 'rgba(245,230,211,0.4)' : 'white'};">
        <div style="font-size: 0.8rem; font-weight: 600; color: var(--color-espresso); margin-bottom: 2px;">${n.icon} ${n.title}</div>
        <div style="font-size: 0.75rem; color: var(--text-muted);">${n.body}</div>
        <div style="font-size: 0.7rem; color: var(--text-muted); margin-top: 4px;">${n.time}</div>
      </div>
    `).join('')}
    <div style="padding: 10px 16px; text-align: center;">
      <a href="../user/notifications.php" style="font-size: 0.8rem; color: var(--color-coffee); font-weight: 600;">View all notifications →</a>
    </div>
  `;
}

/* ================================================
   ADMIN: Render Admin Notifications
   ================================================ */

const adminNotifications = [
  {
    id: 101,
    title: 'New Order Received',
    body: 'Order #JC-00125 placed by Maria Santos — ₱220.00',
    time: 'Just now',
    type: 'order',
    icon: '📦',
    unread: true
  },
  {
    id: 102,
    title: 'Low Stock Alert',
    body: 'Brown Sugar Syrup is running low. Only 3 units left.',
    time: '10 minutes ago',
    type: 'inventory',
    icon: '⚠️',
    unread: true
  },
  {
    id: 103,
    title: 'New User Registered',
    body: 'Juan dela Cruz created a new account.',
    time: '1 hour ago',
    type: 'user',
    icon: '👤',
    unread: false
  },
  {
    id: 104,
    title: 'Daily Sales Report',
    body: 'Total sales for today: ₱8,450.00 from 62 orders.',
    time: '6 hours ago',
    type: 'report',
    icon: '📊',
    unread: false
  }
];

function renderAdminNotifications(filter = 'all') {
  const container = document.getElementById('admin-notifications-list');
  if (!container) return;

  let items = adminNotifications;

  if (filter !== 'all') {
    items = filter === 'unread'
      ? items.filter(n => n.unread)
      : items.filter(n => n.type === filter);
  }

  if (items.length === 0) {
    container.innerHTML = `<div style="text-align: center; padding: 40px; color: var(--text-muted);">No notifications found.</div>`;
    return;
  }

  container.innerHTML = items.map(function (notif) {
    return `
      <div class="notification-card ${notif.unread ? 'unread' : ''}">
        <div class="notif-icon" style="background: rgba(111,78,55,0.1); color: var(--color-coffee); font-size: 1.3rem;">
          ${notif.icon}
        </div>
        <div style="flex: 1;">
          <div class="notif-title">${notif.title}</div>
          <div class="notif-body">${notif.body}</div>
          <div class="notif-time">🕐 ${notif.time}</div>
        </div>
        ${notif.unread ? '<div class="unread-dot"></div>' : ''}
      </div>
    `;
  }).join('');
}

/* ================================================
   INIT on DOM Ready
   ================================================ */

document.addEventListener('DOMContentLoaded', function () {
  updateNotifBadge();
  renderNotifications();
  renderAdminNotifications();
  renderNotifDropdown();
  initNotifFilters();

  // Admin filter buttons
  document.querySelectorAll('.admin-notif-filter-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.admin-notif-filter-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      renderAdminNotifications(btn.dataset.filter || 'all');
    });
  });
});
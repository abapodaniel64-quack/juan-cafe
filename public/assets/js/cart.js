/* ================================================
   JUAN CAFÉ - Cart JavaScript (cart.js)
   Frontend cart interactions (no backend)
   ================================================ */

/* ================================================
   CART STATE
   Stores cart items in memory (no backend yet)
   ================================================ */

let cartItems = [
  // Sample pre-loaded items for demo
  {
    id: 1,
    name: 'Classic Milk Tea',
    category: 'Milk Tea',
    price: 75,
    qty: 2
  },
  {
    id: 2,
    name: 'Brown Sugar Coffee',
    category: 'Coffee',
    price: 95,
    qty: 1
  },
  {
    id: 3,
    name: 'Lychee Fruit Tea',
    category: 'Fruit Tea',
    price: 80,
    qty: 1
  }
];

/* ================================================
   CART BADGE UPDATE
   Updates the cart badge count in the navbar
   ================================================ */

function updateCartBadge() {
  const badge = document.querySelector('.cart-badge');
  const totalItems = cartItems.reduce((sum, item) => sum + item.qty, 0);

  if (badge) {
    badge.textContent = totalItems;
    badge.style.display = totalItems > 0 ? 'flex' : 'none';
  }
}

/* ================================================
   CALCULATE TOTALS
   ================================================ */

function getCartSubtotal() {
  return cartItems.reduce((sum, item) => sum + (item.price * item.qty), 0);
}

function getCartTotal() {
  const subtotal = getCartSubtotal();
  const delivery = subtotal > 0 ? 50 : 0; // Flat delivery fee
  const discount = 0; // No discount for now
  return subtotal + delivery - discount;
}

/* ================================================
   RENDER CART ITEMS
   Renders cart items in the cart page
   ================================================ */

function renderCartItems() {
  const cartList = document.getElementById('cart-items-list');
  if (!cartList) return;

  if (cartItems.length === 0) {
    cartList.innerHTML = `
      <div style="text-align: center; padding: 60px 0; color: var(--text-muted);">
        <div style="font-size: 3rem; margin-bottom: 16px; opacity: 0.4;">🛒</div>
        <p style="font-size: 1rem; margin-bottom: 24px;">Your cart is empty.</p>
        <a href="../products/products.php" class="btn btn-primary">Browse Menu</a>
      </div>
    `;
    updateCartSummary();
    return;
  }

  cartList.innerHTML = cartItems.map(function (item) {
    return `
      <div class="cart-item" data-id="${item.id}">
        <div class="cart-item-img">☕</div>
        <div class="cart-item-info">
          <div class="cart-item-name">${item.name}</div>
          <div class="cart-item-cat">${item.category}</div>
          <div class="qty-control">
            <button class="qty-btn" onclick="changeQty(${item.id}, -1)">−</button>
            <span class="qty-display">${item.qty}</span>
            <button class="qty-btn" onclick="changeQty(${item.id}, 1)">+</button>
            <button
              onclick="removeCartItem(${item.id})"
              style="margin-left: 8px; background: none; border: none; color: var(--color-danger); font-size: 0.85rem; cursor: pointer;"
              title="Remove item"
            >🗑️</button>
          </div>
        </div>
        <div class="cart-item-price">₱${(item.price * item.qty).toFixed(2)}</div>
      </div>
    `;
  }).join('');

  updateCartSummary();
  updateCartBadge();
}

/* ================================================
   UPDATE CART SUMMARY PANEL
   ================================================ */

function updateCartSummary() {
  const subtotalEl  = document.getElementById('cart-subtotal');
  const deliveryEl  = document.getElementById('cart-delivery');
  const discountEl  = document.getElementById('cart-discount');
  const totalEl     = document.getElementById('cart-total');
  const checkoutBtn = document.getElementById('checkout-btn');

  const subtotal = getCartSubtotal();
  const delivery = subtotal > 0 ? 50 : 0;
  const discount = 0;
  const total    = subtotal + delivery - discount;

  if (subtotalEl) subtotalEl.textContent = `₱${subtotal.toFixed(2)}`;
  if (deliveryEl) deliveryEl.textContent = `₱${delivery.toFixed(2)}`;
  if (discountEl) discountEl.textContent = `−₱${discount.toFixed(2)}`;
  if (totalEl)    totalEl.textContent    = `₱${total.toFixed(2)}`;

  if (checkoutBtn) {
    checkoutBtn.disabled = cartItems.length === 0;
  }
}

/* ================================================
   CHANGE QUANTITY
   ================================================ */

function changeQty(itemId, delta) {
  const item = cartItems.find(i => i.id === itemId);
  if (!item) return;

  item.qty += delta;

  if (item.qty <= 0) {
    removeCartItem(itemId);
    return;
  }

  renderCartItems();
}

/* ================================================
   REMOVE CART ITEM
   ================================================ */

function removeCartItem(itemId) {
  cartItems = cartItems.filter(i => i.id !== itemId);
  renderCartItems();
  showToast('Item removed from cart.', 'warning');
}

/* ================================================
   ADD TO CART
   Triggered by "Add to Cart" buttons on product cards
   ================================================ */

function addToCart(productId, name, category, price) {
  const existing = cartItems.find(i => i.id === productId);

  if (existing) {
    existing.qty += 1;
    showToast(`Added another "${name}" to cart! ☕`, 'success');
  } else {
    cartItems.push({
      id: productId,
      name: name,
      category: category,
      price: price,
      qty: 1
    });
    showToast(`"${name}" added to cart! ☕`, 'success');
  }

  updateCartBadge();

  // If we're on the cart page, re-render
  renderCartItems();
}

/* ================================================
   CLEAR CART
   ================================================ */

function clearCart() {
  if (cartItems.length === 0) {
    showToast('Your cart is already empty.', 'warning');
    return;
  }

  if (confirm('Are you sure you want to clear the cart?')) {
    cartItems = [];
    renderCartItems();
    showToast('Cart cleared.', 'warning');
  }
}

/* ================================================
   FAKE CHECKOUT
   ================================================ */

function proceedToCheckout() {
  if (cartItems.length === 0) {
    showToast('Your cart is empty!', 'warning');
    return;
  }

  // Simulate loading
  const btn = document.getElementById('checkout-btn');
  if (btn) {
    btn.disabled = true;
    btn.textContent = 'Processing...';
  }

  setTimeout(function () {
    showToast('Order placed successfully! 🎉', 'success', 5000);

    // Reset cart after "checkout"
    cartItems = [];
    renderCartItems();

    if (btn) {
      btn.disabled = false;
      btn.textContent = 'Place Order';
    }
  }, 2000);
}

/* ================================================
   ATTACH ADD TO CART BUTTON EVENTS
   ================================================ */

document.querySelectorAll('.add-to-cart-btn').forEach(function (btn) {
  btn.addEventListener('click', function () {
    const card = btn.closest('.product-card');
    if (!card) return;

    const id       = parseInt(card.dataset.productId || Math.random() * 1000);
    const name     = card.querySelector('.product-name')?.textContent || 'Product';
    const category = card.dataset.category || 'Drink';
    const priceText= card.querySelector('.product-price')?.textContent || '0';
    const price    = parseFloat(priceText.replace(/[^0-9.]/g, '')) || 0;

    addToCart(id, name, category, price);
  });
});

/* ================================================
   INIT
   ================================================ */

// Initialize cart badge and cart page on load
document.addEventListener('DOMContentLoaded', function () {
  updateCartBadge();
  renderCartItems();
});
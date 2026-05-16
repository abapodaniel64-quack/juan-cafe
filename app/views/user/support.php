<?php
/**
 * JUAN CAFÉ - User Support Page
 * File: app/views/user/support.php
 *
 * Frontend only - no backend logic
 */
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<!-- ================================================
     DASHBOARD WRAPPER
     ================================================ -->
<div class="dashboard-wrapper">

  <!-- Mobile Top Bar (hamburger + page title) -->
  <div class="dashboard-topbar">
    <button class="mobile-menu-btn" title="Open menu">
      <i class="fas fa-bars"></i>
    </button>
    <h1 class="dashboard-page-title">Support</h1>
  </div>

  <!-- ================================================
       MAIN CONTENT AREA
       ================================================ -->
  <main class="dashboard-main">
    <div class="dashboard-content">

      <!-- Page Header -->
      <div class="page-header" style="margin-bottom: var(--space-8);">
        <div>
          <h2 style="font-family: var(--font-heading); font-size: var(--text-2xl); color: var(--color-espresso); margin-bottom: var(--space-1);">
            Help & Support
          </h2>
          <p style="color: var(--text-muted); font-size: var(--text-sm);">
            We're here to help you. Browse FAQs or reach out to us directly.
          </p>
        </div>
      </div>

      <!-- ================================================
           SUPPORT CONTACT CARDS
           ================================================ -->
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: var(--space-5); margin-bottom: var(--space-10);">

        <!-- Card: Chat Support -->
        <div style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-6); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); text-align: center; transition: var(--transition-normal);"
             onmouseover="this.style.boxShadow='var(--shadow-md)'; this.style.transform='translateY(-2px)'"
             onmouseout="this.style.boxShadow='var(--shadow-sm)'; this.style.transform='translateY(0)'">
          <div style="width: 56px; height: 56px; background: rgba(111,78,55,0.1); border-radius: var(--border-radius-full); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto var(--space-4);">
            💬
          </div>
          <h3 style="font-family: var(--font-heading); font-size: var(--text-md); color: var(--color-espresso); margin-bottom: var(--space-2);">Live Chat</h3>
          <p style="font-size: var(--text-sm); color: var(--text-muted); margin-bottom: var(--space-4); line-height: 1.6;">
            Chat with our friendly support team in real time.
          </p>
          <span style="display: inline-block; background: rgba(76,175,80,0.12); color: var(--color-success); font-size: var(--text-xs); font-weight: 600; padding: 3px 10px; border-radius: var(--border-radius-full); margin-bottom: var(--space-4);">
            ● Online Now
          </span>
          <br/>
          <button class="btn btn-primary btn-sm" onclick="showToast('Live chat is coming soon! ☕', '')">
            <i class="fas fa-comment-dots"></i> Start Chat
          </button>
        </div>

        <!-- Card: Email Support -->
        <div style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-6); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); text-align: center; transition: var(--transition-normal);"
             onmouseover="this.style.boxShadow='var(--shadow-md)'; this.style.transform='translateY(-2px)'"
             onmouseout="this.style.boxShadow='var(--shadow-sm)'; this.style.transform='translateY(0)'">
          <div style="width: 56px; height: 56px; background: rgba(33,150,243,0.1); border-radius: var(--border-radius-full); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto var(--space-4);">
            ✉️
          </div>
          <h3 style="font-family: var(--font-heading); font-size: var(--text-md); color: var(--color-espresso); margin-bottom: var(--space-2);">Email Us</h3>
          <p style="font-size: var(--text-sm); color: var(--text-muted); margin-bottom: var(--space-4); line-height: 1.6;">
            Send us a message and we'll reply within 24 hours.
          </p>
          <p style="font-size: var(--text-xs); color: var(--color-coffee); font-weight: 600; margin-bottom: var(--space-4);">
            info@juancafe.ph
          </p>
          <a href="/app/views/home/contact.php" class="btn btn-secondary btn-sm">
            <i class="fas fa-envelope"></i> Send Email
          </a>
        </div>

        <!-- Card: Phone Support -->
        <div style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-6); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); text-align: center; transition: var(--transition-normal);"
             onmouseover="this.style.boxShadow='var(--shadow-md)'; this.style.transform='translateY(-2px)'"
             onmouseout="this.style.boxShadow='var(--shadow-sm)'; this.style.transform='translateY(0)'">
          <div style="width: 56px; height: 56px; background: rgba(200,148,42,0.1); border-radius: var(--border-radius-full); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto var(--space-4);">
            📞
          </div>
          <h3 style="font-family: var(--font-heading); font-size: var(--text-md); color: var(--color-espresso); margin-bottom: var(--space-2);">Call Us</h3>
          <p style="font-size: var(--text-sm); color: var(--text-muted); margin-bottom: var(--space-4); line-height: 1.6;">
            Speak directly to our team Mon–Sun, 8AM–10PM.
          </p>
          <p style="font-size: var(--text-xs); color: var(--color-coffee); font-weight: 600; margin-bottom: var(--space-4);">
            +63 (XXX) XXX-XXXX
          </p>
          <button class="btn btn-secondary btn-sm" onclick="showToast('Call us at +63-XXX-XXX-XXXX ☕', '')">
            <i class="fas fa-phone"></i> Call Now
          </button>
        </div>

        <!-- Card: Order Issues -->
        <div style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-6); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); text-align: center; transition: var(--transition-normal);"
             onmouseover="this.style.boxShadow='var(--shadow-md)'; this.style.transform='translateY(-2px)'"
             onmouseout="this.style.boxShadow='var(--shadow-sm)'; this.style.transform='translateY(0)'">
          <div style="width: 56px; height: 56px; background: rgba(229,57,53,0.1); border-radius: var(--border-radius-full); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto var(--space-4);">
            📦
          </div>
          <h3 style="font-family: var(--font-heading); font-size: var(--text-md); color: var(--color-espresso); margin-bottom: var(--space-2);">Order Issue</h3>
          <p style="font-size: var(--text-sm); color: var(--text-muted); margin-bottom: var(--space-4); line-height: 1.6;">
            Problem with an order? We'll fix it right away.
          </p>
          <p style="font-size: var(--text-xs); color: var(--text-muted); margin-bottom: var(--space-4);">
            Avg. response: <strong>under 30 mins</strong>
          </p>
          <a href="/app/views/user/order-history.php" class="btn btn-secondary btn-sm">
            <i class="fas fa-receipt"></i> My Orders
          </a>
        </div>

      </div><!-- /support cards grid -->

      <!-- ================================================
           SUBMIT A TICKET FORM
           ================================================ -->
      <div style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-8); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); margin-bottom: var(--space-10);">

        <h3 style="font-family: var(--font-heading); font-size: var(--text-xl); color: var(--color-espresso); margin-bottom: var(--space-2);">
          Submit a Support Ticket
        </h3>
        <p style="font-size: var(--text-sm); color: var(--text-muted); margin-bottom: var(--space-6);">
          Describe your concern below and our team will get back to you as soon as possible.
        </p>

        <!-- Ticket Form (Frontend UI Only) -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-5);" class="panels-grid">

          <!-- Issue Type -->
          <div>
            <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-espresso); margin-bottom: var(--space-2);">
              Issue Type <span style="color: var(--color-danger);">*</span>
            </label>
            <select style="width: 100%; padding: var(--space-3) var(--space-4); border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: var(--bg-primary); color: var(--text-primary);">
              <option value="">Select issue type...</option>
              <option value="order">Order Problem</option>
              <option value="payment">Payment Issue</option>
              <option value="delivery">Delivery Concern</option>
              <option value="account">Account Problem</option>
              <option value="refund">Refund Request</option>
              <option value="other">Other</option>
            </select>
          </div>

          <!-- Order Number -->
          <div>
            <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-espresso); margin-bottom: var(--space-2);">
              Order Number <span style="color: var(--text-muted); font-weight: 400;">(if applicable)</span>
            </label>
            <input type="text" placeholder="e.g. JC-00124"
              style="width: 100%; padding: var(--space-3) var(--space-4); border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: var(--bg-primary);" />
          </div>

          <!-- Subject -->
          <div style="grid-column: 1 / -1;">
            <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-espresso); margin-bottom: var(--space-2);">
              Subject <span style="color: var(--color-danger);">*</span>
            </label>
            <input type="text" placeholder="Brief description of your concern"
              style="width: 100%; padding: var(--space-3) var(--space-4); border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: var(--bg-primary);" />
          </div>

          <!-- Message -->
          <div style="grid-column: 1 / -1;">
            <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-espresso); margin-bottom: var(--space-2);">
              Message <span style="color: var(--color-danger);">*</span>
            </label>
            <textarea rows="5" placeholder="Describe your issue in detail..."
              style="width: 100%; padding: var(--space-3) var(--space-4); border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: var(--bg-primary); resize: vertical;"></textarea>
          </div>

          <!-- Priority -->
          <div>
            <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-espresso); margin-bottom: var(--space-2);">
              Priority
            </label>
            <select style="width: 100%; padding: var(--space-3) var(--space-4); border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); background: var(--bg-primary); color: var(--text-primary);">
              <option value="low">Low</option>
              <option value="normal" selected>Normal</option>
              <option value="high">High</option>
              <option value="urgent">Urgent</option>
            </select>
          </div>

          <!-- Submit Button -->
          <div style="display: flex; align-items: flex-end;">
            <button class="btn btn-primary btn-block"
              onclick="showToast('Ticket submitted! We\'ll respond soon. ☕', 'success')">
              <i class="fas fa-paper-plane"></i> Submit Ticket
            </button>
          </div>

        </div><!-- /ticket form grid -->
      </div><!-- /ticket form card -->

      <!-- ================================================
           FAQ SECTION
           ================================================ -->
      <div style="margin-bottom: var(--space-10);">
        <h3 style="font-family: var(--font-heading); font-size: var(--text-xl); color: var(--color-espresso); margin-bottom: var(--space-2);">
          Frequently Asked Questions
        </h3>
        <p style="font-size: var(--text-sm); color: var(--text-muted); margin-bottom: var(--space-6);">
          Quick answers to the most common questions.
        </p>

        <!-- FAQ Items (accordion, powered by app.js) -->

        <div class="faq-item">
          <div class="faq-question">
            How do I place an order?
            <span class="faq-icon" style="font-size: 1.2rem; font-weight: 700; color: var(--color-coffee);">+</span>
          </div>
          <div class="faq-answer">
            Browse our menu, click "Add to Cart" on your desired drinks, then go to your cart and click "Place Order." Make sure you're logged in to complete a purchase.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            How long does delivery take?
            <span class="faq-icon" style="font-size: 1.2rem; font-weight: 700; color: var(--color-coffee);">+</span>
          </div>
          <div class="faq-answer">
            Delivery typically takes 20–45 minutes depending on your location and order volume. You'll receive real-time status updates via the notifications section.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            Can I cancel or modify my order?
            <span class="faq-icon" style="font-size: 1.2rem; font-weight: 700; color: var(--color-coffee);">+</span>
          </div>
          <div class="faq-answer">
            Orders can be cancelled within 5 minutes of placement if they haven't been confirmed yet. To modify an order, please contact our support team immediately via Live Chat or phone.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            What payment methods are accepted?
            <span class="faq-icon" style="font-size: 1.2rem; font-weight: 700; color: var(--color-coffee);">+</span>
          </div>
          <div class="faq-answer">
            We currently accept Cash on Delivery (COD), GCash, Maya, and major credit/debit cards. Online payment options are available during checkout.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            How do I request a refund?
            <span class="faq-icon" style="font-size: 1.2rem; font-weight: 700; color: var(--color-coffee);">+</span>
          </div>
          <div class="faq-answer">
            Submit a refund request via the Support Ticket form above, selecting "Refund Request" as the issue type. Include your order number and reason. Refunds are processed within 3–5 business days.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            How do I update my account information?
            <span class="faq-icon" style="font-size: 1.2rem; font-weight: 700; color: var(--color-coffee);">+</span>
          </div>
          <div class="faq-answer">
            Go to <a href="/app/views/user/profile.php" style="color: var(--color-coffee); font-weight: 600;">My Profile</a> from the sidebar to update your name, email, phone number, and delivery address.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            Do you have a loyalty or rewards program?
            <span class="faq-icon" style="font-size: 1.2rem; font-weight: 700; color: var(--color-coffee);">+</span>
          </div>
          <div class="faq-answer">
            Yes! Juan Café has a loyalty points system. Every purchase earns you points that can be redeemed for discounts on future orders. Watch your dashboard for your points balance.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            Are your drinks customizable?
            <span class="faq-icon" style="font-size: 1.2rem; font-weight: 700; color: var(--color-coffee);">+</span>
          </div>
          <div class="faq-answer">
            Absolutely! You can adjust sugar level, ice level, and add-ons (such as pearls, jelly, or cream) when viewing product details. Customizations appear before adding to your cart.
          </div>
        </div>

      </div><!-- /FAQ section -->

      <!-- ================================================
           OPERATING HOURS CARD
           ================================================ -->
      <div style="background: linear-gradient(135deg, var(--color-coffee), var(--color-espresso)); border-radius: var(--border-radius-lg); padding: var(--space-8); color: white; display: flex; align-items: center; gap: var(--space-8); flex-wrap: wrap;">
        <div style="font-size: 3rem;">🕐</div>
        <div>
          <h3 style="font-family: var(--font-heading); font-size: var(--text-xl); margin-bottom: var(--space-2);">Support Hours</h3>
          <p style="opacity: 0.85; font-size: var(--text-sm); line-height: 1.8;">
            Monday – Sunday &nbsp;|&nbsp; <strong>8:00 AM – 10:00 PM</strong><br/>
            Response time: <strong>Live Chat under 5 mins</strong> &nbsp;|&nbsp; Email within <strong>24 hours</strong>
          </p>
        </div>
        <div style="margin-left: auto;">
          <a href="/app/views/home/contact.php" class="btn btn-gold">
            <i class="fas fa-map-marker-alt"></i> Contact Page
          </a>
        </div>
      </div>

    </div><!-- /dashboard-content -->
  </main><!-- /dashboard-main -->

</div><!-- /dashboard-wrapper -->

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
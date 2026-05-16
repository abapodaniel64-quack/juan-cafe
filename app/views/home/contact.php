<?php
/**
 * JUAN CAFÉ - Contact Page
 * File: app/views/home/contact.php
 */
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
?>

<!-- ================================================
     PAGE HERO
     ================================================ -->
<section style="
  background: linear-gradient(135deg, var(--color-espresso), var(--color-coffee));
  padding: calc(var(--navbar-height) + var(--space-16)) 0 var(--space-16);
  text-align: center;
  color: white;
">
  <div class="container">
    <span class="section-badge" style="color: var(--color-gold-light);">Get in Touch</span>
    <h1 class="section-title" style="color: white; font-size: var(--text-4xl);">Contact Us</h1>
    <div class="divider"></div>
    <p style="color: rgba(255,255,255,0.75); max-width: 500px; margin: 0 auto;">
      Have questions or want to know more about franchising? We'd love to hear from you.
    </p>
  </div>
</section>

<!-- ================================================
     CONTACT GRID
     ================================================ -->
<section class="section-padding">
  <div class="container">
    <div class="contact-grid">

      <!-- Left: Contact Information -->
      <div>
        <h2 style="font-family: var(--font-heading); font-size: var(--text-2xl); color: var(--color-espresso); margin-bottom: var(--space-6);">
          Let's Connect
        </h2>

        <!-- Contact Cards -->
        <div class="contact-info-card">
          <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
          <div>
            <strong style="color: var(--color-espresso); display: block; margin-bottom: var(--space-1);">Our Location</strong>
            <span style="color: var(--text-muted); font-size: var(--text-sm);">Philippines · Top Juan Franchising Inc.</span>
          </div>
        </div>

        <div class="contact-info-card">
          <div class="contact-icon"><i class="fas fa-envelope"></i></div>
          <div>
            <strong style="color: var(--color-espresso); display: block; margin-bottom: var(--space-1);">Email Address</strong>
            <a href="mailto:info@juancafe.ph" style="color: var(--color-coffee); font-size: var(--text-sm);">info@juancafe.ph</a>
          </div>
        </div>

        <div class="contact-info-card">
          <div class="contact-icon"><i class="fas fa-phone"></i></div>
          <div>
            <strong style="color: var(--color-espresso); display: block; margin-bottom: var(--space-1);">Phone Number</strong>
            <span style="color: var(--text-muted); font-size: var(--text-sm);">+63 (XXX) XXX-XXXX</span>
          </div>
        </div>

        <div class="contact-info-card">
          <div class="contact-icon"><i class="fas fa-clock"></i></div>
          <div>
            <strong style="color: var(--color-espresso); display: block; margin-bottom: var(--space-1);">Business Hours</strong>
            <span style="color: var(--text-muted); font-size: var(--text-sm);">Mon – Sun: 8:00 AM – 10:00 PM</span>
          </div>
        </div>

        <!-- Map Placeholder -->
        <div class="map-placeholder">
          <i class="fas fa-map-marker-alt" style="font-size: 2rem; opacity: 0.4;"></i>
          <span>Map Placeholder</span>
          <small style="opacity: 0.6;">Replace with Google Maps embed</small>
        </div>

        <!-- Social Media -->
        <div>
          <strong style="color: var(--color-espresso); display: block; margin-bottom: var(--space-4);">Follow Us</strong>
          <div style="display: flex; gap: var(--space-3);">
            <a href="#" style="width: 40px; height: 40px; background: var(--bg-secondary); border-radius: var(--border-radius-full); display: flex; align-items: center; justify-content: center; color: var(--color-coffee); transition: var(--transition-fast);" title="Facebook">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" style="width: 40px; height: 40px; background: var(--bg-secondary); border-radius: var(--border-radius-full); display: flex; align-items: center; justify-content: center; color: var(--color-coffee); transition: var(--transition-fast);" title="Instagram">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" style="width: 40px; height: 40px; background: var(--bg-secondary); border-radius: var(--border-radius-full); display: flex; align-items: center; justify-content: center; color: var(--color-coffee); transition: var(--transition-fast);" title="TikTok">
              <i class="fab fa-tiktok"></i>
            </a>
          </div>
        </div>

      </div><!-- /left column -->

      <!-- Right: Contact Form -->
      <div>
        <div style="background: white; border-radius: var(--border-radius-lg); padding: var(--space-8); border: 1px solid var(--border-light); box-shadow: var(--shadow-md);">
          <h2 style="font-family: var(--font-heading); font-size: var(--text-2xl); color: var(--color-espresso); margin-bottom: var(--space-6);">
            Send Us a Message
          </h2>

          <!-- Contact Form (UI Only) -->
          <div id="contact-form">

            <!-- Full Name -->
            <div class="form-group" style="margin-bottom: var(--space-5);">
              <label class="form-label" style="display: block; font-weight: var(--font-weight-medium); color: var(--color-espresso); margin-bottom: var(--space-2); font-size: var(--text-sm);">
                Full Name <span style="color: var(--color-danger);">*</span>
              </label>
              <div class="form-control-wrap">
                <input type="text" id="contact-name" class="form-input"
                  placeholder="e.g. Juan dela Cruz"
                  style="width: 100%; padding: var(--space-3) var(--space-4); border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); transition: var(--transition-fast); background: var(--bg-primary);"
                />
              </div>
            </div>

            <!-- Email -->
            <div class="form-group" style="margin-bottom: var(--space-5);">
              <label class="form-label" style="display: block; font-weight: var(--font-weight-medium); color: var(--color-espresso); margin-bottom: var(--space-2); font-size: var(--text-sm);">
                Email Address <span style="color: var(--color-danger);">*</span>
              </label>
              <div class="form-control-wrap">
                <input type="email" id="contact-email" class="form-input"
                  placeholder="e.g. juan@email.com"
                  style="width: 100%; padding: var(--space-3) var(--space-4); border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); transition: var(--transition-fast); background: var(--bg-primary);"
                />
              </div>
            </div>

            <!-- Subject -->
            <div class="form-group" style="margin-bottom: var(--space-5);">
              <label class="form-label" style="display: block; font-weight: var(--font-weight-medium); color: var(--color-espresso); margin-bottom: var(--space-2); font-size: var(--text-sm);">
                Subject
              </label>
              <select class="form-input"
                style="width: 100%; padding: var(--space-3) var(--space-4); border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); transition: var(--transition-fast); background: var(--bg-primary);"
              >
                <option value="">Select a subject...</option>
                <option value="general">General Inquiry</option>
                <option value="franchise">Franchise Inquiry</option>
                <option value="feedback">Feedback</option>
                <option value="support">Customer Support</option>
                <option value="other">Other</option>
              </select>
            </div>

            <!-- Message -->
            <div class="form-group" style="margin-bottom: var(--space-6);">
              <label class="form-label" style="display: block; font-weight: var(--font-weight-medium); color: var(--color-espresso); margin-bottom: var(--space-2); font-size: var(--text-sm);">
                Message <span style="color: var(--color-danger);">*</span>
              </label>
              <textarea id="contact-message" rows="5" class="form-input"
                placeholder="Type your message here..."
                style="width: 100%; padding: var(--space-3) var(--space-4); border: 1.5px solid var(--border-light); border-radius: var(--border-radius-md); font-size: var(--text-sm); transition: var(--transition-fast); background: var(--bg-primary); resize: vertical;"
              ></textarea>
            </div>

            <!-- Submit Button -->
            <button
              type="button"
              class="btn btn-primary btn-lg btn-block"
              onclick="showToast('Message sent! We\'ll get back to you soon. ☕', 'success')"
            >
              <i class="fas fa-paper-plane"></i> Send Message
            </button>

          </div><!-- /contact-form -->
        </div>
      </div><!-- /right column -->

    </div><!-- /contact-grid -->
  </div>
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
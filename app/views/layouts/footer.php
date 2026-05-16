<!-- ================================================
     JUAN CAFÉ - Footer
     ================================================ -->
<footer class="footer">
  <div class="container">
    <div class="footer-grid">

      <!-- Brand Column -->
      <div class="footer-brand">
        <h3>☕ Juan Café</h3>
        <p>A brand created in 2022, owned by Top Juan Franchising Inc., committed to serving premium milk tea, coffee, frappe, and fruit tea at affordable prices.</p>
        <div class="footer-socials">
          <a href="#" class="social-btn" title="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-btn" title="Twitter"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-btn" title="TikTok"><i class="fab fa-tiktok"></i></a>
        </div>
      </div>

      <!-- Quick Links -->
      <div>
        <div class="footer-heading">Quick Links</div>
        <div class="footer-links">
          <a href="/app/views/home/index.php">Home</a>
          <a href="/app/views/products/products.php">Our Menu</a>
          <a href="/app/views/home/about.php">About Us</a>
          <a href="/app/views/home/contact.php">Contact</a>
          <a href="/app/views/home/privacy-policy.php">Privacy Policy</a>
        </div>
      </div>

      <!-- Categories -->
      <div>
        <div class="footer-heading">Categories</div>
        <div class="footer-links">
          <a href="/app/views/products/products.php?cat=milk-tea">Milk Tea</a>
          <a href="/app/views/products/products.php?cat=coffee">Coffee</a>
          <a href="/app/views/products/products.php?cat=frappe">Frappe</a>
          <a href="/app/views/products/products.php?cat=fruit-tea">Fruit Tea</a>
          <a href="/app/views/products/products.php?cat=latte">Latte</a>
          <a href="/app/views/products/products.php?cat=premium">Premium Drinks</a>
        </div>
      </div>

      <!-- Contact -->
      <div>
        <div class="footer-heading">Contact Us</div>
        <div class="footer-contact-item">
          <i class="fas fa-map-marker-alt" style="color: var(--color-latte); margin-top: 3px;"></i>
          <span>Philippines<br/>Top Juan Franchising Inc.</span>
        </div>
        <div class="footer-contact-item">
          <i class="fas fa-envelope" style="color: var(--color-latte);"></i>
          <span>info@juancafe.ph</span>
        </div>
        <div class="footer-contact-item">
          <i class="fas fa-phone" style="color: var(--color-latte);"></i>
          <span>+63 (XXX) XXX-XXXX</span>
        </div>
        <div class="footer-contact-item">
          <i class="fas fa-clock" style="color: var(--color-latte);"></i>
          <span>Mon–Sun: 8:00 AM – 10:00 PM</span>
        </div>
      </div>

    </div><!-- /footer-grid -->

    <!-- Bottom Bar -->
    <div class="footer-bottom">
      <p>&copy; <?= date('Y') ?> Juan Café · Top Juan Franchising Inc. All rights reserved.</p>
      <div class="footer-bottom-links">
        <a href="/app/views/home/privacy-policy.php">Privacy Policy</a>
        <a href="/app/views/home/contact.php">Contact</a>
      </div>
    </div>

  </div><!-- /container -->
</footer>

<!-- Back to Top Button -->
<button class="back-to-top" id="back-to-top" title="Back to top">
  <i class="fas fa-chevron-up"></i>
</button>

<!-- Toast Notification Container -->
<div class="toast-container" id="toast-container"></div>

<!-- JavaScript Files -->
<script src="/assets/js/app.js"></script>
<script src="/assets/js/cart.js"></script>
<script src="/assets/js/notifications.js"></script>

</body>
</html>
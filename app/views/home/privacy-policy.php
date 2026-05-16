<?php
/**
 * JUAN CAFÉ - Privacy Policy Page
 * File: app/views/home/privacy-policy.php
 */
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
?>

<!-- ================================================
     PAGE HERO
     ================================================ -->
<section style="
  background: linear-gradient(135deg, var(--color-espresso), var(--color-coffee));
  padding: calc(var(--navbar-height) + var(--space-12)) 0 var(--space-12);
  text-align: center;
  color: white;
">
  <div class="container">
    <span class="section-badge" style="color: var(--color-gold-light);">Legal</span>
    <h1 class="section-title" style="color: white;">Privacy Policy</h1>
    <div class="divider"></div>
    <p style="color: rgba(255,255,255,0.7); font-size: var(--text-sm);">
      Last Updated: January 2024
    </p>
  </div>
</section>

<!-- ================================================
     PRIVACY POLICY CONTENT
     ================================================ -->
<section class="section-padding">
  <div class="container">

    <!-- Breadcrumb -->
    <nav style="margin-bottom: var(--space-6); font-size: var(--text-sm); color: var(--text-muted);">
      <a href="/app/views/home/index.php" style="color: var(--color-coffee);">Home</a>
      <span style="margin: 0 var(--space-2);">/</span>
      <span>Privacy Policy</span>
    </nav>

    <div class="policy-content">

      <!-- Introduction -->
      <h2 style="margin-top: 0 !important;">Privacy Policy of Juan Café Website</h2>
      <p>
        This privacy policy for Juan Café website provides details about website visitor's information
        when they voluntarily provide their information through our website, or through our affiliated
        social media pages and/or contact information.
      </p>

      <!-- What We Collect -->
      <h2>Information We Collect</h2>
      <p>
        The personal information we collect include but not limited to Names, Phone numbers, Email addresses,
        Mailing/Billing addresses, etc., which we use for promotional, after sales or marketing purposes.
      </p>

      <!-- How We Use It -->
      <h2>How We Use Your Information</h2>
      <p>
        Information collected may be used for the following purposes:
      </p>
      <ul style="padding-left: var(--space-6); color: var(--text-secondary); line-height: 2; font-size: var(--text-base); margin-bottom: var(--space-5);">
        <li>Processing and fulfilling your orders</li>
        <li>Sending promotional updates, newsletters, and marketing materials</li>
        <li>Improving our website and services</li>
        <li>Responding to customer inquiries and support requests</li>
        <li>After-sales follow-up and customer satisfaction surveys</li>
      </ul>

      <!-- Third Party -->
      <h2>Third-Party Sharing</h2>
      <p>
        We do not sell nor share your information to any third party individuals, firms or organizations,
        that are not affiliated with us.
      </p>

      <!-- Security -->
      <h2>Data Security</h2>
      <p>
        Please be rest assured that your information obtained through our website are kept secure and confidential.
        We implement appropriate security measures to protect your personal data against unauthorized access,
        alteration, disclosure, or destruction.
      </p>

      <!-- Cookies -->
      <h2>Cookies</h2>
      <p>
        Our website may use cookies to enhance your browsing experience. Cookies are small data files stored
        on your device that help us recognize returning visitors and improve site functionality. You may
        choose to disable cookies through your browser settings.
      </p>

      <!-- Your Rights -->
      <h2>Your Rights</h2>
      <p>
        You have the right to request access to, correction of, or deletion of your personal information
        held by us. To exercise these rights, please contact us through the information provided below.
      </p>

      <!-- Changes to Policy -->
      <h2>Changes to This Policy</h2>
      <p>
        We reserve the right to update this Privacy Policy at any time. We will notify users of any
        significant changes by posting the updated policy on this page with a revised date.
      </p>

      <!-- Contact for Concerns -->
      <h2>Contact Us</h2>
      <p>
        For concerns regarding your privacy or this policy, you may contact us through our contact
        information provided in this website.
      </p>

      <!-- Divider -->
      <hr style="border: none; border-top: 1px solid var(--border-light); margin: var(--space-8) 0;" />

      <!-- Contact Link -->
      <div style="text-align: center;">
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-bottom: var(--space-4);">
          Have questions about our privacy practices?
        </p>
        <a href="/app/views/home/contact.php" class="btn btn-primary">
          <i class="fas fa-envelope"></i> Contact Us
        </a>
      </div>

    </div><!-- /policy-content -->
  </div>
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
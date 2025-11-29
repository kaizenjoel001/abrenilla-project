<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SKGYES - Sangguniang Kabataan Governance & Youth Empowerment System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Toastify CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<!-- Toastify JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  <style>
    :root {
      --primary-blue: #003d82;
      --secondary-blue: #0052cc;
      --accent-gold: #ffd700;
      --light-blue: #e6f3ff;
      --dark-blue: #002a5c;
      --success-green: #28a745;
      --danger-red: #dc3545;
      --text-dark: #2c3e50;
      --text-light: #6c757d;
      --white: #ffffff;
      --light-gray: #f8f9fa;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      line-height: 1.6;
      color: var(--text-dark);
      overflow-x: hidden;
    }

    /* Header Navigation */
    .navbar {
      background: rgba(0, 61, 130, 0.95);
      backdrop-filter: blur(10px);
      padding: 15px 0;
      box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      transition: all 0.3s ease;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
      font-weight: 700;
      font-size: 1.5rem;
      color: var(--white) !important;
      text-decoration: none;
    }

    .sk-logo {
      width: 50px;
      height: 50px;
      margin-right: 15px;
      background: var(--white);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .sk-logo svg {
      width: 35px;
      height: 35px;
    }

    .navbar-nav .nav-link {
      color: var(--white) !important;
      font-weight: 500;
      margin: 0 10px;
      transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: var(--accent-gold) !important;
      transform: translateY(-2px);
    }

    /* Hero Section */
    .hero-section {
      min-height: 100vh;
      position: relative;
      display: flex;
      align-items: center;
      background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
      overflow: hidden;
    }

    .hero-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><defs><linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:rgba(255,255,255,0.1);stop-opacity:1" /><stop offset="100%" style="stop-color:rgba(255,255,255,0.05);stop-opacity:1" /></linearGradient></defs><g opacity="0.3"><circle cx="200" cy="150" r="80" fill="url(%23grad1)"/><circle cx="800" cy="200" r="120" fill="url(%23grad1)"/><circle cx="1000" cy="500" r="100" fill="url(%23grad1)"/><circle cx="300" cy="600" r="90" fill="url(%23grad1)"/><polygon points="600,100 700,150 650,250 550,200" fill="url(%23grad1)"/><polygon points="100,400 200,450 150,550 50,500" fill="url(%23grad1)"/></g></svg>');
      background-size: cover;
      background-position: center;
      opacity: 0.6;
    }
    .hero-section {
  position: relative;
  height: 100vh;
  overflow: hidden;
}

.hero-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('/assets/images/hero-bg.jpg') no-repeat center center/cover;
  filter: blur(2px);
  z-index: 1;
}

.hero-content {
  position: relative;
  z-index: 2;
  color: white;
  text-align: center;
  padding-top: 10vh;
}


    .hero-content {
      position: relative;
      z-index: 2;
      text-align: center;
      color: var(--white);
      padding: 120px 0 60px;
    }

    .hero-logo {
      width: 120px;
      height: 120px;
      margin: 0 auto 30px;
      background: var(--white);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }

    .hero-logo svg {
      width: 80px;
      height: 80px;
    }

    .hero-title {
      font-size: 3.5rem;
      font-weight: 800;
      margin-bottom: 20px;
      text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      animation: slideInUp 1s ease-out;
    }

    .hero-subtitle {
      font-size: 1.3rem;
      font-weight: 400;
      margin-bottom: 40px;
      opacity: 0.9;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
      animation: slideInUp 1s ease-out 0.2s both;
    }

    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .hero-buttons {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
      animation: slideInUp 1s ease-out 0.4s both;
    }

    .btn-hero {
      padding: 15px 35px;
      font-size: 1.1rem;
      font-weight: 600;
      border-radius: 50px;
      text-decoration: none;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 10px;
      min-width: 180px;
      justify-content: center;
      border: none;
      cursor: pointer;
    }

    .btn-primary-hero {
      background: var(--accent-gold);
      color: var(--primary-blue);
      box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
    }

    .btn-primary-hero:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 35px rgba(255, 215, 0, 0.4);
      color: var(--primary-blue);
    }

    .btn-outline-hero {
      background: transparent;
      color: var(--white);
      border: 2px solid var(--white);
    }

    .btn-outline-hero:hover {
      background: var(--white);
      color: var(--primary-blue);
      transform: translateY(-3px);
    }

    /* Features Section */
    .features-section {
      padding: 100px 0;
      background: var(--light-gray);
      position: relative;
    }

    .features-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 100px;
      background: linear-gradient(to bottom, var(--secondary-blue), transparent);
      opacity: 0.1;
    }

    .section-title {
      text-align: center;
      margin-bottom: 60px;
    }

    .section-title h2 {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--primary-blue);
      margin-bottom: 15px;
    }

    .section-title p {
      font-size: 1.1rem;
      color: var(--text-light);
      max-width: 600px;
      margin: 0 auto;
    }

    .feature-card {
      background: var(--white);
      border-radius: 20px;
      padding: 40px 30px;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      height: 100%;
      border: none;
      position: relative;
      overflow: hidden;
    }

    .feature-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, var(--primary-blue), var(--secondary-blue));
    }

    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .feature-icon {
      width: 80px;
      height: 80px;
      margin: 0 auto 25px;
      background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      font-size: 2rem;
    }

    .feature-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--primary-blue);
      margin-bottom: 15px;
    }

    .feature-desc {
      color: var(--text-light);
      line-height: 1.7;
      margin-bottom: 25px;
    }

    .btn-feature {
      background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
      color: var(--white);
      padding: 12px 30px;
      border-radius: 25px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-feature:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 61, 130, 0.3);
      color: var(--white);
    }

    /* Modal Styles */
    .modal-content {
      border-radius: 25px;
      border: none;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
      overflow: hidden;
    }

    .modal-header {
      background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
      color: var(--white);
      padding: 30px;
      border-bottom: none;
    }

    .modal-title {
      font-weight: 700;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .btn-close {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      opacity: 1;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      filter: brightness(0) invert(1);
    }

    .btn-close:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    .modal-body {
      padding: 40px;
      background: var(--white);
    }

    .form-group {
      margin-bottom: 25px;
      position: relative;
    }

    .form-control {
      border: 2px solid #e9ecef;
      border-radius: 15px;
      padding: 18px 50px 18px 20px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background: #f8f9fa;
    }

    .form-control:focus {
      border-color: var(--secondary-blue);
      box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
      background: var(--white);
    }

    .form-icon {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-light);
      font-size: 1.1rem;
    }

    .modal-footer {
      padding: 30px 40px;
      border-top: none;
      background: var(--white);
    }

    .btn-modal {
      background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
      color: var(--white);
      padding: 15px 40px;
      border-radius: 25px;
      border: none;
      font-weight: 600;
      font-size: 1.1rem;
      width: 100%;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .btn-modal:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(0, 61, 130, 0.3);
    }

    /* Alert Styles */
    .alert {
      border-radius: 15px;
      border: none;
      padding: 20px 25px;
      margin-bottom: 30px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .alert-success {
      background: linear-gradient(135deg, #d4edda, #c3e6cb);
      color: #155724;
      border-left: 4px solid var(--success-green);
    }

    .alert-danger {
      background: linear-gradient(135deg, #f8d7da, #f5c6cb);
      color: #721c24;
      border-left: 4px solid var(--danger-red);
    }

    /* Footer */
    .footer {
      background: var(--dark-blue);
      color: var(--white);
      padding: 50px 0 30px;
      text-align: center;
    }

    .footer-content {
      max-width: 800px;
      margin: 0 auto;
    }

    .footer-logo {
      width: 60px;
      height: 60px;
      margin: 0 auto 20px;
      background: var(--white);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .footer-text {
      font-size: 0.9rem;
      opacity: 0.8;
      margin-bottom: 20px;
    }

    .footer-links {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-bottom: 20px;
    }

    .footer-links a {
      color: var(--white);
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .footer-links a:hover {
      color: var(--accent-gold);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .hero-subtitle {
        font-size: 1.1rem;
      }
      
      .hero-buttons {
        flex-direction: column;
        align-items: center;
      }
      
      .btn-hero {
        width: 100%;
        max-width: 300px;
      }
      
      .hero-content {
        padding: 100px 20px 40px;
      }
      
      .feature-card {
        margin-bottom: 30px;
      }
      
      .modal-body {
        padding: 30px 20px;
      }
      
      .footer-links {
        flex-direction: column;
        gap: 15px;
      }
    }
  </style>  
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#home">
        <div class="sk-logo">
          <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="45" stroke="#003d82" stroke-width="3" fill="none"/>
            <path d="M25 35 L50 20 L75 35 L75 50 L50 80 L25 50 Z" fill="#003d82"/>
            <text x="50" y="55" text-anchor="middle" fill="white" font-family="Arial Black" font-size="14" font-weight="bold">SK</text>
          </svg>
        </div>
        SKGYES
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section id="home" class="hero-section">
    <div class="hero-bg"></div>
    <div class="container">
      <div class="hero-content">
        <div class="hero-logo">
          <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="45" stroke="#003d82" stroke-width="3" fill="none"/>
            <path d="M25 35 L50 20 L75 35 L75 50 L50 80 L25 50 Z" fill="#003d82"/>
            <text x="50" y="55" text-anchor="middle" fill="white" font-family="Arial Black" font-size="14" font-weight="bold">SK</text>
          </svg>
        </div>
        <h1 class="hero-title">SKGYES</h1>
        <p class="hero-subtitle">
          Sangguniang Kabataan Governance & Youth Empowerment System
          <br>Empowering Filipino Youth Through Digital Innovation
        </p>
        <div class="hero-buttons">
          <button class="btn-hero btn-primary-hero" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="fas fa-sign-in-alt"></i> Login Portal
          </button>
          <button class="btn-hero btn-outline-hero" data-bs-toggle="modal" data-bs-target="#registerModal">
            <i class="fas fa-user-plus"></i> Register Portal
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section id="services" class="features-section">
    <div class="container">
      <!-- Flash Messages -->
      <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          <i class="fas fa-check-circle"></i>
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>
      <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
          <i class="fas fa-exclamation-triangle"></i>
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <div class="section-title">
        <h2>Empowering Youth Through Technology</h2>
        <p>Discover our comprehensive platform designed to strengthen youth governance and community engagement across the Philippines.</p>
      </div>

      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-users"></i>
            </div>
            <h3 class="feature-title">Youth Portal</h3>
            <p class="feature-desc">
              Access exclusive programs, volunteer opportunities, and connect with your local Sangguniang Kabataan community.
            </p>
            <a href="/youth" class="btn-feature">
              <i class="fas fa-arrow-right"></i> Explore Portal
            </a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-vote-yea"></i>
            </div>
            <h3 class="feature-title">Governance Hub</h3>
            <p class="feature-desc">
              Participate in local governance, submit proposals, and track community development projects in real-time.
            </p>
            <a href="#" class="btn-feature">
              <i class="fas fa-arrow-right"></i> Get Involved
            </a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-graduation-cap"></i>
            </div>
            <h3 class="feature-title">Skills Development</h3>
            <p class="feature-desc">
              Access training programs, workshops, and educational resources to enhance your leadership and professional skills.
            </p>
            <a href="#" class="btn-feature">
              <i class="fas fa-arrow-right"></i> Learn More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="post" action="<?= site_url('login') ?>">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">
              <i class="fas fa-sign-in-alt"></i> Login to SKGYES
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input name="email" type="email" class="form-control" placeholder="Email Address" required>
              <i class="fas fa-envelope form-icon"></i>
            </div>
            <div class="form-group">
              <input name="password" type="password" class="form-control" placeholder="Password" required>
              <i class="fas fa-lock form-icon"></i>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn-modal">
              <i class="fas fa-sign-in-alt"></i> Login to Portal
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Register Modal -->
  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
          <form method="post" action="<?= site_url('register') ?>">

          <div class="modal-header">
            <h5 class="modal-title" id="registerModalLabel">
              <i class="fas fa-user-plus"></i> Join SKGYES Community
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input name="full_name" class="form-control" placeholder="Full Name" required>
                  <i class="fas fa-user form-icon"></i>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input name="email" type="email" class="form-control" placeholder="Email Address" required>
                  <i class="fas fa-envelope form-icon"></i>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input name="password" type="password" class="form-control" placeholder="Password" required>
                  <i class="fas fa-lock form-icon"></i>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input name="age" type="number" class="form-control" placeholder="Age" required>
                  <i class="fas fa-birthday-cake form-icon"></i>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input name="phone" class="form-control" placeholder="Phone Number">
                  <i class="fas fa-phone form-icon"></i>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <select name="role" class="form-control" required>
                    <option value="">Select Role</option>
                    <option value="sk_official">SK Official</option>
                    <option value="barangay_official">Barangay Official</option>
                    <option value="admin">Admin</option>
                  </select>
                  <i class="fas fa-user-tag form-icon"></i>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input name="address" class="form-control" placeholder="Complete Address">
              <i class="fas fa-home form-icon"></i>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn-modal">
              <i class="fas fa-user-plus"></i> Create Account
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php if (session()->getFlashdata('toast_error') || session()->getFlashdata('toast_success')): ?>
  <!-- Toastify Assets -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      <?php if (session()->getFlashdata('toast_error')): ?>
        Toastify({
          text: "<?= session()->getFlashdata('toast_error') ?>",
          duration: 4000,
          gravity: "top", // 👈 top position
          position: "right", // 👈 right side
          backgroundColor: "#e74c3c", // red
          close: true,
          stopOnFocus: true
        }).showToast();
      <?php endif; ?>

      <?php if (session()->getFlashdata('toast_success')): ?>
        Toastify({
          text: "<?= session()->getFlashdata('toast_success') ?>",
          duration: 4000,
          gravity: "top", // 👈 top position
          position: "right", // 👈 right side
          backgroundColor: "#2ecc71", // green
          close: true,
          stopOnFocus: true
        }).showToast();
      <?php endif; ?>
    });
  </script>
<?php endif; ?>



  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-logo">
          <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="45" stroke="#003d82" stroke-width="3" fill="none"/>
            <path d="M25 35 L50 20 L75 35 L75 50 L50 80 L25 50 Z" fill="#003d82"/>
            <text x="50" y="55" text-anchor="middle" fill="white" font-family="Arial Black" font-size="14" font-weight="bold">SK</text>
          </svg>
        </div>
        <p class="footer-text">
          SKGYES - Sangguniang Kabataan Governance & Youth Empowerment System
          <br>Empowering Filipino Youth Through Digital Innovation
        </p>
        <div class="footer-links">
          <a href="#privacy">Privacy Policy</a>
          <a href="#terms">Terms of Service</a>
          <a href="#support">Support</a>
          <a href="#contact">Contact Us</a>
        </div>
        <p class="footer-text">
          © 2025 SKGYES. All rights reserved. | Government of the Philippines
        </p>
         <p class="footer-text">
          Created by: Joel II M. Abrenilla
        </p>
        <?= view('components/chatbot') ?>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
      const navbar = document.querySelector}
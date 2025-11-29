<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SK Official Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS & Lucide Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
 <!-- Bootstrap 5 JS bundle (required for modal to work) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Animate.css CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
  background: #f6f8fa;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

    .sidebar {
      height: 100vh;
      background: linear-gradient(180deg, #1e3c72 0%, #2a5298 100%);
      color: white;
      padding: 20px 0;
      position: fixed;
      top: 0;
      left: 0;
      width: 280px;
      box-shadow: 4px 0 20px rgba(0,0,0,0.1);
      overflow-y: auto;
      z-index: 1000;
    }

    .sidebar-header {
      padding: 0 20px 20px;
      text-align: center;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .profile-container {
      position: relative;
      display: inline-block;
    }

    .profile-img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid rgba(255,255,255,0.3);
      background: linear-gradient(45deg, #667eea, #764ba2);
    }

    .online-indicator {
      position: absolute;
      bottom: 5px;
      right: 5px;
      width: 16px;
      height: 16px;
      background: #10b981;
      border-radius: 50%;
      border: 2px solid white;
    }

    .sidebar-nav {
      padding-top: 20px;
    }

    .sidebar a {
      color: rgba(255,255,255,0.8);
      display: flex;
      align-items: center;
      padding: 15px 20px;
      text-decoration: none;
      transition: all 0.3s ease;
      border-radius: 0 25px 25px 0;
      margin: 2px 0;
      margin-right: 20px;
    }

    .sidebar a:hover {
      background: rgba(255,255,255,0.1);
      color: white;
      transform: translateX(5px);
    }

    .sidebar .active {
      background: linear-gradient(90deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
      color: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .sidebar a i {
      margin-right: 12px;
      width: 20px;
      text-align: center;
    }

    .main-content {
      margin-left: 280px;
      padding: 30px;
      min-height: 100vh;
    }

    .header-card {
      background: rgba(255,255,255,0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 30px;
      margin-bottom: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      border: 1px solid rgba(255,255,255,0.2);
    }

    .stat-card {
      background: white;
      border-radius: 15px;
      padding: 25px;
      margin-bottom: 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: 1px solid rgba(0,0,0,0.05);
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .stat-icon {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 15px;
    }

    .activities-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }

    .activity-card {
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.08);
      transition: transform 0.3s ease;
    }

    .activity-card:hover {
      transform: translateY(-5px);
    }

    .activity-img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      background: linear-gradient(45deg, #667eea, #764ba2);
    }

    .activity-content {
      padding: 20px;
    }

    .form-container {
      background: white;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      margin-top: 20px;
    }

    .form-control {
      border: 2px solid #e5e7eb;
      border-radius: 10px;
      padding: 12px 16px;
      transition: border-color 0.3s ease;
    }

    .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-primary {
      background: linear-gradient(45deg, #667eea, #764ba2);
      border: none;
      padding: 12px 30px;
      border-radius: 10px;
      font-weight: 600;
      transition: transform 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .hidden { display: none; }

    .badge-custom {
      background: linear-gradient(45deg, #10b981, #059669);
      color: white;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 0.8em;
      font-weight: 500;
    }

    .progress-custom {
      height: 8px;
      background: #e5e7eb;
      border-radius: 4px;
      overflow: hidden;
    }

    .progress-bar-custom {
      height: 100%;
      background: linear-gradient(90deg, #10b981, #059669);
      transition: width 0.3s ease;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      
      .main-content {
        margin-left: 0;
        padding: 20px;
      }
      #dashboard-calendar {
  background: white;
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.08);
  padding: 20px;
}
#dashboard-calendar .fc {
  color: #222 !important;
}
#dashboard-calendar .fc-event,
#dashboard-calendar .fc-daygrid-event {
  background-color: #f3f4f6 !important;
  color: #222 !important;
  border: 1px solid #d1d5db !important;
}
#dashboard-calendar .fc-toolbar-title {
  color: #222 !important;
}
#dashboard-calendar .fc-button {
  color: #222 !important;
  background: #fff !important;
  border: 1px solid #d1d5db !important;
}
#dashboard-calendar .fc-button-active, 
#dashboard-calendar .fc-button-primary {
  background: #e5e7eb !important;
  color: #222 !important;
  border-color: #d1d5db !important;
}

    }
  </style>
</head>
<link rel="stylesheet" href="<?= base_url('css/skproposal.css') ?>">
<body>

<div class="sidebar">
  <div class="sidebar-header">
    <div class="profile-container">
      <div class="profile-container position-relative">

      <?php
        $profilePicture = session()->get('profile_picture');
        $profileUrl = !empty($profilePicture)
          ? base_url('uploads/profile_pictures/' . $profilePicture)
          : base_url('assets/img/default-avatar.png');
      ?>

      <div class="profile-img rounded-circle shadow" style="
        width: 70px;
        height: 70px;
        background-size: cover;
        background-position: center;
        background-image: url('<?= $profileUrl ?>');
      "></div>

      <div class="online-indicator position-absolute bottom-0 end-0 bg-success rounded-circle"
           style="width: 14px; height: 14px; border: 2px solid white;"></div>
    </div>
      
    </div>
    <h5 class="mt-3 mb-1">SK Official</h5>
    <small style="color: rgba(255,255,255,0.7);">Youth</small>
  </div>
  
  <nav class="sidebar-nav">
    <a href="#" onclick="showSection('homeSection')" class="active">
      <i data-lucide="home"></i>
      <span>Dashboard</span>
    </a>
    <a href="#" onclick="showSection('createProposalSection')">
      <i data-lucide="plus-circle"></i>
      <span>Create Proposal</span>
    </a>
    <a href="<?= base_url('proposals/sk') ?>">
      <i data-lucide="folder-open"></i>
      <span>View Proposals</span>
    </a>
    <a href="#" onclick="showSection('createResolutionSection')">
      <i data-lucide="plus-circle"></i>
      <span>Proposed Resolution</span>
    </a>  
    <a href="<?= base_url('event/portal') ?>">
  <i data-lucide="calendar-plus"></i>
  <span>Post Events</span>
</a>


    <a href="#">
      <i data-lucide="message-circle"></i>
      <span>Youth Feedback</span>
    </a>
    <a href="#">
      <i data-lucide="globe"></i>
      <span>SDG Projects</span>
    </a>
    <a href="<?= base_url('dashboard/sk') ?>" data-bs-toggle="modal" data-bs-target="#milestoneModal">
  <i data-lucide="trophy"></i>
  <span>Milestones</span>
</a>
    <a href="<?= base_url('sk/profile') ?>">
  <i data-lucide="user"></i>
  <span>My Profile</span>
</a>

<a href="<?= base_url('skmembers') ?>">
  <i data-lucide="users"></i>
  <span>SK Members</span>
</a>

   <a href="<?= base_url('logout') ?>">
      <i data-lucide="log-out"></i>
      <span>Logout</span>
    </a>
  </nav>
</div>

<div class="main-content">
  <!-- Home Section -->
  <div id="homeSection">
    <div class="header-card">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h2 class="mb-3" style="color: #1e3c72; font-weight: 700;">Welcome to SK Dashboard</h2>
          <p class="lead mb-4" style="color: #6b7280;">Empowering youth through innovative programs and community engagement initiatives.</p>
        </div>
        <div class="col-md-4 text-end">
          <i data-lucide="users" style="width: 80px; height: 80px; color: #667eea;"></i>
        </div>
        <div class="d-flex align-items-center flex-wrap gap-3">
  <span class="badge-custom">Active Leader</span>
  <a href="/resolutions" class="btn btn-sm btn-outline-light text-primary fw-semibold" style="
    background: white;
    border: 2px solid #667eea;
    border-radius: 30px;
    padding: 8px 20px;
    font-size: 0.9rem;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
  ">
    <i data-lucide="file-search" class="me-1" style="width:16px;height:16px;"></i>
    View Resolution Portal
  </a>
</div>

      </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="stat-card">
          <div class="stat-icon" style="background: linear-gradient(45deg, #10b981, #059669);">
            <i data-lucide="file-text" style="color: white;"></i>
          </div>
          <h3 style="color: #1e3c72; font-weight: 700;">24</h3>
          <p style="color: #6b7280; margin: 0;">Active Proposals</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-card">
          <div class="stat-icon" style="background: linear-gradient(45deg, #f59e0b, #d97706);">
            <i data-lucide="calendar" style="color: white;"></i>
          </div>
          <h3 style="color: #1e3c72; font-weight: 700;">12</h3>
          <p style="color: #6b7280; margin: 0;">Upcoming Events</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-card">
          <div class="stat-icon" style="background: linear-gradient(45deg, #8b5cf6, #7c3aed);">
            <i data-lucide="users" style="color: white;"></i>
          </div>
          <h3 style="color: #1e3c72; font-weight: 700;">850</h3>
          <p style="color: #6b7280; margin: 0;">Youth Engaged</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-card">
          <div class="stat-icon" style="background: linear-gradient(45deg, #ef4444, #dc2626);">
            <i data-lucide="target" style="color: white;"></i>
          </div>
          <h3 style="color: #1e3c72; font-weight: 700;">96%</h3>
          <p style="color: #6b7280; margin: 0;">Goal Achievement</p>
        </div>
      </div>
    </div>

    <!-- Youth Activities Section -->
    <div class="header-card">
      <h3 style="color: #1e3c72; font-weight: 700; margin-bottom: 20px;">Recent Youth Activities</h3>
      <div class="activities-grid">
        <div class="activity-card">
          <div class="activity-img" style="background: linear-gradient(45deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center;">
            <i data-lucide="graduation-cap" style="width: 60px; height: 60px; color: white;"></i>
          </div>
          <div class="activity-content">
            <h5 style="color: #1e3c72; font-weight: 600;">Education Summit 2024</h5>
            <p style="color: #6b7280; font-size: 0.9em;">Engaging 200+ youth in educational workshops and career guidance sessions.</p>
            <div class="progress-custom mb-2">
              <div class="progress-bar-custom" style="width: 85%;"></div>
            </div>
            <small style="color: #6b7280;">85% Complete</small>
          </div>
        </div>
        
        <div class="activity-card">
          <div class="activity-img" style="background: linear-gradient(45deg, #10b981, #059669); display: flex; align-items: center; justify-content: center;">
            <i data-lucide="heart" style="width: 60px; height: 60px; color: white;"></i>
          </div>
          <div class="activity-content">
            <h5 style="color: #1e3c72; font-weight: 600;">Health & Wellness Drive</h5>
            <p style="color: #6b7280; font-size: 0.9em;">Community health screening and wellness programs for youth and families.</p>
            <div class="progress-custom mb-2">
              <div class="progress-bar-custom" style="width: 70%;"></div>
            </div>
            <small style="color: #6b7280;">70% Complete</small>
          </div>
        </div>
        
        <div class="activity-card">
          <div class="activity-img" style="background: linear-gradient(45deg, #f59e0b, #d97706); display: flex; align-items: center; justify-content: center;">
            <i data-lucide="briefcase" style="width: 60px; height: 60px; color: white;"></i>
          </div>
          <div class="activity-content">
            <h5 style="color: #1e3c72; font-weight: 600;">Livelihood Training</h5>
            <p style="color: #6b7280; font-size: 0.9em;">Skills development and entrepreneurship training for economic empowerment.</p>
            <div class="progress-custom mb-2">
              <div class="progress-bar-custom" style="width: 90%;"></div>
            </div>
            <small style="color: #6b7280;">90% Complete</small>
          </div>
        </div>
        
        <div class="activity-card">
          <div class="activity-img" style="background: linear-gradient(45deg, #8b5cf6, #7c3aed); display: flex; align-items: center; justify-content: center;">
            <i data-lucide="gamepad-2" style="width: 60px; height: 60px; color: white;"></i>
          </div>
          <div class="activity-content">
            <h5 style="color: #1e3c72; font-weight: 600;">Youth Sports Festival</h5>
            <p style="color: #6b7280; font-size: 0.9em;">Inter-barangay sports competition promoting teamwork and healthy competition.</p>
            <div class="progress-custom mb-2">
              <div class="progress-bar-custom" style="width: 60%;"></div>
            </div>
            <small style="color: #6b7280;">60% Complete</small>
          </div>
        </div>
      </div>

    <!-- Calendar Section -->
    <div class="header-card mt-4">
      <h3 style="color: #1e3c72; font-weight: 700; margin-bottom: 20px;">Events Calendar</h3>
      <div id="dashboard-calendar"></div>
    </div>
    </div>
  </div>

  <!-- Create Proposal Section -->
  <div id="createProposalSection" class="hidden">
    <div class="header-card">
      <h3 style="color: #1e3c72; font-weight: 700;">Create New Proposal</h3>
      <p style="color: #6b7280;">Submit your project proposal for community development and youth engagement.</p>
    </div>

    <div class="form-container">
      <form action="<?= site_url('proposal/store') ?>" method="post" enctype="multipart/form-data">

        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" style="font-weight: 600; color: #374151;">Project Title</label>
            <input name="title" class="form-control" placeholder="Enter project title" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" style="font-weight: 600; color: #374151;">Category</label>
            <select name="category" class="form-control" required>
              <option value="">Select Category</option>
              <option value="Health">Health & Wellness</option>
              <option value="Education">Education & Training</option>
              <option value="Livelihood">Livelihood & Economic</option>
              <option value="Gaming">Sports & Recreation</option>
              <option value="Gaming">Gaming</option>
            </select>
          </div>
        </div>
        

        <div class="mb-4">
          <label class="form-label" style="font-weight: 600; color: #374151;">Description</label>
          <textarea name="description" class="form-control" rows="4" placeholder="Describe your project in detail" required></textarea>
        </div>

        <div class="mb-4">
          <label class="form-label" style="font-weight: 600; color: #374151;">Objectives</label>
          <textarea name="objectives" class="form-control" rows="3" placeholder="List the main objectives of your project" required></textarea>
        </div>

        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" style="font-weight: 600; color: #374151;">Target Beneficiaries</label>
            <input name="beneficiaries" class="form-control" placeholder="Who will benefit from this project?" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" style="font-weight: 600; color: #374151;">Location</label>
            <input name="location" class="form-control" placeholder="Project location" required>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label" style="font-weight: 600; color: #374151;">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" style="font-weight: 600; color: #374151;">End Date</label>
            <input type="date" name="end_date" class="form-control" required>
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label" style="font-weight: 600; color: #374151;">Estimated Budget</label>
          <input name="estimated_budget" type="number" class="form-control" placeholder="Enter estimated budget" required>
        </div>

        <div class="mb-4">
          <label class="form-label" style="font-weight: 600; color: #374151;">Budget Breakdown</label>
          <textarea name="budget_breakdown" class="form-control" rows="3" placeholder="Provide detailed budget breakdown" required></textarea>
        </div>

        <div class="mb-4">
          <label class="form-label" style="font-weight: 600; color: #374151;">Source of Funds</label>
          <input name="source_of_funds" class="form-control" placeholder="Where will funding come from?" required>
        </div>

        <div class="mb-4">
          <label class="form-label" style="font-weight: 600; color: #374151;">Expected Outcomes</label>
          <textarea name="expected_outcomes" class="form-control" rows="3" placeholder="What outcomes do you expect?" required></textarea>
        </div>

        <div class="mb-4">
          <label class="form-label" style="font-weight: 600; color: #374151;">Partners (Optional)</label>
          <input name="partners" class="form-control" placeholder="List any partner organizations">
        </div>

        <div class="mb-4">
          <label class="form-label" style="font-weight: 600; color: #374151;">Attachment (PDF/Image)</label>
          <input type="file" name="attachments" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
          <i data-lucide="send" style="width: 16px; height: 16px; margin-right: 8px;"></i>
          Submit Proposal
        </button>
      </form>
    </div>
  </div>

<!-- ✅ Toast Container -->
<div id="toastContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 1060;"></div>

<!-- ✅ Success Modal with Animated Check -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow-lg animate__animated animate__fadeInDown">
      <div class="modal-body text-center p-5">

        <!-- Animated Checkmark -->
        <div class="checkmark-container mb-4">
          <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
            <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" />
            <path class="checkmark-check" fill="none" d="M14 27l7 7 17-17" />
          </svg>
        </div>

        <!-- Message -->
        <h4 class="text-success fw-bold mb-3">Success!</h4>
        <p id="successModalMessage" class="text-secondary">Proposal submitted successfully!</p>
      </div>
    </div>
  </div>
</div>

<!-- ✅ JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form[action="/proposal/store"]');
  const successModalElement = document.getElementById('successModal');
  const successModal = new bootstrap.Modal(successModalElement);
  const successMessage = document.getElementById('successModalMessage');
  const toastContainer = document.getElementById('toastContainer');

  if (form) {
    form.addEventListener('submit', async function (e) {
      e.preventDefault();
      const formData = new FormData(form);

      try {
        const response = await fetch('/proposal/store', {
          method: 'POST',
          body: formData
        });

        const data = await response.json();

        if (data.success) {
          // Set success message
          successMessage.textContent = data.message || "Proposal submitted successfully!";
          successModal.show();

          setTimeout(() => successModal.hide(), 2000);
          form.reset();
          refreshProposalTable();
        } else {
          showToast(data.message || "Failed to submit proposal", true);
        }
      } catch (error) {
        console.error('Fetch error:', error);
        showToast("Something went wrong!", true);
      }
    });
  }

  // ✅ Toast function
  function showToast(message, isError = false) {
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white ${isError ? 'bg-danger' : 'bg-success'} border-0 fade show mb-2`;
    toast.style.minWidth = '280px';
    toast.role = 'alert';

    toast.innerHTML = `
      <div class="d-flex">
        <div class="toast-body">${message}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    `;

    toastContainer.appendChild(toast);
    setTimeout(() => {
      toast.classList.remove('show');
      toast.addEventListener('transitionend', () => toast.remove());
    }, 4000);
  }

  // ✅ Refresh Proposal Table
  function refreshProposalTable() {
    fetch('/proposals/sk')
      .then(response => response.text())
      .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newTable = doc.querySelector('#proposalTableContainer');
        const currentTable = document.querySelector('#proposalTableContainer');
        if (newTable && currentTable) {
          currentTable.innerHTML = newTable.innerHTML;
        }
      })
      .catch(err => {
        console.error('Error updating table:', err);
        showToast("Failed to update proposal table", true);
      });
  }
});
</script>

 <!-- Create Resolution Section -->
<div id="createResolutionSection">
  <div class="header-card">
    <h3 style="color: #1e3c72; font-weight: 700;">Create Resolution</h3>
    <p style="color: #6b7280;">Submit your resolution for SK initiatives or related proposals.</p>
  </div>

  <div class="form-container">
    <form id="resolutionForm" action="<?= base_url('/resolution/store') ?>" method="post" enctype="multipart/form-data">
      <div class="row mb-4">
        <div class="col-md-6">
          <label class="form-label">Resolution No.</label>
          <input name="resolution_no" class="form-control" placeholder="e.g., 2025-001" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Date Passed</label>
          <input type="date" name="date_passed" class="form-control" required>
        </div>
      </div>

      <div class="mb-4">
        <label class="form-label">Title</label>
        <input name="title" class="form-control" placeholder="e.g., A Resolution Supporting the ML Tournament" required>
      </div>

      <div class="mb-4">
        <label class="form-label">Prepared By</label>
        <input name="prepared_by" class="form-control" value="<?= session('full_name') ?>" readonly>
      </div>

      <div class="mb-4">
        <label class="form-label">Resolution Content</label>
        <textarea name="resolution_content" class="form-control" rows="5" placeholder="Write full content here..." required></textarea>
      </div>

      <div class="mb-4">
        <label class="form-label">Attachment (optional)</label>
        <input type="file" name="attachment" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">
        <i data-lucide="file-text" style="margin-right: 6px;"></i> Submit Resolution
      </button>
    </form>
  </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <div class="mx-auto mb-3" style="width: 80px; height: 80px;">
        <svg xmlns="http://www.w3.org/2000/svg" class="text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <circle cx="12" cy="12" r="10" stroke="green" stroke-width="2" fill="white"/>
          <path stroke="green" stroke-width="2" d="M8 12l2 2 4-4" />
        </svg>
      </div>
      <h5 class="modal-title" id="successModalLabel">Resolution Submitted Successfully!</h5>
      <p class="text-muted mt-2">Refreshing the page...</p>
    </div>
  </div>
</div>

<!-- JavaScript -->
<script>
document.getElementById('resolutionForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);

  fetch(form.action, {
    method: 'POST',
    body: formData
  })
  .then(res => res.ok ? res.text() : Promise.reject(res.statusText))
  .then(() => {
    const modalElement = document.getElementById('successModal');
    const modal = new bootstrap.Modal(modalElement);
    modal.show();

    // Clear form fields
    form.reset();

    // Hide modal after 2.5 seconds, then reload after 3 seconds
    setTimeout(() => {
      const modalInstance = bootstrap.Modal.getInstance(modalElement);
      modalInstance.hide();
    }, 2500);

    setTimeout(() => {
      window.location.href = window.location.href; // Refresh same page
    }, 3000);
  })
  .catch(err => {
    alert('Submission failed. Please try again.');
    console.error(err);
  });
});
</script>





<!-- Toast Container (Top-Right) -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
  <?php if (session()->getFlashdata('toast_success')): ?>
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2500">
      <div class="d-flex">
        <div class="toast-body">
          <?= session()->getFlashdata('toast_success') ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('toast_error')): ?>
    <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
      <div class="d-flex">
        <div class="toast-body">
          <?= session()->getFlashdata('toast_error') ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  <?php endif; ?>
</div>



<!-- Milestone Showcase Modal -->
<div class="modal fade" id="milestoneModal" tabindex="-1" aria-labelledby="milestoneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-gradient" style="background: linear-gradient(90deg,#667eea,#764ba2); color: white;">
        <h5 class="modal-title" id="milestoneModalLabel">
          <i class="bi bi-trophy me-2"></i> Recognition & Milestone Showcase
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4 py-3">

        <!-- Upload Achievement/Milestone -->
        <div class="card mb-4 shadow-sm border-0">
          <div class="card-body">
            <h6 class="fw-bold mb-3"><i class="bi bi-cloud-upload me-2"></i>Upload New Milestone</h6>
            <form action="/milestone/upload" method="post" enctype="multipart/form-data">
              <div class="row g-4 align-items-center">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Milestone Title</label>
                  <input type="text" name="title" class="form-control" placeholder="Milestone Title" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Attachment (Image/PDF)</label>
                  <input type="file" name="attachment" class="form-control" accept="image/*,application/pdf">
                </div>
                <div class="col-md-12">
                  <label class="form-label fw-semibold">Description</label>
                  <textarea name="description" class="form-control" rows="3" placeholder="Describe achievement or milestone" required></textarea>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Category</label>
                  <select name="category" class="form-select" required>
                    <option value="">Select Category</option>
                    <option value="Award">Award</option>
                    <option value="Project">Project</option>
                    <option value="Training">Training</option>
                    <option value="Community Service">Community Service</option>
                  </select>
                </div>
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary w-100 mt-3">
                    <i class="bi bi-upload me-1"></i> Upload Milestone
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        
<!-- Achievements & Milestones List -->
<div>
  <h6 class="fw-bold mb-3"><i class="bi bi-list-stars me-2"></i>Achievements & Milestones</h6>
  <!-- Live Search -->
  <div class="mb-3">
    <input type="text" id="milestoneSearch" class="form-control" placeholder="Search milestones...">
  </div>

  <ul class="list-group mb-3" id="milestoneList">
    <?php if (!empty($milestones)): ?>
      <?php foreach ($milestones as $milestone): ?>
        <li class="list-group-item">
          <div class="row align-items-center">
            <div class="col-md-9">
              <strong class="fs-5"><?= esc($milestone['title']) ?></strong>
              <span class="badge bg-info ms-2"><?= esc($milestone['category'] ?? 'Uncategorized') ?></span>
              <br>
              <span><?= esc($milestone['description']) ?></span>
              <?php if (!empty($milestone['attachment'])): ?>
                <br>
                <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $milestone['attachment'])): ?>
                  <img src="<?= base_url('uploads/milestones/' . $milestone['attachment']) ?>" alt="Milestone Image" class="rounded shadow-sm mt-2" style="max-width:180px;">
                <?php else: ?>
                  <a href="<?= base_url('uploads/milestones/' . $milestone['attachment']) ?>" target="_blank">View Attachment</a>
                <?php endif; ?>
              <?php endif; ?>
              <div class="text-muted mt-1">
                <small>Uploaded on <?= date('F j, Y', strtotime($milestone['created_at'])) ?></small>
              </div>
            </div>
            <div class="col-md-3 text-end">
              <!-- Social Share Buttons -->
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(base_url('uploads/milestones/' . $milestone['attachment'])) ?>" target="_blank" class="btn btn-sm btn-outline-info me-1" title="Share on Facebook">
                <i class="bi bi-facebook"></i>
              </a>
              <a href="https://twitter.com/intent/tweet?url=<?= urlencode(base_url('uploads/milestones/' . $milestone['attachment'])) ?>&text=<?= urlencode($milestone['title']) ?>" target="_blank" class="btn btn-sm btn-outline-info me-1" title="Share on Twitter">
                <i class="bi bi-twitter"></i>
              </a>
              <a href="https://www.instagram.com/?url=<?= urlencode(base_url('uploads/milestones/' . $milestone['attachment'])) ?>" target="_blank" class="btn btn-sm btn-outline-danger" title="Share on Instagram">
                <i class="bi bi-instagram"></i>
              </a>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    <?php else: ?>
      <li class="list-group-item text-muted">No milestones uploaded yet.</li>
    <?php endif; ?>
  </ul>
</div>

<script>
// Live search for milestones
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('milestoneSearch');
  const milestoneList = document.getElementById('milestoneList');
  const items = milestoneList.querySelectorAll('li.list-group-item');

  searchInput.addEventListener('input', function() {
    const query = this.value.toLowerCase();
    items.forEach(item => {
      const text = item.innerText.toLowerCase();
      item.style.display = text.includes(query) ? '' : 'none';
    });
  });
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Initialize Lucide icons
  lucide.createIcons();
  
  // Initialize Lucide icons
  lucide.createIcons();
  
  function showSection(id) {
    // Hide all sections properly
    const sections = ['homeSection', 'createProposalSection', 'createResolutionSection'];
    sections.forEach(section => {
      document.getElementById(section).classList.add('hidden');
    });

    // Show selected section
    document.getElementById(id).classList.remove('hidden');

    // Update active nav item
    document.querySelectorAll('.sidebar a').forEach(link => {
      link.classList.remove('active');
    });
    event.target.closest('a').classList.add('active');
  }

  // Animate stat cards on load
  document.addEventListener('DOMContentLoaded', function() {
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
      setTimeout(() => {
        card.style.transform = 'translateY(0)';
        card.style.opacity = '1';
      }, index * 100);
    });

    lucide.createIcons();
  });

 
  document.querySelectorAll('.toast').forEach(function(toastEl) {
    new bootstrap.Toast(toastEl).show();
  });
</script>

<!-- FullCalendar CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('dashboard-calendar');
    if (calendarEl) {
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 500,
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek'
        },
        events: [
          // Example events, replace with dynamic PHP if needed
          { title: 'Education Summit', start: '2025-07-10' },
          { title: 'Sports Festival', start: '2025-07-18' },
          { title: 'Health Drive', start: '2025-07-22' }
        ]
      });
      calendar.render();
    }
  });
</script>

</script>
</body>
</html>
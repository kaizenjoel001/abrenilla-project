<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  

  <style>
    .toast {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 50;
      padding: 16px 24px;
      border-radius: 8px;
      font-weight: 500;
      animation: fadein 0.5s, fadeout 0.5s 3s forwards;
    }
    @keyframes fadein {
      from { opacity: 0; top: 0; }
      to { opacity: 1; top: 20px; }
    }
    @keyframes fadeout {
      from { opacity: 1; top: 20px; }
      to { opacity: 0; top: 0; }
    }
    .peer-checked:bg-green-500 {
  box-shadow: 0 0 10px rgba(34,197,94,0.5);
}

  </style>
</head>
<body class="flex bg-gray-100 min-h-screen">

  <!-- Sidebar -->
<aside class="w-64 bg-gray-900 text-white flex flex-col">
  <div class="p-6 text-center border-b border-gray-700">
    <h1 class="text-xl font-bold">Admin Panel</h1>
  </div>

  <nav class="flex-1 p-4 space-y-2">
    <a href="#" id="dashboardBtn" class="flex items-center gap-2 p-2 rounded hover:bg-gray-800">
      <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
    </a>

    <a href="/users" id="manageUsersBtn" class="flex items-center gap-2 p-2 rounded hover:bg-gray-800">
      <i data-lucide="users" class="w-5 h-5"></i> Manage Users
    </a>

    <a href="/proposals" class="flex items-center gap-2 p-2 rounded hover:bg-gray-800">
      <i data-lucide="file-text" class="w-5 h-5"></i> Manage Proposals
    </a>

    <!-- ✅ Fixed Settings Section -->
    <a href="/settings" class="flex items-center gap-2 p-2 rounded hover:bg-gray-800">
      <i data-lucide="settings" class="w-5 h-5"></i> Settings
    </a>
    <a href="<?= base_url('network-logs') ?>" class="flex items-center gap-2 p-2 rounded hover:bg-gray-800">
  <i data-lucide="activity" class="w-5 h-5"></i> Network Logs
</a>

<div class="flex items-center justify-between mt-3 ml-3 mr-3 bg-white/10 backdrop-blur-sm shadow-sm px-3 py-2 rounded-lg">
  <div class="flex items-center gap-2">
    <span id="statusDot" class="w-2.5 h-2.5 bg-green-400 rounded-full"></span>
    <span id="systemStatusText" class="text-sm font-medium text-green-400">System Online</span>
  </div>

  <!-- Toggle Switch -->
  <label class="relative inline-flex items-center cursor-pointer scale-90">
    <input type="checkbox" id="systemModeToggle" class="sr-only peer">
    <div class="w-10 h-5 bg-gray-400 rounded-full peer peer-checked:bg-green-500
                after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white 
                after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5">
    </div>
  </label>
</div>

<!-- Toast Notification -->
<div id="toastContainer" class="fixed top-5 right-5 z-50 space-y-2"></div>


    <a href="<?= base_url('/logout') ?>"  class="flex items-center gap-2 p-2 rounded hover:bg-gray-800 text-red-400">
      <i data-lucide="log-out" class="w-5 h-5"></i> Logout
    </a>
  </nav>
</aside>


  <!-- Main Content -->
  <main class="flex-1 p-8">
    <!-- Dashboard Section -->
    <section id="dashboardSection">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Welcome, Admin</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-6">
          <h4 class="text-gray-600 mb-2">Total Users</h4>
          <p id="totalUsers" class="text-3xl font-bold text-blue-600">...</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
          <h4 class="text-gray-600 mb-2">Proposals Submitted</h4>
          <p id="totalProposals" class="text-3xl font-bold text-green-600">...</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
          <h4 class="text-gray-600 mb-2">Pending Approvals</h4>
          <p id="pendingApprovals" class="text-3xl font-bold text-yellow-600">...</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
          <h4 class="text-gray-600 mb-2">Approved Proposals</h4>
          <p id="approvedProposals" class="text-3xl font-bold text-green-700">...</p>
        </div>
        
      </div>
      
      <!-- Notifications Section -->
      <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h4 class="text-gray-600 mb-4">Notifications</h4>
        <ul id="notificationsContainer" class="space-y-2 text-sm text-gray-700 max-h-48 overflow-y-auto">
          <!-- Notifications will be dynamically loaded here -->
        </ul>
      </div>

      <div class="bg-white shadow rounded-lg p-6 mb-8">
  <h4 class="text-gray-600 mb-4">Analytics Overview</h4>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Users Chart -->
    <div>
      <canvas id="usersChart"></canvas>
    </div>
    <!-- Proposals Chart -->
    <div>
      <canvas id="proposalsChart"></canvas>
    </div>
  </div>
</div>

      <div class="flex justify-between items-center mb-6">
        <div>
          <label class="mr-2 font-medium text-gray-700">Filter:</label>
          <select id="monthFilter" class="p-2 border rounded">
            <option value="">All Months</option>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
        </div>
        <div class="space-x-2">
          <button onclick="exportTable('xlsx')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Export Excel</button>
          <button onclick="exportTable('pdf')" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Export PDF</button>
        </div>
      </div>

      <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h4 class="text-gray-600 mb-4">Scheduled Proposals</h4>
        <div id="calendar"></div>
      </div>
    </section>

    <!-- Inside Manage Users Section -->
<section id="manageUsersSection" class="hidden">
  <div class="flex justify-between items-center mb-4">
    <h3 class="text-xl font-semibold text-gray-800">Manage Users</h3>
    <div class="flex gap-2">
      <input type="text" id="userSearch" placeholder="Search users..." class="p-2 border rounded w-64" />
      <button onclick="openAddModal()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm">+ Add User</button>
    </div>
  </div>
  <div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="w-full text-sm text-left text-gray-700">
      <thead class="bg-gray-100 border-b">
        <tr>
          <th class="p-3">Full Name</th>
          <th class="p-3">Email</th>
          <th class="p-3">Role</th>
          <th class="p-3">Phone</th>
          <th class="p-3 text-center">Actions</th>
        </tr>
      </thead>
      <tbody id="usersTableBody"></tbody>
    </table>
  </div>
</section>

  </main>

  <!-- Edit User Modal -->
  <div id="editUserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-full max-w-md">
      <h3 class="text-lg font-semibold mb-4">Edit User</h3>
      <form id="editUserForm">
        <input type="hidden" id="editUserId">
        <div class="mb-2">
          <label class="block text-sm font-medium">Full Name</label>
          <input type="text" id="editFullName" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-2">
          <label class="block text-sm font-medium">Email</label>
          <input type="email" id="editEmail" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-2">
          <label class="block text-sm font-medium">Phone</label>
          <input type="text" id="editPhone" class="w-full p-2 border rounded">
        </div>
        <div class="mb-2">
          <label class="block text-sm font-medium">Role</label>
          <select id="editRole" class="w-full p-2 border rounded">
            <option value="skofficial">Sk Official</option>
            <option value="barangayofficial">Barangay Official</option>
            <option value="admin">Admib</option>
          </select>
        </div>
        <div class="flex justify-end space-x-2 mt-4">
          <button type="button" onclick="closeEditModal()" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
        </div>
      </form>
    </div>
  </div>

<!-- Add User Modal -->
<div id="addUserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-40">
  <div class="bg-white p-6 rounded-lg w-full max-w-md">
    <h3 class="text-lg font-semibold mb-4">Add New User</h3>
    <form id="addUserForm">
      <div class="mb-2">
        <label class="block text-sm font-medium">Full Name</label>
        <input type="text" id="addFullName" class="w-full p-2 border rounded" required>
      </div>
      <div class="mb-2">
        <label class="block text-sm font-medium">Email</label>
        <input type="email" id="addEmail" class="w-full p-2 border rounded" required>
      </div>
      <div class="mb-2">
        <label class="block text-sm font-medium">Phone</label>
        <input type="text" id="addPhone" class="w-full p-2 border rounded">
      </div>
      <div class="mb-2">
        <label class="block text-sm font-medium">Role</label>
        <select id="addRole" class="w-full p-2 border rounded">
          <option value="SK Official">SK Official</option>
          <option value="Barangay Official">Barangay Official</option>
          <option value="Admin">Admin</option>
        </select>
      </div>
      <div class="flex justify-end space-x-2 mt-4">
        <button type="button" onclick="closeAddModal()" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Add</button>
      </div>
    </form>
  </div>
</div>
 <script>
function showToast(message, type = 'success') {
  const toastContainer = document.getElementById('toastContainer');
  const toast = document.createElement('div');

  // Toast styles
  toast.className = `toast px-4 py-2 rounded shadow text-white ${
    type === 'success' ? 'bg-green-500' : 'bg-red-500'
  }`;
  toast.textContent = message;

  // Append toast to container
  toastContainer.appendChild(toast);

  // Remove toast after 3 seconds
  setTimeout(() => {
    toast.remove();
  }, 3000);
}
 </script>
  <!-- Toast Notification -->
  <div id="toast" class="toast bg-green-500 text-white hidden">Welcome back, Admin!</div>
<!-- Toast Notification -->
<div id="toastContainer" class="fixed top-5 right-5 z-50 space-y-2"></div>
  <!-- Scripts -->
  <script>
    window.onload = () => {
      lucide.createIcons();
      showToast();
      fetchData();
      initCalendar();
    };

    function fetchData() {
      fetch('/api/total-users').then(res => res.json()).then(data => document.getElementById('totalUsers').textContent = data.totalUsers ?? 0);
      fetch('/api/total-proposals').then(res => res.json()).then(data => document.getElementById('totalProposals').textContent = data.totalProposals ?? 0);
      fetch('/api/pending-approvals').then(res => res.json()).then(data => document.getElementById('pendingApprovals').textContent = data.pendingApprovals ?? 0);
      fetch('/api/approved-proposals').then(res => res.json()).then(data => document.getElementById('approvedProposals').textContent = data.approvedProposals ?? 0);
      fetch('/api/recent-activities')
        .then(res => res.json())
        .then(data => {
          const container = document.getElementById('activityLogs');
          container.innerHTML = '';
          if (data.activities?.length > 0) {
            data.activities.forEach(act => {
              const li = document.createElement('li');
              li.textContent = `• ${act.message}`;
              container.appendChild(li);
            });
          } else {
            container.innerHTML = '<li>No recent activities.</li>';
          }
        });
    }

    function showToast() {
      const toast = document.getElementById('toast');
      toast.classList.remove('hidden');
      setTimeout(() => toast.classList.add('hidden'), 3500);
    }

    function exportTable(type) {
      alert(`Export as ${type.toUpperCase()} coming soon...`);
    }

    function initCalendar() {
      const calendarEl = document.getElementById('calendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 400,
        events: '/api/calendar-events'
      });
      calendar.render();
    }

    function loadUsers() {
      fetch('/api/users')
        .then(res => res.json())
        .then(data => {
          const tbody = document.getElementById('usersTableBody');
          const searchInput = document.getElementById('userSearch');
          let allUsers = data;

          function renderUsers(users) {
            tbody.innerHTML = '';
            if (users.length > 0) {
              users.forEach(user => {
                const row = `
                  <tr class="border-b">
                    <td class="p-3">${user.full_name}</td>
                    <td class="p-3">${user.email}</td>
                    <td class="p-3 capitalize">${user.role}</td>
                    <td class="p-3">${user.phone}</td>
                    <td class="p-3 text-center space-x-2">
                      <button class="text-blue-600 hover:underline text-sm" onclick="editUser(${user.user_id}, '${user.full_name}', '${user.email}', '${user.phone}', '${user.role}')">Edit</button>
                      <button class="text-red-600 hover:underline text-sm" onclick="deleteUser(${user.user_id})">Delete</button>
                    </td>
                  </tr>`;
                tbody.insertAdjacentHTML('beforeend', row);
              });
            } else {
              tbody.innerHTML = '<tr><td colspan="5" class="p-3 text-center text-gray-500">No users found.</td></tr>';
            }
          }

          renderUsers(allUsers);

          searchInput.addEventListener('input', () => {
            const keyword = searchInput.value.toLowerCase();
            const filtered = allUsers.filter(user =>
              user.full_name.toLowerCase().includes(keyword) ||
              user.email.toLowerCase().includes(keyword) ||
              user.role.toLowerCase().includes(keyword)
            );
            renderUsers(filtered);
          });
        })
        .catch(err => console.error('Error loading users:', err));
    }

    function editUser(id, name, email, phone, role) {
      document.getElementById('editUserId').value = id;
      document.getElementById('editFullName').value = name;
      document.getElementById('editEmail').value = email;
      document.getElementById('editPhone').value = phone;
      document.getElementById('editRole').value = role;
      document.getElementById('editUserModal').classList.remove('hidden');
    }

    function closeEditModal() {
      document.getElementById('editUserModal').classList.add('hidden');
    }

    document.getElementById('editUserForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const id = document.getElementById('editUserId').value;
      const data = {
        full_name: document.getElementById('editFullName').value,
        email: document.getElementById('editEmail').value,
        phone: document.getElementById('editPhone').value,
        role: document.getElementById('editRole').value
      };
      fetch(`/api/users/update/${id}`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
      }).then(res => res.json()).then(resp => {
        if (resp.success) {
          closeEditModal();
          loadUsers();
        } else {
          alert('Failed to update user.');
        }
      });
    });

    function deleteUser(id) {
      if (confirm('Are you sure you want to delete this user?')) {
        fetch(`/api/users/delete/${id}`, {
          method: 'DELETE'
        }).then(res => res.json()).then(resp => {
          if (resp.success) {
            loadUsers();
          } else {
            alert('Failed to delete user.');
          }
        });
      }
    }
    
const baseUrl = '/skgyes1/public/index.php'; // Adjust this to match your setup

function showToast(message, type = 'success') {
  const toastContainer = document.getElementById('toastContainer');
  const toast = document.createElement('div');

  toast.className = `toast px-4 py-2 rounded shadow text-white ${
    type === 'success' ? 'bg-green-500' : 'bg-red-500'
  }`;
  toast.textContent = message;

  toastContainer.appendChild(toast);

  setTimeout(() => toast.remove(), 3000);
}

// Load current system mode
async function loadSystemMode() {
  try {
    const res = await fetch(`${baseUrl}/api/system-mode`);
    if (!res.ok) throw new Error('Failed to fetch');
    const data = await res.json();
    updateSystemSwitch(data.mode || 'online');
  } catch (err) {
    console.error('Error fetching system mode:', err);
    showToast('Error connecting to server.', 'error');
  }
}

// Toggle system mode
async function toggleSystemMode() {
  try {
    const res = await fetch(`${baseUrl}/api/toggle-system-mode`, { method: 'POST' });
    if (!res.ok) throw new Error('Failed to toggle');
    const data = await res.json();

    if (data.success) {
      updateSystemSwitch(data.newMode);
      showToast(`System is now ${data.newMode.toUpperCase()}!`, 'success');
    } else {
      showToast('Failed to toggle system mode.', 'error');
    }
  } catch (err) {
    console.error('Error toggling system mode:', err);
    showToast('Error connecting to server.', 'error');
  }
}

// Update toggle UI, text, and dot color
function updateSystemSwitch(mode) {
  const toggle = document.getElementById('systemModeToggle');
  const statusText = document.getElementById('systemStatusText');
  const statusDot = document.getElementById('statusDot');

  if (mode === 'online') {
    toggle.checked = true;
    statusText.textContent = '🟢 System Online';
    statusText.className = 'text-sm font-medium text-green-600';
    statusDot.className = 'w-2.5 h-2.5 bg-green-400 rounded-full';
  } else {
    toggle.checked = false;
    statusText.textContent = '⚙️ Under Maintenance';
    statusText.className = 'text-sm font-medium text-yellow-600';
    statusDot.className = 'w-2.5 h-2.5 bg-yellow-400 rounded-full';
  }
}

// Attach toggle listener
document.getElementById('systemModeToggle').addEventListener('change', toggleSystemMode);

// Initialize on page load
document.addEventListener('DOMContentLoaded', loadSystemMode);

    function initAnalytics() {
  // Fetch data for analytics
  Promise.all([
    fetch('/api/total-users').then(res => res.json()),
    fetch('/api/total-proposals').then(res => res.json()),
    fetch('/api/pending-approvals').then(res => res.json()),
    fetch('/api/approved-proposals').then(res => res.json())
  ]).then(([usersData, proposalsData, pendingApprovalsData, approvedProposalsData]) => {
    // Users Chart
    const usersChartCtx = document.getElementById('usersChart').getContext('2d');
    new Chart(usersChartCtx, {
      type: 'doughnut',
      data: {
        labels: ['Total Users', 'Active Users', 'Inactive Users'],
        datasets: [{
          data: [usersData.totalUsers, usersData.activeUsers || 0, usersData.inactiveUsers || 0],
          backgroundColor: ['#4CAF50', '#2196F3', '#FF5722']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top'
          }
        }
      }
    });


    // Proposals Chart
    const proposalsChartCtx = document.getElementById('proposalsChart').getContext('2d');
    new Chart(proposalsChartCtx, {
      type: 'bar',
      data: {
        labels: ['Submitted', 'Pending', 'Approved'],
        datasets: [{
          label: 'Proposals',
          data: [proposalsData.totalProposals, pendingApprovalsData.pendingApprovals, approvedProposalsData.approvedProposals],
          backgroundColor: ['#FFC107', '#FF5722', '#4CAF50']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'Proposal Status'
            }
          },
          y: {
            title: {
              display: true,
              text: 'Count'
            },
            beginAtZero: true
          }
        }
      }
    });
  }).catch(err => {
    console.error('Error fetching analytics data:', err);
  });
}


// Initialize analytics on page load
window.onload = () => {
  lucide.createIcons();
  showToast();
  fetchData();
  initCalendar();
  initAnalytics(); // Initialize analytics
};

    document.getElementById('manageUsersBtn').addEventListener('click', function(e) {
      e.preventDefault();
      document.getElementById('dashboardSection').classList.add('hidden');
      document.getElementById('manageUsersSection').classList.remove('hidden');
      loadUsers();
    });

    document.getElementById('dashboardBtn').addEventListener('click', function(e) {
      e.preventDefault();
      document.getElementById('manageUsersSection').classList.add('hidden');
      document.getElementById('dashboardSection').classList.remove('hidden');
    });
    document.getElementById('editUserForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const id = document.getElementById('editUserId').value;
  const data = {
    full_name: document.getElementById('editFullName').value,
    email: document.getElementById('editEmail').value,
    phone: document.getElementById('editPhone').value,
    role: document.getElementById('editRole').value,
  };

  fetch(`/users/update/${id}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.json())
    .then((result) => {
      if (result.success) {
        alert('User updated successfully!');
        closeEditModal();
        loadUsers(); // Reload the user list
      } else {
        alert('Failed to update user.');
      }
    })
    .catch((error) => console.error('Error updating user:', error));
});
// Open Add User Modal
function openAddModal() {
  document.getElementById('addUserModal').classList.remove('hidden');
}

// Close Add User Modal
function closeAddModal() {
  document.getElementById('addUserModal').classList.add('hidden');
  document.getElementById("addUserForm").reset();
}

// Submit Add User Form
document.getElementById("addUserForm").addEventListener("submit", async function (e) {
  e.preventDefault();

  const data = {
    full_name: document.getElementById("addFullName").value,
    email: document.getElementById("addEmail").value,
    phone: document.getElementById("addPhone").value,
    password: "default123", // default password
    role: document.getElementById("addRole").value
  };

  const response = await fetch('/api/users/create', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  });

  const result = await response.json();

  if (result.success) {
    showToast("User added successfully!");
    closeAddModal();
    loadUsers();
  } else {
    alert("Failed to add user.");
  }
});

loadUsers();
</script>

</body>
</html>
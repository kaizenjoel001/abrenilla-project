<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Barangay Official Dashboard</title>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <script>
    window.onload = () => {
      lucide.createIcons();
    };
  </script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
    }
  </style>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md fixed h-full overflow-y-auto">
    <div class="p-6 border-b border-gray-200">
      <div class="flex items-center space-x-4">
        <img src="https://via.placeholder.com/48" alt="Profile" class="w-12 h-12 rounded-full">
        <div>
          <h2 class="text-lg font-semibold text-gray-800">Barangay Official</h2>
          <p class="text-sm text-gray-500">Welcome back</p>
        </div>
      </div>
    </div>

    <!-- Nav Menu -->
    <nav class="mt-6 px-4">
      <ul class="space-y-2">
        <li>
          <a href="<?= base_url('dashboard/barangay') ?>" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-2 rounded-md transition">
            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            <span class="text-sm font-medium">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('proposals/barangay') ?>" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-2 rounded-md transition">
            <i data-lucide="file-text" class="w-5 h-5"></i>
            <span class="text-sm font-medium">View Proposals</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('skmembers/view') ?>" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50 p-2 rounded-md transition">
            <i data-lucide="users"></i>
            <span class="text-sm font-medium">SK Member List</span>
          </a>
        </li>
        <li>
          <a href="/logout" class="flex items-center space-x-3 text-gray-700 hover:text-red-600 hover:bg-red-50 p-2 rounded-md transition">
            <i data-lucide="log-out" class="w-5 h-5"></i>
            <span class="text-sm font-medium">Logout</span>
          </a>
        </li>
      </ul>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="ml-64 p-6 flex-1">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Barangay Dashboard</h1>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500">Total Proposals Submitted</p>
            <h3 class="text-xl font-bold"><?= $totalProposals ?></h3>
          </div>
          <div class="bg-blue-100 text-blue-600 rounded-full p-2">
            <i data-lucide="file-text" class="w-6 h-6"></i>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500">Approved Proposals</p>
            <h3 class="text-xl font-bold"><?= $approvedCount ?></h3>
          </div>
          <div class="bg-green-100 text-green-600 rounded-full p-2">
            <i data-lucide="check-circle" class="w-6 h-6"></i>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500">Pending Proposals</p>
            <h3 class="text-xl font-bold"><?= $pendingCount ?></h3>
          </div>
          <div class="bg-yellow-100 text-yellow-600 rounded-full p-2">
            <i data-lucide="clock" class="w-6 h-6"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Proposal Breakdown and Chart -->
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Proposal Breakdown</h2>
        <p class="text-green-600 font-semibold">Approved: <?= $approvedCount ?></p>
        <p class="text-yellow-600 font-semibold">Pending: <?= $pendingCount ?></p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Status Chart</h2>
        <div class="w-full h-64">
          <canvas id="proposalStatusChart" class="w-full h-full"></canvas>
        </div>
      </div>
    </div>

    <!-- Recent Proposals -->
    <div class="mt-8 bg-white p-6 rounded-xl shadow">
      <h2 class="text-lg font-semibold text-gray-700 mb-4">Recent Proposals</h2>
      <ul class="divide-y divide-gray-200">
        <?php foreach ($recentProposals as $proposal): ?>
          <li class="py-2">
            <div class="flex justify-between">
              <div>
                <h3 class="text-md font-medium text-gray-800"><?= esc($proposal['title']) ?></h3>
                <p class="text-sm text-gray-500"><?= esc($proposal['status']) ?> • <?= date('M d, Y', strtotime($proposal['created_at'])) ?></p>
              </div>
              <button 
                class="text-blue-600 hover:underline text-sm viewProposalBtn" 
                data-id="<?= $proposal['id'] ?>"
              >
                View
              </button>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- Overview -->
    <div class="mt-8">
      <h2 class="text-lg font-semibold text-gray-700 mb-2">Overview</h2>
      <p class="text-gray-600">Here you can manage and track SK proposals submitted by the youth sector. Use the sidebar to view full proposals and respond as needed.</p>
    </div>
  </main>
</div>

<!-- Modal -->
<div id="proposalModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
  <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh]">
    <h2 class="text-xl font-semibold mb-4" id="modalTitle">Proposal Title</h2>
    <div id="modalContent" class="space-y-2 text-gray-700 text-sm">
      <!-- Loaded via AJAX -->
    </div>
    <div class="mt-6 text-right">
      <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Close</button>
    </div>
  </div>
</div>

<!-- Chart.js + Modal Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Chart
  const ctx = document.getElementById('proposalStatusChart').getContext('2d');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Approved', 'Pending'],
      datasets: [{
        data: [<?= $approvedCount ?>, <?= $pendingCount ?>],
        backgroundColor: ['rgba(34, 197, 94, 0.7)', 'rgba(234, 179, 8, 0.7)'],
        borderColor: ['rgba(34, 197, 94, 1)', 'rgba(234, 179, 8, 1)'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' },
        tooltip: {
          callbacks: {
            label: (context) => `${context.label}: ${context.parsed} proposal(s)`
          }
        }
      }
    }
  });

  function closeModal() {
    document.getElementById('proposalModal').classList.add('hidden');
    document.getElementById('modalContent').innerHTML = '';
  }

  document.querySelectorAll('.viewProposalBtn').forEach(btn => {
    btn.addEventListener('click', async () => {
      const id = btn.getAttribute('data-id');
      const modal = document.getElementById('proposalModal');
      const content = document.getElementById('modalContent');

      try {
        const response = await fetch(`/dashboard/viewProposal/${id}`);
        if (!response.ok) throw new Error("Proposal not found");
        const data = await response.json();

        document.getElementById('modalTitle').textContent = data.title;
        content.innerHTML = `
          <p><strong>Category:</strong> ${data.category}</p>
          <p><strong>Description:</strong> ${data.description}</p>
          <p><strong>Objectives:</strong> ${data.objectives}</p>
          <p><strong>Beneficiaries:</strong> ${data.beneficiaries}</p>
          <p><strong>Location:</strong> ${data.location}</p>
          <p><strong>Start - End:</strong> ${data.start_date} to ${data.end_date}</p>
          <p><strong>Estimated Budget:</strong> ₱${data.estimated_budget}</p>
          <p><strong>Budget Breakdown:</strong> ${data.budget_breakdown}</p>
          <p><strong>Source of Funds:</strong> ${data.source_of_funds}</p>
          <p><strong>Expected Outcomes:</strong> ${data.expected_outcomes}</p>
          <p><strong>Partners:</strong> ${data.partners}</p>
          ${data.attachments ? `<p><strong>Attachment:</strong> <a href="/uploads/${data.attachments}" target="_blank">View File</a></p>` : ''}
        `;
        modal.classList.remove('hidden');
      } catch (err) {
        alert("Failed to load proposal details.");
      }
    });
  });
</script>
  

</body>
</html>

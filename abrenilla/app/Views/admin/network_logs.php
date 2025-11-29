<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta charset="UTF-8">
  <title>Network Activity Logs</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen font-sans">

<div class="max-w-6xl mx-auto py-10 px-6">

  <!-- Header -->
  <div class="flex items-center justify-between mb-8 border-b border-gray-700 pb-4">
    <h2 class="text-3xl font-bold text-yellow-400 flex items-center gap-2">
      🧠 Network Activity Logs
    </h2>

    <div class="flex gap-2">
      <!-- Clear Logs Button -->
      <form action="<?= site_url('network-logs/clear') ?>" method="post" onsubmit="return confirm('Are you sure you want to clear all logs?')">
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
          🧹 Clear Logs
        </button>
      </form>

      <!-- Maintenance Toggle Button -->
      <button onclick="toggleSystemMode(this)"
              class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
        ⚙️ Toggle Maintenance Mode
      </button>
    </div>
  </div>

  <!-- Logs Table -->
  <div class="overflow-x-auto rounded-xl shadow-xl border border-gray-700">
    <table class="min-w-full text-sm">
      <thead class="bg-gray-800 text-gray-300 uppercase text-xs tracking-wider">
        <tr>
          <th class="px-5 py-3 text-left">#</th>
          <th class="px-5 py-3 text-left">User</th>
          <th class="px-5 py-3 text-left">IP Address</th>
          <th class="px-5 py-3 text-left">MAC Address</th>
          <th class="px-5 py-3 text-left">Action</th>
          <th class="px-5 py-3 text-left">Timestamp</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-800">
        <?php if (!empty($logs)): ?>
          <?php $count = 1; foreach ($logs as $log): ?>
            <tr class="hover:bg-gray-800/60 transition-colors">
              <td class="px-5 py-3 text-gray-400"><?= $count++ ?></td>
              <td class="px-5 py-3 font-medium text-yellow-400"><?= esc($log['full_name'] ?? 'Unknown User') ?></td>
              <td class="px-5 py-3"><?= esc($log['ip_address']) ?></td>
              <td class="px-5 py-3"><?= esc($log['mac_address']) ?></td>
              <td class="px-5 py-3 text-blue-400"><?= esc($log['action']) ?></td>
              <td class="px-5 py-3 text-gray-300"><?= date('M d, Y h:i A', strtotime($log['created_at'])) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="px-5 py-8 text-center text-gray-400">
              🚫 No network activity recorded yet.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</div>

<!-- Flash Message Toast -->
<?php if (session()->getFlashdata('success')): ?>
  <div id="toast"
       class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 animate-fade-in">
    ✅ <?= esc(session()->getFlashdata('success')) ?>
  </div>
  <script>
    setTimeout(() => {
      const toast = document.getElementById('toast');
      if (toast) toast.remove();
    }, 2000);
  </script>
<?php endif; ?>

<!-- Maintenance Toggle JS -->
<script>
async function toggleSystemMode(el) {
    try {
        const response = await fetch('<?= site_url('api/toggle-system-mode') ?>', { method: 'POST' });
        if (!response.ok) throw new Error('Failed to toggle');

        const data = await response.json();
        alert(`System maintenance mode: ${data.maintenance ? 'ON' : 'OFF'}`);
    } catch (err) {
        console.error('Error toggling system mode:', err);
        alert('Failed to toggle system mode');
    }
}
</script>

</body>
</html>
  
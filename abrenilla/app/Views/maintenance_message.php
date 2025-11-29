<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>System Maintenance | SK Youth Portal</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 via-sky-500 to-yellow-400 text-white">

  <div class="bg-white/10 backdrop-blur-md rounded-3xl p-10 text-center shadow-2xl max-w-md mx-auto border border-white/20">
    <div class="flex justify-center mb-6">
      <div class="bg-white rounded-full p-4 shadow-lg">
        <span class="text-5xl">⚙️</span>
      </div>
    </div>

    <h1 class="text-3xl md:text-4xl font-extrabold mb-4">System Under Maintenance</h1>
    <p class="text-white/90 mb-6 leading-relaxed">
      The SK Youth Portal is currently undergoing system updates to improve your experience.
      Please check back soon. 💪
    </p>

    <div class="mt-6">
      <div class="inline-flex items-center bg-white text-blue-700 font-semibold py-2 px-6 rounded-full shadow-lg hover:bg-blue-50 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18m-6 6l6-6-6-6" />
        </svg>
        Please come back later
      </div>
    </div>

    <footer class="mt-10 text-sm text-white/70">
      <p>— Sangguniang Kabataan Youth Portal —</p>
      <p class="mt-1">&copy; <?= date('Y'); ?> All Rights Reserved.</p>
    </footer>
  </div>

</body>
</html>

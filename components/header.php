<?php
// Check if a session is not already started before calling session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function confirmLogout(event) {
      event.preventDefault(); // Prevent the default action of the link
      if (confirm("Are you sure you want to log out?")) {
        window.location.href = event.target.href; // Redirect to the logout page
      }
    }
  </script>
</head>

<body>
  <header class="bg-gray-800">
    <nav class="container mx-auto px-6 py-3">
      <div class="flex items-center justify-between">
        <div class="text-white font-bold text-xl">
          <a href="/index.php">StepUp Shoes</a>
        </div>
        <div class="hidden md:flex items-center space-x-4">
          <a href="/index.php" class="text-gray-300 hover:text-white">Home</a>
          <a href="/shoes/" class="text-gray-300 hover:text-white">Shoes</a>
          <a href="/manage/index.php" class="text-gray-300 hover:text-white">Manage</a>
          <?php if (isset($_SESSION['admin_id'])): ?>
            <a href="/login/logoutprocess.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" onclick="confirmLogout(event)">Logout</a>
          <?php else: ?>
            <a href="/login/login.php" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
          <?php endif; ?>
        </div>
        <div class="md:hidden">
          <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none">
            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
              <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </button>
        </div>
      </div>
      <div id="mobile-menu" class="md:hidden hidden mt-2">
        <a href="/index.php" class="block text-gray-300 hover:text-white py-2">Home</a>
        <a href="/shoes/" class="block text-gray-300 hover:text-white py-2">Shoes</a>
        <a href="/login/manage.php" class="block text-gray-300 hover:text-white py-2">Manage</a>
        <?php if (isset($_SESSION['admin_id'])): ?>
          <a href="/login/logoutprocess.php" class="block text-gray-300 hover:bg-gray-700 hover:text-white py-2" onclick="confirmLogout(event)">Logout</a>
        <?php else: ?>
          <a href="/login/login.php" class="block text-gray-300 hover:bg-gray-700 hover:text-white py-2">Login</a>
        <?php endif; ?>
      </div>
    </nav>
  </header>

  <script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>logout | StepUp Shoes</title>
    <!-- icon -->
    <link rel="icon" href="../assets/favicon.svg" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #131212;
      color: #f8f9fa;
      font-family: 'Arial', sans-serif;
    }
    .logout-container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .logout-frame {
      width: 80%;
      max-width: 500px;
      background: #1b1919;
      border: 1px solid #343a40;
      box-shadow: 0 8px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      padding: 40px;
      text-align: center;
    }
    .logout-frame h1 {
      font-weight: 700;
      margin-bottom: 30px;
      color: #ffffff;
    }
    .logout-frame p {
      color: #ffffff;
      margin-bottom: 30px;
    }
    .logout-frame button {
      background-color: #ff0000;
      border-color: #ff0000;
    }
    .logout-frame button:hover {
      background-color: #e60000;
      border-color: #e60000;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logout-container">
      <div class="logout-frame">
        <h1>You have been logged out</h1>
        <p>Thank you for visiting StepUp Shoes. You have successfully logged out.</p>
        <a href="/login/login.php" class="btn btn-primary btn-block">Login Again</a>
        <!-- Redirect to login with message -->
        <a href="/login/login.php?message=login_required" class="btn btn-secondary btn-block mt-2">Return to Home</a>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

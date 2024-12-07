<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | StepUp Shoes</title>
    <!-- icon -->
    <link rel="icon" href="../assets/favicon.svg" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <div class="container">
    <div class="register-container">
      <div class="register-frame">
        <h1>Create Account</h1>
        <?php
        session_start();
        if (!empty($_SESSION['error_msg'])) { ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error_msg']); ?></div>
          <?php unset($_SESSION['error_msg']); // Clear error message after displaying it ?>
        <?php } ?>

        <form action="registerProcess.php" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            <ul class="password-requirements">
              <li id="length" class="invalid">At least 8 characters long</li>
              <li id="uppercase" class="invalid">At least one uppercase letter</li>
              <li id="lowercase" class="invalid">At least one lowercase letter</li>
              <li id="digit" class="invalid">At least one digit</li>
              <li id="special" class="invalid">At least one special character</li>
            </ul>
          </div>
          <button type="submit" class="btn btn-primary">Register</button>
        </form>
        
        <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    document.getElementById('password').addEventListener('input', function() {
      var password = this.value;

      // Length check
      var lengthCondition = document.getElementById('length');
      if (password.length >= 8) {
        lengthCondition.classList.remove('invalid');
        lengthCondition.classList.add('valid');
      } else {
        lengthCondition.classList.remove('valid');
        lengthCondition.classList.add('invalid');
      }

      // Uppercase letter check
      var uppercaseCondition = document.getElementById('uppercase');
      if (/[A-Z]/.test(password)) {
        uppercaseCondition.classList.remove('invalid');
        uppercaseCondition.classList.add('valid');
      } else {
        uppercaseCondition.classList.remove('valid');
        uppercaseCondition.classList.add('invalid');
      }

      // Lowercase letter check
      var lowercaseCondition = document.getElementById('lowercase');
      if (/[a-z]/.test(password)) {
        lowercaseCondition.classList.remove('invalid');
        lowercaseCondition.classList.add('valid');
      } else {
        lowercaseCondition.classList.remove('valid');
        lowercaseCondition.classList.add('invalid');
      }

      // Digit check
      var digitCondition = document.getElementById('digit');
      if (/[0-9]/.test(password)) {
        digitCondition.classList.remove('invalid');
        digitCondition.classList.add('valid');
      } else {
        digitCondition.classList.remove('valid');
        digitCondition.classList.add('invalid');
      }

      // Special character check
      var specialCondition = document.getElementById('special');
      if (/[\W_]/.test(password)) {
        specialCondition.classList.remove('invalid');
        specialCondition.classList.add('valid');
      } else {
        specialCondition.classList.remove('valid');
        specialCondition.classList.add('invalid');
      }
    });
  </script>
</body>
</html>

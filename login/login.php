<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | StepUp Shoes</title>
    <!-- icon -->
    <link rel="icon" href="../assets/favicon.svg" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">   
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-frame">
                <div class="shoe-image">
                    <img src="/resources/login-img.jpg" alt="Shoe Image">
                </div>
                <div class="login-form">
                    <h1>Welcome to StepUp Shoes</h1>
                    <?php
                    session_start();
                    if (!empty($_SESSION['error_msg'])) {
                        echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error_msg']) . '</div>';
                        unset($_SESSION['error_msg']);
                    }
                    ?>
                    <form action="loginProcess.php" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                    <p class="text-center mt-3">Don't have an account? <a href="register.php">Create Account</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
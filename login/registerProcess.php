<?php
// Start session
session_start();

// Database connector class
class DbConnector {
    private ?PDO $conn = null;

    public function __construct() {
        $dsn = 'mysql:host=localhost;dbname=stepup_shoes';
        $username = 'root';
        $password = '';

        try {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Database connection failed: ' . $e->getMessage();
            exit();
        }
    }

    public function getConnection(): ?PDO {
        return $this->conn;
    }
}

// User registration class
class UserRegistration {
    private ?PDO $conn;
    private string $error_msg = '';

    public function __construct(DbConnector $dbConnector) {
        $this->conn = $dbConnector->getConnection();
    }

    public function registerUser(string $username, string $password): void {
        // Validate username
        if (!$this->validateUsername($username)) {
            $this->redirectWithMessage('/login/register.php', $this->error_msg);
        }

        // Validate password
        if (!$this->validatePassword($password)) {
            $this->redirectWithMessage('/login/register.php', $this->error_msg);
        }

        // Check username availability
        if (!$this->checkUsernameAvailability($username)) {
            $this->redirectWithMessage('/login/register.php', $this->error_msg);
        }

        // Insert user into the database
        $this->insertUser($username, $password);
    }

    private function validateUsername(string $username): bool {
        if (empty($username)) {
            $this->error_msg = "Username is required.";
            return false;
        } elseif (strlen($username) < 5) {
            $this->error_msg = "Username must be at least 5 characters long.";
            return false;
        }
        return true;
    }

    private function validatePassword(string $password): bool {
        if (empty($password)) {
            $this->error_msg = "Password is required.";
            return false;
        }

        $password_length = strlen($password);
        $has_uppercase = preg_match('/[A-Z]/', $password);
        $has_lowercase = preg_match('/[a-z]/', $password);
        $has_digit = preg_match('/[0-9]/', $password);
        $has_special = preg_match('/[\W_]/', $password);

        if ($password_length < 8 || !$has_uppercase || !$has_lowercase || !$has_digit || !$has_special) {
            $this->error_msg = "Password must be at least 8 characters long, with one uppercase letter, one lowercase letter, one digit, and one special character.";
            return false;
        }
        return true;
    }

    private function checkUsernameAvailability(string $username): bool {
        $sql = "SELECT * FROM admin WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $this->error_msg = "Username already taken.";
            return false;
        }
        return true;
    }

    private function insertUser(string $username, string $password): void {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admin (username, password_hash) VALUES (:username, :password_hash)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password_hash', $password_hash);

        try {
            $stmt->execute();
            $this->redirectWithMessage('/login/login.php', 'Registration successful. Please login.');
        } catch (PDOException $e) {
            $this->redirectWithMessage('/login/register.php', 'Error: ' . $e->getMessage());
        }
    }

    private function redirectWithMessage(string $location, string $message): void {
        $_SESSION['error_msg'] = $message;
        header("Location: $location");
        exit();
    }
}

// Instantiate required classes
$dbConnector = new DbConnector();
$userRegistration = new UserRegistration($dbConnector);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate input
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Register the user
    $userRegistration->registerUser($username, $password);
}
?>

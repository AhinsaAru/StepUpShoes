<?php
session_start();

// Class to connect to the database
class DbConnector {
    private $conn; 

    public function __construct() {
        $dsn = 'mysql:host=localhost;dbname=stepup_shoes'; 
        $username = 'root'; 
        $password = '';

        try {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit();
        }
    }
    // Get the database connection
    public function getConnection() {
        return $this->conn;
    }
}

// Handle user login
class Auth {
    private $conn; 
    public function __construct($dbConnector) {
        $this->conn = $dbConnector->getConnection();
    }
    public function login($username, $password) {
        $sql = "SELECT * FROM admin WHERE username = :username";
        $stmt = $this->conn->prepare($sql); 
        $stmt->bindParam(':username', $username);
        $stmt->execute(); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 

        if ($row && password_verify($password, $row['password_hash'])) {
            $_SESSION['admin_id'] = $row['admin_id'];
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['error_msg'] = "Invalid username or password.";
            header("Location: login.php");
            exit();
        }
    }
}

$dbConnector = new DbConnector();
$auth = new Auth($dbConnector);

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $auth->login($username, $password);
}
?>

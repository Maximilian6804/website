<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session configuration
session_set_cookie_params([
    'secure' => true, // Send only over HTTPS
    'httponly' => true, // No access via JavaScript
    'samesite' => 'Strict' // No cross-site access
]);
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php"); // User is logged in, redirect to the dashboard
    exit();
}

// Database connection
require_once 'config.php';

// Establish connection to the database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Check if username or email exists
    $sql = "SELECT * FROM users WHERE username=? OR email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"]; // Store username in session
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Username or email not found.";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles_login.css"> 
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <input type="text" name="login" placeholder="Username or Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account yet? <a href="register.php">Register now</a></p>
            <a href="/index.php" class="home-button">Back to homepage</a> 
        </div>
    </div>
</body>
</html>

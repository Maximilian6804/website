<?php
session_start();

$timeout_duration = 1800; // 30-minute session timeout

// Check if the session has expired
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Session expired, log out the user
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

// Update last activity timestamp
$_SESSION['LAST_ACTIVITY'] = time();

// Redirect to login page if the user is not authenticated
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_dashboard.css"> <!-- Link to external CSS file -->
    <title>Dashboard</title>
</head>
<body>

<main class="content">
    <header>
        <nav>
            <ul>
                <li><a href="/index.php">Home</a></li>
                <li><a href="https://github.com/Maximilian6804" target="_blank">GitHub</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- User dropdown menu -->
    <div class="user-box">
        <button class="user-button" onclick="toggleDropdown()">
            <?php
            // Display the logged-in user's username
            echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : "Guest";
            ?>
            ▼
        </button>
        <div class="dropdown-menu" id="dropdown-menu">
            <a href="#">Settings</a>
            <a href="#">Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <h1>Welcome to the Dashboard!</h1>

    <script src="script_dashboard.js"></script>

</body>
</html>

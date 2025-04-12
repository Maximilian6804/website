<?php
session_start();

$timeout_duration = 1800;

// Check if the last activity timestamp is set
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Last activity was too long ago, destroy the session and log out the user
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

// Set last activity to the current time
$_SESSION['LAST_ACTIVITY'] = time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <aside class="profile-sidebar">
            <img src="images/profile.png" alt="Profile Picture" class="profile-pic">
            <h1>Maximilian</h1>
            <p class="subtitle">Developer | Learning Coder</p>
            <div class="contact-info">
                <p><strong>DISCORD:</strong> @maximilian.s</p>
                <p><strong>LOCATION:</strong> NRW, Germany</p>
            </div>
        </aside>

        <main class="content">
            <header>
                <nav>
                    <ul>
                        <li><a href="#about">About</a></li>
                        <li><a href="https://github.com/Maximilian6804" target="_blank">GitHub</a></li>
                        <li><a href="#">Projects</a></li>
                        <li><a href="user/dashboard.php">Dashboard</a></li>
                        <li><a href="user/contact.html">Contact</a></li>
                        <li><a href="user/login.php">Login</a></li>
                    </ul>
                </nav>
            </header>

            <!-- User box at the top right -->
            <div class="user-box">
                <button class="user-button" onclick="toggleDropdown()">
                    <?php
                    // Display username if the user is logged in
                    if (isset($_SESSION['username'])) {
                        echo htmlspecialchars($_SESSION['username']); // Safe output
                    } else {
                        echo "Guest"; // If the user is not logged in
                    }
                    ?>
                    ▼
                </button>

                <!-- Dropdown menu for the user -->
                <div class="dropdown-menu" id="dropdown-menu">
                    <a href="#">Settings</a>
                    <a href="#">Profile</a>
                    <a href="user/logout.php">Logout</a>
                </div>
            </div>

            <section id="about">
                <h2>About Me</h2>
                <p>Hey, I'm Maximilian. I am a hobby developer, mainly focusing on this website right now, but sometimes I also like to work on other projects.</p>
                <h3>Tech Stack</h3>
                <div class="tech-stack">
                    <i class="fab fa-html5"></i>
                    <i class="fab fa-css3-alt"></i>
                    <i class="fab fa-python"></i>
                    <i class="fab fa-java"></i>
                    <i class="fab fa-github"></i>
                    <i class="fas fa-c"></i><span>#</span>
                </div>
            </section>
            
            <section id="work">
                <h3>What I'm Doing:</h3>
                <div class="work-item">
                    <h4>My Website</h4>
                    <p>I am currently working on this website in my spare time.</p>
                </div>
                <div class="work-item">
                    <h4>Minecraft Development</h4>
                    <p>I develop plugins for Minecraft using the Paper/Bukkit APIs.</p>
                </div>

                <h3>Work in progress:</h3>
                <div class="work-item">
                    <h5>Profile settings</h5>
                    <h5>Profile</h5>
                    <h5>Profile customization</h5>
                    <h5>Dashboard</h5>
                    <h5>Projects Tab</h5>
                </div>
            </section>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>

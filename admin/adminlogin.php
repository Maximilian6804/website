<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles_adminlogin.css"> <!-- CSS-Datei verlinken -->
</head>
<body>

<div class="admin-login-container"> <!-- Anwendung der neuen CSS-Klasse -->
    <h2>Admin Login</h2>
    <form action="adminlogin.php" method="POST">
        <label for="username">Benutzername:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Einloggen">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();  // Session starten

        $admin_username = "admin";
        $admin_password = "12345";

        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username === $admin_username && $password === $admin_password) {
            $_SESSION['admin_logged_in'] = true;  // Setze Admin-Status in der Session
            header('Location: admin_dashboard.php');  // Leite weiter zum Admin-Dashboard
            exit;
        } else {
            echo "<p class='error-message'>Ungültiger Benutzername oder Passwort.</p>"; // Nutzung der Fehlerklasse
        }
    }
    ?>
</div>

</body>
</html>

<?php
session_start();
session_destroy();
header("Location: login.php"); // Umleitung zur Anmeldeseite
exit();
?>

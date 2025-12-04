<?php
// Session starten (notwendig für Login/Logout-Anzeige)
session_start();
?>

<nav>
    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Benutzer ist eingeloggt -->
        <a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['user_name']); ?>)</a>
    <?php else: ?>
        <!-- Benutzer ist NICHT eingeloggt -->
        <a href="login.php">Login</a>
        
    <?php endif; ?>

    <ul class="nav-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="produkte.php">Produkte</a></li>
        <li><a href="login.php">Anmeldung</a></li> <!-- Be jaye "Registrieren", link ro be login.php ersāl mikonim -->
        <li><a href="#">Warenkorb</a></li>
        <li><a href="#">Über uns</a></li>
        <li><a href="#">Kontakt</a></li>
    </ul>
</nav>

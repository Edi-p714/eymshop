<?php
// Session starten (notwendig für Login/Logout-Anzeige)
session_start();
?>

<nav>
    <a href="index.php">Starseite</a>
    <a href="produkte.php">Produkte</a>

    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Benutzer ist eingeloggt -->
        <a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['user_name']); ?>)</a>

    <?php else: ?>
        <!-- Benutzer ist NICHT eingeloggt -->
        <a href="login.php">Login</a>
        <a href="register.php">Registrieren</a>
    <ul class="nav-menu">
        <li><a href="#">Home</a></li>
        <li><a href="#">Kategorie</a></li>
        <li><a href="#">Anmeldung</a></li>
        <li><a href="#">Warenkorb</a></li>
        <li><a href="#">Über uns</a></li>
        <li><a href="#">Kontakt</a></li>
    </ul>





    <?php endif; ?>        
</nav>
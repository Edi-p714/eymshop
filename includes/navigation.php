<nav class="main-nav">
    <div class="nav-user">
    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Benutzer ist eingeloggt -->
        <a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['user_name']); ?>)</a>
    <?php else: ?>
        <a href="login.php">login</a>
    <?php endif; ?>
    </div>
    

    <ul class="nav-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="produkte.php">Produkte</a></li>
        <li><a href="register.php">Registrierung</a></li> <!-- Be jaye "Registrieren", link ro be login.php ersāl mikonim -->
        <li><a href="warenkorb.php">Warenkorb</a></li>
        <li><a href="#">Über uns</a></li>
        <li><a href="#">Kontakt</a></li>
    </ul>
</nav>

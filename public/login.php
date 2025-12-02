<?php
// Gemeinsame Seiteelemente laden
require_once '../includes/header.php';
require_once '../includes/navigation.php';
require_once '../includes/db.php'; 
?>

<h2>Login</h2>

<?php 
// Hinweis nach erfolgreicher Registrierung anzeigen
if (isset($_GET['success'])) {
    echo '<p>Registrierung erfolgreich! Bitte einloggen.</p>';
} 
?>

<!-- Login-Formular (sendet Daten an login_action.php) -->
<form action="login_action.php" method="POST">

    <!-- E-Mail-Adresse -->
    <label for="email">E-Mail:</label><br>
    <input type="email" name="email" required><br><br>

    <!-- Passwort -->
    <label for="passwort">Passwort</label><br>
    <input type="password" name="passwort" id="passwort" required><br><br>

    <!-- Formular absenden -->
    <button type="submit">Login</button>
</form>

<?php
// Fußbereich laden
require_once '../includes/footer.php';
?>
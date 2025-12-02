<?php
// Navigation einbinden (enthält session_start und Menü)
require_once '../includes/header.php';
require_once '../includes/navigation.php';
require_once '../includes/db.php'; 
?>

<h2>Registrierung</h2>

<!-- Registrierungsformular (sendet Daten an register_action.php) -->
<form action="register_action.php" method="POST">
<!-- Vorname -->
    <label for="name">Vorname</label><br>
    <input type="text" name="name" id="name" required><br>

    <!-- E-Mail-Adresse -->
    <label for="email">E-Mail:</label><br>
    <input type="email" name="email" required><br>

    <!-- passwort -->
    <label for="passwort">Passwort:</label><br>
    <input type="password" name="passwort" id="passwort" required><br>

    <!-- Absenden -->
    <button type="submit">Registrieren</button>
</form>

<?php require_once '../includes/footer.php';?>


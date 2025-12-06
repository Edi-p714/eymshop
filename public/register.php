<?php
// Fehler anzeigen
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session starten
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konto erstellen - EymShop</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/register-style.css">
</head>
<body>

<?php
require_once '../includes/header.php';
?>   

<div class="container">
    <div class="register-page">
        <h1 class="register-title">Konto erstellen</h1>
        <p class="register-subtitle">Treten Sie EYMShop bei und entdecken Sie eine großartige Auswahl an Produkten</p>

        <!-- Fehlermeldungen -->
        <?php if (isset($_GET['error'])): ?>
            <div class="error-message" style="color: red; margin-bottom: 15px;">
                <?php
                $error = $_GET['error'];
                // Fehlercodes Übersetzen
                switch ($error) {
                    case 'empty': $msg = 'Alle Felder müssen ausgefüllt werden.'; break;
                    case 'email_exists': $msg = 'Diese E-Mail existiert bereits.'; break;
                    case 'password': $msg = 'Passwort muss mindestens 6 Zeichen haben.'; break;
                    case 'password_mismatch': $msg = 'Passwörter stimmen nicht überein.'; break;
                    case 'terms': $msg = 'Bitte akzeptieren Sie die Nutzungsbedingungen.'; break;
                    default: $msg = 'Ein Fehler ist aufgetreten.';
                }
                ?>
            </div>
        <?php endif; ?>
    

        <form action="register_action.php" method="POST" class="register-form" id="registerForm">
            <div class="form-group">
                <label for="name">Vollständiger Name *</label>
                <input type="text" name="name" id="name" placeholder="Max Mustermann" required>
            </div>

            <div class="form-group">
                <label for="email">E-Mail-Adresse *</label>
                <input type="email" name="email" id="email" placeholder="max@beispiel.de" required>
            </div>

            <div class="form-group">
                <label for="passwort">Passwort *</label>
                <input type="password" name="passwort" id="passwort" placeholder="Geben Sie ein sicheres Passwort ein" required>
                <p class="password-hint">Mindestens 6 Zeichen erforderlich.</p>
            </div>

            <div class="form-group">
                <label for="passwort_confirm">Passwort bestätigen *</label>
                <input type="password" name="passwort_confirm" id="passwort_confirm" placeholder="Geben Sie Ihr Passwort erneut ein" required>
            </div>

            <div class="terms-group">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">Ich akzeptiere die Datenschutzrichtlinie und die Nutzungsbedingungen</label>
            </div>

            <button type="submit" class="register-btn">Konto erstellen</button>
        </form>

        <div class="login-link">
            <p>Haben Sie bereits ein Konto? <a href="login.php">Hier anmelden</a></p>
        </div>
    </div>
</div>

<script>
document.getElementById('registerForm').addEventListener('submit', function(event) {
    const password = document.getElementById('passwort').value;
    const confirmPassword = document.getElementById('passwort_confirm').value;

    if (password !== confirmPassword) {
        event.preventDefault();
        alert('Passwörter stimmen nicht überein.');
    }
});
</script>

<?php require_once '../includes/footer.php'; ?>
</body>
</html>

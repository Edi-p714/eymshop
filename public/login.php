<?php
session_start();
require_once '../includes/header.php';
require_once '../includes/navigation.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmelden - EymShop</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/login-style.css">
</head>
<body>
<div class="container">
    <div class="login-page-container">
        <div class="login-container">
            <h2>Anmelden</h2>

            <?php 
            if (isset($_GET['success'])) {
                echo '<div class="message success-message">Registrierung erfolgreich! Bitte einloggen.</div>';
            } 
            if (isset($_GET['error'])) {
                echo '<div class="message error-message">Falsche E-Mail oder falsches Passwort.</div>';
            } 
            ?>

            <form action="login_action.php" method="POST" class="login-form">
                <div class="form-group">
                    <label for="email">E-Mail-Adresse</label>
                    <input type="email" name="email" id="email" placeholder="ihre.email@beispiel.de" required>
                </div>

                <div class="form-group">
                    <label for="passwort">Passwort</label>
                    <input type="password" name="passwort" id="passwort" placeholder="Ihr Passwort" required>
                </div>

                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Angemeldet bleiben</label>
                    </div>
                    <div class="forgot-password">
                        <a href="#" class="forgot-link">Passwort vergessen?</a>
                    </div>
                </div>

                <button type="submit" class="login-button">Anmelden</button>
            </form>

            <div class="register-link">
                <p>Haben Sie noch kein Konto? <a href="register.php">Jetzt registrieren</a></p>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
</body>
</html>

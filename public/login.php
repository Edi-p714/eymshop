<?php
session_start();

// E-Mail aus URL vorbefüllen (falls vorhanden)
$prefilledEmail = $_GET['email'] ??'';
$errorCode = $_GET['error'] ?? null;
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

<?php 
// Header einbinden
require_once '../includes/header.php';
?>

<div class="container">
    <div class="login-page-container">
        <div class="login-container">
            <h2>Anmelden</h2>

            <?php
            // Erfolg nach Registrierung
            if (isset($_GET['success'])) {
                echo '<div class="message success-message" style="color: green; margin-bottom: 10px;">Registrierung erfolgreich! Bitte einloggen.</div>';
            } 

            // Fehlermeldungen
            if ($errorCode) {
                $msg = 'Falsche E-Mail oder falsches Passwort.';

                if ($errorCode === 'empty') {
                    $smg = 'Bitte E-Mail und Passwort ausfüllen.';
                } elseif ($errorCode === 'invalid') {
                        $smg = 'Falsche E-Mail oder flasches Paswwort.';
                    }
                    echo '<div class="message error-message" style="color: red; margin-bottom: 10px">' . htmlspecialchars($msg) .'</div>';        
            }
            ?>

            <form action="login_action.php" method="POST" class="login-form">
                <div class="form-group">
                    <label for="email">E-Mail-Adresse</label>
                    <input type="email" name="email" id="email" placeholder="ihre.email@beispiel.de" required
                    value="<?php echo htmlspecialchars($prefilledEmail); ?>">
                </div>

                <div class="form-group">
                    <label for="passwort">Passwort</label>
                    <input type="password" name="passwort" id="passwort" placeholder="Ihr Passwort" required>
                </div>

                <button type="submit"class="login-button">Anmelden</button>
            </form>

            <div class="register-link">
                <p>Noch kein Konto? <a href="register.php">Jetzt registrieren</a></p>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
</body>
</html>

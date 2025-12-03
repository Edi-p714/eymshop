<?php
// Fehler anzeigen
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Starte Session
session_start();

// Datenbankverbindung
require_once '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konto erstellen - EymShop</title>
    
    <!-- CSS-Dateien -->
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/register-style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <div class="logo-img">EYMShop</div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav>
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="produkte.php">Kategorie</a></li>
                <li><a href="login.php">Anmeldung</a></li>
                <li><a href="register.php" style="color: #e6a8b3;">Registrieren</a></li>
                <li><a href="warenkorb.php">Warenkorb</a></li>
            </ul>
        </nav>
        
        <!-- Search -->
        <div class="search-container">
            <input type="text" class="search-box" placeholder="Produkte suchen...">
            <div class="user-cart-container">
                <a href="login.php" class="login-link">Nutzer Konto</a>
                <a href="warenkorb.php" class="cart-link"></a>
            </div>
        </div>
        
        <!-- Register Content -->
        <div class="register-page">
            <h1 class="register-title">Konto erstellen</h1>
            <p class="register-subtitle">Treten Sie EYMShop bei und entdecken Sie eine großartige Auswahl an Produkten</p>
            
            <!-- Fehlermeldungen -->
            <?php 
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                $msg = '';
                switch ($error) {
                    case 'empty': $msg = 'Alle Felder müssen ausgefüllt werden.'; break;
                    case 'email_exists': $msg = 'Diese E-Mail existiert bereits.'; break;
                    case 'password': $msg = 'Passwort muss mindestens 6 Zeichen haben.'; break;
                    case 'password_mismatch': $msg = 'Passwörter stimmen nicht überein.'; break;
                    case 'terms': $msg = 'Bitte akzeptieren Sie die Nutzungsbedingungen.'; break;
                    default: $msg = 'Ein Fehler ist aufgetreten.';
                }
                echo '<div class="error-message">' . $msg . '</div>';
            }
            
            if (isset($_GET['success'])) {
                echo '<div class="success-message">Registrierung erfolgreich! Bitte einloggen.</div>';
            }
            ?>
            
            <form action="register_action.php" method="POST" class="register-form" id="registerForm">
                <!-- Vollständiger Name -->
                <div class="form-group">
                    <label for="name">Vollständiger Name *</label>
                    <input type="text" name="name" id="name" placeholder="Max Mustermann" required>
                </div>
                
                <!-- E-Mail-Adresse -->
                <div class="form-group">
                    <label for="email">E-Mail-Adresse *</label>
                    <input type="email" name="email" id="email" placeholder="max@beispiel.de" required>
                </div>
                
                <!-- Passwort -->
                <div class="form-group">
                    <label for="passwort">Passwort *</label>
                    <input type="password" name="passwort" id="passwort" placeholder="Geben Sie ein sicheres Passwort ein" required>
                    <p class="password-hint">Mindestens 6 Zeichen erforderlich.</p>
                </div>
                
                <!-- Passwort bestätigen -->
                <div class="form-group">
                    <label for="passwort_confirm">Passwort bestätigen *</label>
                    <input type="password" name="passwort_confirm" id="passwort_confirm" placeholder="Geben Sie Ihr Passwort erneut ein" required>
                </div>
                
                <!-- Terms Checkbox -->
                <div class="terms-group">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">Ich akzeptiere die Datenschutzrichtlinie und die Nutzungsbedingungen</label>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="register-btn">Konto erstellen</button>
            </form>
            
            <!-- Login Link -->
            <div class="login-link">
                <p>Haben Sie bereits ein Konto? <a href="login.php">Hier anmelden</a></p>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>EymShop</h3>
                    <p>Ihr Online-Shop für Herren- und Damenbekleidung</p>
                </div>
                <div class="footer-section">
                    <h3>Kontakt</h3>
                    <p>Email: info@eymshop.de</p>
                    <p>Telefon: +49 123 456789</p>
                </div>
                <div class="footer-section">
                    <h3>Schnellzugriff</h3>
                    <a href="index.php">Startseite</a><br>
                    <a href="login.php">Login</a><br>
                    <a href="register.php">Registrieren</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> EymShop. Alle Rechte vorbehalten.</p>
            </div>
        </footer>
    </div>
    
    <!-- JavaScript direkt im HTML -->
    <script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('passwort').value;
        const confirmPassword = document.getElementById('passwort_confirm').value;
        const terms = document.getElementById('terms').checked;
        
        // Einfache Validierung
        if (!name || !email || !password || !confirmPassword) {
            event.preventDefault();
            alert('Bitte füllen Sie alle Pflichtfelder aus.');
            return false;
        }
        
        if (!terms) {
            event.preventDefault();
            alert('Bitte akzeptieren Sie die Nutzungsbedingungen.');
            return false;
        }
        
        if (password.length < 6) {
            event.preventDefault();
            alert('Passwort muss mindestens 6 Zeichen lang sein.');
            return false;
        }
        
        if (password !== confirmPassword) {
            event.preventDefault();
            alert('Passwörter stimmen nicht überein.');
            return false;
        }
        
        return true;
    });
    </script>
</body>
</html>
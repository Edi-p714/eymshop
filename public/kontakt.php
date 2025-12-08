<?php
// public/kontakt.php
session_start();
require_once '../includes/db.php';

// Variables para el formulario
$success = false;
$name = '';
$email = '';

// Si el usuario ya está logueado, pre-llenamos sus datos
if (isset($_SESSION['benutzer_id'])) {
    // Obtenemos el nombre de la sesión (si lo guardaste) o consultamos la BD
    // Por simplicidad, usaremos datos vacíos o de sesión si los tienes
    $name = $_SESSION['user_name'] ?? ''; 
    // Si quisieras el email, tendrías que consultarlo, pero dejémoslo que lo escriban
}

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí podrías guardar el mensaje en una tabla 'kontakt_nachrichten' si quisieras
    // Para el proyecto, simularemos el envío exitoso:
    $success = true;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt - EymShop</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/kontakt.css">
</head>
<body>

<div class="container">
    <?php require_once '../includes/header.php'; ?>

    <div class="contact-wrapper">
        <div class="contact-header">
            <h1>Kontaktieren Sie uns</h1>
            <p>Haben Sie Fragen? Wir sind für Sie da!</p>
        </div>

        <?php if ($success): ?>
            <div class="success-msg">
                <strong>Vielen Dank!</strong> Ihre Nachricht wurde erfolgreich gesendet. 
                Wir werden uns in Kürze bei Ihnen melden.
            </div>
        <?php endif; ?>

        <form action="kontakt.php" method="POST">
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-input" 
                       placeholder="Geben sie Ihren Name ein" required 
                       value="<?php echo htmlspecialchars($name); ?>">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">E-Mail-Adresse</label>
                <input type="email" id="email" name="email" class="form-input" 
                       placeholder="Ihre E-Mail Adresse" required>
            </div>

            <div class="form-group">
                <label for="betreff" class="form-label">Betreff</label>
                <select id="betreff" name="betreff" class="form-input">
                    <option value="allgemein">Allgemeine Anfrage</option>
                    <option value="bestellung">Frage zu einer Bestellung</option>
                    <option value="retoure">Rücksendung / Reklamation</option>
                    <option value="sonstiges">Sonstiges</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nachricht" class="form-label">Ihre Nachricht</label>
                <textarea id="nachricht" name="nachricht" class="form-textarea" 
                          placeholder="Ihre Nachricht" required></textarea>
            </div>

            <button type="submit" class="btn-send">Nachricht senden</button>
        </form>

        <div class="contact-info">
            <div class="info-item">
                <span class="info-icon">📍</span>
                <strong>Adresse</strong><br>
                Bismarktstraße<br>
                30455 Hannover
            </div>
            <div class="info-item">
                <span class="info-icon">📧</span>
                <strong>E-Mail</strong><br>
                eymshop@gmail.com
            </div>
            <div class="info-item">
                <span class="info-icon">📞</span>
                <strong>Telefon</strong><br>
                +49 176767676
            </div>
        </div>
    </div>

    <?php require_once '../includes/footer.php'; ?>
</div>




  
</body>
</html>
<?php
// Sitzung starten (notwendig für Benutzer-Login)
session_start();

// Datenbankverbindung laden
require_once '../includes/db.php';

// Nur POST-Anfragen verbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formular-Daten auslesen
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    // SQL: Benutzer anhand der E-Mail suchen
    $sql = "SELECT * FROM benutzer WHERE email = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Prüfen: Benutzer gefunden + Passwort korrekt?
    if ($user && password_verify($passwort, $user['passwort'])) {
        // Login erfolgreich - Session-Informationen speichern
        $_SESSION['user_id'] = $user['benutzer_id'];
        $_SESSION['user_name'] = $user['name'];

        // Benutzer nach erfolgreichem Login auf die Startseite leiten
        header("Location: index.php");
        exit;
    } else {
        // Fehlermeldung bei falschen Login-Daten
        echo "Falsche E-Mail oder falsches passwort.";
    }
}
?>
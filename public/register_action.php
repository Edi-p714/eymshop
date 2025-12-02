<?php
// Sitzung starten (notwendig für spätere Benitzeranmeldung)
session_start();

// Datenbankverbindung einbinden
require_once '../includes/db.php';

// Formular-Daten auslesen
// Wir prüfen mit dem Nullkoaleszenz-Operator (??), falls ein feld fehlt
$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$passwort = $_POST['passwort'] ?? null;

// Prüfung: Sind alle Pflichtfelder ausgefüllt?
if (!$name || !$email || !$passwort) {
    die("Fehler: Alle Felder müssen ausgefüllt werden.");
}

// Überprüfen, ob die E-Mail bereits existiert
$sql = "SELECT benutzer_id FROM benutzer WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

// Wenn ein Datensatz gefunden wurden -> E-Mail existiert bereits
if ($stmt->num_rows > 0) {
    die("Fehler: Diese E-Mail existiert bereits.");
}

// Passwort hashen für sichere Speicherung
$hash = password_hash($passwort, PASSWORD_DEFAULT);

// Neuen Benutzer einfügen
$sql = "INSERT INTO benutzer (name, email, passwort) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $hash);

// Wenn das Einfügen erfolgreich war -> Weiterleitung zur Login_Seite
if ($stmt->execute()) {
    header("Location: login.php?success=1");
    exit;

// Fehlerfall    
} else {
    die("Fehler beim Registrieren. Bitte später erneut versuchen.");
}
?>
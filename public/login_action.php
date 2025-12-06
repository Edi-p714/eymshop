<?php
// Fehler anzeigen
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session starten
session_start();

// Datenbankverbindungen
require_once '../includes/db.php';

// Nur POST-Anfragen
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
} 

// Daten holen
$email = trim($_POST['email'] ??'');
$passwort = $_POST['passwort'] ??'';

// Grundvalidierung: Felder leer?
if (empty($email) || empty($passwort)) {
    header("Location: login.php?error=empty&email=" .urlencode($email) );
    exit;
}

// Benutzer suchen
$sql = "SELECT benutzer_id, name, passwort FROM benutzer WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Benutzer prüfen
if ($user && password_verify($passwort, $user['passwort'])) {
    // Session setzen
    $_SESSION['benutzer_id'] = $user['benutzer_id'];
    $_SESSION['user_name'] = $user['name'];

    // Weiterleitung
    header("Location: index.php");
    exit;

} else {
    // Login fehlgeschlagen
    header("Location: login.php?error=invalid&email=" . urlencode($email));
    exit;
}
?>
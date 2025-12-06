<?php
// Fehler anzeigen (nur für entwicklung)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session starten 
session_start();

// Datenbankverbindung 
require_once '../includes/db.php';

// Prüfen, ob Formular gesendet wurde
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: register.php");
    exit;
}

// -------------------------------
// Formular-Daten lesen
// -------------------------------
$name = trim($_POST['name'] ??'');
$email = trim($_POST['email'] ??'');
$passwort = $_POST['passwort'] ??'';
$passwort_confirm = $_POST['passwort_confirm'] ??'';
$terms = isset($_POST['terms']);


// -------------------------------
// Grundvalidierungen
// -------------------------------
if (empty($name) || empty($email) || empty($passwort) || empty($passwort_confirm)) {
    header("Location: register.php?error=empty ");
    exit;
}

if (!$terms) {
    header("Location: register.php?error=terms");
    exit;
}

if (strlen($passwort)<6) {
    header("Location: register.php?error=password");
    exit;
}

if ($passwort !== $passwort_confirm) {
    header("Location: register.php?error=password_mismatch");
    exit;
}

// -------------------------------
// Prüfen ob E-Mail existiert
// -------------------------------
$sql_check = "SELECT benutzer_id FROM benutzer WHERE email = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

// Wenn ein Datensatz gefunden wurden -> E-Mail existiert bereits
if ($stmt->num_rows > 0) {
    header("Location: register.php?error=email_exists");
    exit;
}
$stmt->close();

// Passwort hashen für sichere Speicherung
$hash = password_hash($passwort, PASSWORD_DEFAULT);

// -------------------------------
// Benutzer speichern
// -------------------------------
$sql_insert = "INSERT INTO benutzer (name, email, passwort) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql_insert);
if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}
$stmt->bind_param("sss", $name, $email, $hash);

// Wenn das Einfügen erfolgreich war -> Weiterleitung zur Login_Seite
if ($stmt->execute()) {
    header("Location: login.php?success=registered");
    exit;

// Fehlerfall    
} else {
    header("Location: register.php?error=database");
    exit;
}



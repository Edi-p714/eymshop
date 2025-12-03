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
?><?php
// Fehler anzeigen
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Starte Session
session_start();

// Datenbankverbindung
require_once '../includes/db.php';

// Nur POST-Anfragen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hole Daten
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $passwort = $_POST['passwort'] ?? '';
    $passwort_confirm = $_POST['passwort_confirm'] ?? '';
    $terms = isset($_POST['terms']) ? true : false;
    
    // Validierung
    if (empty($name) || empty($email) || empty($passwort) || empty($passwort_confirm)) {
        header("Location: register.php?error=empty");
        exit;
    }
    
    if (!$terms) {
        header("Location: register.php?error=terms");
        exit;
    }
    
    if (strlen($passwort) < 6) {
        header("Location: register.php?error=password");
        exit;
    }
    
    if ($passwort !== $passwort_confirm) {
        header("Location: register.php?error=password_mismatch");
        exit;
    }
    
    try {
        // Prüfe E-Mail
        $stmt = $conn->prepare("SELECT benutzer_id FROM benutzer WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            header("Location: register.php?error=email_exists");
            exit;
        }
        
        // Passwort hashen
        $hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        // Benutzer speichern
        $stmt = $conn->prepare("INSERT INTO benutzer (vorname, email, passwort) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hash);
        
        if ($stmt->execute()) {
            header("Location: login.php?success=1");
            exit;
        } else {
            header("Location: register.php?error=database");
            exit;
        }
    } catch (Exception $e) {
        header("Location: register.php?error=database");
        exit;
    }
} else {
    header("Location: register.php");
    exit;
}
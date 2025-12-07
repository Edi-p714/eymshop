<?php
// Sitzung starten (notwendig, um aktive Session zu löschen)
session_start();

// Alle Session-Daten Löschen
$_SESSION = array();

//
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Session zerstören
session_destroy();

// Benutzer zurück zur Startseite leiten
header("Location: index.php?success=1");
exit;
?>
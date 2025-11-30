<?php
// Sitzung starten (notwendig, um aktive Session zu löschen)
session_start();

// Alle Session-Daten Löschen
session_destroy();

// Benutzer zurück zur Startseite leiten
header("Location: index.php");
exit;
?>
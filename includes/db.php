<?php
// includes/db.php

// Erkennung der Umgebung (lokal oder Produktion)
$host = $_SERVER['HTTP_HOST'];

$isLocal = (strpos($host, 'localhost') !== false) || (strpos($host, '127.0.0.1') !== false);

if ($isLocal) {
    // Lokale Umgebung (Mac/Windows)
    $servername = "localhost";
    $dbname = "Eymshop"; 

    mysqli_report(MYSQLI_REPORT_OFF);

    // Versuch 1: Windows/XAMPP
    $conn = @new mysqli($servername, "root", "", $dbname, 3306);

    // Versuch 2: Mac/MAMP
    if ($conn->connect_error) {
        $conn = @new mysqli($servername, "root", "root", $dbname, 8889);
        
        if ($conn->connect_error) {
            // Si ambos fallan, reactivamos errores y morimos
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            die("Local Connection Failed (XAMPP & MAMP): " . $conn->connect_error);
        }
    }

} else {
    // Produktionsumgebung (Live-Server)

    $servername = " ... "; 
    $username   = " ... ";
    $password   = " ... "; 
    $dbname     = " ... "; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Live Connection Failed: " . $conn->connect_error);
    }
}

// Gemeinsame Einstellungen
$conn->set_charset("utf8mb4");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
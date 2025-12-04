<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    
    $sql = "SELECT benutzer_id, vorname, nachname, passwort FROM benutzer WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($passwort, $user['passwort'])) {
            $_SESSION['user_id'] = $user['benutzer_id'];
            $_SESSION['user_name'] = $user['vorname'] . ' ' . $user['nachname'];
            header("Location: index.php");
            exit;
        }
    }
    
    header("Location: login.php?error=1");
    exit;
}
?>
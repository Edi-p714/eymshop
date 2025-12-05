<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? '';
    $passwort = $_POST['passwort'] ?? '';

    $stmt = $conn->prepare("SELECT benutzer_id, name, passwort FROM benutzer WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($passwort, $user['passwort'])) {
            $_SESSION['user_id'] = $user['benutzer_id'];
            $_SESSION['user_name'] = $user['name']; // ← الصحيح
            
            header("Location: index.php");
            exit;
        }
    }
    
    header("Location: login.php?error=1");
    exit;
}
?>

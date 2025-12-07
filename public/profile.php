<?php
// Session starten
session_start();

// Datenbankverbindung
require_once '../includes/db.php';

// Sicherheitscheck: Ist Nutzer eingeloggt?
if (!isset($_SESSION['benutzer_id'])) {
    header('Location: login.php');
    exit();
}

// Benutzer holen
$user_id = $_SESSION['benutzer_id'];
$sql = "SELECT * FROM benutzer WHERE benutzer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Sicherheitsfall
if (!$user) {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="de"><
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil von <?php echo htmlspecialchars($user['benutzername']); ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>
<body>
    <?php require_once '../includes/header.php'; ?>

    <div class="container">
        <div class="profile-icon">👤</div>
        <h1>Willkommen, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <p>Hier sind Ihre persönlichen Daten.</p>

        <div class="profile-info">
            <div class="info-row">
                <span class="info-label">Kunden-ID:</span>
                <span class="info-value">#<?php echo $user['benutzer_id']; ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Name:</span>
                <span class="info-value"></span><?php echo htmlspecialchars($user['name']); ?></span>
            </div>    

            <div class="info-row">
                <span class="info-label">E-Mail:</span>
                <span class="info-value"><?php echo htmlspecialchars($user['email']); ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">Registriert am:</span>
                <span class="info-value"><?php
                // Datum
                echo date("d,m,Y", strtotime($user['erstellt_am']));  ?></span>
            </div>
        </div>
    
        <a href="logout.php" class="logout-btn">Abmelden (Logout)</a>
    </div>
    </div>    

    <?php require_once '../includes/footer.php'; ?>
</body>
</html>
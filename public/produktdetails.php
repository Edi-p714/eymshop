<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isset($_GET['id'])) {
    die("Produkt nicht gefunden.");
}

$produkt_id = intval($_GET['id']);
$produkt = getProductById($conn, $produkt_id);

if (!$produkt) {
    die("Produkt existiert nicht.");
}

if (isset($_GET['add'])) {
    header("Location: warenkorb.php");
    exit();
}
?>

<!DCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktdetails - <?php echo htmlspecialchars($produkt['produktname']); ?> - EymShop</title>

    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/produktdetails.css">
</head>
<body>

<div class="container">
    <?php require_once '../includes/header.php'; ?>

    <div class="detail-wrapper">
        <div class="detail-image-container">
            <img class="detail-img"
                src="../<?php htmlspecialchars($produkt['hauptbild']); ?>" 
                alt="<?php echo htmlspecialchars($produkt['produktname']); ?>">
        </div>

        <div class="detail-info-container">
            <h1 class="detail-title"><?php echo htmlspecialchars($produkt['produktname']); ?></h1>
            
            <p><?php echo number_format($produkt['preis'], 2, ',', '.') ?> €</p>

            <div class="detail-description">
                <h3>Beschreibung:</h3>
                <p><?php echo nl2br(htmlspecialchars($produkt['produktbeschreibung'])); ?></p>
            </div>

            <div class="detail-option">
                <h4>Farben:</h4>
                <ul class="color-list">
                <?php 
                if (function_exists('getColorsByProduct')) {
                    $farben = getColorsByProduct($conn, $produkt_id); 
                while ($f = $farben->fetch_assoc()): 
                ?>
                <li class="color-bagde">
                    <?php echo htmlspecialchars($f['farbe']); ?></li>
                <?php endwhile;
                }
                ?>
                </ul>
            </div>

            <div class="detail-actions">
                <a href="warenkorb.php?add=<?php echo $produkt_id; ?>" class="btn btn-large"> In den Warenkorb lagen 🛒
                </a>
                <a href="produkte.php" class="back-link">← Zurück zur Übersicht</a>
            </div>
        </div>
    </div>
    <?php require_once '../includes/footer.php'; ?>
</div>

</body>
</html>









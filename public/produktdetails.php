<?php
require_once '../includes/header.php';
require_once '../includes/navigation.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (isset($_GET['add'])) {
    addToCart($_GET['add'], 1);
}

if (!isset($_GET['id'])) {
    die("Produkt nicht gefunden.");
}

$produkt_id = intval($_GET['id']);
$produkt = getProductById($conn, $produkt_id);

if (!$produkt) {
    die("Produkt existiert nicht.");
}
?>

<h2><?php echo htmlspecialchars($produkt['produktname']); ?></h2>

<div class="produkt-details">
    <img class="produkt-details-bild"
        src="../<?php htmlspecialchars($produkt['hauptbild']); ?>" 
        alt="<?php echo htmlspecialchars($produkt['produktname']); ?>">

    <div class="produkt-info">

    <h3><?php echo number_format($produkt['preis'], 2, ',', '.') ?> €</h3>

    <p><?php echo nl2br(htmlspecialchars($produkt['produktbeschreibung'])); ?></p>

    <h4>Farben:</h4>
    <ul>
        <?php 
        $farben = getColorsByProduct($conn, $produkt_id); 
        while ($f = $farben->fetch_assoc()): 
        ?>
        <li><?php echo htmlspecialchars($f['farbe']); ?></li>
        <?php endwhile; ?>
    </ul>
    </div>
</div>

<a href="warenkorb.php?add=<?php echo $produkt_id; ?>">In den Warenkorb</a>

<?php require_once '../includes/footer.php'; ?>

<!-- Correct CSS Path -->
<link rel="stylesheet" href="../assets/css/styles.css">
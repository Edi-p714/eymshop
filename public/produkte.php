




<?php
require_once '../includes/header.php';
require_once '../includes/navigation.php'; 
require_once '../includes/db.php';
require_once '../includes/functions.php';
?>

<h2>Produkte</h2>
<!-- Correct CSS Path -->
<link rel="stylesheet" href="../assets/css/styles.css">

<div class="produkt-grid">

<?php
$produkte = getAllProducts($conn);

while ($p = $produkte->fetch_assoc()):
?>

    <div class="produkt-card">
     <!--   <img src="../<?php echo htmlspecialchars($p['hauptbild']);?>" alt="<?php echo htmlspecialchars($p['produktname']);?>" class="produkt-bild">-->
        <img src="../assets/image/<?php echo htmlspecialchars($p['hauptbild']); ?>" 
     alt="<?php echo htmlspecialchars($p['produktname']); ?>" 
     class="produkt-bild">

     class="produkt-bild">


        <h3><?php echo htmlspecialchars($p['produktname']);?></h3>
        <p><?php echo number_format($p['preis'],2, ',', '.'); ?> €</p>
        <a href="produktdetails.php?id=<?php echo $p['produkt_id'];?>" class="btn">Detais ansehen</a>
    </div>

<?php
endwhile; 
?>    
</div>

<?php require_once '../includes/footer.php'; ?>


<?php
require_once '../includes/header.php';
require_once '../includes/navigation.php'; 
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Produkte aus der Datenbank laden
$produkte = getAllProducts($conn);
?>

<!-- <!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Produkte</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<h2 style="text-align:center; margin-top:20px;">Produkte</h2>

<div class="product-grid">

<?php while ($p = $produkte->fetch_assoc()): ?>

    <div class="product-card">
        <img src="../<?php echo htmlspecialchars($p['hauptbild']); ?>" 
             alt="<?php echo htmlspecialchars($p['produktname']); ?>" 
             class="produkt-bild">

        <h3><?php echo htmlspecialchars($p['produktname']); ?></h3>

        <p>Preis: <?php echo number_format($p['preis'], 2, ',', '.'); ?> €</p>

        <button onclick="window.location.href='produktdetails.php?id=<?php echo $p['produkt_id']; ?>'">
            Beschreibung
        </button>
    </div>

<?php endwhile; ?>

</div>

</body>
</html>-->

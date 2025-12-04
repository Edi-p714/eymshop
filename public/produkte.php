<?php
require_once '../includes/header.php';
require_once '../includes/navigation.php'; 
require_once '../includes/db.php';
require_once '../includes/functions.php';

$produkte = getAllProducts($conn);
?>


<!-- Correct CSS Path -->
<link rel="stylesheet" href="../assets/css/styles.css">
<h2>Produkte</h2>

<div class="produkt-grid">

<?php while ($p = $produkte->fetch_assoc()): ?>

    <div class="produkt-card">
        <!-- Bild - korrekt aus DB geladen -->
        <img src="../<?php echo htmlspecialchars($p['hauptbild']); ?>" 
        alt="<?php echo htmlspecialchars($p['produktname']); ?>" 
        class="produkt-bild">

        <h3><?php echo htmlspecialchars($p['produktname']);?></h3>
        <p><?php echo number_format($p['preis'],2, ',', '.'); ?> €</p>
        <a href="produktdetails.php?id=<?php echo $p['produkt_id'];?>" class="btn">Detais ansehen</a>
    </div>

<?php endwhile; ?>    
</div>

<?php require_once '../includes/footer.php'; ?>




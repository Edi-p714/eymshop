<?php
require_once '../includes/header.php';
require_once '../includes/navigation.php'; 
require_once '../includes/db.php';
require_once '../includes/functions.php';
?>

<h2>Produkte</h2>

<div class="produkt-grid">

<?php
$produkte = getAllProducts($conn);

while ($p = $produkte->fetch_assoc())
?>

    <div class="produkt-card">
        <img src="../<?php echo htmlspecialchars($p['hauptbild']);?>" alt="<?php echo htmlspecialchars($p['produktname']);?>" class="produkt-bild">

        <h3><?php echo htmlspecialchars($p['produkname']);?></h3>
        <p><?php echo number_format($p['preis'],2, ',', '.'); ?> €</p>
        <a href="produktdetails.php?id=<?php echo $p['produkt_id'];?>" class="btn">Detais ansehen</a>
    </div>

endwhile; ?>    
</div>

<?php require_once '../includes/footer.php'; ?>
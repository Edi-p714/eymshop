<?php
// Session starten
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EymShop - Starseite</title>
    
    <!-- Correct CSS Path -->
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<div class="container">

    <!-- HEADER -->
    <?php include '../includes/header.php'; ?>

    <div style="text-align: center; margin: 20px;">
        <h1>Willkommen bei EymShop!</h1>
        <p>Entdecken Sie neuesten Trends für Herren und Damen.</p>

    <!-- PRODUCTS -->
    <div class="products-section">

        <div class="product-card">
            <div class="product-image">
                <a href="produkte.php?kategorie=Herren">
                <img src="../assets/images/menner.jpg" alt="Herren">
                </a>
                
            </div>
            <div class="product-title">
                <a href="produkte.php?kategorie=Herren">Herren</a>
            </div>
        </div>

        <div class="product-card">
            <div class="product-image">
                <a href="produkte.php?kategorie=Damen">
                <img src="../assets/images/frauen_.jpg" alt="Damen Mode">
                </a>
                
            </div>
            <div class="product-title">
                <a href="produkte.php?kategorie=Damen">Damen</a>
            </div>
            <div class="product-type"></div>
        </div>

        <div class="product-card">
            <div class="product-image">
                <a href="produkte.php?kategorie=Mädchen">
                <img src="../assets/images/maedchen.jpg" alt="mädchen Mode">
                </a>
                
            </div>
            <div class="product-title">
                <a href="produkte.php?kategorie=Maedchen">Mädchen</a>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<?php include '../includes/footer.php'; ?>

</body>
</html>

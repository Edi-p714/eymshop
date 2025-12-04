<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kleidungsgeschäft</title>
    
    <!-- Correct CSS Path -->
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<div class="container">

    <!-- HEADER -->
    <?php include '../includes/header.php'; ?>

    <!-- PRODUCTS -->
    <div class="products-section">

      
        
        <div class="product-card">
            <div class="product-image">
                <img src="../assets/image/männer.jpeg" alt="Herren">
            </div>
            <div class="product-title">Herren</div>
            <div class="product-type"></div>
        </div>

        <div class="product-card">
            <div class="product-image">
                <img src="../assets/image/Frauen..jpeg" alt="damen">
            </div>
            <div class="product-title">Damen</div>
            <div class="product-type"></div>
        </div>

      

        <div class="product-card">
            <div class="product-image">
                <img src="../assets/image/mädchen.jpeg" alt="mädchen">
            </div>
            <div class="product-title">Mädchen</div>
            <div class="product-type"></div>
        </div>

        
        

        

   

</div>

<!-- FOOTER -->
<?php include '../includes/footer.php'; ?>

<!-- USERNAME HANDLER -->
<script>
let username = localStorage.getItem("username");

if (username) {
    document.getElementById("userDisplay").innerText = username;
    document.getElementById("userDisplay").href = "#";
}
</script>

</body>
</html>

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
                <img src="../assets/image/herren-Hose.png" alt="Herren Jeanshose">
            </div>
            <div class="product-title">Herren Jeanshose</div>
            <div class="product-type">Hosen</div>
        </div>

        <div class="product-card">
            <div class="product-image">
                <img src="../assets/image/herren-tshirt.jpeg" alt="Herren T-Shirt">
            </div>
            <div class="product-title">Herren T-Shirt</div>
            <div class="product-type">T-Shirt</div>
        </div>

        <div class="product-card">
            <div class="product-image">
                <img src="../assets/image/damen-hose.png" alt="Damen Hose">
            </div>
            <div class="product-title">Damen Hose</div>
            <div class="product-type">Hosen</div>
        </div>

        <div class="product-card">
            <div class="product-image">
                <img src="../assets/image/damen-tschirt.png" alt="Mädchen T-Shirt">
            </div>
            <div class="product-title">Mädchen T-Shirt</div>
            <div class="product-type">T-Shirt</div>
        </div>

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

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
    <header class="header">
        <div class="logo">
            <img src="../assets/image/logo.png" alt="Logo" class="logo-img">
        </div>

        <nav>
            <ul class="nav-menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">Kategorie</a></li>
                <li><a href="#">Anmeldung</a></li>
                <li><a href="#">Warenkorb</a></li>
                <li><a href="#">Über uns</a></li>
                <li><a href="#">Kontakt</a></li>
            </ul>
        </nav>
    </header>

    <!-- SEARCH + Nutzer Konto + Warenkorb -->
    <div class="search-container">
        <input type="text" class="search-box" placeholder="Produkte suchen...">
        <div class="user-cart-container">
            <a href="anmeldung.html" class="login-link" id="userDisplay">Nutzer Konto</a>
            <a href="warenkorb.html" class="cart-link" title="Warenkorb"></a>
        </div>
    </div>

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
<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>Kontakt</h3>
        </div>

        <div class="footer-section">
            <ul>
                <li><a href="#">0176767676</a></li>
                <li><a href="#">Edmshop@gmai.com</a></li>
                <li><a href="#">Hannover 30455</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Folgen Sie uns:</h3>
        </div>

        <div class="footer-section">
            <p>Instagram.com/Edmshop</p>
            <p>x.com/Edmshop</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>Datenschütz</p>
        <p>Alle Rechte vorbehalten © 2025 Edmshop</p>
    </div>
</footer>

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

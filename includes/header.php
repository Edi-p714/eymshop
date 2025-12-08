<?php
// Session nur einmal starten, bevor HTML ausgegeben wird
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- includes/header.php -->
<header class="header">
    <div class="logo">
        <a href="../public/index.php">
        <img src="../assets/images/logonew.jpg" alt="EymShop Logo" class="logo-img">
        </a>  
    </div>

    <?php
    // Navigation relativ zum includes-Verzeichnis einbinden
    require_once __DIR__ . '/navigation.php';
    ?>
</header>

<!-- SEARCH + Nutzer Konto + Warenkorb -->
<div class="search-container">
    <form action="produkte.php" method="GET" style="flex-grow: 1; display: flex; justify-content: center;">
    <input type="text" name="s" class="search-box" placeholder="Produkte suchen..." value="<?php echo isset($_GET['s']) ? htmlspecialchars($_GET['s']) : '';  ?>">
    </form>

    <div class="user-cart-container">
        <?php
        // Überprüfen, ob der Benutzer eingeloggt ist
        if (isset($_SESSION['benutzer_id'])) {
        ?>
            <a href="profile.php" class="login-link">Mein Profil</a>
            <a href="logout.php" class="login-link" style="font-size: 0.8em;">(Logout)</a>
            <?php
            } else {
            ?>
            <a href="login.php" class="login-link">Anmelden / Konto</a>
            <?php
            }
            ?>
            <a href="warenkorb.php" class="cart-link" title="Warenkorb"><span class="cart-icon">🛒</span></a>
    </div>
</div>



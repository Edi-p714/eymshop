<?php

require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EYMShop</title>
    <link rel="stylesheet" href="/eymshop/assets/css/styles.css">
</head>
<body>
    <!-- Auth Links oben rechts -->
    <div class="top-auth-bar">
        <div class="auth-links">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="/eymshop/public/logout.php" class="auth-link">Abmelden</a>
            <?php else: ?>
                <a href="/eymshop/public/login.php" class="auth-link">Anmelden</a>
                <span class="separator">|</span>
                <a href="/eymshop/public/register.php" class="auth-link">Registrieren</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Haupt-Header -->
    <header class="main-header">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <div class="logo">
                    <a href="/eymshop/public/index.php" class="logo-text">
                        <img src="/eymshop/assets/image/logonew.png" alt="EYMShop" class="logo-img">
                        EYMShop
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="main-nav">
                    <a href="/eymshop/public/index.php">Startseite</a>
                    
                    <!-- Dropdown für Produkte -->
                    <div class="dropdown">
                        <a href="#" class="dropdown-btn">Produkte</a>
                        <div class="dropdown-content">
                            <a href="/eymshop/public/produkte.php?kategorie=herren">Herren</a>
                            <a href="/eymshop/public/produkte.php?kategorie=damen">Damen</a>
                            <a href="/eymshop/public/produkte.php?kategorie=maedchen">Mädchen</a>
                        </div>
                    </div>
                    
                    <a href="/eymshop/public/ueberuns.php">Über uns</a>
                    <a href="/eymshop/public/kontakt.php">Kontakt</a>
                </nav>

                <!-- Search und Warenkorb -->
                <div class="header-actions">
                    <div class="search-box">
                        <form action="/eymshop/public/produkte.php" method="GET">
                            <input type="text" name="search" placeholder="Produkte suchen...">
                        </form>
                    </div>
                    <a href="/eymshop/public/warenkorp.php" class="cart-link">
                        <svg class="cart-icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M9 22a1 1 0 100-2 1 1 0 000 2zM20 22a1 1 0 100-2 1 1 0 000 2zM1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                        </svg>
                        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                            <span class="cart-count"><?php echo count($_SESSION['cart']); ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hauptinhalt -->
    <main class="main-content">
        <div class="container">
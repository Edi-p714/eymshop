<?php
// -----------------------------------------------------------------------------
// warenkorp.php – Inhalt des Warenkorbs anzeigen
// -----------------------------------------------------------------------------
ob_start();

if (session_status() === PHP_SESSION_NONE) {
session_start();
}

require_once '../includes/db.php';
require_once '../includes/functions.php';

// Produkt hinzufügen
if (isset($_GET['add'])) {
    $id = intval($_GET['add']);
    if ($id > 0 && function_exists('addToCart')) {
        addToCart($id, 1);
    }
    header("Location: warenkorb.php");
    exit;
}

// Produkt entfernen
if (isset($_GET['remove'])) {
    $id = intval($_GET['remove']);
    if ($id > 0 && function_exists('removeFromCart')) {
        removeFromCart($id);
    }
    header("Location: warenkorb.php");
    exit;
}

// Aktuellen Warenkorb holen
$cart = [];
if (function_exists('getCart')) {
    $cart = getCart();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warenkorb</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/warenkorb.css">
</head>
<body>

<div class="container">
    <?php include '../includes/header.php'; ?>

    <h2 class="cart-title">Mein Warenkorb 🛒</h2>

    <?php if (empty($cart)): ?>
        <div style="text-align: center; padding: 50px;">
        <p>Ihr Warenkorb ist leer.</p>
        <a href="produkte.php" class="btn">Jetzt einkaufen</a>
        </div>
    <?php else: ?>

        <table class="cart-table">
            <thead>
                <tr>
                <th>Produkt</th>
                <th>Preis</th>
                <th>Menge</th>
                <th>Gesamt</th>
                <th>Löschen</th>
                </tr>
            </thead>
            <tbody>
            <?php $summe = 0;
            foreach ($cart as $product_id => $quantity):
                $stmt = $conn->prepare("SELECT produktname, preis, hauptbild FROM produkte WHERE produkt_id = ?");
                $stmt->bind_param("i", $product_id);
                $stmt->execute();
                $res = $stmt->get_result();
                $p = $res->fetch_assoc();

                if (!$p) {
                    continue;
                }

                $bildpath = $p['hauptbild'] ?? '';
                $gesamt = $p['preis'] * $quantity;
                $summe += $gesamt;
    ?>

    <tr>
        <td>
            <div style="display: flex; align-items: center; gap: 10px;">
                <?php if (!empty($bildpath)): ?>
                <img src="../<?php echo htmlspecialchars($bildpath);  ?>" class="cart-img" alt="Bild">
                <?php else: ?>
                    <div class="cart-img" style="background: #eee; display: flex; align-items:center; justify-content:center;">📷</div>
                <?php endif; ?>

                <span><?php echo htmlspecialchars($p['produktname']); ?></span>
            </div>
        </td>
        <td><?php echo number_format($p['preis'], 2, ',', '.'); ?> €</td>
        <td><?php echo $quantity; ?></td>
        <td style="font-weight: bold;"><?php echo number_format($gesamt, 2, ',', '.'); ?></td>
        <td>
            <a href="warenkorb.php?remove=<?php echo $product_id; ?>" class="btn-remove" title="Entfernen" onclick="return confirm('Möchten Sie dieses Produkt wirklich aus dem warenkorb löschen?');">✖</a>
        </td>
    </tr>

    <?php endforeach; ?>
            </tbody>
</table>

<div class="cart-summary">
    <h3>Gesamtsumme:</h3> 
    <span class="total-price"><?php echo number_format($summe, 2, ',', '.') ?> €</span>

    <a href="bestellung.php" class="btn-checkout">Zur Kasse gehen</a>
</div>
<?php endif; ?>
<?php require_once '../includes/footer.php'; ?>
</div>

</body>    
</html>


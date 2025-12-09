<?php 
ob_start();
session_start();

require_once '../includes/db.php';
require_once '../includes/functions.php';


// Benutzer eingeloggt-Check
if (!isset($_SESSION['benutzer_id'])) {
    // Falls du einen anderen key verwendest (z.B user_id), hier anpassen
    header("Location: login.php?error=login_required");
    exit;
}

// Warenkorb holen
$cart = getCart();
if (empty($cart)) {
    header("Location: produkte.php");
    exit;
}

// Produkte anhand der IDs laden (für Preis, Name usw.)
$ids = array_keys($cart);
$produkte = getProductsByIds($conn, $ids)
;
$gesamtSumme = calculateCartTotal($conn, $cart);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['benutzer_id'];

    $bestellid = createOrder($conn, $userId, $cart, $produkte);

    if ($bestellid) {
        clearCart();
        header("Location: bestellung_danke.php?id=$bestellid");
        exit;
    } else {
        $error = "Fehler bei der Bestellung. Bitte versuchen Sie es erneut.";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellung Zusammenfassung</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/bestellung.css">
</head>
<body>

<div class="container">
    <?php require_once '../includes/header.php'; ?>

    <div class="checkout-container">
        <h1 class="checkout-title">Bestellung abschließen</h1>

        <?php if (isset($error)): ?>
            <div class="error-box">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <h3>Zusammenfassung</h3>

        <?php foreach ($cart as $id => $qty):
            if (!isset($produkte[$id])) continue;
            $p = $produkte[$id];
            $subtotal = $p['preis'] * $qty;
        ?>

            <div class="order-row">
                <span><?php echo $qty; ?> X <?php echo htmlspecialchars($p['produktname']); ?></span>
                <span><?php echo number_format($subtotal, 2, ',', '.'); ?> € </span>
            </div>
        <?php endforeach; ?>

        <div class="order-total">
            <span><?php echo number_format($gesamtSumme, 2, ',', '.'); ?> €</span>
        </div>

        <form method="POST" action="">
            <p class="legal-text">
                Mit Ihrer Bestellung erklären Sie sich mit unseren AGB und Datenschutzbestimmung en einverstanden.
            </p>
            <button type="submit" class="btn-confirm">Kostenplichtig bestellen</button>
        </form>

        <div class="back-link-container">
            <a href="warenkorb.php">← Zurück zum Warenkorb</a>
        </div>
    </div>
    <?php require_once '../includes/footer.php'; ?>
</div>

</body>
</html>
<?php ob_end_flush(); ?>



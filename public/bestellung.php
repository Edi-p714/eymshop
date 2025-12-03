<?php 
// -----------------------------------------------------------------------------
// bestellung.php – Bestellung anlegen & Zusammenfassung anzeigen
// -----------------------------------------------------------------------------

require_once '../includes/header.php';
require_once '../includes/navigation.php'; 
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Sicherstellen, dass die Session läuft (falls nicht schon header.php)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Prüfen, ob Benutzer eingeloggt ist
if (!isset($_SESSION['benutzer_id'])) {
    // Falls du einen anderen key verwendest (z.B user_id), hier anpassen
    header('Location: login.php');
    exit;
}

$benutzerId = (int) $_SESSION['benutzer-id'];

// Aktuellen zum Warenkorb 
$produkte = getProductsByIds($conn, array_keys($cart));
$gesamt = calculateCartTotal($conn, $cart);

$bestellErfolg = false;
$bestellId = null;

// ------------------------------------
// Bestellung anlegen (bei Formular-POST)
// ------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order'])) {
    //Bestellung in DB anlagen
    $bestellId = createOrder($conn, $benutzerId, $cart, $produkte);

    if ($bestellId !== null) {
        // Warenkorb leeren
        clearCart();
        $bestellErfolg = true;
    }
}
?>

<h2>Bestellung</h2>

<?php if ($bestellErfolg && $bestellId !== null): ?>

    <p>Vielen Dank für Ihre Bestellung!</p>
    <p>Ihre Bestellunmmer lautet: <strong><?php echo (int) $bestellId;  ?></strong></p>

    <p><a href="produkte.php" class="btn">Weiter einkaufen</a></p>

<?php else: ?>

    <h3>Bestellübersicht</h3>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Produkt</th>
                <th>Preis</th>
                <th>Menge</th>
                <th>Zwischensnummer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart as $produktId => $menge): ?>
                <?php if (!isset($produkte[$produktId])) continue; ?>
                <?php 
                $produkt = $produkte[$produktId];
                $preis = (float) $produkt['preis'];
                $mengeInt = (int) $menge;
                $subtotal = $preis * $mengeInt;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($produkt['produktname']); ?></td>
                    <td><?php echo number_format($preis, 2, ',', '.'); ?> €</td>
                    <td><?php echo $mengeInt; ?></td>
                    <td><?php echo number_format($subtotal, 2, ',', '.'); ?> €</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><strong>Gesamt:</strong>
    <?php echo number_format($gesamt, 2, ',', '.'); ?> €
    </p>

    <form method="POST">
        <p>
            <button type="submit" name="confirm_order" class="btn">
                Bestellung jetzt abschließen
            </button>
        </p>
    </form>

<?php endif; ?>

<?php require_once '../includes/footer.php'; ?>

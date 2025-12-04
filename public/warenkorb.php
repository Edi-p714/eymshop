<?php
// -----------------------------------------------------------------------------
// warenkorp.php – Inhalt des Warenkorbs anzeigen
// -----------------------------------------------------------------------------

require_once '../includes/header.php';
require_once '../includes/navigation.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Sicherstellen, dass die Session läuft (falls nicht schon im header.php)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Aktuellen Warenkorb holen
$cart = getCart();
?>

<h2>Warenkorb</h2>

<?php if (empty($cart)): ?>
    <p>Ihr Warenkorb ist leer.</p>
<?php else: ?>

<table border="1" cellpadding="8">
    <tr>
        <th>Produkt</th>
        <th>Preis</th>
        <th>Menge</th>
        <th>Gesamt</th>
    </tr>

    <?php $summe = 0;
    foreach ($cart as $product_id => $quantity):
        $stmt = $conn->prepare("SELECT produktname, preis, hauptbild FROM produkte WHERE produkt_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $p = $stmt->get_result()->fetch_assoc();

        $gesamt = $p['preis'] * $quantity;
        $summe += $gesamt;
    ?>

    <tr>
        <td><?php echo htmlspecialchars($p['produktname']); ?></td>
        <td><?php echo number_format($p['preis'], 2, ',', '.'); ?> €</td>
        <td><?php echo $quantity; ?></td>
        <td><?php echo number_format($gesamt, 2, ',', '.'); ?></td>
    </tr>

    <?php endforeach; ?>
</table>

<h3>Gesamtsumme: <?php echo number_format($summe, 2, ',', '.') ?> €</h3>

<a href="bestellung.php" class="btn">Weiter zur Bestellung</a>

<?php endif; ?>

<?php require_once '../includes/footer.php'; ?>
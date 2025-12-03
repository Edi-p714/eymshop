<?php
// -----------------------------------------------------------------------------
// warenkorp.php – Warenkorb anzeigen & bearbeiten
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

// -----------------------------
// POST-Handling (Update / Clear)
// -----------------------------
if ($_SERVER['REQUEST_METHOD']=== 'POST') {
    // Mengen aktualisieren
    if (isset($_POST['update_cart']) &&
    isset($_POST['menge']) && is_array($_POST['menge'])) {
        foreach ($_POST['menge'] as $produkId => $menge) {
            $produktId = (int) $produktId;
            $menge = (int) $menge;

            if ($menge <= 0) {
                removeFromCart($produktId);
            } else {
                updateCart($produktId, $menge);
            }
        }
        $cart = getCart(); // nach Update Warenkorb neu laden
    }

    // Warenkorb leeren
    if (isset($_POST['clear_cart'])) {
        clearCart();
        $cart = [];
    }
}

// Produkte zum aktuellen Warenkorb holen
$produkte = [];
$gesamt = 0.0;

if (!empty($cart)) {
    $produkte = getProductsByIds($conn, array_keys($cart));
    $gesamt = calculateCartTotal($conn, $cart);
}
?>

<h2>Warenkorb</h2>

<?php if (empty($cart)): ?>

    <p>Ihr Warenkorb ist leer.</p>
    <p><a href="produkte.php" class="btn">Zurück zu den Produkten</a></p>

<?php else: ?>

    <form method="POST">
        <table border="1" cellpaddin="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Preis</th>
                    <th>Menge</th>
                    <th>Zwischensumme</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $produkId => $menge): ?>
                    <?php if (!isset($produkte[$produkId])) continue; ?>
                    <?php 
                        $produkt = $produktId[$produktId];
                        $preis = (float) $produkt['preis'];
                        $mengeInt = (int) $menge;
                        $subtotal = $preis * $mengeInt;
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($produkt['produktname']); ?></td>
                            <td><?php echo number_format($preis, 2, ',', '.'); ?></td>
                            <td>
                                <input
                                    type="number"
                                    name="menge[<?php echo $produkId; ?>]"
                                    value="<?php echo $mengeInt; ?>"
                                    min="0"
                                    >
                                    <small>(0 = entfernen)</small>
                            </td>
                            <td><?php echo number_format($subtotal, 2, ',', '.'); ?> €</td>
                        </tr>
                        <?php endforeach; ?>
            </tbody>
        </table>

        <p><strong>Gesamt:</strong>
            <?php echo number_format($gesamt, 2, ',', '.'); ?> €
        </p>

        <button type="submit" name="update_cart" class="btn">
            Warenkorb aktualisieren
        </button>

        <button type="submit" name="clear_cart" class="btn">
            Warenkorb leeren
        </button>

        <a href="bestellung.php" class="btn">
            Weiter zur Bestellung
        </a>   
    </form>

<?php endif; ?>

<?php require_once '../includes/footer.php'; ?>
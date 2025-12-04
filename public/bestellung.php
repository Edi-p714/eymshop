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

// Benutzer eingeloggt-Check
if (!isset($_SESSION['benutzer_id'])) {
    // Falls du einen anderen key verwendest (z.B user_id), hier anpassen
    header('Location: login.php');
    exit;
}

$benutzerId = (int) $_SESSION['benutzer-id'];

// Warenkorb holen
$cart = getCart();

if (empty($cart)) {
    echo "<h2>Ihr Warenkorb ist leer.</h2>";
    require_once '../includes/footer.php';
    exit();
}

// Produkte anhand der IDs laden (für Preis, Name usw.)
$produkte = getProductsByIds($conn, array_keys($cart));

// Bestellung anlagen (intkl. Bestellpositionen)
$bestell_id = createOrder($conn, $benutzer_id, $cart, $gesamtpreis);
if ($bestell_id === null) {
    echo "<h2>Fehler: Bestellung konnte nicht gespeichert werden.</h2>";
    require_once '../includes/footer.php';
    exit();
}

// Warenkorb leerem
clearCart();
?>

<h2>Vielen Dank für Ihre Bestellung!</h2>

<p>Ihre Bestellnummer lautet: <strong><?php echo (int)$bestell_id; ?></strong></p>

<p>
<a href="index.php" class="btn">weiter einkaufen</a>
</p>

<?php require_once '../includes/footer.php'; ?>

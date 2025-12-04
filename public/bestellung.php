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

if (!isset($_SESSION['benutzer_id'])) {
    die("Bitte zuerst einloggen.");
}

$benutzer_id = $_SESSION['benutzer_id'];

// Warenkorb Prüfen
$cart = getCart();
if (empty($cart)) {
    die("Warenkorb ist leer.");
}

// Gesamtpreis berechnen
$gesamtpreis = calculateTotal($conn);

// Bestellung speicher
$bestell_id = createOrder($conn, $benutzer_id, $gesamtpreis);

// Positionen speichern
saveOrderItems($conn, $bestell_id);

// Warenkorb leerem
clearCart();
?>

<h2>Vielen Dank für Ihre Bestellung!</h2>

<p>Ihre Bestellnummer lautet: <strong><?php echo $bestell_id; ?></strong></p>

<p>Gesamtpreis: <strong><?php echo number_format($gesamtpreis, 2, ',', '.'); ?> €</strong></p>

<p>Sie erhalten eine Bestätigung per E-Mail.</p>

<a href="index.php" class="btn">Zurück zur Starseite</a>

<?php require_once '../includes/footer.php'; ?>

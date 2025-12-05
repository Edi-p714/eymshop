<?php
// Funktionen für EYMShop

// Prüfen ob Benutzer angemeldet ist
function istAngemeldet() {
    return isset($_SESSION['user_id']);
}

// Warenkorb Anzahl erhalten
function getWarenkorbAnzahl() {
    return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
}

// Weiterleitung zu Seite
function weiterleiten($seite) {
    header("Location: $seite");
    exit();
}

// Produkte aus Datenbank laden
function getAllProdukte($conn) {
    $sql = "SELECT * FROM produkte ORDER BY produkt_id DESC";
    return $conn->query($sql);
}

// Produkt nach ID laden
function getProduktById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM produkte WHERE produkt_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Produkte nach Kategorie filtern
function getProdukteByKategorie($conn, $kategorie) {
    $stmt = $conn->prepare("
        SELECT p.* FROM produkte p
        JOIN kategorien k ON p.kategorie_id = k.kategorie_id
        WHERE k.kategoriename = ?
    ");
    $stmt->bind_param("s", $kategorie);
    $stmt->execute();
    return $stmt->get_result();
}

// Zum Warenkorb hinzufügen
function zumWarenkorbHinzufuegen($produkt_id, $menge = 1) {
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    
    if (isset($_SESSION['cart'][$produkt_id])) {
        $_SESSION['cart'][$produkt_id] += $menge;
    } else {
        $_SESSION['cart'][$produkt_id] = $menge;
    }
}
?>
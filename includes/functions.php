<?php
// ------------------------------------------------
// functions.php - Backend-Funktionen für EymShop
// ------------------------------------------------
if (!isset($conn)) {
    require_once __DIR__. '/db.php';
}

// -------------------------------------------------
// PRODUKTE LADEN
//-------------------------------------------------
function getAllProducts($conn) {
    // SQL-Spaltennamen angepasst an deine Datenbank
    $sql = "SELECT * FROM produkte ORDER BY produkt_id DESC";
    return $conn->query($sql);
}

//-------------------------------------------------
// PRODUKTDETAILS
//-------------------------------------------------
function getProductById($conn, $id) {
    $stmt = $conn->prepare("
        SELECT *
        FROM produkte
        WHERE produkt_id = ?
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

//-------------------------------------------------
// PRODUKTE-FARBEN
//-------------------------------------------------
function getColorsByProduct($conn, $product_id) {
    $stmt = $conn->prepare("
        SELECT farben.farb_id, farben.farbe, farben.farbcode 
        FROM lagerbestand 
        JOIN farben ON lagerbestand.farb_id = farben.farb_id WHERE lagerbestand.produkt_id = ? 
        GROUP BY farben.farb_id");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    return $stmt->get_result();
}

//------------------------------------------------
// PRODUKT-GRÖßEN
//------------------------------------------------
function getSizesByProduct($conn, $product_id) {
    $stmt = $conn->prepare("
        SELECT groessen.groessen_id, groessen.groesse 
        FROM lagerbestand 
        JOIN groessen ON lagerbestand.groessen_id = groessen.groessen_id 
        WHERE lagerbestand.produkt_id = ? 
        GROUP BY groessen.groessen_id");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    return $stmt->get_result();
}

//------------------------------------------------
// INVENTAR
//------------------------------------------------
function getInventory($conn, $product_id, $farbe_id, $groesse_id) {
    $stmt = $conn->prepare("
        SELECT verfuegbare_menge 
        FROM lagerbestand 
        WHERE produkt_id = ? AND farb_id = ? AND groessen_id = ?");
    $stmt->bind_param("iii", $product_id, $farbe_id, $groesse_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

//------------------------------------------------
// KATEGORIE-FILTER
//------------------------------------------------
function getProductsByCategory($conn, $categoryName) {
    $stmt = $conn->prepare("
        SELECT p.*
        FROM produkte p
        JOIN kategorien k ON p.kategorie_id = k.kategorie_id
        WHERE k.kategoriename = ?
    ");
    $stmt->bind_param("s", $categoryName);
    $stmt->execute();
    return $stmt->get_result();
}

//------------------------------------------------
// WARENKORB (SESSION)
//------------------------------------------------
function addToCart($product_id, $quantity = 1) {
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

function removeFromCart($produkt_id) {
    unset($_SESSION['cart'][$produkt_id]);
}

function clearCart() {
    unset($_SESSION['cart']);
}

function getCart() {
    return $_SESSION['cart'] ?? [];
}
?>


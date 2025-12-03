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

// -----------------------------------------------------------------------------
// HILFSFUNKTIONEN FÜR WARENKORB & BESTELLUNG
// -----------------------------------------------------------------------------
/** 
* Holt alle Produkte zu einer Liste von produkt_id-Werten. 
* Rückgabe: assoziatives Array [produkt_id => produkt-row] 
*/
function getProductsByIds(mysqli $conn, array $ids): array {
    if (empty($ids)) {
        return [];
    }

    //IDs sicher in eine IN-Listen konvertieren
    $cleanIds = array_map('intval', $ids);
    $inList = implode(',', $cleanIds);

    $sql = "SELECT * FROM produkte WHERE produkt_id IN ($inList)";

    $produkte = [];
    while ($row = $result->fetch_assoc()) {
        $produkte[$row['produkt_id']] = $row;
    }

    return $produkte;
}

/**
 * Berechnet die Gesamtsumme des Warenkorbs.
 * Erwartet: $cart = [produk_id => menge]
 */
function calculateCartTotal(mysqli $conn, array $cart): float {
    $total = 0.0;

    if (empty($cart)) {
        return $total;
    }

    $produkte = getProductsByIds($conn, array_keys($cart));

    foreach ($cart as $produktId => $menge) {
        if (isset($produkte[$produktId])) {
            $preis = (float) $produkte[$produktId]['preis'];
            $total += $preis * (int) $menge;
        }
    }

    return $total;
}

/**
 * Legt eine neue Bestellung an und speichert Bestellpositionen.
 * Erwartet:
 * - $benutzerId = ID des eingeloggten Benutzers
 * - $cart:  [produkt_id =>menge]
 * - $produkte: [produkt_id => produkt-row] (z.B aus getProductsByIds)
 * 
 * Rückgabe:
 * - bestell_id (int) bei Erfolg
 * - null bei Fehler
 */
function createOrder(mysqli $conn, int $benutzerId, array $cart, array $produkte): ?int {
    if (emty($cart)) {
        return null;
    }

    // Gesamtpreis berechnen
    $gesamtpreis = 0.0;
    foreach ($cart as $produktId => $menge) {
        if (!isset($produkte[$produktId])) {
            continue;
        }
        $preis = (float) $produkte[$produktId]['preis'];
        $gesamtpreis += $preis * (int) $menge;
    }

    // Bestellung in "bestellungen" einfügen
    $stmtBestellung = $conn->prepare("
    INSERT INTO bestellungen (benutzer_id, Gesamtpreis, erstellt_am)
    VALUES (?, ? NOW())
    ");
    if (!$stmtBestellung) {
        return null;
    }

    $stmtBestellung->bind_param("id", $benutzerld, $gesamtpreis);

    if (!$stmtBestellung->execute()) {
        $stmtBestellung->close();
        return null;
    }

    $besttellId = $stmtBestellung->insert_id;
    $stmtBestellung->close();

    // Bestellpositionen in "bestellpositionen" einfügen
    $stmtPosition = $conn->prepare("
    INSERT INTO bestellpositionen (bestell_id, produkt_id, MENGE, Stueckpreis)
    VALUES (?,?,?,?)
    ");
    if (!$stmtPosition) {
        return null;
    }

    foreach ($cart as $produktId => $menge) {
        if (!isset($produkte[$produktId])) {
            continue;
        }

        $preis = (float) $produkte[$produktId]['preis'];
    $mengeInt = (int) $menge;

    $stmtPosition->bind_param("iiid", $bestellId, $produktId, $mengeInt, $preis);
    $stmtPosition->execute(); // einfache Fehlerbehanglung reicht hier für das projekt
    }

    $stmtPosition->close();

    return $bestellId;
}




?>


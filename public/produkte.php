<?php
session_start(); 
require_once '../includes/db.php';
require_once '../includes/functions.php';

$kategorie_filter = isset($_GET['kategorie']) ? $_GET['kategorie'] : null;
$search_query = isset($_GET['s']) ?
trim($_GET['s']) : null;
$produkte = [];
$titleSeitet = "Produkte";


if ($search_query) {
    // CASO 1: BÚSQUEDA ACTIVADA (?s=...)
    $titleSeitet = "Suchergebnisse für: \"" . htmlspecialchars($search_query) . "\"";
    
    // Usamos LIKE con % para buscar coincidencias parciales
    $sql = "SELECT * FROM produkte WHERE produktname LIKE ? OR produktbeschreibung LIKE ?";
    $stmt = $conn->prepare($sql);
    
    // Agregamos los % para SQL
    $searchTerm = "%" . $search_query . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm); // Busca en Nombre O Descripción
    $stmt->execute();
    $produkte = $stmt->get_result();

} elseif ($kategorie_filter) {
    // CASO 2: FILTRO POR CATEGORÍA (?kategorie=...)
    $titleSeitet = "Kategorie: " . htmlspecialchars($kategorie_filter);
    
    $sql_kat = "SELECT kategorie_id FROM kategorien WHERE kategoriename = ?";
    $stmt_kat = $conn->prepare($sql_kat);
    $stmt_kat->bind_param("s", $kategorie_filter);
    $stmt_kat->execute();
    $res_kat = $stmt_kat->get_result();

    if ($row = $res_kat->fetch_assoc()) {
        $kat_id = $row['kategorie_id'];

        $sql = "SELECT * FROM produkte WHERE kategorie_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $kat_id);
        $stmt->execute();
        $produkte = $stmt->get_result();
    } else {
        // Categoría no encontrada
        $produkte = getAllProducts($conn);
    }
    $stmt_kat->close();

} else {
    // CASO 3: NADA (Mostrar todo)
    $produkte = getAllProducts($conn);
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkte</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<div class="container">
    <?php include '../includes/header.php'; ?>
    
    <h2>
        <?php echo $titleSeitet; ?>
    </h2>

    <div class="produkt-grid">
        <?php 
        if ($produkte && $produkte->num_rows > 0) {
            while ($p = $produkte->fetch_assoc()) {
        ?>

            <div class="produkt-card">
                <div class="produkt-bild-container">
                    <!-- Bild - korrekt aus DB geladen -->
                    <img src="../<?php echo htmlspecialchars($p['hauptbild']); ?>" 
                    alt="<?php echo htmlspecialchars($p['produktname']); ?>" 
                    class="produkt-bild">
                </div>

                <h3><?php echo htmlspecialchars($p['produktname']);?></h3>
                <p style="font-size: 1.2em; color: #d48aa1; font-weight: bold;"><?php echo number_format($p['preis'],2, ',', '.'); ?> €</p>
                <a href="produktdetails.php?id=<?php echo $p['produkt_id'];?>" class="btn">Details ansehen</a>
            </div>

        <?php
            }
        } else {
        ?>
            <p>Keine Produkte gefunden.</p>
        <?php
        }
        ?>
    </div>


<?php require_once '../includes/footer.php'; ?>
</div>

</body>
</html>


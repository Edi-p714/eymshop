<?php
// public/überuns.php
session_start();
require_once '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Über uns - EYMshop</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/uberuns.css">
</head>
<body>


<div class="container">
<?php require_once '../includes/header.php'; ?>
    <div class="uberuns-wrapper">
        <div class="uberuns-header">
            <h1>Über uns</h1>
            <p>Willkommen bei <strong>EYMshop</strong> – Ihrem Online-Shop für hochwertige Kleidung für Herren, Damen und Mädchen.</p>
        </div>

        <h2>Unsere Geschichte</h2>
        <p>
            Gegründet im Dezember 2025 in Hannover, Deutschland, verfolgen wir bei EYMshop das Ziel, Mode von hoher Qualität von Kopf bis Fuß anzubieten, 
            die gleichzeitig modern und erschwinglich ist. Unser Sortiment umfasst sorgfältig ausgewählte Kleidung für die ganze Familie.
        </p>

        <h2>Unsere Philosophie</h2>
        <p>
            Bei EYMshop steht die Qualität an erster Stelle, ohne dabei die Preise aus den Augen zu verlieren.  
            Wir glauben, dass jeder Zugang zu stilvoller, langlebiger und komfortabler Kleidung haben sollte – ohne Kompromisse.
        </p>

        <h2>Unser Standort</h2>
        <p>
            Unser Team arbeitet direkt in Hannover, Deutschland, und wir halten uns streng an alle geltenden gesetzlichen Vorschriften, 
            um Ihnen ein sicheres und vertrauensvolles Einkaufserlebnis zu bieten.
        </p>

        <h2>Warum EYMshop?</h2>
        <ul>
            <li>Hochwertige Kleidung für Herren, Damen und Mädchen</li>
            <li>Modische Styles von Kopf bis Fuß</li>
            <li>Günstige Preise bei bester Qualität</li>
            <li>Direkt aus Hannover, Deutschland</li>
            <li>Einhaltung aller rechtlichen Vorgaben</li>
        </ul>

        <p>Vielen Dank, dass Sie EYMshop Ihr Vertrauen schenken!</p>
    </div> <!-- /ueberuns-wrapper -->
    <?php require_once '../includes/footer.php'; ?>
</div> <!-- /container -->



</body>
</html>

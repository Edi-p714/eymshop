<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danke! - EymShop</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/danke.css">
</head>
<body>

<div class="container">
<?php require_once '../includes/header.php'; ?>

    <div class="thank-you-box">
        <span class="icon">🎉</span>
        <h1>Vielen Dank!</h1>
        <p>Ihre Bestellung wurde erfolgreich aufgenommen.</p>

        <?php if (isset($_GET['id'])): ?>
            <p>Ihre Bestellummer lautet:</p>
            <div class="order-badge">#<?php echo intval($_GET['id']); ?>
            </div>
        <?php endif; ?>

        <p>Wir werden Ihre Artikel so schnell wie möglich versenden.</p>

        <a href="index.php" class="btn-continue">Weiter einkaufen</a>  
    </div>
    <?php require_once '../includes/footer.php'; ?>
</div>

</body>
</html>
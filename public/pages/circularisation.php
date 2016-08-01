<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/skeleton.css">
    <link rel="stylesheet" href="../css/main.css">
    <title>AMS</title>
</head>
<body>

<?php $path = $_GET['circularisation'] . '_circularisation.php'; ?>

<?php if (isset($_GET['circularisation']) && file_exists($path)) : ?>
    <?php require $path; ?>
<?php else: ?>
    <div class="box">
        <h1>Page introuvable</h1>
    </div>
<?php endif; ?>

</body>
</html>
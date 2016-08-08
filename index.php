<?php
//
$environment = 'DEBUG';

setlocale(LC_ALL, 'fr_FR');

session_start();

// Check the environment for error displays
if ($environment === 'DEBUG') {

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Check mission session
    if (!isset($_SESSION['idMission'])) {
        $_SESSION['idMission'] = 53;
        $_SESSION['id'] = 1;
    }
}

?>

<?php require 'vendor/autoload.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/normalize.css">
    <link rel="stylesheet" href="public/css/skeleton.css">
    <link rel="stylesheet" href="public/css/main.css">
    <title><?= isset($_GET['type']) ? 'Circularisation ' . $_GET['type'] : 'fournisseur' ?></title>
</head>
<body>

<!-- Test the file existance -->
<?php if (isset($_GET['type'])) {
    $types = array('fournisseur' => 40, 'client' => 41, 'avocat' => 42, 'banque');
} ?>

<!-- Check the error -->
<?php if (array_key_exists($_GET['type'], $types)): ?>
    <?php
    if ($_GET['type'] == 'avocat') {
        $path = 'files/circularisations/cir-' . $_GET['type'] . '.php';;
        if (file_exists($path)) {
            require $path;
        }
    } else {
        $index = $types[$_GET['type']];
        require 'files/circularisations/index.php';
    } ?>
<?php else: ?>
    <?php header('Not Found', true, 404) ?>
    <div class="box">
        <h1>Page introuvable</h1>
    </div>
<?php endif; ?>
</body>
</html>
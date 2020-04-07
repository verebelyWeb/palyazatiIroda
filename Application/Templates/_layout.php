<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="icon" type="image/jpeg" href="favicon.png">
    <link rel="stylesheet" href="<?=STEPBACK?><?= APPPATH ?>Style/style.css?p=<?= date('s') ?>">
</head>
<body>
    <!-- Free icons: https://icons8.com/app -->
    <?php require_once APPPATH.'Templates/header.php' ?>
    <!-- View -->
    <?php require_once APPPATH."Templates/{$view}View.php" ?>
</body>
</html>
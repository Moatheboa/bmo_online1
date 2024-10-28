<?php

include('../config/config.php');
$title = 'Hem';
include('../view/head.php');

$dbPath = "../db/bmo.sqlite";
$pdo = connectToDataBase($dbPath);

$imgArray1 = fetchOneRowFromDb(['category', 'image'], 'object', 27, $pdo);
$cat1 = $imgArray1['category'];
$img1 = $imgArray1['image'];
$imgArray2 = fetchOneRowFromDb(['category', 'image'], 'object', 5, $pdo);
$cat2 = $imgArray2['category'];
$img2 = $imgArray2['image'];
?>

    <body>
        <?php
        include('../view/header.php');
        ?>
        <main class="mainHome">
            <h2>Begravningsmuseum Online</h2>
            <div class="homeDiv">
                <figure><img src="../img/250x250/<?=$img1?>" alt="Begravningskonfekt"><figcaption><?=$cat1?></figcaption></figure>
                <h1>BMO</h1>
                <figure><img src="../img/250x250/<?=$img2?>" alt="Begravningskonfekt"><figcaption><?=$cat2?></figcaption></figure>
            </div>
            <p class="homeP">En digital upptäcktsfärd genom begravningsritualernas seder och bruk under 1800- och 1900-talen.</p>
        </main>
        <?php include('../view/footer.php'); ?>
    </body>
</html>

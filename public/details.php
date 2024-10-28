<?php

include('../config/config.php');
$title = 'Objekt';
include('../view/head.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "Inget id specificerad.";
}

$filename = "../db/bmo.sqlite";    // Filen i vscode, för studentwebben.
$pdo = connectToDatabase($filename);

$obj = fetchOneRowFromDb([], 'object', $id, $pdo);
$title = $obj['title'];
$category = $obj['category'];
$text = $obj['text'];
$image = $obj['image'];
$owner = $obj['owner'];

?>

    <body>
        <?php
        include('../view/header.php');
        ?>
        <main class="mainDetails">
            <figure><img src="../img/250/<?=$image?>" alt="$title"></figure>
            <div class="details">
                <p class="detailsText"><?=$text?></p>
                <p>Titel: <?=$title?>.</p>
                <p>Kategori: <?=$category?>.</p>
                <P>Ägs av: <?=$owner?>.</p>
            </div>
        </main>
    <?php include('../view/footer.php'); ?>
    </body>
</html>


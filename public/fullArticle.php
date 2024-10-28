<?php

include('../config/config.php');
$title = 'Full artikel';
include('../view/head.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "Inget id specificerad.";
    exit;
}

$filename = "../db/bmo.sqlite";
$pdo = connectToDatabase($filename);

$art = fetchOneRowFromDb(['title', 'content', 'author', 'pubdate'], 'article', $id, $pdo);
$title = $art['title'];
$content = $art['content'];
$author = $art['author'];
$pubdate = $art['pubdate'];

if ($author === 'Av Maggy Larsson') {
    $mags = fetchFromDb(['image', 'caption'], 'maggy', $pdo);

    $photos = [];
    $captions = [];

    foreach ($mags as $row) {
        $photos[] = $row['image'];
        $captions[] = $row['caption'];
    }

    $count = count($photos);

    $magsOutput = "";
    for ($i = 0; $i < $count; $i++) {
        $magsOutput .= "
        <figure>
            <img src='../img/maggy/$photos[$i]' alt=''>
                <figcaption>
                    <p>$captions[$i]</p>
                </figcaption>
        </figure>";
    }
}
?>

    <body>
        <?php
        include('../view/header.php');
        ?>
        <main class="mainFullArticle">
            <?php if ($author === 'Av Maggy Larsson') : ?>
            <div class="twoCols">
                <div class="MaggyArticle">
            <?php endif; ?>

            <div class="article">
                <h1><?= $title ?>.</h1>
                <p class="info">Skriven av <?=$author?>. Publicerad <time datetime="<?= $pubdate ?>"><?= $pubdate ?></time>.</p>
                <p class="articleContent"><?= $content ?></p>
            </div>

            <?php if ($author === 'Av Maggy Larsson') : ?>
                </div>
                <div class="MaggyPhotos">
                <?= $magsOutput ?>
                </div>
            </div>
            <?php endif; ?>

        </main>
    <?php include('../view/footer.php'); ?>
    </body>
</html>


<?php

include('../config/config.php');
$title = 'Full artikel';
include('../view/head.php');

$filename = "../db/bmo.sqlite";
$pdo = connectToDatabase($filename);

$about = fetchOneRowFromDb(['title', 'content', 'pubdate'], 'article', 4, $pdo);
$title = $about['title'];
$content = $about['content'];
$pubdate = $about['pubdate'];

?>

    <body>
        <?php
        include('../view/header.php');
        ?>
        <main class="mainAbout">
                <div class="article">
                <h1><?= $title ?></h1>
                <p class="info">Publicerad <time datetime="<?= $pubdate ?>"><?= $pubdate ?></time>.</p>
                <p><?= $content ?></p>
            </div>
        </main>
    <?php include('../view/footer.php'); ?>
    </body>
</html>


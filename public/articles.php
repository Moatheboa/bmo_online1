<?php

include('../config/config.php');
$title = 'Objekt';
include('../view/head.php');

$filename = "../db/bmo.sqlite";
$pdo = connectToDatabase($filename);

$resArticles = fetchFromDb(['id', 'title'], 'article', $pdo);
$ids = [];
$titles = [];

foreach ($resArticles as $row) {
    $ids[] = htmlspecialchars($row['id']);
    $titles[] = htmlspecialchars($row['title']);
}

// unset och array_values takes away the article Om BMO that should not be displayed here.
unset($ids[3]);
unset($titles[3]);
$ids = array_values($ids);
$titles = array_values($titles);

$amount = count($ids);
$articlesOutput = "";

for ($i = 0; $i < $amount; $i++) {
    $articlesOutput .= "<li><a href='fullArticle.php?id=" . $ids[$i] . "'>$titles[$i]</a></li>";
}

?>
    <body>
        <?php
        include('../view/header.php');
        ?>

        <main class="mainArticles">
            <h1>Artiklar på museet</h1>
            <p>Klicka på texten för att läsa artikeln.<p>
            <ul>
                <?= $articlesOutput ?>
            </ul>
        </main>
    <?php include('../view/footer.php');?>
    </body>
</html>

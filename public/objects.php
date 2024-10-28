<?php

include('../config/config.php');
$title = 'Objekt';
include('../view/head.php');

$filename = "../db/bmo.sqlite";
$pdo = connectToDatabase($filename);

$resObject = fetchFromDb(['id', 'title', 'image'], 'object', $pdo);

// Create separate arrays with all id's, titles and images.
$id = [];
$titles = [];
$images = [];

foreach ($resObject as $row) {
    $ids[] = $row['id'];
    $titles[] = $row['title'];
    $images[] = $row['image'];
}

$numItems = count($titles);

$objectOutput = '';

// Börja generera HTML-output
for ($i = 0; $i < $numItems; $i += 3) {
    $objectOutput .= '<div class="row">';

    // Generera upp till tre kolumner per rad
    for ($j = 0; $j < 3; $j++) {
        // Kontrollera att vi inte överstiger antalet objekt i arrayen
        if (($i + $j) < $numItems) {
            $title = htmlspecialchars($titles[$i + $j]);
            $image = htmlspecialchars($images[$i + $j]);
            $id = urlencode($ids[$i + $j]);

            $objectOutput .= "
            <figure>
                <img src='../img/250x250/$image' alt='$title'>
                    <figcaption>
                        <a href='details.php?id=" . $id . "'>$title</a>
                    </figcaption>
            </figure>";
        }
    }
    $objectOutput .= '</div>';
}
?>
    <body>
        <?php
        include('../view/header.php');
        ?>

        <main class="mainObjects">
            <h1>Objekt på museet</h1>
            <p>Klicka på texten under bilden för mer information om objektet.<p>
            <div class= "objectsOutput"><?= $objectOutput ?></div>
        </main>
    <?php include('../view/footer.php');?>
    </body>
</html>

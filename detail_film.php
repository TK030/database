<?php

$dsn = 'mysql:host=localhost:3307;dbname=netland';
$gebruiker = 'bit_academy';
$psw = 'bit_academy';


try {
    $conect = new PDO($dsn, $gebruiker, $psw);
    echo "connected to db of 'netland' with version 5.7.26";
} catch (PDOException $e) {
    echo 'failed' . $e->getmessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>detail_film</title>
    <style>
        body {
            background-color: #797D7F;
            color: black;
        }

        td {
            color: whitesmoke;
            border: 2px solid black;
            padding: 40px;
        }

        th {
            color: whitesmoke;
            border: 2px solid black;
            padding: 40px;
        }

        h1,
        h2 {
            color: whitesmoke;
            text-align: center;
        }

        table {
            margin-left: 150px;
            margin-right: 150px;
        }

        iframe {
            width: 1080;
            height: 620;
        }
    </style>
</head>

<body>
    <?php
    echo "<br>";
    echo "<br>";
    echo "<a href='index.php?='>Terug</a>";
    echo "<br>";
    echo "<br>";

    if (isset($_GET['id'])) :
        $id = $_GET['id'];
        $stmt = $conect->prepare("SELECT * FROM movies WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($row = $stmt->fetch()) :
            $moviesrow = "";
            $moviesrow .= '<td><a href="edit_film.php?id=' . $row['id'] . '">Bewerk</a></td>';
            echo $moviesrow;
            ?>
            <h1><?= $row['title'] ?> - <?= $row['length_in_minutes'] ?> minuten</h1>
            <table>
                <tr>
                    <td>
                        <h2>Datum van uitkomst: <?= $row['released_at'] ?></h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Land van uitkomst: <?= $row['country_of_origin'] ?></h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3><?= $row['summary'] ?><h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <iframe src="https://www.youtube.com/embed/<?= $row['youtube_trailer_id'] ?>" frameborder="0" allowfullscreen></iframe>
                    </td>
                </tr>
            </table>
        <?php endwhile; ?>
    <?php endif; ?>
</body>

</html>
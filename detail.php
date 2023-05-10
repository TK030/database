<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Detail</title>
</head>

<body>
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

    echo "<br>";
    echo "<br>";
    echo "<a href='index.php?='>Terug</a>";
    echo "<br>";
    echo "<br>";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $conect->prepare("SELECT * FROM media WHERE id= :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($datarow = $stmt->fetch()) {
            $htmlRows = "";
            $htmlRows .= '<td><a href="edit.php?id=' . $datarow['id'] . '">Bewerk</a></td>';
            echo $htmlRows; ?>
            <h1><?= $datarow['title'] ?> - <?= $datarow['rating'] ?></h1>
            <table>
                <tr>
                    <td>Awards: <?= $datarow['has_won_awards'] ?></td>
                </tr>
                <tr>
                    <td>Seasons: <?= $datarow['seasons'] ?></td>
                </tr>
                <tr>
                    <td>Language: <?= $datarow['spoken_in_language'] ?></td>
                </tr>
                <tr>
                    <td>Country: <?= $datarow['country_of_origin'] ?></td>
                </tr>
                <tr>
                    <td>Minutes: <?= $datarow['length_in_minutes'] ?></td>
                </tr>
                <tr>
                    <td>Media: <?= $datarow['media'] ?></td>
                </tr>
                <tr>
                    <td>Released: <?= $datarow['released_at'] ?></td>
                </tr>
                <tr>
                    <td><Br><?= $datarow['summary'] ?></td>
                </tr>
                <tr>
                    <td>
                        <iframe src="https://www.youtube.com/embed/<?= $row['youtube_trailer_id'] ?>" frameborder="0" allowfullscreen></iframe>
                    </td>
                </tr>
            </table> <?php
        }
	}
	?>
</body>

</html>
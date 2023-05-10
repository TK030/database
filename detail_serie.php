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
    <title>detail_serie</title>
</head>

<body>
    <style>
        body {
            background-color: #797D7F;
            color: black;
        }

        td {
            color: black;
            border: 2px solid black;
            padding: 40px;
        }

        th {
            color: black;
            border: 2px solid black;
            padding: 40px;
        }

        h1,
        h2 {
            color: black;
            text-align: center;
        }

        table {
            margin-right: 150px;
            margin-left: 150px;
        }
    </style>

    <?php
    echo "<br>";
    echo "<br>";
    echo "<a href='index.php?='>Terug</a>";
    echo "<br>";
    echo "<br>";

    if (isset($_GET['id'])) :
        $id = $_GET['id'];
        $stmt = $conect->prepare("SELECT * FROM series WHERE id= :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($row = $stmt->fetch()) :
            $htmlSeriesRows = "";
            $htmlSeriesRows .= '<td><a href="edit_serie.php?id=' . $row['id'] . '">Bewerk</a></td>';
            echo $htmlSeriesRows;
            ?>
            <h1><?= $row['title'] ?> - <?= $row['rating'] ?></h1>
            <table>
                <tr>
                    <td>Awards? <?= $row['has_won_awards'] ?></td>
                </tr>
                <tr>
                    <td>Seasons <?= $row['seasons'] ?></td>
                </tr>
                <tr>
                    <td>Country <?= $row['country'] ?></td>
                </tr>
                <tr>
                    <td>Language <?= $row['spoken_in_language'] ?></td>
                </tr>
                <tr>
                    <td><Br><?= $row['summary'] ?></td>
                </tr>
            </table>

</html>
            <?php
        endwhile;
    endif;
    ?>
</body>

</html>
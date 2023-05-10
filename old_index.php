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
echo "<br>";
echo "<a href='add_serie.php?id='>Serie toevoegen</a>";
echo "<br>";
echo "<br>";
$stmt = $conect->prepare("SELECT * FROM series where rating ORDER BY rating DESC");
$stmt->execute();
$htmlSeriesRows = "";
while ($dataRow = $stmt->fetch()) {
    $htmlSeriesRows .= '
    <tr>
        <td>' . $dataRow['title'] . '</td>
        <td>' . $dataRow['rating'] . '</td>
        <td><a href="detail_serie.php?id=">Bekijk details</a></td>
    </tr>
';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <style>
        body {
            background-color: #797D7F;
            color: black;
        }

        p {
            text-align: center;
            font-family: Verdana;
            font-size: x-large;
            color: black;
        }

        td {
            color: black;
            border: 2px solid black;
            padding: 20px;
            text-align: center;
            font-family: Verdana;
        }

        th {
            color: black;
            border: 2px solid black;
            padding: 20px;
            font-family: Verdana;
        }

        h1 {
            text-align: center;
            font-family: Verdana;
            font-size: large;
            color: black;
        }

        h2 {
            color: black;
            text-align: center;
        }

        table {
            display: flex;
            justify-content: center;
            margin-bottom: 150px;
            color: black;
        }
    </style>
</head>

<body>
    <h1>Series</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Rating</th>
            <th>Details</th>
        </tr>
        <?php echo $htmlSeriesRows; ?>
    </table>
    <?php
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<a href='add_film.php?id='>Film toevoegen</a>";
    echo "<br>";
    echo "<br>";
    ?>
    <h1>Films</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Duur</th>
            <th>Details</th>
        </tr>
        <?php
        $stmt = $conect->prepare("SELECT * FROM movies where length_in_minutes ORDER BY length_in_minutes DESC");
        $stmt->execute();
        while ($moviesrow = $stmt->fetch()) : ?>
            <tr>
                <td>
                    <?= $moviesrow['title'] ?>
                </td>
                <td>
                    <?= $moviesrow['length_in_minutes'] ?>
                </td>
                <td>
                    <a href=" detail_film.php?id=<?= $moviesrow['id'] ?>">Bekijk details</a>
                </td>
            </tr>

        <?php endwhile; ?>
    </table>
</body>

</html>
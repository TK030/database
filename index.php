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
    <link rel="stylesheet" href="style.css">
    <title>Index</title>
</head>

<body>
    <br>
    <br>
    <a href='insert.php?='>Media Toevoegen</a>
    <br>
    <br>
    <h1>Media</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Duur</th>
            <th>Details</th>
        </tr>
        <?php
        $stmt = $conect->prepare("SELECT * FROM media ORDER BY length_in_minutes DESC");
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
                    <a href=" detail.php?id=<?= $moviesrow['id'] ?>">Bekijk details</a>
                </td>
            </tr>

        <?php endwhile; ?>
    </table>
</body>

</html>
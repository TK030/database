<?php

$dsn = 'mysql:host=localhost:3307;dbname=netland';
$user = 'bit_academy';
$pass = 'bit_academy';

try {
    $conect = new PDO($dsn, $user, $pass);
    echo "connected to db of 'netland' with version 5.7.26";
} catch (PDOException $e) {
    echo 'failed' . $e->getmessage();
}
$serieId = $_GET["id"];





if (isset($_POST["submit"])) {
    $stmt = $conect->prepare(
        "UPDATE series
 SET
 title = '" . $_POST["title"] . "',
 rating = " . $_POST["rating"] . ",
 has_won_awards = " . $_POST["awards"] . ",
 seasons = " . $_POST["seasons"] . ",
 country = '" . $_POST["country"] . "',
 summary = '" . addslashes($_POST["description"]) . "'
 WHERE
 id = '" . $_GET["id"] . "';"
    );
    $stmt->execute();
}


echo "<a href='index.php'>Terug</a>";
$stmt = $conect->query('SELECT * FROM series WHERE id = "' . $serieId . '"');

$form = "<form id='series_form' action='edit_serie.php?id=" . $serieId . "' method='post'><table>";
while ($dataRow = $stmt->fetch()) {
    echo "<h1>" . $dataRow["title"] . " - " . $dataRow["rating"] . "</h1>";
    $form .= "<tr><td><b>Title</b></td><td><input type='text' name='title' value='" . $dataRow["title"] . "'></td><tr>";
    $form .= "<tr><td><b>Rating</b></td><td><input type='number' name='rating' step='0.1' min='0' max='5' value='" . $dataRow["rating"] . "'></td><tr>";
    $form .= "<tr><td><b>Awards</b></td><td><select name='awards'>";
    if ($dataRow["has_won_awards"] == 1) {
        $form .= "<option value='1' selected>Ja</option>";
    } else {
        $form .= "<option value='1'>Ja</option>";
    }
    if ($dataRow["has_won_awards"] == 0) {
        $form .= "<option value='0'selected>Nee</option>";
    } else {
        $form .= "<option value='0'>Nee</option>";
    }
    $form .= "</select></td><tr>";
    $form .= "<tr><td><b>Seasons</b></td><td><input type='number' name='seasons' value='" . $dataRow["seasons"] . "'></td><tr>";
    $form .= "<tr><td><b>Country</b></td><td><input type='text' name='country' value='" . $dataRow["country"] . "'></td><tr>";
    $form .= "<tr><td><b>Language</b></td><td><input type='text' name='language' value='" . $dataRow["spoken_in_language"] . "'></td><tr>";
    $form .= "<tr><td><b>Description</b></td><td><textarea name='description' form='series_form'>" . $dataRow["summary"] . "</textarea></td><tr>";
    $form .= "<tr><td></td><td><input type='submit' name='submit'></input></td><tr>";
}
$form .= "</table></form>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>EditSeries</title>
</head>

<body>
    <?php

    echo $form;

    ?>
</body>

</html>
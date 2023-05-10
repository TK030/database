<?php

$dsn = 'mysql:host=localhost:3307;dbname=netland';
$user = 'bit_academy';
$pass = 'bit_academy';

try {
    $pdo = new PDO($dsn, $user, $pass);
    echo "connected to db of 'netland' with version 5.7.26";
} catch (PDOException $e) {
    echo 'failed' . $e->getmessage();
}
$MoviesID = $_GET["id"];
if (isset($_POST["submit"])) {
    $stmt = $pdo->prepare(
        "UPDATE movies SET
    title = '" . $_POST["title"] . "',
    length_in_minutes = " . $_POST["length_in_minutes"] . ",
    released_at = '" . $_POST["released_at"] . "',
    country_of_origin = '" . $_POST["country_of_origin"] . "',
    summary = '" . addslashes($_POST["summary"]) . "',
    youtube_trailer_id = '" . ($_POST["youtube_trailer_id"]) . "'
    WHERE id = " . $_GET["id"] . ";"
    );
    $stmt->execute();
    $MoviesID = $_GET["id"];
}
echo "<a href='index.php'>Terug</a>";
$stmt = $pdo->query('SELECT * FROM movies WHERE id = "' . $MoviesID . '"');
$form = "<form id='movies_form' action='edit_film.php?id=" . $MoviesID . "' method='POST'><table>";
while ($dataRow = $stmt->fetch()) {
    echo "<h1>" . $dataRow["title"] . " - " . $dataRow["length_in_minutes"] . "</h1>";
    $form .= "<tr><td><b>Title</b></td><td><input type='text' name='title' value='" . $dataRow["title"] . "'></td><tr>";
    $form .= "<tr><td><b>length_in_minutes</b></td><td><input type='text' name='length_in_minutes'" . $dataRow["length_in_minutes"] . "'></td><tr>";
    $form .= "<tr><td><b>released_at<b></td><td><input type='date' name='released_at'" . $dataRow["released_at"] . "'></td><td>";
    $form .= "<tr><td><b>country_of_origin</b></td><td><input type='text' name='country_of_origin'>";
    $form .= "<tr><td><b>summary</b></td><td><textarea name='summary' form='movies_form'>" . $dataRow["summary"] . "</textarea></td><tr>";
    $form .= "<tr><td><b>youtube_trailer_id</b></td><td><input type='text' name='youtube_trailer_id' value='" . $dataRow["youtube_trailer_id"] . "'></td><tr>";
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
    <title>EditMovie</title>
</head>

<body>
    <?php echo $form; ?>

</body>

</html>
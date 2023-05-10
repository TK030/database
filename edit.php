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
echo "<a href='index.php?id='>Terug</a>";

$MediaID = $_GET["id"];
if (isset($_POST["submit"])) {
    $stmt = $conect->prepare(
        "UPDATE media SET
    Title = '" . $_POST["title"] . "',
    length_in_minutes = '" . $_POST["length_in_minutes"] . "',
    released_at = '" . $_POST["released_at"] . "',
    country_of_origin = '" . $_POST["country_of_origin"] . "',
    summary = '" . $_POST["summary"] . "',
    youtube_trailer_id = '" . $_POST["youtube_trailer_id"] . "',
    rating = '" . $_POST["rating"] . "',
    has_won_awards = '" . $_POST["has_won_awards"] . "',
    seasons = '" . $_POST["seasons"] . "',
    spoken_in_language = '" . $_POST["spoken_in_language"] . "',
    media = '" . $_POST["media"] . "'
    WHERE id = " . $_GET["id"] . ";"
    );
    $stmt->execute();
    $MoviesID = $_GET["id"];
}
$stmt = $conect->query('SELECT * FROM media WHERE id = "' . $MediaID . '"');
$form = "<form id='media_form' action='edit.php?id=" . $MediaID . "' method='POST'><table>";
while ($dataRow = $stmt->fetch()) {
    echo "<h1>" . $dataRow["title"] . " - " . $dataRow["length_in_minutes"] . "</h1>";
    $form .= "<tr>
              <td>Title</td>
              <td><input type='text' name='title' value='" . $dataRow["title"] . "'></td>
              <tr>";
    $form .= "<tr>
              <td>Minutes</td>
              <td><input type='text' name='length_in_minutes'" . $dataRow["length_in_minutes"] . "'></td>
              <tr>";
    $form .= "<tr>
              <td>Released</td>
              <td><input type='date' name='released_at'" . $dataRow["released_at"] . "'></td>
              <tr>";
    $form .= "<tr>
              <td>Country</td>
              <td><input type='text' name='country_of_origin'" . $dataRow["country_of_origin"] . "'></td>
              <tr>";
    $form .= "<tr>
              <td>Summary</td>
              <td><textarea name='summary' form='media_form'>" . $dataRow["summary"] . "</textarea></td>
              <tr>";
    $form .= "<tr>
              <td>Youtube-Trailer</td>
              <td><input type='text' name='youtube_trailer_id' value='" . $dataRow["youtube_trailer_id"] . "'></td>
              <tr>";
    $form .= "<tr>
              <td>Rating</td>
              <td><input type='number' name='rating' step='0.1' min='0' max='5' value='" . $dataRow["rating"] . "'></td>
              <tr>";
    $form .= "<tr>
              <td>Language</td>
              <td><input type='text' name='spoken_in_language'" . $dataRow["spoken_in_language"] . "'></td>
              <tr>";
    $form .= "<tr>
              <td>Awards</td>
              <td><select name='has_won_awards'>";
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
    $form .= "</select></td>
              <tr>";
    $form .= "<tr>
              <td>Seasons</td>
              <td><input type='number' name='seasons' value='" . $dataRow["seasons"] . "'></td>
              <tr>";
    $form .= "<tr>
              <td>Media</td>
              <td><select name='media'>";
    if ($dataRow["media"] == 1) {
        $form .= "<option value='1' selected>Movie</option>";
    } else {
        $form .= "<option value='1'>Movie</option>";
    }
    if ($dataRow["media"] == 0) {
        $form .= "<option value='0'selected>Serie</option>";
    } else {
        $form .= "<option value='0'>Serie</option>";
    }
    $form .= "</select></td>
              <tr>";
    $form .= "<tr>
              <td>
              <input type='submit' name='submit'></input></td>
              <tr>";
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
    <title>Edit</title>
</head>

<body>
    <?php echo $form; ?>
</body>

</html>
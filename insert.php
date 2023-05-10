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

if (isset($_POST["submit"])) {
    $title =  $_POST["title"];
    $length_in_minutes =  $_POST["length_in_minutes"];
    $released_at =  $_POST["released_at"];
    $country_of_origin =  $_POST["country_of_origin"];
    $summary =  $_POST["summary"];
    $youtube_trailer_id =  $_POST["youtube_trailer_id"];
    $rating =  $_POST["rating"];
    $has_won_awards =  $_POST["has_won_awards"];
    $seasons =  $_POST["seasons"];
    $spoken_in_language = $_POST["spoken_in_language"];
    $media = $_POST["media"];

    $query = "INSERT INTO `media` (`title`, `length_in_minutes`, `released_at`, `country_of_origin`,
    `youtube_trailer_id`, `summary`, `rating`, `has_won_awards`, `seasons`, `spoken_in_language`, `media`) 
    VALUE(:title, :length_in_minutes, :released_at, :country_of_origin, :youtube_trailer_id, :summary, :rating, :has_won_awards, :seasons, :spoken_in_language, :media)";
    $query_run = $conect->prepare($query);
    $data = [
        'title' => $title,
        'length_in_minutes' =>  $length_in_minutes,
        'released_at' =>  $released_at,
        'country_of_origin' =>  $country_of_origin,
        'summary' => $summary,
        'youtube_trailer_id' =>  $youtube_trailer_id,
        'rating' =>  $rating,
        'has_won_awards' =>  $has_won_awards,
        'seasons' =>  $seasons,
        'country_of_origin' =>  $country_of_origin,
        'spoken_in_language' => $spoken_in_language,
        'media' => $media
    ];
    $query_excute = $query_run->execute($data);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Insert</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-4">
                <div class="table">
                    <div class="card-header">
                        <h3>Nieuwe Media</h3>
                    </div>
                    <div class="card-body">
                        <form action="insert.php" method="POST">
                            <div class="mb-3">
                                <p>Title</p>
                                <input type="text" name="title" value="Vul in!" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <p>Length In Minutes</p>
                                <input type="text" name="length_in_minutes" value="Vul in!" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <p>Released At</p>
                                <input type="date" name="released_at" value="Vul in!" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <p>Country Of Origin</p>
                                <input type="text" name="country_of_origin" value="Vul in!" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <p>Summary</p>
                                <input type="text" name="summary" value="Vul in!" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <p>Youtube Trailer Id</p>
                                <input type="link" name="youtube_trailer_id" value="Vul in!" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <p>Rating</p>
                                <input type="number" name="rating" value="Vul in!" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <p>Has Won Awards</p>
                                <select name='has_won_awards'>
                                    <option value='1' selected>Ja</option>
                                    <option value='0'>Nee</option>
                                </select>
                                <div class="mb-3">
                                    <p>Seasons</p>
                                    <input type="text" name="seasons" value="Vul in!" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <p>Spoken In Language</p>
                                    <input type="Text" name="spoken_in_language" value="Vul in!" class="form-control" />
                                </div class="mb-3">
                                <div class="mb-3">
                                    <p>Media</p>
                                    <select name='media'>
                                        <option value='1' selected>Movie</option>
                                        <option value='0' selected>Serie</option>
                                    </select>
                                </div class="mb-3">
                                <br>
                                <div class="mb-3">
                                    <input type="submit" name="submit" value="Toevoegen" class="btn btn-primary" />
                                </div class="mb-3">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
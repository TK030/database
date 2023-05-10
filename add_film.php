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
if (isset($_POST["submit"])) {
    $title =  $_POST["title"];
    $length_in_minutes =  $_POST["length_in_minutes"];
    $released_at =  $_POST["released_at"];
    $country_of_origin =  $_POST["country_of_origin"];
    $summary =  $_POST["summary"];
    $youtube_trailer_id =  $_POST["youtube_trailer_id"];

    $query = "INSERT INTO `movies` (`title`, `length_in_minutes`, `released_at`, `country_of_origin`, `youtube_trailer_id`, `summary`) 
    VALUE(:title, :length_in_minutes, :released_at, :country_of_origin, :youtube_trailer_id, :summary)";
    $query_run = $pdo->prepare($query);
    $data = [
        'title' => $title,
        'length_in_minutes' =>  $length_in_minutes,
        'released_at' =>  $released_at,
        'country_of_origin' =>  $country_of_origin,
        'summary' => $summary,
        'youtube_trailer_id' =>  $youtube_trailer_id,
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
    <link rel="stylesheet" href="style.css">
    <title>AddMovie</title>
</head>

<body>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Nieuwe Film</h3>
                        </div>
                        <div class="card-body">
                            <form action="add_film.php" method="POST"><a href="index.php">Terug</a>
                                <br>
                                <br>
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
                                <br>
                                <br>
                                <div class="mb-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Toevoegen</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</body>

</html>
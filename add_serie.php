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
    $rating =  $_POST["rating"];
    $summary =  $_POST["summary"];
    $has_won_awards =  $_POST["has_won_awards"];
    $seasons =  $_POST["seasons"];
    $country =  $_POST["country"];
    $spoken_in_language = $_POST["spoken_in_language"];

    $query = "INSERT INTO `series` (`title`, `rating`, `summary`, `has_won_awards`, `seasons`, `country`, `spoken_in_language` ) 
    VALUE(:title, :rating, :summary, :has_won_awards, :seasons, :country, :spoken_in_language)";
    $query_run = $pdo->prepare($query);
    $data = [
        'title' => $title,
        'rating' =>  $rating,
        'summary' =>  $summary,
        'has_won_awards' =>  $has_won_awards,
        'seasons' =>  $seasons,
        'country' =>  $country,
        'spoken_in_language' => $spoken_in_language,
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
    <title>AddSerie</title>
</head>

<body>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Nieuwe Serie</h3>
                        </div>
                        <div class="card-body">
                            <form action="add_serie.php" method="POST"><a href="index.php">Terug</a>
                                <br>
                                <br>
                                <div class="mb-3">
                                    <p>Title</p>
                                    <input type="text" name="title" value="Vul in!" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <p>Rating</p>
                                    <input type="number" name="rating" value=0 class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <p>Summary</p>
                                    <input type="text" name="summary" value="Vul in!" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <p>Has Won Awards</p>
                                    <input type="number" name="has_won_awards" value="Vul in!" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <p>Seasons</p>
                                    <input type="text" name="seasons" value="Vul in!" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <p>Country</p>
                                    <input type="Text" name="country" value="Vul in!" class="form-control" />
                                </div>
                                <div>
                                    <p>Spoken In Language</p>
                                    <input type="Text" name="spoken_in_language" value="Vul in!" class="form-control" />
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
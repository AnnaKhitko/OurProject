<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php require_once 'navbar.php'; ?>
    <h2>All the movies</h2>
    <?php

    //connect to the DB
    require_once 'database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, 'movieProject', '8889');

    //$orderBy = 'm.movieId';

    if ($conn) {

        $query = "SELECT * FROM movies";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
            // echo '<pre>';
            // var_dump($movies);
            // echo '</pre>';

            foreach ($movies as $movie) {
                echo '<img  height = 200px src="' . $movie['poster'] . '">' . '<br>';
                echo '#' . $movie['movieId'];
                echo $movie['title'] . '<br>';
                echo substr($movie['synopsis'], 0, 30) . '...' . '<br>' . '<a href="http://localhost:8888/PHP/DB_ex/Movie_Ex_4.php?movieId=' . $movie['movieId'] . '">more</a><br><hr>';
            }
        }
    } else {
        echo 'Problems with connestion';
    };
    ?>

</body>

</html>
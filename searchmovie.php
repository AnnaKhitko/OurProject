<?php
session_start();
?>
<?php

// Search in the DB
require_once 'database.php';
// connecting to the DBMS
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);


if (!empty($_POST) && isset($_POST['checkName'])) {

    // creating variable for searching movie
    $searchMovie = $_POST['checkName'];

    //writing query to fetch result from database

    $querySearch = "SELECT * FROM movies WHERE title LIKE '$searchMovie%'";

    //connecting the query with database

    $resultSearch = mysqli_query($conn, $querySearch);

    //creating array to display movies

    $movies = array();

    //fetching result in associative array manner
    $movies = mysqli_fetch_assoc($resultSearch);

    //showing autocompleted movie
    // var_dump($movies);

    echo '<a href="movie.php?id=" ' . $movies['title'] . '">' . $movies['title'] . '</a>';
}
/*if (isset($_POST['submitmovie'])) {
    if ($conn) {
        echo 'hello';,
        $inputSearch = $_POST['inputSearch']
        $querySubmit = "SELECT * FROM movies WHERE title = '" . $inputSearch . "' ";
        $resultSearch = mysqli_query($conn, $querySubmit);
        var_dump($resultSearch);
        while ($movies = mysqli_fetch_assoc($resultSearch)) {
            echo  $movies['title'] . '<br>';
        }
    }
}*/

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie details</title>
</head>

<body>
    <h2>Movie Details</h2>
    <a href="http://localhost:8888/moviedetails.php">Return to the list</a>

</body>

</html>

<?php
//connect to the DB
require_once 'database.php';
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, 'movieProject', '8889');

if ($conn) {

    //check if we have a movieId in the url
    if (isset($_GET['movieId'])) {

        //get the movie id from url
        $id = (int) $_GET['movieId']; //convert to integer
        // echo $id . '<br>';

        $query = 'SELECT m.title as movieName,
        c.title as categ,
         m.year as year,
         m.poster as poster, 
         m.synopsis as synopsis,
         a.name as actorName
        FROM movies m 
        JOIN category c ON m.categId = c.categId
        JOIN actors a ON a.actorsId = m.actorId
        WHERE movieId = ' . $id;
        $result = mysqli_query($conn, $query);


        //$movie = mysqli_fetch_assoc($result); - take only 1 result from movie, because we expect only 1 result
        if ($result) {
            $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($movies as $movie) {
                echo '<img  height = 200px src="' . $movie['poster'] . '">' . '<br>';
                echo $movie['movieName'] . '<br>';
                echo 'Year: ' . $movie['year'] . '<br>';
                echo 'Description: ' . $movie['synopsis'] . '<br>';
                echo 'Actor: ' . $movie['actorName'] . '<br>';
            }
        } else {
            echo 'Problem sorting';
        }
    }
} else {
    echo 'Problems with connestion';
}
mysqli_close($conn);

?>
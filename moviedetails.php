<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie details</title>
</head>

<body>
    <?php require_once 'navbar.php'; ?>
    <h2>Movie Details</h2>

</body>

</html>

<?php
$conn = mysqli_connect('localhost', 'root', 'root', 'moviedatabase', '8889');
if ($conn) {
    $query = 'SELECT * FROM movies';
    $result = mysqli_query($conn, $query);

    if ($result) {
        $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($movies as $movie) {
            echo '<img  height = 200px src="' . $movie['poster'] . '">' . '<br>';
            echo '<a href="http://localhost:8888/PHP/DB_ex/Movie_Ex_4.php?movieId=' . $movie['movieId'] . '">' . $movie['title'] . '</a>' . '<br>';
            // echo $movie['title'] . '<br>';
            echo $movie['year_released'] . '<br>';
            echo '<hr>';
        }
    } else {
        echo 'Problem sorting';
    }
} else {
    echo 'Problems with connestion';
}
mysqli_close($conn); ?>
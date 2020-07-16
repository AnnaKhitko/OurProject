<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homePage</title>
</head>

<body>

    <!--Add the nav bar inside the php : Require_once-->

    <form action="searchMovie.php" method="post">
        <!--Introduction text for the page-->
        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>

        <!--search box and submit button-->

        <input type="search" name="inputSearch" id="search_Movie" placeholder="Enter Movie" style="width: 600px; height: 30px;">
        <div id="results"></div>

        <!--<input type="submit" name="submitmovie" value="Search">-->

    </form>





    <!--connecting the jquery cdn-->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <!-- writing the script with ajax : To find movies in the search box -->
    <script>
        //Jquery function for keyup
        $(function() {
            $('#search_Movie').keyup(function(e) {
                console.log('hello');
                e.preventDefault();
                $.ajax({
                    url: 'searchMovie.php',
                    type: 'post',

                    data: {
                        checkName: $(this).val()
                    },

                    success: function(result) {
                        console.log(result);
                        $('#results').show();
                        $('#results').html(result);
                    },

                    error: function(err) {
                        // If ajax errors happens
                    }
                });
            });
        });
    </script>
    <!--finished with jquery cdn-->

    <?php

    require_once 'database.php';
    // connecting to the DBMS
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

    if ($conn) {

        $queryDisplayCate = "SELECT category.title,COUNT(movies.categId) as total
         FROM category INNER JOIN movies ON category.categId = movies.categId GROUP BY movies.categId";

        $resultsDisplayCate = mysqli_query($conn, $queryDisplayCate);

        $displayCate = mysqli_fetch_all($resultsDisplayCate, MYSQLI_ASSOC);
    }

    ?>

    <?php foreach ($displayCate as $display) : ?>
        <hr>
        <p>
            <strong>Category name:</strong>
            <?= '<a href =movie.php? >' . $display['title'] . '</a>' . $display['total'] ?>
        </p>

    <?php endforeach; ?>

    <?php

    $queryDisplayMovie = "SELECT poster,title FROM movies ORDER BY movieId DESC LIMIT 4";

    $resultsDisplayMovie = mysqli_query($conn, $queryDisplayMovie);

    $displayMovie = mysqli_fetch_all($resultsDisplayMovie, MYSQLI_ASSOC);

    ?>

    <?php foreach ($displayMovie as $movie) : ?>
        <hr>
        <p>
            <strong>Movie name:</strong>
            <?= '<a href =movie.php? >"' .  $movie['title'] . '"  </a>' ?>
        </p>
        <p>
            <?= "<img src='" . $movie['poster'] . "' width='300' height='200' />"  ?>
        </p>
    <?php endforeach; ?>




</body>

</html>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!--Add the nav bar inside the php : Require_once-->


    <?php

    // Search in the DB
    // require_once 'navbar.php';
    require_once 'database.php';
    // connecting to the DBMS
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);


    ?>

    <?php

    if (isset($_GET['edit'])) {

        $id = $_GET['edit'];

        $query_modify = "SELECT * FROM movies WHERE movieId = '" . $id . "' ";

        var_dump($query_modify);

        $results_modify = mysqli_query($conn, $query_modify);

        $movie_modify = mysqli_fetch_assoc($results_modify);

    ?>

        <form method="post">
            <input type="text" name="title" placeholder="Add Title" value="<?= $movie_modify['title']; ?>"><br><br>
            <input type="img" name="poster" placeholder="Add Poster" value="<?= $movie_modify['poster']; ?>"><br><br>
            <input type="text" name="synopsis" placeholder="Add Synopsis" value="<?= $movie_modify['synopsis']; ?>"><br><br>
            <input type="text" name="year" placeholder="Add year" value="<?= $movie_modify['year']; ?>"><br><br>

            <?php

            if ($conn) {
                $queryCateDropdown = "SELECT categId,title FROM category";
                $resultsCateDropdown = mysqli_query($conn, $queryCateDropdown);

                echo '<select name="cateList">';
                while ($db_cateList = mysqli_fetch_assoc($resultsCateDropdown)) {
                    echo '<option value="' . $db_cateList['categId'] . '">' . $db_cateList['title'] . '</option>';
                }

                echo '</select>' . '<br>' . '<br>';

                // $actorsid = $db_actorList['actorsId'];
            }
            ?><br>

            <?php

            if ($conn) {

                $queryactorDropdown = "SELECT actorsId,name FROM actors";
                $resultsactorDropdown = mysqli_query($conn, $queryactorDropdown);

                echo '<select name="actorList">';
                while ($db_actorList = mysqli_fetch_assoc($resultsactorDropdown)) {
                    echo '<option value="' . $db_actorList['actorsId'] . '">' . $db_actorList['name'] . '</option>';
                }

                echo '</select>' . '<br>';

                // $actorsid = $db_actorList['actorsId'];
            }
            ?><br>
            <input type="submit" name="submitModify" value="Modify">
        </form>

        <?php

        if (isset($_POST['submitModify'])) {
            $title = $_POST['title'];
            $poster = $_POST['poster'];
            $synopsis = $_POST['synopsis'];
            $year = $_POST['year'];
            $category = $_POST['cateList'];
            $actor = $_POST['actorList'];

            $query_modify = "UPDATE movies
            SET title = '$title',poster = '$poster',synopsis = '$synopsis',year = '$year',actorId = '$actor',categId = '$category'
            WHERE movieId = '$id'";

            $resultsModifyMovie = mysqli_query($conn, $query_modify);

            var_dump($resultsModifyMovie);

            if ($resultsModifyMovie) {
                echo 'Movie updated';
            } else {
                echo 'Movie not updated';
            }
        }


        ?>


    <?php

    } else { ?>

        <form method="post">
            <input type="text" name="title" placeholder="Add Title"><br><br>
            <input type="img" name="poster" placeholder="Add Poster"><br><br>
            <input type="text" name="synopsis" placeholder="Add Synopsis"><br><br>
            <input type="text" name="year" placeholder="Add year"><br><br>

            <?php

            if ($conn) {
                $queryCateDropdown = "SELECT categId,title FROM category";
                $resultsCateDropdown = mysqli_query($conn, $queryCateDropdown);

                echo '<select name="cateList">';
                while ($db_cateList = mysqli_fetch_assoc($resultsCateDropdown)) {
                    echo '<option value="' . $db_cateList['categId'] . '">' . $db_cateList['title'] . '</option>';
                }

                echo '</select>' . '<br>' . '<br>';

                // $actorsid = $db_actorList['actorsId'];
            }
            ?><br>

            <?php

            if ($conn) {

                $queryactorDropdown = "SELECT actorsId,name FROM actors";
                $resultsactorDropdown = mysqli_query($conn, $queryactorDropdown);

                echo '<select name="actorList">';
                while ($db_actorList = mysqli_fetch_assoc($resultsactorDropdown)) {
                    echo '<option value="' . $db_actorList['actorsId'] . '">' . $db_actorList['name'] . '</option>';
                }

                echo '</select>' . '<br>';

                // $actorsid = $db_actorList['actorsId'];
            }
            ?>

            <br>
            <input type="submit" name="submit" value="Add">
            <input type="submit" name="submitModify" value="Modify">
        </form>


        <?php




        if (isset($_POST['submit'])) {

            $title = $_POST['title'];
            $poster = $_POST['poster'];
            $synopsis = $_POST['synopsis'];
            $year = $_POST['year'];
            $category = $_POST['cateList'];
            $actor = $_POST['actorList'];

            if ($conn) {
                $queryAddMovie = "INSERT into movies(title,poster,synopsis,year,actorId,categId) 
            VALUES ('$title','$poster','$synopsis','$year','$actor','$category')";
                var_dump($queryAddMovie);

                $resultsAddMovie = mysqli_query($conn, $queryAddMovie);

                var_dump($resultsAddMovie);

                if ($resultsAddMovie) {
                    echo 'Movie Added';
                } else {
                    echo 'Movie not Added';
                }
            }
        }
        ?>

    <?php

    }

    ?>









</body>

</html>
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
    $getParams = $_GET;
    $getParams['order'] = 'desc';
    $orderDesckLink = http_build_query($getParams);

    $getParams['order'] = 'asc';
    $orderAscLink = http_build_query($getParams);
    ?>
    <a href="?<?= $orderDesckLink; ?>">Never movies firs</a>
    <a href="?<?= $orderAscLink; ?>">Older movies first</a>
    <br>
    <br>
    <?php

    //connect to the DB
    require_once 'database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, 'movieProject', '8889');

    $orderBy = 'movieId';
    $orderType = 'ASC';
    if (isset($_GET['order'])) {
        $orderBy = 'year';
        $orderType = $_GET['order'];
    }

    $page = 1;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    // = 
    // $page = isset($_GET['page']) ? $_GET['page'] : 1;
    // $page = $_GET['page'] ?? 1;

    if ($conn) {
        $limit = 3;
        $offset = $limit * ($page - 1);

        $countQuery = "SELECT count(*) as total FROM movies";
        $countResult = mysqli_query($conn, $countQuery);
        $count = mysqli_fetch_assoc($countResult);
        $count = (int) $count['total'];

        $query = "SELECT * FROM movies
        ORDER BY $orderBy $orderType
        LIMIT $limit OFFSET $offset";

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

            $paginationLinks = [];
            $getParams = $_GET;
            if ($page > 1) {
                $getParams['page'] = $page - 1;
                $paginationLinks[] = [
                    'title' => 'Previous',
                    'link' => '?' . http_build_query($getParams),
                ];
            }

            $getParams['page'] = $page;
            $paginationLinks[] = [
                'title' => $page,
                'link' => '?' . http_build_query($getParams)
            ];
            if ($page * $limit < $count) {
                $getParams['page'] = $page + 1;
                $paginationLinks[] = [
                    'title' => 'Next',
                    'link' => '?' . http_build_query($getParams)
                ];
            }

    ?>
            <div>
                <?php foreach ($paginationLinks as $link) { ?>
                    <a href="<?= $link['link']; ?>"><?= $link['title']; ?></a>
                <?php } ?>
            </div>
    <?php
        }
    } else {
        echo 'Problems with connestion';
    };
    ?>

</body>

</html>
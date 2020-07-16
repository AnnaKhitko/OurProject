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
    <h1>Category</h1>
    <?php
    //connect to the DB
    require_once 'database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, 'spotify', '8889');


    $result_query = mysqli_query($conn, "SELECT * FROM category");
   
    if ($result_query) {
        $category = mysqli_fetch_all($result_query, MYSQLI_ASSOC);
        var_dump($category);
    ?>
        <br>
        <form action="" method="post">
            <input type="hidden" name="songId" value="<?= $category['songId']; ?>">
            <label for="categories">||Add to playlist:</label>

            <select name="categories" id="categories">
                <?php
                foreach ($playlists as $playlist) {
                    echo "<option value='{$playlist['playlistId']}'>{$playlist['title']}</option>";
                }
                ?>
            </select>
        <?php
    }
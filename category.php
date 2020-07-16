<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php //require_once 'navbar.php'; ?>
    <h1>Category</h1>
    <?php
    //connect to the DB
    require_once 'database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, 'movieProject', '8889');

if ($conn) {
    //create new category:
    if(isset($_POST["create"])){
        $newCateg = htmlspecialchars($_POST["newCateg"]);
        if(!empty($newCateg)){
            $resultAddCateg = mysqli_query($conn, "INSERT IGNORE INTO category (title) VALUES ('$newCateg')");
           echo   "Done !";
        }
        else {
           echo  "you need to fill the form ";
        } 
    }
    //////
    ////modify categ 
    if(isset($_POST["modifyCateg"])){
        $query = "UPDATE category set title ='".$_POST["textCateg"]."' WHERE categId='".$_POST["categories"]."'"; 
    }
////////////////

    $result_query = mysqli_query($conn, "SELECT * FROM category");
    if ($result_query) {
        $category = mysqli_fetch_all($result_query, MYSQLI_ASSOC);
    ?>
        <br>
        <form action="" method="post">
            <label for="categories"> All Categories:</label>

            <select name="categories" id="categories">
                <?php
                foreach ($category as $categ) {
                    echo "<option value='{$categ['categId']}'>{$categ['title']}</option>";
                }
                ?>
            </select>
    <?php
    }
}
    ?>
    <!-- add button -->
            <input type="submit" value="modify" name="modifyCateg">
            <input type="text" name="textCateg">
        </form>
        <br>

    <form action="" method="POST">
        <input type="text" name="newCateg">
        <input type="submit" name="create" value="create">
    </form>
<?php
session_start();
/*if(isset($_SESSION["id"]) && isset($_SESSION["username"])){
    $userId = $_SESSION['id'];
    $username = $_SESSION['username'];
}*/

$userId = 2;
$username = 'dora';


$error = array();
if(isset($_POST['submit'])){
    $playlist = $_POST['playlist'];
    if($playlist){
        $error [] = "You need to fill the form"; 
    }
    include_once 'database.php';
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, 'movieProject');
    if($connection){
        $query = "INSERT INTO playlist(name, date, userId) VALUES('$username', now(), '$userId')";
        $result = mysqli_insert_id($connection);
        if($result){
            echo "done !";
        }
    }
    mysqli_close($connection);
}

?>

<form action="" method="POST">
    <input type="text" name="playlist">
    <input type="submit" name="submit" value="Add new playlist">
</form>
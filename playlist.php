<?php
session_start();


/*if(isset($_SESSION["id"]) && isset($_SESSION["username"])){
    $userId = $_SESSION['id'];
    $username = $_SESSION['username'];
}*/

//$userId= $_GET["playlistId"];///////////
$userId =2;
$username = 'dora';
$done='';
$update = false;
$name ='';
///// connection to database : 
include_once 'database.php';
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, 'movieProject', '8889');

$query = "SELECT * FROM playlist";
$result_query = mysqli_query($connection, $query);
$playlists = mysqli_fetch_all($result_query, MYSQLI_ASSOC);

if(isset($_GET['delete'])){
    //$query = "DELETE FROM playlist WHERE playlistId='".$_GET["playlistId"]."'";
    $query = "DELETE FROM playlist WHERE playlistId='".$_GET["delete"]."'";
    $result_query = mysqli_query($connection, $query);
}

///edit 
if(isset($_GET['edit'])){
    $edit = $_GET["edit"];
    $update = true;
    $record = mysqli_query($connection, "SELECT * FROM playlist WHERE playlistId='".$_GET["edit"]."'");
    //var_dump("SELECT * FROM playlist WHERE playlistId='".$_GET["edit"]."'");

    $modifiedPlaylist = mysqli_fetch_array($record);
    $name = $modifiedPlaylist['name'];
}
if(isset($_POST['edit'])){
    $record = mysqli_query($connection, "UPDATE  playlist SET name='".$name."' WHERE playlistId='".$_GET["edit"]."'");
    header("Location : playlist.php");
}


/////// submit form :  create new playlist 

if(isset($_POST['submit'])){
$error = array();
$playlist = $_POST['playlistName'];
if(!$playlist){
        echo $error [] = "You need to fill the form"; 
    }else{
        if($connection){
            $query = "INSERT INTO playlist(name, date, userId) VALUES('$playlist', now(), '$userId')";
            $result_query = mysqli_query($connection, $query);
            $result = mysqli_affected_rows($connection);
            if($result){
                $done ='playlist saved';
            }
        }
        mysqli_close($connection);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    table{
    width: 50%;
    margin: 30px auto;
    border-collapse: collapse;
    text-align: left;
}
tr {
    border-bottom: 1px solid #cbcbcb;
}
th, td{
    border: none;
    height: 30px;
    padding: 2px;
}
tr:hover {
    background: #F5F5F5;
}
    form {
    width: 45%;
    margin: 50px auto;
    text-align: left;
    padding: 20px; 
    border: 1px solid #bbbbbb; 
    border-radius: 5px;
}

.input-group {
    margin: 10px 0px 10px 0px;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}
.btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    background: #5F9EA0;
    border: none;
    border-radius: 5px;
}
.edit_btn {
    text-decoration: none;
    padding: 2px 5px;
    background: #2E8B57;
    color: white;
    border-radius: 3px;
}

.del_btn {
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    border-radius: 3px;
    background: #800000;
}
span {
    margin: 30px auto; 
    padding: 10px; 
    border-radius: 5px; 
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    width: 50%;
    text-align: center;
}
.msg {
    margin: auto; 
    padding: 10px; 
    border-radius: 5px; 
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    width: 50%;
    text-align: center;
}
    </style>
</head>
<h2>Your playlist</h2>
<table style="width :50%;">
    <tr>
        <th> Playlist</th>
        <th> Creation date</th>
        <th colspan="2"> Action </th>
    </tr>
    <?php foreach ($playlists as $playlist) : ?>
    <tr>
        <td>
           <?= $playlist["name"]; ?>
        <td>
        <td>
            <?= $playlist["date"]; ?>
        <td>
			<a href="playlist.php?edit=<?php echo $playlist['playlistId']; ?>" class="edit_btn" >Edit</a>
		</td>
		<td>
			<a href="playlist.php?delete=<?php echo $playlist['playlistId']; ?>" class="del_btn">Delete</a>
		</td>  
    </tr>
    <?php endforeach; ?>
</table>

<form action="" method="POST">
    <div class="input-group">
        <input type="text"  name="playlistName" value="<?= $name; ?>" >
        <?php if ($update == true): ?>
	        <button class="btn" type="submit" name="submit" style="background: #556B2F;" >Edit</button>
        <?php else: ?>
	        <button class="btn" type="submit" name="submit" >Save</button>
        <?php endif ?>
    </div>
</form>
<span ><?= $done; ?></span>
    
</body>
</html>

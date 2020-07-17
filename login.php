<?php
session_start();
$errors = array();
$error = '';


if (isset($_POST['submit'])) {
    $login = false;
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    $sanitizeMail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $filterdMail = filter_var($sanitizeMail, FILTER_VALIDATE_EMAIL);

    if (!$filterdMail)
        $errors[] = "Email is mandatory ! ";


    if (empty($password))
        $errors[] = "password is mandatory !";

    if (count($errors) == 0) {
        include_once 'database.php';
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
        $query = "SELECT * 
        FROM users 
        WHERE email ='" . $filterdMail . "'";
        $result_query = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($result_query);

        if (!empty($user)) {
            //$passwordVerified = password_verify($password, $user['password']);
            if ($password) {
                $login = true;
                $_SESSION['email'] = $filterdMail;
                $_SESSION['username'] = $user['name'];
                $_SESSION['id'] = $user["userId"];
                header('Location:homePage.php');
            } else {
                $errors[] = "Wrong password !";
            }
        } else {
            $errors[] = 'User with this address email doesnt exists.';
        }
    }
    if ($login) {
        echo 'welcome ! ';
    } else {
        echo 'try again';
    }
}

if (count($errors) > 0) {
    $error = implode('<br>', $errors);
}


?>

<form action="" method="POST">
    <label for="email">Email address</label>
    <input type="text" id="email" name="email">
    <label for="password">Password</label>
    <input type="text" id="password" name="password">
    <input type="submit" name="submit" value="Login">
    <p><a href="register.php">Register</a></p>
</form>
<span><?= $error ?></span>
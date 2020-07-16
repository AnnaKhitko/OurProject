<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Best movies</h1>
    <hr>
    <h3>Register to the website</h3>
    <br>

    <?php
    //array for errors
    $errors = array();

    // Check if the form was submitted
    if (isset($_POST['submit'])) {
        $userName = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        // First, I clean the email
        $sanitizeMail = filter_var($email, FILTER_SANITIZE_EMAIL);
        // Verify the format
        $sanitizeMail = filter_var($sanitizeMail, FILTER_VALIDATE_EMAIL);

        //first name not empty
        if (empty($userName))
            $errors['username'] = 'Name is mandatory.';
        //if the email is valid
        if (!$sanitizeMail)
            $errors['mail'] = 'You must enter a valid email address.';
        //check if password not empty 
        if (empty($password))
            $errors['password'] = 'Password is mandatory.';
        //password length
        if ((strlen($password) < 8)) {
            $errors['passwordLength'] = "Wrong password length. It should be more than 8 characters.";
        }
        //password confirmation
        if ($_POST['password'] != $_POST['repeatPass']) {
            $errors['passwordConfirmation'] =  "Your password and confirmation password do not match.";
        }


        // If there is no errors, insert user into DB
        if (count($errors) == 0) {

            //connect to the DB
            require_once 'database.php';
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

            // Make sure email is not already taken
            $selectQuery = "SELECT *
            FROM users
            WHERE email ='$sanitizeMail'";

            $result_query = mysqli_query($conn, $selectQuery);
            $count = mysqli_num_rows($result_query);


            if ($count > 0) {
                // EMAIL ALREADY TAKEN !
                $errors['duplicatemail'] = 'Email already taken !';
            } else {

                // Hash the password
                $securePassword = password_hash($password, PASSWORD_DEFAULT);

                // Prepare & Execute query
                $query = "INSERT INTO users(name,password, email)
                VALUES('$userName','$securePassword','$sanitizeMail')";
                // var_dump($query);

                $result_query = mysqli_query($conn, $query);

                // Check if the user was successfully registered
                if ($result_query) {
                    echo 'Successfully registered. You can now login.<br>';
                    echo '<a href="login.php">Login</a>';
                } else {
                    echo 'Something went wrong... Try again.';
                }
                // Close connection
            }
            mysqli_close($conn);
        }
        //show the errors
        foreach ($errors as $error) {
            echo $error . ' <br>';
        }
        if (count($errors) == 0) {
            echo ' ';
        }
    }
    ?>

    <form action="" method="post">
        <input type="text" name="username" placeholder="Name"><br>
        <input type="text" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="password" name="repeatPass" placeholder="Repeat password"><br>

        <!-- <input type="password" name="passwordCheck" placeholder="Repeat password"><br> -->
        <input type="submit" name="submit" value="Register">
    </form>
</body>

</html>
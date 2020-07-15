<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <?php require_once 'navbar.php'; ?> -->
    <h1>Register to the website</h1>
    <br>

    <?php
    $mail = '';
    //array for errors
    $errors = array();

    // Check if the form was submitted
    if (isset($_POST['submit'])) {
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $email = $_POST['mail'];
        $password = $_POST['password'];
        // First, I clean the email
        $sanitizeMail = filter_var($email, FILTER_SANITIZE_EMAIL);
        // Verify the format
        $sanitizeMail = filter_var($sanitizeMail, FILTER_VALIDATE_EMAIL);

        //if the email is valid
        if (!$sanitizeMail)
            $errors['mail'] = 'You must enter a valid email address.';
        //not empty password
        if (empty($password))
            $errors['password'] = 'Password is mandatory.';
        //first name not empty
        if (empty($firstName))
            $errors['firstname'] = 'First name is mandatory.';

        if (empty($lastName))
            $errors['lastname'] = 'Last name is mandatory.';

        // If there is no errors, insert user into DB
        if (count($errors) == 0) {

            //connect to the DB
            require_once 'database.php';
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, 'spotify', '8889');
            //$conn = mysqli_connect('localhost', 'root', 'root', 'spotify', '8889');

            // Make sure email is not already taken
            $selectQuery = "SELECT *
            FROM USERS
            WHERE mail ='{$sanitizeMail}'";

            $result_query = mysqli_query($conn, $selectQuery);
            $count = mysqli_num_rows($result_query);

            if ($count > 0) {
                // EMAIL ALREADY TAKEN !
                $errors['duplicatemail'] = 'Email already taken !';
            } else {

                // Hash the password
                $securePassword = password_hash($password, PASSWORD_DEFAULT);

                // Prepare & Execute query
                $query = "INSERT INTO USERS(first_name, last_name, mail, password)
                VALUES('$firstName','$lastName', '$sanitizeMail', '$securePassword')";
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
    }
    ?>

    <form action="" method="post">
        <input type="text" name="firstname" placeholder="First name"><br>
        <input type="text" name="lastname" placeholder="Last name"><br>
        <input type="text" name="mail" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="submit" name="submit" value="Register">
    </form>
</body>

</html>
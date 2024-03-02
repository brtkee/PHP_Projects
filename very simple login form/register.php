<?php
    // include db, and make the connection
    include('db_conn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <h2> Register form</h2>
        <label for="username">Username: </label><br>
        <input type="text" name="username" placeholder="Type your username..."><br>
        <label for="password">Password: </label><br>
        <input type="password" name="password" placeholder="Type your password..."><br>
        <button id="submit" name="submit">Submit</button>

        <div class="log-in">
            <p>Already have account? <a href="index.php">Log in!</a></p>
        </div>
    </form>
</body>
</html>

<?php

    if(isset($_POST['submit']))
    {

        // Check if both username or password are empty
        if(empty($_POST['username']) && empty($_POST['password']))
        {
            echo "Username or Password fields are empty";
        }
        else
        {
            // if not filter input, hash the password and send it to the db.
            $username = $_POST['username'];
            $password = $_POST['password'];

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            // send informations to db  

            $sql = "INSERT INTO `users`(`Username`, `Password`) VALUES ('$username', '$hash')";

            try 
            {
                mysqli_query($db_conn, $sql);
                
                echo "User registered succesfully";


            }
            catch(mysqli_sql_exception $e)
            {
                echo "Internal server error! Try Again." . $e ;
            }

        
        }

    }


    // close the db connection
    mysqli_close($db_conn);

?>

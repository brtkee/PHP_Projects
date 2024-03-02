<?php
    // include db, and make the connection
    include('db_conn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    
    <form action="" method="post">
        <h2>Log in form</h2>
        <label for="username">Username: </label><br>
        <input type="text" name="username" placeholder="Type your username..."><br>
        <label for="password">Password: </label><br>
        <input type="password" name="password" placeholder="Type your password..."><br>
        <button id="submit" name="submit">Submit</button>

        <div class="register">
            <p>Don't have account? <a href="register.php">Create one!</a></p>
        </div>
    </form>

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
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT Password FROM users WHERE Username = ?";
            $stmt = mysqli_prepare($db_conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $hashed_password);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            if($hashed_password)
            {
                if(password_verify($password, $hashed_password))
                {
                    echo "Logged in succesully";
                }
                else 
                {
                    echo "Invalid password";
                }
            }
            else 
            {
                echo "Invalid username";
            }
        }

    }

    ?>


</body>
</html>


<?php 

    mysqli_close($db_conn);

?>

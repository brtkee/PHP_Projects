<!-- Include head -->
<?php $title = "Log in"; require_once './templates/head.php'; ?>

<?php require './templates/navbar.php'; ?>

<?php

    // set session expire for the 30 days: (i know it's bad for the security)
    session_set_cookie_params(86400 * 30);

    require './includes/db.php'; 


    // check if user is already logged in
    redirect_if_loged();

    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']))
    {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($email) || empty($password))
        {
            echo "<div class='error-message'> <p>One or more inputs are empty</p></div>";
        } 
        else 
        {
        
            $sql = "SELECT Password, ID, Username FROM users WHERE Email = ?";

            if($stmt = $db_conn->prepare($sql))
            {
                $stmt->bind_param("s", $email);

                $stmt->execute();

                $stmt->bind_result($hashed_password, $user_id, $username);
                $stmt->fetch();

                $stmt->close();

                if($hashed_password) {
                    if(password_verify($password, $hashed_password))
                    {
                     
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['username'] = $username;

                        header("Location: index.php");
                        exit();
                    }
                    else
                    {
                        echo "<div class='error-message'> <p>Incorrect password</p></div>";
                    }
                } else {
                    echo "<div class='error-message'> <p>Email not found</p></div>";
                }
            }
        }
    }

    $db_conn->close();
?>



<!-- include db and navbar -->
<?php require_once './includes/db.php'; ?>

<div class="wrapper">
    <div class="content">
        
        <?php require './templates/login_form.php' ?>

        <?php require './templates/footer.php'; ?>
    </div>
</div>


<!-- Include ionicons-->
<?php require './includes/ion-icons.php'; ?>


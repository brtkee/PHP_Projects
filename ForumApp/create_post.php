<!-- Include head -->
<?php $title = "Create Post"; require_once './templates/head.php'; ?>

<?php require './templates/navbar.php'; ?>

<?php


    require './includes/db.php'; 

    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']))
    {

        if(empty($_SESSION["user_id"]))
        {
            echo "<div class='error-message'> <p>You must be loged in to send posts</p> </div>";
        } else 
        {

            $post_title = filter_input(INPUT_POST, "post-title", FILTER_SANITIZE_SPECIAL_CHARS);
            $post_snippet = filter_input(INPUT_POST, "post-snippet", FILTER_SANITIZE_SPECIAL_CHARS);
            $post_content = filter_input(INPUT_POST, "post-content", FILTER_SANITIZE_SPECIAL_CHARS);

            if(empty($post_title) || empty($post_snippet) || empty($post_content))
            {
                echo "<div class='error-message'> <p>One or more inputs are empty</p></div>";
            } 
            else 
            {
            
                $sql = "INSERT INTO posts (PostName, PostSnippet, PostContent, PostComments, Likes, Created_By, Created_At) VALUES (?, ?, ?, 0, 0, ?, NOW())";

                if($stmt = $db_conn->prepare($sql))
                {
                    $created_by_id = $_SESSION['user_id'];

                    $stmt->bind_param("sssi", $post_title, $post_snippet,$post_content, $created_by_id);

                    if($stmt->execute())
                    {
                        echo "<div class='success-message'> <p>Post added</p> </div>";
                    }
                    else 
                    {
                        echo "<div class='error-message'> <p>Something went wrong. try again</p> </div>";
                    }

                    $stmt->close();
                }
            }

            $db_conn->close();
        }

    }

        
?>

<div class="wrapper">
    <div class="content">
        
        <?php require './templates/post_form.php' ?>

        <?php require './templates/footer.php'; ?>
    </div>
</div>


<!-- Include ionicons-->
<?php require './includes/ion-icons.php'; ?>

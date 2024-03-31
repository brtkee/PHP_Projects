<!-- Include head -->

<?php 

    if(!isset($_GET['title']) && !isset($_GET['postID']))
    {
        header("Location:index.php");
        exit();
    }

?>
<?php $title = urldecode($_GET['title']); require_once './templates/head.php'; ?>


<!-- include db and navbar -->
<?php require_once './includes/db.php'; ?>
<?php require './templates/navbar.php'; ?>


<?php 
        
?>

<div class="wrapper">
    <div class="content">

        <?php require './templates/footer.php'; ?>

        <?php echo get_post_by_id($_GET['postID'], $db_conn); ?>

        <?php require './templates/comment_form.php' ?>

        <section id='comment-section'>
            <h2 class='title'>Comments:</h2>
        </section>
        <hr>

        <?php 

            if(isset($_POST['submit']))
            {
                if(empty($_SESSION["user_id"]))
                {
                    echo "<div class='error-message'> <p>You must be loged in to send posts</p> </div>";
                }
                else 
                {
                    if(empty($_POST['comment']))
                    {
                        echo "<div class='error-message'> <p>Your input is empty!</p></div>";
                    }
                    else
                    {
                        $content = filter_input(INPUT_POST, "comment", FILTER_SANITIZE_SPECIAL_CHARS);
    
                        echo create_comment($_GET['postID'], $content, $db_conn);
                    }
                }
            }


            show_comments_by_id($_GET['postID'], $db_conn)
        ?>

    </div>
</div>



<!-- Include ionicons-->
<?php require './includes/ion-icons.php'; ?>


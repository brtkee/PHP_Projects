<!-- Include head -->
<?php $title = "Home"; require_once './templates/head.php'; ?>


<!-- include db and navbar -->
<?php require_once './includes/db.php'; ?>
<?php require './templates/navbar.php'; ?>

<?php 
        
    $current_page = isset($_GET['page']) ? $_GET['page'] : (isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : 1);

    $sql = "SELECT COUNT(*) FROM posts";

    $total_records = 0;

    if($stmt = $db_conn->prepare($sql))
    {
        $stmt->execute();

        $stmt->bind_result($total_records);
        $stmt->fetch();
    }

    $limit_per_page = 4;
    $total_pages = ceil($total_records / $limit_per_page);

    $pagination_links = generate_pagination_links($current_page, $total_pages);
    
    $stmt->close();

    if(isset($_POST['likes']))
    {
        if (isset($_SESSION['user_id']))
        {
            like_post($_POST['post_id'], $_SESSION['user_id'], $db_conn);
        }
        else 
        {
            echo "<div class='error-message'> <p>You must be loged in to like posts.</p></div>";
        }
    }
?>

<div class="wrapper">
    <div class="content">
        
        <?php echo display_posts($current_page, $limit_per_page, $db_conn) ?>
        
        <?php echo $pagination_links; ?>

        <?php require './templates/footer.php'; ?>

    </div>
</div>



<!-- Include ionicons-->
<?php require './includes/ion-icons.php'; ?>


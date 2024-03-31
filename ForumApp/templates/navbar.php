<?php 
require_once './includes/functions.php';
$current_page_name = basename($_SERVER['PHP_SELF']);
session_start();
?>

<nav class="navbar">
    <h2 class="nav-title">ForumApp</h2>

    <ul class="icons-links">
        <li title="Home" class="<?php echo is_active('index.php', $current_page_name ) ?>">
            <a href="index.php">
                <ion-icon name="home-outline"></ion-icon>
            </a>
        </li>

        <?php 
        if(!isset($_SESSION['user_id']))
        {
        ?>
            <li title="register" class="<?php echo is_active('register.php', $current_page_name ) ?>">
                <a href="register.php">
                    <ion-icon name="person-outline"></ion-icon>
                </a>
            </li>

            <li title="Log in" class="<?php echo is_active('login.php', $current_page_name ) ?>">
                <a href="login.php">
                    <ion-icon name="log-in-outline"></ion-icon>
                </a>
            </li>
        <?php 
        }
        else 
        {
        ?>
            <li title="Log out" class="<?php echo is_active('logout.php', $current_page_name ) ?>">
                <a href="logout.php">
                    <ion-icon name="log-out-outline"></ion-icon>
                </a>
            </li>
        <?php 
        }
        ?>    

    </ul>

    <section class="group">

    <span class="logged-user">
        <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : "User" ?>
    </span>

    <button id="add-post">
        <a href="./create_post.php">
            Add Post 
        </a>
    </button>

    </section>

</nav>

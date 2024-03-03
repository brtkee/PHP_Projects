<?php
    require_once('./includes/db_connection.php');
    require_once('./classes/TaskManager.php');

    $taskManager = new TaskManager($pdo);

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit']))
    {
        if(!empty($_POST['item-input']))
        {
            $description = $_POST['item-input'];

            $taskManager->create_task($description);

            // redirect
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        }
    }
    
    $tasks = $taskManager->view_all_tasks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todoapp</title>
    <link rel="stylesheet" href="includes/style.css">
</head>
<body>
    <div class="content">
        <div class="card">
            <div class="card-title">
                <h2>You have <?php echo count($tasks) ?> Tasks</h2>
            </div>
            <div class="card-body">
                <ul class="tasks">
                    <?php 
                        if(count($tasks) == 0)
                        {
                            echo "No tasks to display...";
                        }    
                    ?>
                    <?php
                    foreach($tasks as $task)
                    { ?>
                        <div class="task">
                            <li><?php echo filter_var($task['description'], FILTER_SANITIZE_SPECIAL_CHARS) ?>
                                <form action="<?php $_SERVER['PHP_SELF'] ?>"  method="post">
                                    <input type="hidden" name="task_id" value="<?php echo $task['ID'] ?>">
                                    <button id="delete" name="delete_submit">X</button>
                                </form>
                            </li>
                        </div>
              <?php } ?>
                </ul>
            </div>
            <div class="card-inputs">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="task-form"   >
                    <input type="text" placeholder="Enter item" name="item-input" id="item-input">
                    <button id="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php 
    // delete a task
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_submit']))
    {
        if(isset($_POST['task_id']))
        {
            $task_id = $_POST['task_id'];

            $taskManager->delete_task($task_id);

            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        }
    }

?>

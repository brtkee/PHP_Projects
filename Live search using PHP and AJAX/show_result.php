<?php 

require_once 'db_config.php';

$data = file_get_contents("php://input");

if($_SERVER['REQUEST_METHOD'] === "POST" && $data !== null)
{

    $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sql = "SELECT User_Name FROM users WHERE User_name LIKE CONCAT('%', ?, '%')";

    $stmt = $db_connection->prepare($sql);

    $stmt->bind_param("s", $data);
    
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {

        show_results($result);

    } else 
    {

        echo "Nothing found.";

    }

    
}

function show_results($data) 
{

    while($row = $data->fetch_assoc())
    {
        echo "<li>
                {$row['User_Name']}
             </li>";
    }

    return;

}

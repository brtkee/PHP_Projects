<?php 

    function is_active($page_name, $current_page_name)
    {

        return $page_name === $current_page_name ? 'active' : '';

    }

    function redirect_if_loged(){

        if(isset($_SESSION['user_id']))
        {

            header("Location: index.php");
            exit();

        }
        
    }

    function generate_pagination_links($current_page, $total_page)
    {

        $links = "<section class='pagination-elements'>";
        
        if ($current_page > 1) {
            $prev_page = $current_page - 1;
            $links .= "<a href=?page=$prev_page>Previous</a>";
        }
    
        $start = max(1, $current_page - 2);
        $end = min($total_page, $start + 4);
    
        for ($i = $start; $i <= $end; $i++) {
            $current_class = ($i == $current_page) ? 'current' : '';
            $links .= "<a class='$current_class' href=?page=$i>$i</a>";
        }
    
        if ($current_page < $total_page) {
            $next_page = $current_page + 1;
            $links .= "<a href=?page=$next_page>Next</a>";
        }
    
        $links .= "</section>";
    
        return $links;

    }
    

    function display_posts($current_page, $limit_per_page, $db_conn)
    {

        $offset = ($current_page - 1) * $limit_per_page;
    
        $sql = "SELECT posts.*, users.Name 
                FROM posts 
                INNER JOIN users ON Created_By = users.ID 
                ORDER BY Likes DESC, Created_At DESC
                LIMIT $limit_per_page OFFSET $offset";
    
        $result = $db_conn->query($sql); 
    
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $encoded_title = urlencode($row['PostName']);
                echo "<div class='question-container'>
                        <a class='hover-class' href='view_post.php?postID={$row['IDPost']}&title={$encoded_title}'>
                            <div class='top-container'>
                                <span class='username'>{$row['Name']}</span> 
                                <span id='created_at'>{$row['Created_At']}</span>
                            </div>
                            <span class='question-title hoverable'>{$row['PostName']}</span>
                            <span class='question-snippet'>{$row['PostSnippet']}</span>
                            <section class='like-comment-container'>
                        </a>

                            <form action = {$_SERVER['PHP_SELF']} method='post'>
                                <input type='hidden' name='post_id' value='{$row['IDPost']}'>

                                <button id='like' name='likes'>
                                    <span class='like'>
                                        <ion-icon name='heart-outline'></ion-icon>
                                        <p class='likes-num'>{$row['Likes']}</p>
                                    </span>   
                                </button>
                            </form>
                
                            <div>
                                <button id='comments' name='comments'>
                                    <span class='comments'>
                                        <ion-icon name='chatbubble-outline'></ion-icon>
                                        <p class='comments-num'>{$row['PostComments']}</p>
                                    </span>
                                </button>
                            </div>
                        </section>
                </div>";
            }
        } else {
            echo "<p id='no-records'>No posts yet.</p>";
        }

    }
    

    function like_post($postId, $userId, $conn)
    {

        $checkQuery = "SELECT * FROM post_likes WHERE User_ID = $userId AND Post_ID = $postId";
        $checkResult = $conn->query($checkQuery);
    
        if ($checkResult->num_rows > 0) {
            $deleteQuery = "DELETE FROM post_likes WHERE User_ID = $userId AND Post_ID = $postId";
            if ($conn->query($deleteQuery)) {
                $updateQuery = "UPDATE posts SET Likes = Likes - 1 WHERE IDPost = $postId";
            }
        } else {
            $insertQuery = "INSERT INTO post_likes (User_ID, Post_ID) VALUES ($userId, $postId)";
            if ($conn->query($insertQuery)) {
                $updateQuery = "UPDATE posts SET Likes = Likes + 1 WHERE IDPost = $postId";
                $conn->query($updateQuery);
            }
        }

    }
    
    function get_post_by_id($PostID, $db_conn)
    {
        
        $sql = "SELECT posts.*, users.Name 
        FROM posts 
        INNER JOIN users ON posts.Created_By = users.ID
        WHERE posts.IDPost = ?";

        $stmt = $db_conn->prepare($sql);

        $stmt->bind_param("i", $PostID);

        $stmt->execute();

        $result = $stmt->get_result();


        if ($result && $result->num_rows > 0) 
        {

            $post = $result->fetch_assoc();

            $stmt->close();

            return "<div class='question-container'>
                        <div class='top-container'>
                            <span class='username'>{$post['Name']}</span> 
                            <span id='created_at'>{$post['Created_At']}</span>
                        </div>
                        <span class='question-title'>{$post['PostName']}</span>
                        <span class='question-content'>{$post['PostContent']}</span>
                        <section class='like-comment-container'>

                        <form action = {$_SERVER['PHP_SELF']} method='post'>
                            <input type='hidden' name='post_id' value='{$post['IDPost']}'>

                            <button id='like' name='likes'>
                                <span class='like'>
                                    <ion-icon name='heart-outline'></ion-icon>
                                    <p class='likes-num'>{$post['Likes']}</p>
                                </span>   
                            </button>
                        </form>

                        <div>
                            <button id='comments' name='comments'>
                                <span class='comments'>
                                    <ion-icon name='chatbubble-outline'></ion-icon>
                                    <p class='comments-num'>{$post['PostComments']}</p>
                                </span>
                            </button>
                        </div>
                    </section>
                    </div>";
        } else {

            $stmt->close();

            header("Location: index.php");
        }
    }

    function create_comment($postID, $postContent, $db_conn)
    {

        $sql = "INSERT INTO comments (CommentedPost, CommentContent, Created_By, Created_At) VALUES (?, ?, ?, NOW())";

        $stmt = $db_conn->prepare($sql);

        $stmt->bind_param("iss" ,$postID, $postContent, $_SESSION['user_id']);

        $stmt->execute();

        $stmt->close();

    }

    function show_comments_by_id($id, $db_conn)
    {
        $sql = "SELECT comments.*, users.Name AS CreatedBy
        FROM comments
        JOIN users ON comments.Created_By = users.ID
        WHERE comments.CommentedPost = ?";
        $stmt = $db_conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='comment'>
                        <div class='title-head'>
                            <span class='created_by'>{$row['CreatedBy']}</span>
                            <span class='created_at'>{$row['Created_At']}</span>
                        </div>
                        <div class='content'>{$row['CommentContent']}</div>
                    </div>";
                }
            } else {

                echo "<p id='no-comments'>No comments yet...</p>";
            }
    }


?>
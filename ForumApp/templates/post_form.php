<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="post-form" accept-charset="UTF-8">
            
    <label for="post-title">Post Title:</label>
    <input type="text" id="post-title" name="post-title" placeholder="Type your Post title">

    <label for="post-snippet">Post Snippet: </label>
    <textarea name="post-snippet" id="post-snippet" placeholder="Type your Post Snippet" minlength="50"></textarea>

    <label for="post-content">Post Content: </label>
    <textarea name="post-content" id="post-content" placeholder="Type your Post Content" minlength="75"></textarea>

    <button id="submit" name="submit">Create Post</button>

</form>
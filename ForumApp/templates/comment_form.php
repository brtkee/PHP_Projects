<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" id="comment-form">
    <label for="comment">Leave a Comment</label>
    <div class="group-inputs">
        <textarea name="comment" id="comment" placeholder="Something..."></textarea>
        <button id="submit" name="submit">Add comment</button>
    </div>
</form>

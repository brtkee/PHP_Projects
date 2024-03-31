<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="register-form" accept-charset="UTF-8">
                
    <label for="name">Name: </label>
    <input type="text" id="name" name="name" placeholder="Type your name">

    <label for="surname">Surname: </label>
    <input type="text" id="surname" name="surname" placeholder="Type your surname">

    <label for="email">Email: </label>
    <input type="text" id="email" name="email" placeholder="Type your email">

    <label for="username">Username: </label>
    <input type="text" id="username" name="username" placeholder="Type your username for the account">

    <label for="password">Password: </label>
    <input type="password" id="password" name="password" placeholder="Type your password">

    <button id="submit" name="submit">Register</button>

</form>
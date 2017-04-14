<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header.php'; ?>
        <?php require 'utils/toolbar.php'; ?>

        <?php
        if (isset($errorMessage))
            echo "<p>$errorMessage</p>";
        ?>
        <form action="register.php" method="POST">
            <label for="username">Username: </label>
            <input type="text"
                   id="username"
                   name="username"
                   value="<?php if (isset($username)) echo $username; ?>"
                   />
            <span class="error">
                <?php if (isset($errors['username'])) echo $errors['username']; ?>
            </span>
            <br/>
            <label for="password">Password: </label>
            <input type="password"
                   id="password"
                   name="password"
                   value=""
                   />
            <span class="error">
                <?php if (isset($errors['password'])) echo $errors['password']; ?>
            </span>
            <label for="cpassword">Password: </label>
            <input type="password"
                   id="cpassword"
                   name="cpassword"
                   value=""
                   />
            <span class="error">
                <?php if (isset($errors['cpassword'])) echo $errors['cpassword']; ?>
            </span>
            <br/>
            <input type="submit" value="Register" />
            <p><a href="login_form.php">Login</a></p>
        </form>
        <?php require 'utils/footer.php'; ?>
    </body>
</html>

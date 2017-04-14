<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';



if (!is_logged_in()) {
    header("Location: login_form.php");
}



?>
<!DOCTYPE html>
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
        echo '<p>Hello, </p>';
        ?>
        john kenny
        <?php require 'utils/footer.php'; ?>
    </body>
</html>

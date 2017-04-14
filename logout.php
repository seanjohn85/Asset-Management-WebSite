<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';

start_session();

if (!is_logged_in()) 
{
    header("Location: login_form.php");
}
else 
{
    unset($_SESSION['user']);
    unset($_SESSION['role']);
    //unset($_SESSION);

    header("Location: login_form.php");
}
?>

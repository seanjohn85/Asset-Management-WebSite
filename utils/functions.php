<?php
require_once 'classes/User.php';

//sets user if logged in 
function is_logged_in() 
{
    start_session();
    return (isset($_SESSION['user']));
}

//starts a session with this user
function start_session() 
{
    $id = session_id();
    if ($id === "") {
        session_start();
    }
}
?>

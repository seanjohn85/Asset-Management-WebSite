<?php
    
    /*this is used to delete a branch from the database*/

    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Branch.php';
    require_once 'classes/DB.php';
    require_once 'classes/BranchTableGateway.php';

    start_session();

    /*redirects to login if the user is not logged in  or if is a hr of customer
      as they have no access to this page    
    */
    if (!is_logged_in() || $_SESSION['role'] === 'hr' || $_SESSION['role'] === 'customer')     
    {
        //loads log on screen
        header("Location: login_form.php");
    }
    
    //gets branch no and sets it
    $branchNo = $_GET['branchNo'];
    //creates a connection
    $connection = Connection::getInstance();
    //uses connection
    $gateway = new BranchTableGateway($connection);
    
    //deletes the branch from the database using the branch no
    $gateway->deleteBranch($branchNo);
    //print_r($gateway);
    
    //loads viewAllBranches after delete
    header('Location: viewAllBranches.php');
    

    
    

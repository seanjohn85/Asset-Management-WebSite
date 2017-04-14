<?php

    /*
     * This is used to edit a branch on the database
     */
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Branch.php';
    require_once 'classes/DB.php';
    require_once 'classes/BranchTableGateway.php';
    require_once 'validateBranch.php';

    start_session();

    /*redirects to login if the user is not logged in  or if is a hr of customer
      as they have no access to this page    
    */
    if (!is_logged_in() || $_SESSION['role'] === 'hr' || $_SESSION['role'] === 'customer')     
    {
        //loads log on screen
        header("Location: login_form.php");
    }
    
    //calls validate function from the validateBranch class
    validate($formdata, $errors);
    
    //if there are no form errors
    if (empty($errors)) 
    {
        //gets new values to be updated 
        $brno = $formdata['branchNo'];
        $brName = $formdata['name'];
        $brAddress = $formdata['address'];
        $bropenDate = $formdata['openDate'];;
        $brPhone = $formdata['phone'];
        $brHours = $formdata['opening'];

       //creates a branch object with the new values
        $branch = new Branch($brno, $brName, $brAddress, $brPhone, $brHours, $bropenDate);
        //print_r($branch);tester
        //creates a connection
        $connection = Connection::getInstance();
        //uses connection in the BranchTableGateway
        $gateway = new BranchTableGateway($connection);

        //print_r($gateway);

        //uses the branch number to delete from the database
        $branchNo = $gateway->updateBranch($branch);

        //print_r($branchNo);
    
        //redirects to view all branches to view changes
        header('Location: viewAllBranches.php');
    }
    else 
    {
        //remains on this page is there are errors on the form 
        require 'editBranchForm.php';
    }


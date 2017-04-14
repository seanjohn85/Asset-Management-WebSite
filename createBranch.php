<?php
    
    /*
     * This file is used to take information from a form and create a branch object
     * when the object is created it is added to the database using the BranchTableGateway.php
     */
    //files used by this page
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
    
    //calls the validate function passing in the formadata and errors array
    //validate prevents the application moving forward untill the validate citria is meet
    validate($formdata, $errors);
            
    if (empty($errors)) 
    {
        //sets object properties used to set a branch
        $brName = $formdata['name'];
        $brAddress = $formdata['address'];
        $bropenDate = $formdata['openDate'];
        $brPhone = $formdata['phone'];
        $brHours = $formdata['opening'];

        //cretaes a branch object
        $branch = new Branch( -1, $brName, $brAddress, $brPhone, $brHours, $bropenDate);
        //creates a connection
        $connection = Connection::getInstance();
        //uses connection in BranchTableGateway
        $gateway = new BranchTableGateway($connection);

        //print_r($branch);
        //sets the branch no to the return from the new branch created
        $branchNo = $gateway->newBranch($branch);

        //returns to the home page
        //print_r($branchNo);

        //returns to the view all branches
        header('Location: viewAllBranches.php');
    }
    else 
    {
        //if any issues remains on this page
        require 'createBranchForm.php';
    }

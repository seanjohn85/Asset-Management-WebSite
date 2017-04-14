<?php
    
    /*
     * This file is used to take information from a form and create a branch object
     * when the object is created it is added to the database using the BranchTableGateway.php
     */
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Customer.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    require_once 'validateCustomer.php';

    start_session();

    if (!is_logged_in()) 
    {
        header("Location: login_form.php");
    }
    //calls the validate function passing in the formadata and errors array
    //validate prevents the application moving forward untill the validate citria is meet
    validate($formdata, $errors);
            
    if (empty($errors)) 
    {
        //sets object properties used to set a customer
        $branchNo   = $formdata['branchNo'];
        $fName      = $formdata['fName'];
        $lName      = $formdata['lName'];
        $address    = $formdata['address'];
        $gender     = $formdata['gender'];
        $mobileNo   = $formdata['mobileNo'];
        $email      = $formdata['email'];

       //cretaes a customer object
 
        $branch= new Customer( -1, $branchNo, $fName, $lName, $address, $gender, $mobileNo, $email );

        $connection = Connection::getInstance();

        $gateway = new CustomerTableGateway($connection);

        //print_r($customer);
        //sets the branch no to the return from the new branch created
        $customerNo = $gateway->newCustomer($branch);

        //returns to the home page
        //print_r($customerNo);

        header('Location: index.php');
    }
    else {
    require 'createCustomerForm.php';
    }

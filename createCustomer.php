<?php

/*
     * This file is used to take information from a form and create a customer object
     * when the object is created it is added to the database using the CustomerTableGateway.php
     *Creates a  user accaont for this customer 
     */
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Customer.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    require_once 'validateCustomer.php';
    require_once 'classes/User.php';
    require_once 'classes/UserTable.php';

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
        
        //sets object properties used to set a customer
        $branchNo   = $formdata['branchNo'];
        $fName      = $formdata['fName'];
        $lName      = $formdata['lName'];
        $address    = $formdata['address'];
        $gender     = $formdata['gender'];
        $mobileNo   = $formdata['mobileNo'];
        $email      = $formdata['email'];
        $username = $formdata['email'];
        $password = $formdata['password'];
   
        //print_r($formdata);
        

       //cretaes a customer object
 
        $cust= new Customer( -1, $branchNo, $fName, $lName, $address, $gender, $mobileNo, $email );

       $connection = Connection::getInstance();

        $gateway = new CustomerTableGateway($connection);

        print_r($cust);
        //print_r($customer);
        //sets the branch no to the return from the new branch created
        $customerNo = $gateway->newCustomer($cust);
        
        

       //creates a new user object
        $user = new User(null, $email, $password, "customer");
        //connects to the usertable 
        $userTable = new UserTable($connection);
        //creates user account
        $id = $userTable->insert($user);


        //returns to the viewAllCustomers
        header('Location: viewAllCustomers.php');
    }
    else 
    {
        //if any errors remains here
        require 'createCustomerForm.php';
    }

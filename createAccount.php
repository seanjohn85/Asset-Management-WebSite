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
    require_once 'classes/UserTable.php';

    $connection = Connection::getInstance();

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
   
        print_r($formdata);
        

       //cretaes a customer object
 
        $cust= new Customer( -1, $branchNo, $fName, $lName, $address, $gender, $mobileNo, $email );

       $connection = Connection::getInstance();

        $gateway = new CustomerTableGateway($connection);

        //print_r($customer);
        //sets the branch no to the return from the new branch created
        $customerNo = $gateway->newCustomer($cust);
        
       //$customerNo = $gateway->newCust($fName);
       
        
        //returns to the home page
       print_r($customerNo);
       
       start_session();
        $user = new User(null, $email, $password, "customer");
          
        $userTable = new UserTable($connection);
        $id = $userTable->insert($user, $customerNo);
        $user->setId($id);
        $_SESSION['user'] = $user;

        header('Location: myAccount.php');

        
    }
    else 
    {
        require 'signUpCreateCustomerForm.php';
    }

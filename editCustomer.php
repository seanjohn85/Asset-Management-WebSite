<?php

    /*
     * This is used to edit a customer on the database
     */
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    require_once 'validateCustomerEdit.php';

    start_session();

    /*redirects to login if the user is not logged in  or if is a hr of customer
      as they have no access to this page    
    */
    if (!is_logged_in() || $_SESSION['role'] === 'hr')     
    {
        //loads log on screen
        header("Location: login_form.php");
    }
    
    //uses the validate function from validateCustomer
    validate($formdata, $errors);
     
    //checks for form errors
    if (empty($errors)) 
    {
        //gets new values to be updated 
        $customerNo = $formdata['customerNo'];
        $branchNo   = $formdata['branchNo'];
        $fName      = $formdata['fName'];
        $lName      = $formdata['lName'];
        $address    = $formdata['address'];
        $gender     = $formdata['gender'];
        $mobileNo   = $formdata['mobileNo'];
        $email      = $formdata['email'];

       //creates a branch object with the new values
        $cust= new Customer($customerNo, $branchNo, $fName, $lName, $address, $gender, $mobileNo, $email);
        //print_r($branch);
        $connection = Connection::getInstance();

        $gateway = new CustomerTableGateway($connection);

        //print_r($gateway);

        //uses the customer number to update from the database
        $customerNo = $gateway->updateCustomer($cust);

        //customer redirect on complete
        if($_SESSION['role'] === 'customer')
        {
            header('Location: myAccount.php');
        }
        //staff redirect on complete
        else 
        {
            header('Location: viewAllCustomers.php');
        }
 
    }
    else 
    {
        //if errors stay on this page
        require 'editCustomerForm.php';
    }


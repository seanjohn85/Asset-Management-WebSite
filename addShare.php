<?php

    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Stock.php';
    require_once 'classes/DB.php';
    require_once 'classes/StockTableGateway.php';


    start_session();

    if (!is_logged_in()) 
    {
        header("Location: login_form.php");
    }

    //print_r($_POST);

    //posted form to add share
    $input_met = INPUT_POST;

    //sanatize data
    //creates a new array
    $formdata = array();


    //fills the array by geting the input by the name reference on the form and sanitizing to ensure a string was entered

    //sets customer number from the form
    $formdata['customerNo'] = filter_input($input_met, "customerNo", FILTER_SANITIZE_NUMBER_INT);
    //sets stock id from the form
    $formdata['stockId'] = filter_input($input_met, "stockId", FILTER_SANITIZE_STRING);

    //connects to db
    $connection = Connection::getInstance();

    //uses connection in StockTableGateway
    $stockgateway = new StockTableGateway($connection);

    //ckecks if the customer hads this stock
    $stock = $stockgateway->getStockByCustomerNoStockId($formdata['customerNo'], $formdata['stockId']);
    //if the customer has this stock
    if(($stock->rowCount() !== 0))
    {
       // print_r($stock);
        //gets the row grom the pivot tabel
        $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
        //gets the rows qty and adds 1 to it and store it in qty
        $qty = 1 + $stockRow['qty'];
         //$stockId = $stockgateway->updateCustStock($formdata['qty'], $formdata['customerNo'],$formdata['stockId']);
        //updates the stock qty
        $stockId = $stockgateway->updateCustStock($qty, $formdata['customerNo'],$formdata['stockId']);
    }
    //if the user is a customer
    if ( $_SESSION['role'] === 'customer')     
    {
        //loads log my account
        header('Location: myAccount.php#stotable');
    }
    //if the user is staff
    else 
    {
        //loads all cusotmers
        header('Location: viewAllCustomers.php');
    }
    
    //print_r($formdata);


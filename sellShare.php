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

    //used to get form info
    $input_met = INPUT_POST;

    //sanatize data
    //creates a new array
    $formdata = array();


    //fills the array by geting the input by the name reference on the form and sanitizing to ensure a string was entered

    //sets customer no from the form
    $formdata['customerNo'] = filter_input($input_met, "customerNo", FILTER_SANITIZE_NUMBER_INT);
    //sets branch no from the form
    $formdata['stockId'] = filter_input($input_met, "stockId", FILTER_SANITIZE_STRING);

    //creates connection  
    $connection = Connection::getInstance();

    //uses connection in StockTableGateway
    $stockgateway = new StockTableGateway($connection);
    //sql to get the cust stock match from the pivot tabel
    $stock = $stockgateway->getStockByCustomerNoStockId($formdata['customerNo'], $formdata['stockId']);
    //if the customer has this stock
    if(($stock->rowCount() !== 0))
    {
       // print_r($stock);
        //sets row from pivot table
        $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
        //qry is set to db qty -1
        $qty = $stockRow['qty'] - 1;
         //$stockId = $stockgateway->updateCustStock($formdata['qty'], $formdata['customerNo'],$formdata['stockId']);
        //if qty is greater that 0 modify qty
        if($qty >0)
        {
            //updates with decreased qty  
            $stockId = $stockgateway->updateCustStock($qty, $formdata['customerNo'],$formdata['stockId']);
        }
        //if qty is 0 or  less this customer no longer has shares of this stock so delete from db
        else 
        {
            //deltles this entry from pivot table
            $stockId = $stockgateway->delCustStock($formdata['customerNo'],$formdata['stockId']);
        }
    }
    //is the user is a customer
    if ( $_SESSION['role'] === 'customer')     
    {
        //loads my account
        header('Location: myAccount.php#stotable');
    }
    //if the user is staff
    else 
    {
        //loads viewAllCustomers
        header('Location: viewAllCustomers.php');
    }
        
   


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


    $input_met = INPUT_POST;

    //sanatize data
    //creates a new array
    $formdata = array();


    //fills the array by geting the input by the name reference on the form and sanitizing to ensure a string was entered

    $formdata['customerNo'] = filter_input($input_met, "customerNo", FILTER_SANITIZE_NUMBER_INT);
    $formdata['count'] = filter_input($input_met, "count", FILTER_SANITIZE_NUMBER_INT);
 
    //print_r($formdata);
    $count = $formdata['count']; 
    
    while($count >= 1)
    {
       
        //print_r($formdata);
        //print_r($count);
        $int_as_string = (string) $count;
        $qty = "qty".$int_as_string;
        $id = "id".$int_as_string;    
        $formdata['qty'] = filter_input($input_met, $qty, FILTER_SANITIZE_NUMBER_INT);
        $formdata['stockId'] = filter_input($input_met, $id, FILTER_SANITIZE_STRING);
        //print_r($formdata);
        //print_r($qty);
        //print_r($stockId);
        $count = $count- 1;
        
        $connection = Connection::getInstance();


        $stockgateway = new StockTableGateway($connection);
    
        $stock = $stockgateway->getStockByCustomerNoStockId($formdata['customerNo'], $formdata['stockId']);
        if(($stock->rowCount() !== 0))
        {
           // print_r($stock);
            $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
            $qty = $formdata['qty'] + $stockRow['qty'];
             //$stockId = $stockgateway->updateCustStock($formdata['qty'], $formdata['customerNo'],$formdata['stockId']);
            $stockId = $stockgateway->updateCustStock($qty, $formdata['customerNo'],$formdata['stockId']);
        }  
        else 
        {
             $stockId = $stockgateway->addStockToCustomer($formdata['qty'], $formdata['customerNo'],$formdata['stockId']);
        }
        
    }
    
    if (isset($_SESSION['cart'])) // used for manipulating page when entering in wizard 
    {
        unset ($_SESSION['cart']);
    }
    
    header('Location: myAccount.php#stotable');


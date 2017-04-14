<?php
    
    /*
     * This file is used to take information from a form and create a branch object
     * when the object is created it is added to the database using the BranchTableGateway.php
     */
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Stock.php';
    require_once 'classes/DB.php';
    require_once 'classes/StockTableGateway.php';
    //php validation file
    require_once 'validateStock.php';

    start_session();

    //ensures user is logged in else redirect to home page
    if (!is_logged_in()) 
    {
        header("Location: login_form.php");
    }
    //calls the validate function passing in the formadata and errors array
    //validate prevents the application moving forward untill the validate citria is meet
    validate($formdata, $errors);
            
    if (empty($errors)) 
    {
        //sets object properties used to set a stock
        //formdata array created by the validate stock file
        $stockName      = $formdata['stockName'];
        $stockCode      = $formdata['stockCode'];
        $qty            = $formdata['qty'];
        $openPrice      = $formdata['openPrice'];
        $currentPrice   = $formdata['currentPrice'];
        $image          = $_FILES["filename"]['name'];

       //cretaes a new stock object
        $stock = new Stock( -1, $stockName, $stockCode, $qty, $openPrice, $currentPrice, $image );

        //creates a connection
        $connection = Connection::getInstance();

        //uses the connection in the StockTableGateway class
        $gateway = new StockTableGateway($connection);

        //print_r($stock); 
        //sets the stockId to the return from the new stock created using the stock object above
        $stockId = $gateway->newStock($stock);

        //returns to the home page
        //print_r($stockId);

        //redirects to viewAllStock if stock created
        header('Location: viewAllStock.php');
    }
    else 
    {
        //remains on createStockForm is errors are contained in the form
        require 'createStockForm.php';
    }

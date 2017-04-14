<?php

    /*
     * This is used to edit stock on the database
     * required files
     */
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Stock.php';
    require_once 'classes/DB.php';
    require_once 'classes/StockTableGateway.php';
    require_once 'validateStock.php';

    start_session();

    //kicks the user out of this page if they are not logged in
    if (!is_logged_in()) 
    {
        header("Location: login_form.php");
    }
    //customer and hr have no access to this page so they are redirected home here
    if ($_SESSION['role'] === 'customer' || $_SESSION['role'] === 'hr') 
    {
        header("Location: homepage.php");
    }

    //calls the validate method from validateStock to fill the formdata and errors arrays
    validate($formdata, $errors);
    //if there are no errors after validation       
    if (empty($errors)) 
    {
        //gets new values to be updated 
        $stockId        = $formdata['stockId'];
        $stockName      = $formdata['stockName'];
        $stockCode      = $formdata['stockCode'];
        $qty            = $formdata['qty'];
        $openPrice      = $formdata['openPrice'];
        $currentPrice   = $formdata['currentPrice'];
        $image          = $_FILES["filename"]['name'];

       //creates a stock object with the new values
        $stock = new Stock($stockId, $stockName, $stockCode, $qty, $openPrice, $currentPrice, $image);
        //print_r($stock);
        //creates a db connection
        $connection = Connection::getInstance();

        //uses the connection on the StockTableGateway class
        $gateway = new StockTableGateway($connection);

        //print_r($gateway); testing only

        //uses the stockId to update the database with the stock object just created
        $stockId = $gateway->updateStock($stock);

        //if stock was updated redirect user to viewAllStock where the update can be seen
        header('Location: viewAllStock.php');
    }
    else 
    {
        //any issues remain on this page
        require 'editStockForm.php';
    }


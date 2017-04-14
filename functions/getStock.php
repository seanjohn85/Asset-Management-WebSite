<?php


    // if getting form for first time retrieve details from database
    // into the formdata array
    if ($_SERVER['REQUEST_METHOD'] === "GET") 
    {
        //checks for a stock id if there is no branch no the application is killed
        if (!isset($_GET['stockId'])) 
        {
            die("Invalid request here");
        }
        //sets the stockId using the get request
        $stockId = $_GET['stockId'];
        
        /**
         * gets a stock row from the database uses the stock id to get that stock
         * and stores it in the array row
         */
        
        //creates a connection
        $connection = Connection::getInstance();
        //uses connection in StockTableGateway
        $gateway = new StockTableGateway($connection);
        //gets this stock using the stock id and the method from the stockTableGateway class
        $stock = $gateway->getStockByNo($stockId);

        //stores the in info of this stock in a varaible
        $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
        if (!$stockRow) 
        {
            //if the stock doses exist kills the application
            die("Invalid Stock");
        }
  
        //fills the form data array with the values of this stock
        $formdata = array();
        $formdata['stockId']        = $stockRow['stockId'];
        $formdata['stockName']      = $stockRow['stockName'];
        $formdata['stockCode']      = $stockRow['stockCode'];
        $formdata['qty']            = $stockRow['qty'];
        $formdata['openPrice']      = $stockRow['openPrice'];
        $formdata['currentPrice']   = $stockRow['currentPrice'];
        $formdata['logo']           = $stockRow['image'];
    }
    //creates errors array
    if (!isset($errors)) 
    {
        $errors = array();
    }
    


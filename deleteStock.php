<?php
    
    /*this is used to delete a stock from the database*/

    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require_once 'classes/StockTableGateway.php';

    start_session();

    /*redirects to login if the user is not logged in  or if is a hr of customer
      as they have no access to this page    
    */
    if (!is_logged_in() || $_SESSION['role'] === 'hr' || $_SESSION['role'] === 'customer')     
    {
        //loads log on screen
        header("Location: login_form.php");
    }
    
    //gets stock id to delete
    $stockId = $_GET['stockId'];
    
    //creates a connection
    $connection = Connection::getInstance();
    
    //uses the connection in the StockTableGateway
    $gateway = new StockTableGateway($connection);
    
    //deltes the stock from the database using the stock id
    $gateway->deleteStock($stockId);
    //print_r($gateway);
    
    //loads view all stoc so user can see changes
    header('Location: viewAllStock.php');
    

    
    

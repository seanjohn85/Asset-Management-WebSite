<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require 'classes/DB.php';
require 'classes/StockTableGateway.php';
require_once 'classes/CustomerTableGateway.php';
  $input_met = INPUT_POST;

    //sanatize data
    //creates a new array
    $formdata = array();


    //fills the array by geting the input by the name reference on the form and sanitizing to ensure a string was entered

    $id = filter_input($input_met, "id", FILTER_SANITIZE_STRING);
    $qty = filter_input($input_met, "qty", FILTER_SANITIZE_STRING);


          
    $pages=array("products", "cart"); 
 

    if(isset($_SESSION['cart'][$id]))
    { 
 echo'<pre>'.$id."</pre>";
  
        $_SESSION['cart'][$id]['quantity'] =
                $_SESSION['cart'][$id]['quantity']+ $qty; 

    }
    else
    { 

        $connection = Connection::getInstance();
       $gateway2 = new StockTableGateway($connection);

       $stock2 = $gateway2->getStockByNo($id);


        if(($stock2->rowCount() !== 0))
        { 
           $rows = $stock2->fetch(PDO::FETCH_ASSOC); 
    
           $_SESSION['cart'][$rows['stockId']]=array( 
                    "quantity" => $qty, 
                    "price" => $rows['currentPrice'] 
                ); 

            //echo '<pre>'.  print_r($_SESSION['cart']).'</pre>';
        }
        else
        { 
            $message="This product id it's invalid!"; 

        } 
    
       
}        

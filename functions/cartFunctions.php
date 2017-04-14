<?php

//used to add stock to cart

//if its a get request with the action equal to add
if(isset($_GET['action']) && $_GET['action']=="add")
{ 
    //sets id to the id from the get request. The id will repersent a stock id
    $id=intval($_GET['id']); 

    //checks if this stock is already in the cart
    if(isset($_SESSION['cart'][$id]))
    { 
        //increases the qty of this stock in the cart
        $_SESSION['cart'][$id]['quantity']++; 
    }
    //if not already in cart its added to cart here
    else
    { 
        //gets a connection in the StockTableGateway
       $gateway2 = new StockTableGateway($connection);
       
       //finds the stock to match the id
       $stock2 = $gateway2->getStockByNo($id);

        //if the stock is found
        if(($stock2->rowCount() !== 0))
        { 
           //gets the stock data and places it in rows 
           $rows = $stock2->fetch(PDO::FETCH_ASSOC); 
    
           //adds a qty of this stock to the cart and sets the price
           $_SESSION['cart'][$rows['stockId']]=array( 
                    "quantity" => 1, 
                    "price" => $rows['currentPrice'] 
                ); 

            //echo '<pre>'.  print_r($_SESSION['cart']).'</pre>';
        }
        else
        { 
            //error message
            $message="This stock id it's invalid!"; 

        } 
    } 
} //close if (add to cart)


//used to subtract stock from cart

//if its a get request with the action equal to remove
if(isset($_GET['action']) && $_GET['action']=="remove")
{ 
    //sets id to the id from the get request. The id will repersent a stock id
    $id=intval($_GET['id']); 

    //checks if this stock is already in the cart
    if(isset($_SESSION['cart'][$id]))
    { 
        //decreases qty by 1
        $_SESSION['cart'][$id]['quantity']--; 
        //checks qty
        $qty = $_SESSION['cart'][$id]['quantity'];
        //if qty is 0 or less
        if($qty <= 0)
        {
            //remove from cart
           unset($_SESSION['cart'][$id]); 
        }
    }
    else
    { 
        //error message
        $message="This stock id it's invalid!"; 
    } 
} //close if (remove from cart)

//deletes stock from cart

//if its a get request with the action equal to delete
if(isset($_GET['action']) && $_GET['action']=="delete")
{ 
    //sets id to the id from the get request. The id will repersent a stock id
    $id=intval($_GET['id']); 

    //if this stock is in the cart
    if(isset($_SESSION['cart'][$id]))
    { 
        //deletes from cart
        unset($_SESSION['cart'][$id]); 
    }
    else
    { 
        //if stock id is invalid
        $message="This stock id it's invalid!"; 

    } 
} //close if (delete from cart)
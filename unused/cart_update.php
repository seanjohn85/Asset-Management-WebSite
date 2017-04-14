<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    require_once 'classes/StockTableGateway.php';

start_session();

if (!is_logged_in()) {
    header("Location: login_form.php");
}
//add product to session or create new one
if(isset($_POST["type"]) && $_POST["type"]=='add' && $_POST["product_qty"]>0)
{
	foreach($_POST as $key => $value){ //add all post vars to new_product array
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
	//remove unecessary vars
	unset($new_product['type']);
	unset($new_product['return_url']); 
        
        
        $connection = Connection::getInstance();
$gateway = new StockTableGateway($connection);

$stock = $gateway->getStockByNo($new_product[$key]);


$stockRow = $stock->fetch(PDO::FETCH_ASSOC);
	
    $product_name = $stockRow['stockName']; 
    $price = $stockRow['currentPrice']; 

	
	while($stockRow){
		
		//fetch product name, price from db and add to new_product array
        $new_product["product_name"] = $product_name; 
        $new_product["product_price"] = $price;
        
        if(isset($_SESSION["cart_products"])){  //if session var already exist
            if(isset($_SESSION["cart_products"][$new_product['product_code']])) //check item exist in products array
            {
                unset($_SESSION["cart_products"][$new_product['product_code']]); //unset old array item
            }           
        }
        $_SESSION["cart_products"][$new_product['product_code']] = $new_product; //update or create product session with new item  
    } 
}


//update or remove items 
if(isset($_POST["product_qty"]) || isset($_POST["remove_code"]))
{
	//update item quantity in product session
	if(isset($_POST["product_qty"]) && is_array($_POST["product_qty"])){
		foreach($_POST["product_qty"] as $key => $value){
			if(is_numeric($value)){
				$_SESSION["cart_products"][$key]["product_qty"] = $value;
			}
		}
	}
	//remove an item from product session
	if(isset($_POST["remove_code"]) && is_array($_POST["remove_code"])){
		foreach($_POST["remove_code"] as $key){
			unset($_SESSION["cart_products"][$key]);
		}	
	}
}

//back to return url
$return_url = (isset($_POST["return_url"]))?urldecode($_POST["return_url"]):''; //return url
header('Location:'.$return_url);

?>
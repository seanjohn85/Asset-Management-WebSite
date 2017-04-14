<?php
//files used by this page
require_once 'utils/functions.php';
require_once 'classes/User.php';
require 'classes/DB.php';
require 'classes/StockTableGateway.php';
require_once 'classes/CustomerTableGateway.php';


start_session();


if (!is_logged_in()) {
    header("Location: login_form.php");
}
//creates connection
$user = $_SESSION['user'];
 
if(isset($_GET['page']))
{ 
          
    $pages=array("products", "cart"); 

    if(in_array($_GET['page'], $pages)) 
    { 
        $_page=$_GET['page']; 
    }
    else
    { 
        $_page="products"; 
        
    } 
}
else
{ 

    $_page="products"; 
          
} 



$connection = Connection::getInstance();
$gateway = new StockTableGateway($connection);

$custGateway = new CustomerTableGateway($connection);

$customer = $custGateway->getCustByEmail($user->getUsername());


$custRow = $customer->fetch(PDO::FETCH_ASSOC);

//gets all branches from the branch table using the getBranches() method
$stock = $gateway->getStock();

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
                    $gateway2 = new StockTableGateway($connection);

                    $stock2 = $gateway2->getStockByNo($_GET["code"]);
			$productByCode = $gateway2->getStockByNo($id);
			$itemArray = array($productByCode[0]["stockId"]=>array('name'=>$productByCode[0]["stockName"], 'stockId'=>$productByCode[0]["stockId"], 'quantity'=>$_POST["stockName"], 'price'=>$productByCode[0]["currentPrice"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["stockId"],$_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["stockId"] == $k)
								$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}

if(isset($_GET['action']) && $_GET['action']=="add")
{ 
  
    $id=intval($_GET['id']); 

    if(isset($_SESSION['cart'][$id]))
    { 

        $_SESSION['cart'][$id]['quantity']++; 

    }
    else
    { 

       $gateway2 = new StockTableGateway($connection);

       $stock2 = $gateway2->getStockByNo($id);


        if(($stock2->rowCount() !== 0))
        { 
           $rows = $stock2->fetch(PDO::FETCH_ASSOC); 
    
           $_SESSION['cart'][$rows['stockId']]=array( 
                    "quantity" => 1, 
                    "price" => $rows['currentPrice'] 
                ); 

            //echo '<pre>'.  print_r($_SESSION['cart']).'</pre>';
        }
        else
        { 
            $message="This product id it's invalid!"; 

        } 
    } 
}        

?>



<!DOCTYPE html>
<!--
    To change this license header, choose License Headers in Project Properties.
    To change this template file, choose Tools | Templates
    and open the template in the editor.
    -->
<html>
    <head>
        <!--Meta Tags-->
        <?php require 'utils/meta.php'; ?>
        <title><?php echo $user->getUsername() . "  Cart"; ?></title>
        <?php require 'utils/styles.php'; ?>
    </head>
    <body>
        <?php  require 'utils/toolbar.php'; ?>

        <div class="container">
            <div class ="row ">
                <!--heading-->
                <div class="col-lg-12 top">
                    <h1>
                        Buy Stock
                        <subset>Add shares to your cart</subset>
                    </h1>
                </div>
            </div>
            <!-- button used to link to the add new branch form-->
            <div class ="row">
                <section class="col-lg-12 ">
                    <h2>All Stocks</h2>
                    <!--<div class="product-thumb"><img src="images/{$obj->product_img_name}"></div>-->
                    <div id="our-stocks" class="products owl-carousel">
                       
                            <?php
                            $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

                                $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
                                
                                //loops through all the rows of this table on the database
                                
                                
                                while ($stockRow) {
                                    
                                
                                echo'<div class="item">';
                                echo'<img src="image/logos/'.$stockRow['image'].'" class="backup_picture img-responsive">';

                                echo '<h3><b>Stock Name: </b><span>'.$stockRow['stockName'].'</span></h3>';
                                echo '<p><b>Stock Code: </b>'.$stockRow['stockCode'].'</p>';
    
                                echo '<p><b>Current Price: </b> &dollar;'.$stockRow['currentPrice'].'</p>';
                                
                                echo '<form method="post" action="buyStock_2.php?action=add&code='.$stockRow['stockId'].'>'
                                . '<input type="hidden" name="product_code" value="'.$stockRow['stockId'].'" />
    <div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>
   
    </form></div>';
                                
                                
                                    //ends the statement to stop an infinate loop on this row
                                
                                    $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
                                }//close while
                                ?>
                        
                </section>
                <section class="col-lg-3">
                    <h2>Cart</h2> 
                    <form action="addStock2Cust.php" method="post">
                        <?php 
                            if(isset($_SESSION['cart_item'])){ 

                                $count = 0;

                                foreach($_SESSION['cart_item'] as $id => $value) { 

                                $gateway3 = new StockTableGateway($connection);

                                $stock3 = $gateway->getStockByNo($id);


                                $row = $stock3->fetch(PDO::FETCH_ASSOC);
                                echo $row['stockName'];
                                //echo $_SESSION['cart'][$rows['stockId']]['quantity'];

                             $count ++;

                            ?> 
                        <input type="hidden" name="count" value="<?php echo $count?>">
                        <input type="hidden" name="customerNo" value="<?php echo $custRow['customerNo']?>">
                        <p><?php echo $row['stockName'] ?> x <?php echo $_SESSION['cart_item'][$row['stockId']]['quantity'] ?></p> 
                        <input type="hidden" name="id<?php echo $count?>" value="<?php echo $row['stockId']; ?>" 
                        <p><input type="number" name="qty<?php echo $count?>" value="<?php echo $_SESSION['cart'][$row['stockId']]['quantity'] ?>"></p> 
                        <?php 
                            }
                            ?> 
                        
                        <hr /> 
                        <input type="submit" id="submit" name ="Purchase" value ="submit" class="myButton">
                    </form>
                    <?php 
                        }else{ 

                            echo "<p>Your Cart is empty. Please add some stocks.</p>"; 

                        } 

                        ?>
                </section>
            </div><!--close grid_12-->
            
        </div>
        <!--close container-->
        <?php require 'utils/footer.php'; ?>
        <?php require 'utils/scripts.php'; ?>

<script>
$(window).bind('load', function() {
$('img').each(function() {
    if((typeof this.naturalWidth != "undefined" &&
        this.naturalWidth == 0 ) 
        || this.readyState == 'uninitialized' ) {
        $(this).attr('src', 'image/logos/stock.png');
    }
}); })
</script>

    </body>
</html>
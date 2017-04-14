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
 
/*if(isset($_GET['page']))
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
          
} */



$connection = Connection::getInstance();
$gateway = new StockTableGateway($connection);

$custGateway = new CustomerTableGateway($connection);

$customer = $custGateway->getCustByEmail($user->getUsername());


$custRow = $customer->fetch(PDO::FETCH_ASSOC);

//gets all branches from the branch table using the getBranches() method
$stock = $gateway->getStock();

require 'functions/cartFunctions.php';
 

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
        <div class="row topnavbg">
            <?php  require 'utils/toolbar.php'; ?>
        </div>

        <div class="container">
         
       
            
            <div class ="row">
                <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top">
         
                    
                    <?php 
                    
                        if(isset($_SESSION['cart']))
                            { 
                                if (!empty($_SESSION['cart']))
                                {
                                $newitem = end($_SESSION['cart']);
                                $id;
                                $total = 0;
                                foreach($_SESSION['cart'] as $id => $value) 
                                {
                                    $total += (($_SESSION['cart'][$id]['quantity']) *($_SESSION['cart'][$id]['price']));
                                }
                                $gateway3 = new StockTableGateway($connection);

                                $stock4 = $gateway->getStockByNo($id);


                                $row = $stock4->fetch(PDO::FETCH_ASSOC);
                                //print_r($newitem);
                                //print_r($id);
                                //print_r($row);
                                echo '<div class="preview-cart">';
                                echo '<div class="tum-logo col-md-4 col-sm-2 hidden-xs"><div class="col-md-3 hidden-sm hidden-xs"> <i class="fa fa-check fa-3x"></i></div>'
                                . '<img src="image/logos/'.$row['image'].'">'
                                        . '<span class="hidden-sm hidden-xs">Added to Cart</span></div>';
                                echo '<div class="new-cart col-md-6 col-sm-7 col-xs-6"><h2>Cart Total: &dollar;'.$total.'</h2>'
                                        . '<p ><strong>Stock Name: </strong>'.$row['stockName'].'<span class="hidden-sm hidden-xs"> <strong>Share Price: </strong>&dollar;'.$row['currentPrice'].'</span></p>'
                                        . '<p ><ins class="hidden-sm hidden-xs"><strong>Qty Ordered: </strong>'.$newitem['quantity'].'</ins><span > <strong>Total Price: </strong>&dollar;'.($newitem['quantity']*$row['currentPrice']).'</span></div>';
                                echo '<div class="col-md-2 col-sm-3  col-xs-6 center-all-content preview-btns"> <a class="buy_btn" href="buyStock.php?page=products&action=add&id='.$id.'"><i class="fa fa-cart-plus"></i></a>'
                                        . '<a class="sell_btn" href="buyStock.php?page=products&action=remove&id='.$id.'"><i class="fa fa-cart-arrow-down"></i></a>'
                                        . '<p><a href="viewcart.php" class="myButton smaller">View Cart</a></p></div>';
                                echo '</div>';
                                
                                }

                            }
 
                                
                    ?>
            
                    
                    
                </section>
            </div><!--close grid_12-->
            
            
            
            
            
            <!-- button used to link to the add new branch form-->
            <div class ="row">
                <section class="col-lg-12  add-2-cart">
                    <hr>
                    <h1>All Stock</h1>
                    <!--<div class="product-thumb"><img src="images/{$obj->product_img_name}"></div>-->
                    <div id="our-stocks" class="owl-carousel">
                       
                            <?php
                                $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
                                
                                //loops through all the rows of this table on the database
                                
                                
                                while ($stockRow) {
                                    
                                
                                echo'<div class="item">';
                                echo'<img src="image/logos/'.$stockRow['image'].'" class="backup_picture img-responsive">';

                                echo '<h3><b>Stock Name: </b><span>'.$stockRow['stockName'].'</span></h3>';
                                echo '<p><b>Stock Code: </b>'.$stockRow['stockCode'].'</p>';
    
                                echo '<p><b>Current Price: </b> &dollar;'.$stockRow['currentPrice'].'</p>';
                                
                                echo '<a class="button button-block" href="buyStock.php?page=products&action=add&id='.$stockRow['stockId'].'">Add to cart</a></td> 
                                </div>';
                                
                                
                                    //ends the statement to stop an infinate loop on this row
                                
                                    $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
                                }//close while
                                ?>
                    </div>
                    <!--instructions for owl-carousel-->
                    <!--image on the right of text-->
                    <div class="col-md-3 col-sm-3 col-xs-3 right-img">
                        <img class="img-responsive img-circle" src="image/grab.png" alt="grap">
                    </div>
                    <!--centered text-->
                    <div class="col-md-6 col-sm-6 col-xs-6 center-all-content">
                        <h2>Grab or Scroll through our Stocks</h2>
                    </div>
                    <!--image on the left of text-->
                    <div class="col-md-3   col-sm-3 col-xs-3 left-img">
                        <img class="img-responsive img-circle" src="image/touch.png" alt="touch">
                    </div>
                    <div class="clearfix"></div>
                  
                    <div class="col-md-12 center-all-content">
                        
                    </div>
                    <hr>
                </section>

                <section class="col-lg-3">
                    <h3>Cart</h3> 
                    
                    <?php 
                            if(isset($_SESSION['cart']) )
                                { 
                                foreach($_SESSION['cart'] as $id => $value) { 
                                $gateway3 = new StockTableGateway($connection);

                                $stock4 = $gateway->getStockByNo($id);


                                $row = $stock4->fetch(PDO::FETCH_ASSOC);
                                echo $row['stockName'];
                                echo $row['currentPrice']. 'x'.$_SESSION['cart'][$row['stockId']]['quantity'] ;
                                echo '<a class="button button-block" href="buyStock.php?page=products&action=add&id='.$row['stockId'].'">Add to cart</a></td> 
                                </div>';
                                    echo '<a class="button button-block" href="buyStock.php?page=products&action=remove&id='.$row['stockId'].'">remove</a></td> 
                                </div>';
                                }
                            }
                            ?>
                    <form action="addStock2Cust.php" method="post" >
                        <?php 
                            if(isset($_SESSION['cart'])){ 

                                $count = 0;

                                foreach($_SESSION['cart'] as $id => $value) { 

                                $gateway3 = new StockTableGateway($connection);

                                $stock3 = $gateway->getStockByNo($id);


                                $row = $stock3->fetch(PDO::FETCH_ASSOC);
                                 //echo $row['stockName'];
                                //echo $_SESSION['cart'][$rows['stockId']]['quantity'];

                             $count ++;

                            ?> 
                        <input type="hidden" name="count" value="<?php echo $count?>">
                        <input type="hidden" name="customerNo" value="<?php echo $custRow['customerNo']?>">
                       
                        <input type="hidden" name="id<?php echo $count?>" value="<?php echo $row['stockId']; ?>" 
                        <p><input type="hidden" name="qty<?php echo $count?>" value="<?php echo $_SESSION['cart'][$row['stockId']]['quantity'] ?>"></p> 
              
                        <?php 
                            }
                            ?> 
                        <hr /> 
                        <input type="submit" id="submit" name ="Purchase" value ="Buy All" class="myButton">
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
        
      


    </body>
</html>
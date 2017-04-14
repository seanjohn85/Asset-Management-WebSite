<?php
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require 'classes/DB.php';
    require 'classes/StockTableGateway.php';
    require_once 'classes/CustomerTableGateway.php';
    
    
    start_session();
    
    //insures user is logged in
    if (!is_logged_in()) 
    {
        header("Location: login_form.php");
    }
    //sets user to session user
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
    
    
    //gets connection
    $connection = Connection::getInstance();
    //uses connection in StockTableGateway
    $gateway = new StockTableGateway($connection);
    //uses connection in CustomerTableGateway
    $custGateway = new CustomerTableGateway($connection);
    //sql to find this user by their email
    $customer = $custGateway->getCustByEmail($user->getUsername());
    
    //sets the custome info from db to $custRow
    $custRow = $customer->fetch(PDO::FETCH_ASSOC);
    
    //gets all stock from the stock table using the getStock() method
    $stock = $gateway->getStock();
    
    //adds items to session cart
    require 'functions/cartFunctions.php';
     
    
?>

<!DOCTYPE html>
<!--
    John Kenny
    N00145905
-->
<html>
    <head>
        <!--Meta Tags-->
        <?php require 'utils/meta.php'; ?>
        <!--page title-->
        <title><?php echo $user->getUsername() . "  Buy Stock"; ?></title>
        <!--css stylesheets-->
        <?php require 'utils/styles.php'; ?>
    </head>
    <body>
        <!--sets bg for top nav-->
        <div class="row topnavbg">
            <!--imports navbar-->
            <?php  require 'utils/toolbar.php'; ?>
        </div>
        <!--main content-->
        <div class="container">
            <!--this is only displayed when the user has added stock to their cart-->
            <div class ="row">
                <!--uses full 12 columns of grid-->
                <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top">
                    <!--php to check cart-->
                    <?php
                        //checks if cart is set
                        if(isset($_SESSION['cart']))
                        { 
                            //ENSURES CART IS NOT EMPTY AS STOCK MAY HAVE BEEN REMOVED
                            if (!empty($_SESSION['cart']))
                            {
                                //lets this to the las stock added to the cart
                                $newitem = end($_SESSION['cart']);
                                //set to last stock id by the for each loop below
                                $id;
                                //calculated by the for each loop
                                $total = 0;
                                //loops through each stock changing id to the current stock of the loop
                                foreach($_SESSION['cart'] as $id => $value) 
                                {
                                    //sets total to qty*price of each stock. adds previuos value every time loop is ran
                                    $total += (($_SESSION['cart'][$id]['quantity']) *($_SESSION['cart'][$id]['price']));
                                }
                                //passes connection to StockTableGateway
                                $gateway3 = new StockTableGateway($connection);
                                //sql to get the stock with the last id in the cart
                                $stock4 = $gateway->getStockByNo($id);
                                //sets its values to row
                                $row = $stock4->fetch(PDO::FETCH_ASSOC);
                                //testers
                                //print_r($newitem);
                                //print_r($id);
                                //print_r($row);
                                //
                                //this is the displayed preview cart of last item added
                                //opening div 
                                echo '<div class="preview-cart">';
                                //left div containsthe logo and added not shown on smaller devices
                                echo '<div class="tum-logo col-md-4 col-sm-2 hidden-xs"><div class="col-md-3 hidden-sm hidden-xs"> <i class="fa fa-check fa-3x"></i></div>'
                                . '<img src="image/logos/'.$row['image'].'">'
                                        . '<span class="hidden-sm hidden-xs">Added to Cart</span></div>';
                                //middle row showing info on the last added stock
                                echo '<div class="new-cart col-md-6 col-sm-7 col-xs-6"><h2>Cart Total: &dollar;'.$total.'</h2>'
                                        . '<p ><strong>Stock Name: </strong>'.$row['stockName'].'<span class="hidden-sm hidden-xs"> <strong>Share Price: </strong>&dollar;'.$row['currentPrice'].'</span></p>'
                                        . '<p ><ins class="hidden-sm hidden-xs"><strong>Qty Ordered: </strong>'.$newitem['quantity'].'</ins><span > <strong>Total Price: </strong>&dollar;'.($newitem['quantity']*$row['currentPrice']).'</span></div>';
                                //final row shown the buttons to modify the cart
                                echo '<div class="col-md-2 col-sm-3  col-xs-6 center-all-content preview-btns"> <a class="buy_btn" href="buyStock.php?page=products&action=add&id='.$id.'"><i class="fa fa-cart-plus"></i></a>'
                                        . '<a class="sell_btn" href="buyStock.php?page=products&action=remove&id='.$id.'"><i class="fa fa-cart-arrow-down"></i></a>'
                                        . '<p><a href="viewcart.php" class="myButton smaller">View Cart</a></p></div>';
                                echo '</div>';

                            }

                        }//close if(isset($_SESSION['cart']))
                        
                                
                    ?>
                </section><!--close this cart preview section-->
            </div><!--close row-->

            <!-- new row displaying all stock that can be added to the cart-->
            <div class ="row">
                <!--uses full grid-->
                <section class="col-lg-12  add-2-cart">
                    <!--breaks with top line-->
                    <hr>
                    <!--section heading-->
                    <h1>All Stock</h1>
                    <!--the stock will be displayed in a scrollable owl-carousel-->
                    <div id="our-stocks" class="owl-carousel">
                        <!--php to get all stock from db-->
                        <?php
                            //gets first row from stock table-->
                            $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
                            
                            //loops through all the rows of this table on the database    
                            while ($stockRow) 
                            {
                                //sets div contain this stock
                                echo'<div class="item">';
                                //adds the stock logo to the div
                                echo'<img src="image/logos/'.$stockRow['image'].'" class="backup_picture img-responsive">';
                                //inserts the stock name
                                echo '<h3><b>Stock Name: </b><span>'.$stockRow['stockName'].'</span></h3>';
                                //inserts the stock code
                                echo '<p><b>Stock Code: </b>'.$stockRow['stockCode'].'</p>';
                                //inserts the stock price
                                echo '<p><b>Current Price: </b> &dollar;'.$stockRow['currentPrice'].'</p>';
                                //inserts the button to add to cart & closes this div
                                echo '<a class="button button-block" href="buyStock.php?page=products&action=add&id='.$stockRow['stockId'].'">Add to cart</a></td> 
                                </div>';
                            
                                //ends the statement to stop an infinate loop on this row
                                //gets next stock row
                                $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
                            }//close while
                        ?>
                        
                    </div><!--clsoes owl-carousel-->
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
                    <!-- bottom line and footer margin added-->
                    <hr class="pushfoot">
                </section><!--close all stocks section-->
                
            </div><!--close row-->
        </div><!--close container-->
        
        <!--imports footer-->
        <?php require 'utils/footer.php'; ?>
        <!--imports js-->
        <?php require 'utils/scripts.php'; ?>
    </body>
</html>
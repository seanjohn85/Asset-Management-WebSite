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
        <title><?php echo $user->getUsername() . "  Cart"; ?></title>
        <!--stylesheets-->
        <?php require 'utils/styles.php'; ?>
    </head>
    <body>
        <!-- nav bar with a top bg colour to match other pages-->
        <div class="row topnavbg">
            <?php  require 'utils/toolbar.php'; ?>
        </div>
        <!--main content-->
        <div class="container">
            
            <div class="row">
                <!--top section displaying all items in cart-->
                <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1>My Cart</h1> 
                    
                    <?php 
                        //checks if cart is set
                        if(isset($_SESSION['cart']))
                            { 
                                $total = 0;
                                //loops through all itmes in the cart
                                foreach($_SESSION['cart'] as $id => $value) 
                                { 
                                    //sets total to qty*price of each stock. adds previuos value every time loop is ran
                                    $total += (($_SESSION['cart'][$id]['quantity']) *($_SESSION['cart'][$id]['price']));
                                    //connects to StockTableGateway
                                    $gateway3 = new StockTableGateway($connection);
                                    //gets current cart stock from db by the id
                                    $stock4 = $gateway->getStockByNo($id);
                                    //gets this row from the db
                                    $row = $stock4->fetch(PDO::FETCH_ASSOC);
                                    //opening div 
                                    echo '<div class="cart-item col-lg-12">'
                                    //plays the stock image left
                                    . '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><img src="image/logos/'.$row['image'].'"></div>';
                                    //then the stock name
                                    echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 cart_text"><strong>'.$row['stockName'].'</strong>';
                                    //next the qty by the stock price
                                    echo '<span>'.$_SESSION['cart'][$row['stockId']]['quantity'] .' X '. '&dollar;'.$row['currentPrice']. '</span></div>';
                                    //the total cost for this stock
                                    echo '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 cart_text"><strong>Total: &dollar;'.($row['currentPrice'] *$_SESSION['cart'][$row['stockId']]['quantity']) .'</strong></div>';
                                   //buttons to add remove shares of this stock
                                    echo '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pull-right cart_btn"><a class="buy_btn" href="viewCart.php?page=products&action=add&id='.$row['stockId'].'"><i class="fa fa-cart-plus"></i></a> 
                                    ';
                                    echo '<a class="sell_btn" href="viewCart.php?page=products&action=remove&id='.$row['stockId'].'"><i class="fa fa-cart-arrow-down"></i></a>
                                    </div></div>';
                            }
                        }
                    ?>
                </section>
            </div><!--close row-->
            <div class="row">
                <!--shown bottom left-->
                <section class="bootom col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!--displays the total of the cart value-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 cart-totaler center-all-content">
                        <?php echo "<h1> Cart Total: $".$total."</h1>";?>
                    </div>
                    <!--shown bottom right-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 cart-totalerbtn">
                        <!--invisable form holds all the cart data-->
                        <form action="addStock2Cust.php" method="post" >
                            <?php 
                                //if items are in the cart
                                if(isset($_SESSION['cart']))
                                {
                                    //used when adding to db
                                    $count = 0;

                                    //loops through each cart item
                                    foreach($_SESSION['cart'] as $id => $value) 
                                    { 

                                        //connects to the StockTableGateway
                                        $gateway3 = new StockTableGateway($connection);

                                        //fints the stock in cart on the db
                                        $stock3 = $gateway->getStockByNo($id);

                                        //gets next db row
                                        $row = $stock3->fetch(PDO::FETCH_ASSOC);
                                         //echo $row['stockName'];
                                        //echo $_SESSION['cart'][$rows['stockId']]['quantity'];

                                        $count ++;

                                ?> 
                            <!--used when looping through arrays to add to the db-->
                            <input type="hidden" name="count" value="<?php echo $count?>">
                            <!--customer number used when adding to the db-->
                            <input type="hidden" name="customerNo" value="<?php echo $custRow['customerNo']?>">
                            <!--stock id used when adding to the db-->
                            <input type="hidden" name="id<?php echo $count?>" value="<?php echo $row['stockId']; ?>" 
                            <!--qty shares to add to the db-->
                            <p><input type="hidden" name="qty<?php echo $count?>" value="<?php echo $_SESSION['cart'][$row['stockId']]['quantity'] ?>"></p> 

                            <?php 
                                    }
                                ?> 
                            <!--buy all stocks in cart button-->
                            <input type="submit" id="submit" name ="Purchase" value ="Buy All" class="button button-block">
                        </form>
                        <?php 
                            }
                            else
                            { 
                                //if cart is empty
                                echo "<p>Your Cart is empty. Please add some stocks.</p>"; 
                            } 

                            ?>

                    </div><!--close cart-totalerbtn-->
                </section><!--close bootom-->
            </div><!--row-->
            
        </div><!--close container-->
        <!--import footer-->
        <?php require 'utils/footer.php'; ?>
        <!--import js-->
        <?php require 'utils/scripts.php'; ?>
        

    </body>
</html>
<?php
//files used by this page
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/DB.php';
require_once 'classes/StockTableGateway.php';
require_once 'classes/CustomerTableGateway.php';


start_session();

if (!is_logged_in()) {
    header("Location: login_form.php");
}

//creates connection
$user = $_SESSION['user'];

$connection = Connection::getInstance();
$gateway = new StockTableGateway($connection);

$custGateway = new CustomerTableGateway($connection);

$customer = $custGateway->getCustByEmail($user->getUsername());


$custRow = $customer->fetch(PDO::FETCH_ASSOC);

//gets all branches from the branch table using the getBranches() method
$stock = $gateway->getStock();
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

        <!--Meta Tags-->

<?php require 'utils/meta.php'; ?>


        <title><?php echo $user->getUsername() . " Account"; ?></title>
<?php require 'utils/styles.php'; ?>
<?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header.php'; ?>
<?php require 'utils/toolbar.php'; ?>

        <div class="container">

            <div class ="row">


                <!--heading-->
                <div class="col-lg-12 top">
                    <h1> Buy Stock
                        <subset>Add shares to your cart</subset></h1>
                </div>

                <!-- button used to link to the add new branch form-->



                <div class="col-lg-9">



<!--<div class="product-thumb"><img src="images/{$obj->product_img_name}"></div>-->

                    <div class="products">
                        <ul class="products">

                            <?php
                            $stockRow = $stock->fetch(PDO::FETCH_ASSOC);

                            //loops through all the rows of this table on the database

                            while ($stockRow) {
                                //creates a html table row to match this row on the database

                                echo '
                            <li class="product">
                                <form method="post" action="cart_update.php">
                                <div class="product-content"><h3>';
                                echo $stockRow['stockName'] . '</h3>';


                                echo'<div class="product-desc">'. $stockRow['stockCode'] . '</div>';
                                echo'<div class="product-info">
                                Price &euro;' . $stockRow['currentPrice'] . ' 

                                <fieldset>


                                <label>
                                    <span>Quantity</span>
                                    <input type="text" size="4" maxlength="4" name="product_qty" value="1" />
                                </label>

                                </fieldset>';
                                echo '<input type="hidden" name="product_code" value="'.$stockRow['stockId'].'" />
                                <input type="hidden" name="type" value="add" />
                                <input type="hidden" name="return_url" value="{$current_url}" />
                                <div align="center"><button type="submit" class="add_to_cart">Add</button></div>
                                </div></div>
                                </form>
                                </li>';

                                //ends the statement to stop an infinate loop on this row

                                $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
                            }//close while
                            ?>

                        </ul>
                    </div>

                    <div class="shopping-cart">
                        <h2>Your Shopping Cart</h2>
                        <?php
                        if (isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"]) > 0) {
                            echo '<div class="cart-view-table-front" id="view-cart">';
                            echo '<h3>Your Shopping Cart</h3>';
                            echo '<form method="post" action="cart_update.php">';
                            echo '<table width="100%"  cellpadding="6" cellspacing="0">';
                            echo '<tbody>';

                            $total = 0;
                            $b     = 0;
                            foreach ($_SESSION["cart_products"] as $cart_itm) {
                                $product_name  = $cart_itm["product_name"];
                                $product_qty   = $cart_itm["product_qty"];
                                $product_price = $cart_itm["product_price"];
                                $product_code  = $cart_itm["product_code"];
                              
                                $bg_color      = ($b++ % 2 == 1) ? 'odd' : 'even'; //zebra stripe
                                echo '<tr class="' . $bg_color . '">';
                                echo '<td>Qty <input type="text" size="2" maxlength="2" name="product_qty[' . $product_code . ']" value="' . $product_qty . '" /></td>';
                                echo '<td>' . $product_name . '</td>';
                                echo '<td><input type="checkbox" name="remove_code[]" value="' . $product_code . '" /> Remove</td>';
                                echo '</tr>';
                                $subtotal = ($product_price * $product_qty);
                                $total    = ($total + $subtotal);
                            }
                            echo '<td colspan="4">';
                            echo '<button type="submit">Update</button><a href="view_cart.php" class="button">Checkout</a>';
                            echo '</td>';
                            echo '</tbody>';
                            echo '</table>';

                            $current_url = urlencode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                            echo '<input type="hidden" name="return_url" value="' . $current_url . '" />';
                            echo '</form>';
                            echo '</div>';

                        }
                        ?>
                    </div>




                </div><!--close grid_12-->
            </div>
         </div><!--close container-->
        <?php require 'utils/footer.php'; ?>


    </body>
</html>

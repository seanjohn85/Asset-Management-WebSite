

<?php
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/CustomerTableGateway.php';
    require_once 'classes/DB.php';
    require_once 'classes/StockTableGateway.php';
    
    
    /*redirects to login if the user is not logged in  or if is a hr of customer
      as they have no access to this page    
    */
    if (!is_logged_in() || $_SESSION['role'] === 'hr' || $_SESSION['role'] === 'customer')     
    {
        //loads log on screen
        header("Location: login_form.php");
    }
    //kills if invalid stock id
    if (!isset($_GET['stockId'])) 
    {
        die("Invalid request");
    }
    //gets stockid
    $stockId = $_GET['stockId'];
    //opens connection to db
    $connection = Connection::getInstance();
    //pass connection to StockTableGateway
    $gateway = new StockTableGateway($connection);
    //sql to get this stock
    $stock = $gateway->getStockByNo($stockId);
    //passes connection to CustomerTableGateway
    $customergateway = new CustomerTableGateway($connection);
    //gets customer sql request method 
    $customer = $customergateway->getCustomerByStockId($stockId);
    //gets stock row from the db of this stock
    $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
    //kills if not found
    if (!$stockRow) 
    {
        die("Invalid Stock");
    }
    
    ?>
<!DOCTYPE html>
<!--
    This is the html page to view all stocks for the staff menu
    Copyright John Kenny N00145905 2016
    -->
<html>
    <head>
        <!--Meta Tags-->
        <?php require 'utils/meta.php'; ?>
        <!--browser page title-->
        <title>Asset Management Stock <?php echo $stockRow['stockName'] ?></title>
        <!--CSS stylesheets  used my css is the last style to give it first preference-->
        <?php  require 'utils/styles.php'; ?>
    </head>
    <!--close head-->
    <!--sets the body background colour using this logOn class-->
    <body class='logOn'>
        <!--inserts my navbar-->
        <?php  require 'utils/toolbar.php'; ?>
        <!--places all my content in the bootstrap container max width 1170px-->
        <div class="container">
            <!--heading-->
            <!-- opens by first row of content using my push class to create a margin 
                from the nav at the  top of this page-->
            <div class="row push">
                <!-- full screen on all devices aligned lift -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12">
                    <!--heading under the nav-->
                    <h1> <?php echo $stockRow['stockName'] ?> </h1>
                </div>
                <!--close heading text-->
            </div>
            <!--close row push top row under nav-->
            <!-- second row of content under the heading  with the table and 
                the search this is the main body of content for this page-->
            <div class="row row2">
                <!--main content  -->
                <!-- this div holds the stock logo hidden on small screens-->
                <div class="stock-image col-lg-5 col-md-5 hidden-sm hidden-xs">
                    <!-- gets stock logo using db filename-->
                    <img class="img-responsive stologo" src=" image/logos/<?php echo  $stockRow['image'] ;?>">
                </div><!--close stock-image-->
                
                <!--this holds a table to display this stocks information-->
                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-10 stock-tab">
                    
                    <table class="details">
                        <tr>
                            <!-- displays stock name gets it from the database-->
                            <td>Stock Name:</td>
                            <td><?php  echo  $stockRow['stockName']; ?></td>
                        </tr>
                        <tr>
                            <!-- displays stock code gets it from the database-->
                            <td>Stock Code:</td>
                            <td><?php  echo  $stockRow['stockCode']; ?></td>
                        </tr>
                        <tr>
                            <!-- displays qty gets it from the database-->
                            <td>Qty Available:</td>
                            <td><?php  echo $stockRow['qty']; ?></td>
                        </tr>
                        <tr>
                            <!-- displays open price gets it from the database-->
                            <td>Open Price:</td>
                            <td>&#36;<?php  echo   $stockRow['openPrice'];  ?></td>
                        </tr>
                        <tr>
                            <!-- displays current price gets it from the database-->
                            <td>Open Price:</td>
                            <td>&#36;<?php  echo   $stockRow['currentPrice'];  ?></td>
                        </tr>
                    </table>
                </div><!--close stock-tab-->
                
                <!--buttons to edit stock-->
                <div class=" col-lg-3 col-md-3 col-sm-4 col-xs-2 stock_but">
                    <!--see css for positioning-->
                    <div>
                        <a href="createStockForm.php" class="myButton hidden-xs">Add Stock</a>
                    </div>
                    <?php 
                        echo '<div><a class=" myButton small" href="editStockForm.php?stockId='.$stockRow['stockId'].'">Edit</a> </div>';
                        echo '<div><a class="delete myButton small hidden-xs" href="deleteStock.php?stockId='.$stockRow['stockId'].'">Delete</a> </div>';
                        ?>
                </div><!--close stock_but-->
            </div><!-- close row 2-->

            <!--this is a table displaying customers who own this stock-->
            <div class="grid_12">
                <?php
                    //if customers have shares of this stock
                    if(($customer->rowCount() !== 0))
                    {
                      
                        //this table displays all the customers of this branch
                        require 'tables/customerStockTable.php'; 
                    }
                    //if no customers have shares of this stock
                    else 
                    {
                        echo"<h2>No clients in Mason assets have shares of ".$stockRow['stockName']. " stock</h2>";
                    }
                    ?>
            </div><!--close grid-12-->
            
        </div><!--close container-->
        <!--imports my javascript files-->
        <?php  require 'utils/scripts.php'; ?>
        
        <!--alerts confirmation on delete-->
        <script type="text/javascript" src="scripts/deleteStock.js"></script>
        <!--imports my footer-->
        <?php  require 'utils/footer.php'; ?>  
    </body>
    <!--close body-->
</html>
<!--close this html doc-->


<?php
   //files required by this page database connections, gatewaytables and functions
   require_once 'utils/functions.php';
   require_once 'classes/User.php';
   require_once 'classes/DB.php';
   require_once 'classes/CustomerTableGateway.php';
   require_once 'classes/BranchTableGateway.php';
   require_once 'classes/StockTableGateway.php';
   
   //starts session
   start_session();
   
   //if the user is not logged in redirect to login_form
   if (!is_logged_in()) 
   {
       header("Location: login_form.php");
   }
   
   //sets the session user in this session
   $user = $_SESSION['user'];
   //used by the toolbar to display the correct menu
   $_SESSION['role'] = $user->getRole();
   
   //if the user is not a customer redirect to home
   if($_SESSION['role'] !="customer")
   {
       header("Location: login_form.php");
   }
   
   //connects to the databae
   $connection = Connection::getInstance();
   //opens connection to the CustomerTableGateway
   $gateway = new CustomerTableGateway($connection);
   //sets the customer to get getCustByEmail using the username (email andusername match)
   $customer = $gateway->getCustByEmail($user->getUsername());
   //gets this customer row from the database
   $custRow = $customer->fetch(PDO::FETCH_ASSOC);
   //opens connection to the StockTableGateway
   $stockgateway = new StockTableGateway($connection);
   //opens connection to the BranchTableGateway
   $branchgateway = new BranchTableGateway($connection);
   //sql to get this customers stock
   $stock = $stockgateway->getStockByCustomerNo($custRow['customerNo']);
   //sql method  to get the value of this customers portfolio
   $portvalue = $stockgateway->getPortfolioValueByCustomerNo($custRow['customerNo']);
   //sql to get this customers stock values
   $top =$stockgateway->getstoByCustomerNo($custRow['customerNo']);
   
   //kills application if the customer account is not found
   if (!$custRow) 
   {
        die("Invalid Customer");
   }
   //sql method to get the customers branch
   $branch = $branchgateway->getBranchByNo($custRow['branchNo']);
   //fetches the branch row info from the database in the brrow varaible
   $brRow = $branch->fetch(PDO::FETCH_ASSOC);
   //gets the first row of stock belonging to this customer
   $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
   
?>

<!DOCTYPE html>
<html>
    <head>
        <!--Meta Tags-->
        <?php  require 'utils/meta.php'; ?>
        <!--sets the title to user name of the user logged in-->
        <title><?php  echo $user->getUsername() . " Account"; ?></title>
        <!--imports css styles see styles.php-->
        <?php  require 'utils/styles.php'; ?>
    </head>
    <!--class used to set bg colour-->
    <body class="logOn">
        <!-- this is the nav bar loaded-->
        <?php  require 'utils/toolbar.php'; ?>
        <!--main content under nav-->
        <div class="container">
            <!-- this is the top tow with the page heading containing the customer name
                the push class is used to create the spacing -->
            <div class ="row push r1">
                <h1><?php  echo $custRow['fName']. " " .$custRow['lName']."'s Account"; ?></h1>
            </div>
            <!--close row push-->
            <!-- this is the second row and contains dashboard info boxes relevent to the 
                clients account-->
            <div class ="row summary r2">
                <!--creates first content box this is the blue box in the top left-->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="portfolio_value">
                        <h1> Portfolio Value</h1>
                        <h2>
                            <!--this php code uses the  the getPortfolioValueByCustomerNo method above
                                and inserts the total value of this customers portfolio -->
                            <?php
                                /*checks if the customer has any stock
                                 * as rowCount will be 0 if they have no stock
                                 */
                                if(($portvalue->rowCount() !== 0))                
                                {
                                    //sets the sql return result to $porfolioTotal
                                    $porfolioTotal = $portvalue->fetch(PDO::FETCH_ASSOC);
                                    //ensures formaated to 2 decimal places
                                    $totalUnformated = $porfolioTotal['round(sum(sto.currentPrice*pivot.qty), 2)'];
                                    $total= floatval($totalUnformated);
                                    $iprice = (round($total, 2));
                                    //uses the price set above
                                    echo "$".$iprice;
                                } 
                                else                 
                                {
                                    //if they have no stock price is o is printed
                                    echo"$0:00";
                                }
                                
                                ?>
                        </h2>
                    </div>
                    <!--close portfolio_value-->
                </div>
                <!--close responsive div-->
                <!--creates second content box this is the yelloe box in the top -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="myStock">
                        <h1>Top Stock</h1>
                        <!--this php code calculates the  top performing stock belonging to this customer-->
                        <?php
                            //these will be set below   
                            $stockName;
                            $shares;
                            $price;
                            $value = 0;
                            /*checks if the customer has any stock
                            * as rowCount will be 0 if they have no stock
                            */
                            if(($top->rowCount() == 0))                
                            {
                               //if this customer has no stock
                               echo "<h2>You currently have no stock</h2>";
                            } 
                            else                 
                            {
                               //gets the current row (first topRow using the top var above)
                              $topRow = $top->fetch(PDO::FETCH_ASSOC);
                              //loops through all the rows of this table on the database
                               while($topRow)                            
                               {
                                   //if the customers value of this stock is the highest set it to his stock
                                   if(($topRow['qty'] * $topRow['currentPrice']) > $value)
                                   {
                                       $stockName = $topRow['stockName'];
                                        $shares = $topRow['qty'];
                                        $price = $topRow['currentPrice'];
                                       $value = ($topRow['qty'] * $topRow['currentPrice']);
                            
                                   }
                            
                                   //ends the statement to stop an infinate loop on this row
                                   //gets the next row(using the stock var above
                                   $topRow = $top->fetch(PDO::FETCH_ASSOC);
                               }//close while
                               
                               //creates a table displaying the information regarding this customers top preforming stock
                               echo "<table> ";
                               echo  "<tr><td>Name: </td> <td>". $stockName. "</td> </tr>".
                                    "<tr class='hidden-lg'><td>Shares:</td> <td>" . $shares."</td> </tr>".
                                    "<tr class='hidden-lg'><td>Share Price:</td> <td>$". $price. "</td> </tr>".
                                    "<tr ><td>My Total:</td> <td>$" .$value. "</td> </tr>".
                                    "</table> ";
                               
                            }//close else
                            
                            ?>
                    </div>
                    <!--close my stock-->
                </div>
                <!--close responsive-->
                <!--this is the third block unlike the other block it contains 2 dashboard items
                    to buy or sell stock these will also act as links-->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <!--links to buyStock-->
                    <a href="buyStock.php">
                        <div class="col-lg-12 col-md-12 col-sm-12 buy">
                            <!--prints buy and the add to cart symbol-->
                            <h1>Buy Stock <i class="fa fa-cart-plus"></i></h1>
                        </div>
                        <!--close buy-->
                    </a>
                    <!--links to stock table-->
                    <a href="#stotable">
                        <div class="col-lg-12 col-md-12 col-sm-12 sell">
                            <!--prints sell and the sell cart symbol-->
                            <h1>Sell Stock <i class="fa fa-cart-arrow-down"></i></h1>
                        </div>
                        <!--close sell-->
                    </a>
                </div>
                <!--close responsive-->
                <!--purple box far right (bottom mobile) used to display this clients preference
                    market and its time and if its open-->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="time">
                        <h1>
                            Preferred Market 
                            <subset>NYSC</subset>
                        </h1>
                        <!--gets the ny time-->
                        <?php
                            //sets date var to the time in yew ork now
                            $date = new DateTime("now", new DateTimeZone('America/New_York') );
                            //displays time
                            echo '<p>'.$date->format('d-m-Y H:i').'</p>';
                            //reformates for the compare
                            $time = explode(':', $date->format('H:i'));
                            //keeps market open between 9 and 5
                            if($time[0] <= "18" ||$time[0] >= "09")
                            {
                               echo"<h3>Market Open</h3>";
                            } 
                            else 
                            {
                               echo"<h3>Market Closed</h3>";
                            }
                            
                            ?>
                    </div>
                    <!--close time-->
                </div>
                <!--close responsive-->
            </div>
            <!--close row r2-->
            <div class='clear'></div>
            <!-- This row is used to show the customers details, branch details, newsfeed and  edit button-->
            <div class="row  topper r3">
                <!--top left-->
                <div class="col-lg-4 col-md-5 col-sm-6 mar_top">
                    <!--this div will display this customers personal details from the database-->
                    <div class="det">
                        <h2>My Details</h2>
                        <!-- checks if the customer has no mobile no on the sytsem and
                            sets mobile to please update-->
                        <?php
                            $mobile = $custRow['mobileNo'];
                            
                            if($mobile  === Null || $mobile  === "")                {
                                print_r($mobile);
                                $mobile = "Not Available";
                            }
                            
                            ?>
                        <!--table is created to hold the customers information-->
                        <table class="details">
                            <tr>
                                <!-- displays name gets it from the database-->
                                <td>Name:</td>
                                <td><?php  echo $custRow['fName']. " " .$custRow['lName']; ?></td>
                            </tr>
                            <tr>
                                <!-- displays gender gets it from the database-->
                                <td>Gender:</td>
                                <td><?php  echo  $custRow['gender']; ?></td>
                            </tr>
                            <tr>
                                <!-- displays mobile srt above-->
                                <td>Mobile Number:</td>
                                <td><?php  echo  $mobile; ?></td>
                            </tr>
                            <tr>
                                <!-- displays address gets it from the database-->
                                <td>Address:</td>
                                <td><?php  echo  $custRow['address']; ?></td>
                            </tr>
                            <tr>
                                <!-- displays email gets it from the database-->
                                <td>Email:</td>
                                <td><?php  echo  $custRow['email']  ?></td>
                            </tr>
                        </table>
                    </div>
                    <!--close det-->
                </div>
                <!--close top left-->
                <!--top center-->
                <div class="col-lg-4 col-md-5  col-sm-6  mar_top">
                    <!--displays this customers branch information gets branch from the database-->
                    <div class="det">
                        <h2>My Branch</h2>
                        <table class="details">
                            <tr>
                                <!-- displays branch name gets it from the database-->
                                <td>Branch Name:</td>
                                <td><?php  echo  $brRow['branchName']; ?></td>
                            </tr>
                            <tr >
                                <!-- displays phone number gets it from the database-->
                                <td>Phone Number:</td>
                                <td><?php  echo  $brRow['phoneNo']; ?></td>
                            </tr>
                            <tr >
                                <!-- displays address gets it from the database-->
                                <td>Address:</td>
                                <td><?php  echo $brRow['address']; ?></td>
                            </tr>
                            <tr>
                                <!-- displays open hours gets it from the database-->
                                <td>Open Hours:</td>
                                <td><?php  echo  $brRow['openHours']  ?></td>
                            </tr>
                            <tr>
                                <!-- not linked with the manager table at this time-->
                                <td>Manger:</td>
                                <td>Not available </td>
                            </tr>
                        </table>
                    </div>
                    <!--close det-->
                </div>
                <!--close 
                    <!--NOT SHOW ON MID - SMALL DISPLAYS right-->
                <div class="col-lg-4 hidden-md  mar_top hidden-sm hidden-xs">
                    <!--sample newsfeed-->
                    <div class="det">
                        <h2><i class="fa fa-rss-square"></i>
                            Newsfeed
                        </h2>
                        <!--diplays news to customer-->
                        <p><i class="fa fa-envelope"></i>
                            Apple to announce quarterly results
                        </p>
                        <p><i class="fa fa-envelope"></i>
                            Did you know our experienced staff are currently waiting to assist you.
                            <?php echo $custRow['customerNo'];?>
                        </p>
                        <p class="nomar"><i class="fa fa-envelope"></i>
                            Thank you for your custom
                        </p>
                    </div>
                    <!-- close det-->
                </div>
                <!--close col-lg-4 hidden-md  mar_top hidden-sm hidden-xs --->
                <!-- button to edit account profile-->
                <div class="col-lg-4  col-lg-offset-0 col-md-2  col-md-offset-0 col-sm-6 col-sm-offset-3  mar_top  col-xs-12">
                    <?php echo '<a class="button button-block center-all-content" href="editCustomerForm.php?customerNo=' . $custRow['customerNo'] . '">Edit My Account<i class="fa fa-user"></i></a>';?>
                </div>
                <!--close button to edit account profile-->
            </div>
            <!--close r3-->
            <!-- new row displays on stock performance graph-->
            <div class="row mar_top r4">
                <!--right of screen-->
                <div class="col-lg-9 col-md-9 mar_top col-sm-12 col-xs-12">
                    <div class="imageHolder">
                        <!-- title bar top of this div-->
                        <div class="title">
                            <h2>My Stocks Performance</h2>
                        </div>
                        <!--close title-->
                        <!--image of a stock graph-->
                        <img src="image/stock.png" class="img-responsive">
                    </div>
                    <!--close imageHolder-->
                </div>
                <!--close col-lg-9 col-md-9 mar_top col-sm-12 col-xs-12-->
                <!--right box --labels for the graph-->
                <div class="col-lg-3 col-md-3 mar_top col-sm-12 col-xs-12">
                    <div class="imageHolder">
                        <div class="title">
                            <h2>Stocks</h2>
                        </div>
                        <!--close title-->
                        <?php
                            //gets the stocks 
                            $top =$stockgateway->getstoByCustomerNo($custRow['customerNo']);
                            
                            /*checks if the customer has any stock
                             * as rowCount will be 0 if they have no stock
                               */
                            //if the customer has less than 3 stocks this will be used
                            $message  = "Sample graph with some top performing stocks";
                                         $stocks =array(array("Apple",100,0), array("Nike",254.62,0), array("Virgin",42.54,0));
                                   
                            if(($top->rowCount() >= 3))
                            {
                               $message = "Graph repersenting my top performing stocks";
                                    //gets the current row (first row using the stock var above)
                                    $graphRow = $top->fetch(PDO::FETCH_ASSOC);
                                    //loops through all the rows of this table on the database
                                    for($x = 0; $x < 3; $x++)
                                    {
                                        //sets the array with the custoemrs ctock values
                                        $stocks[$x][0] = $graphRow['stockName'];
                                        $stocks[$x][1] = $graphRow['currentPrice'];
                                        $stocks[$x][2] = $graphRow['qty'];
                            
                                        //ends the statement to stop an infinate loop on this row
                                        //gets the next row(using the stock var above
                                        $graphRow = $top->fetch(PDO::FETCH_ASSOC);
                                    }     
                            
                            }//close if
                            
                            ?>
                        <!-- list containing stock labels relating to the graph-->
                        <ul>
                            <li class="orange">
                                <!--gets vales from array index 0-->
                                <span>Stock Name: <?php echo$stocks[0][0];?></span>
                                <span>Stock Price: $<?php echo$stocks[0][1];?></span>
                                <span>My Shares: <?php echo$stocks[0][2];?></span>
                            </li>
                            <li class="green">
                                <!--gets vales from array index 1-->
                                <span>Stock Name: <?php echo$stocks[1][0];?></span>
                                <span>Stock Price: $<?php echo$stocks[1][1];?></span>
                                <span>My Shares: <?php echo$stocks[1][2];?></span>
                            </li>
                            <li class="red">
                                <!--gets vales from array index 2-->
                                <span>Stock Name: <?php echo$stocks[2][0];?></span>
                                <span>Stock Price: $<?php echo$stocks[2][1];?></span>
                                <span>My Shares: <?php echo$stocks[2][2];?></span>
                            </li>
                        </ul>
                        <!--close list-->
                    </div>
                    <!--close imageHolder-->
                </div>
                <!--clsoe labels for the graph-->
            </div>
            <!-- close r4-->
            <!-- new width row diplaying table of customers stocks-->
            <div class="row topper r5">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " id="stotable">
                    <?php
                        //checks if the customer has stock
                           if(($stock->rowCount() !== 0))                
                           {
                             //this table displays all the stock this customer has in a responsive table
                             require 'tables/stockCustTable.php';
                             echo'<h2 class="center-all-content tab-lab">Click the arrow to view graph of the buy and sell buttons to add/remove shares</h2>';
                           } 
                           else                 
                           {
                               //if the cust has no stock
                               echo"<h2>You currently have no stock</h2>";
                           }
                           
                           ?>
                </div>
                <!--close grid_12-->
            </div>
            <!--close r5-->
            <div id="r6" class="row topper r6">
                <!-- Js draws a google chart here to repersent the customers stocks
                    this is responsive however the page needs to be refreshed  on screen 
                    change to reload the js and redraw the chart on the new screen size-->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 chart pushfoot">
                    <div id ="inner" class="inner">
                        <!--centered label for the chart-->
                        <h1 class="center-all-content">My Stock Chart</h1>
                        <!-- where the chart will be rendered -->
                        <div id="visualization" ></div>
                    </div>
                    <!--close inner-->
                </div>
                <!--close chart-->
            </div>
            <!--close row r6-->
        </div>
        <!--close container-->
        <!--imports the footer-->
        <?php  require 'utils/footer.php'; ?>
        <!--imports my javascript files-->
        <?php  require 'utils/scripts.php'; ?>
        
        <!-- Modal window not shown
        this displays a stock graph and is triggered by the arrows
        in the stock table-->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <!--the header bar or the model-->
                    <div class="modal-header">
                        <!--clsoe x-->
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        <!--text inserted by js, repersents the stock name clicked-->
                        <h4 id="stockName"></h4>
                    </div>
                    <!--this is the body content showns the stock graph-->
                    <div class="modal-body">
                        <!--imports js-->
                        <?php require 'scripts/chart.php';?>
                        <!--chart added in this div by the above js-->
                        <div id="stock-chart" style="height: 300px; width: 100%;"></div>
                    </div>
                    <!--fotter with close button-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div><!--close modal-dialog-->
        </div><!--close modal-->
        
        <!--imports script to draw google chart-->
        <?php  require 'scripts/googleChart.php'; ?>
    </body>
</html>
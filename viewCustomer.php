<?php
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    require_once 'classes/BranchTableGateway.php';
    require_once 'classes/StockTableGateway.php';

    start_session();

    /*redirects to login if the user is not logged in  or if is a hr of customer
      as they have no access to this page    
    */
    if (!is_logged_in() || $_SESSION['role'] === 'hr' || $_SESSION['role'] === 'customer')     
    {
        //loads log on screen
        header("Location: login_form.php");
    }

    //customer number must be send in a get request
    if (!isset($_GET['customerNo'])) 
    {
        die("Invalid request");
    }
    //sets customer no usin get request
    $customerNo = $_GET['customerNo'];
    
    
    //connects to the databae
   $connection = Connection::getInstance();
   //opens connection to the CustomerTableGateway
   $gateway = new CustomerTableGateway($connection);
   //sets the customer to get getCustByEmail using the username (email andusername match)
   $customer = $gateway->getCustByNo($customerNo);
   
 
   //opens connection to the StockTableGateway
   $stockgateway = new StockTableGateway($connection);
   //opens connection to the BranchTableGateway
   $branchgateway = new BranchTableGateway($connection);
   //sql to get this customers stock

    //gets customer stock
    $stock = $stockgateway->getStockByCustomerNo($customerNo);



    //gets this customer row from the database
    $custRow = $customer->fetch(PDO::FETCH_ASSOC);

    //kells if not a customer
    if (!$custRow) 
    {
        die("Invalid Customer");
    }

    //gets branch sql
    $branch = $branchgateway->getBranchByNo($custRow['branchNo']);
    //stores branch
    $brRow = $branch->fetch(PDO::FETCH_ASSOC);

    //gets first row of stock
    $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <!--Meta Tags-->
        <?php  require 'utils/meta.php'; ?>
        <!--sets the title to user name of the user logged in-->
        <title><?php  echo $custRow['fName']. " " .$custRow['lName'] . " Account"; ?></title>
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
                <!--close -->
                
              
                <!-- button to edit account profile-->
                <div class="col-lg-4  col-lg-offset-0 col-md-2  col-md-offset-0 col-sm-6 col-sm-offset-3 col-xs-12 viewCust-btn">
                    <?php echo '<a class="button button-block center-all-content" href="editCustomerForm.php?customerNo=' 
                    . $custRow['customerNo'] . '">Edit Account<i class="fa fa-user"></i></a>';?>
                    <?php echo '<a class="delete button button-block center-all-content" href="deleteCustomer.php?customerNo=' 
                    . $custRow['customerNo'] . '">Close Account<i class="fa fa-user"></i></a>';?>
                    <?php echo '<a class="button button-block center-all-content"href="viewBranch.php?branchNo='
                    .$brRow['branchNo'].'">View Branch<i class="fa fa-university"></i></a>';?>
                </div>
                <!--close button to edit account profile-->
            </div>
            <!--close r3-->

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
                           echo"<h2>This client currently has no stock</h2>";
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
                        <h1 class="center-all-content">Client Stock Chart</h1>
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
         <!--alerts confirmation on delete-->
        <script type="text/javascript" src="scripts/deleteCustomer.js"></script>
    </body>
</html>
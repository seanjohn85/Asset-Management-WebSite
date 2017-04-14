<?php
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require_once 'classes/BranchTableGateway.php';
    require_once 'classes/CustomerTableGateway.php';
    
    start_session();
    
    /*redirects to login if the user is not logged in  or if is a hr of customer
      as they have no access to this page    
    */
    if (!is_logged_in() || $_SESSION['role'] === 'hr' || $_SESSION['role'] === 'customer')     
    {
        //loads log on screen
        header("Location: login_form.php");
    }
    
    //if no branch kills page
    if (!isset($_GET['branchNo'])) 
    {
        die("Invalid request");
    }
    //stores branch no
    $branchNo = $_GET['branchNo'];
    //creates a db connection
    $connection = Connection::getInstance();
    //passes connection to the BranchTableGateway
    $branchgateway = new BranchTableGateway($connection);
    //passes connection to the CustomerTableGateway
    $customergateway = new CustomerTableGateway($connection);
    //starts sql with statement
    $branch = $branchgateway->getBranchByNo($branchNo);
    //starts sql with statement
    $customer = $customergateway->getCustomerByBranchNo($branchNo);
    //stores row of sql results
    $brRow = $branch->fetch(PDO::FETCH_ASSOC);
    //if no branch row kill
    if (!$brRow) 
    {
        die("Invalid branch");
    }
    ?>
<html>
    <head>
        <!--Meta Tags-->
        <?php require 'utils/meta.php'; ?>
        <!--browser page title-->
        <title>Asset Management Branch <?php echo $brRow['branchName'] ?></title>
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
                    <h1> <?php echo $brRow['branchName']?> Branch</h1>
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
                    <img class="img-responsive stologo" src="image/branch.jpg">
                </div>
                <!--close stock-image-->
                <!--this holds a table to display this stocks information-->
                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-10 stock-tab">
                    <table class="details">
                        <tr>
                            <!-- displays stock name gets it from the database-->
                            <td>Branch No:</td>
                            <td><?php  echo  $brRow['branchNo']; ?></td>
                        </tr>
                        <tr>
                            <!-- displays stock name gets it from the database-->
                            <td>Branch Name:</td>
                            <td><?php  echo  $brRow['branchName']; ?></td>
                        </tr>
                        <tr>
                            <!-- displays qty gets it from the database-->
                            <td>Phone Number:</td>
                            <td><?php  echo $brRow['phoneNo']; ?></td>
                        </tr>
                        <tr>
                            <!-- displays qty gets it from the database-->
                            <td>Address:</td>
                            <td><?php  echo $brRow['address']  ?></td>
                        </tr>
                    </table>
                </div>
                <!--close stock-tab-->
                <!--buttons to edit stock-->
                <div class=" col-lg-3 col-md-3 col-sm-4 col-xs-2 stock_but">
                    <!--see css for positioning-->
                    <div>
                        <a href="createBranchForm.php" class="myButton hidden-xs">Add Branch</a>
                    </div>
                    <?php 
                        echo '<div><a class=" myButton small" href="editBranchForm.php?branchNo=' . $brRow['branchNo'] . '">Edit</a> </td></div>';
                        echo '<div><a class="delete myButton small hidden-xs" href="deleteBranch.php?branchNo=' . $brRow['branchNo'] . '">Delete</a> </div>';
                        ?>
                </div>
                <!--close stock_but-->
            </div>
            <!-- close row 2-->
            <div class="clear"></div>
            <!--new row of content-->
            <div class="row r3">
                <!--contains the customers of this branch-->
                <div class="col-lg-12 col-md-12 col-sm-12 brcustomers">
                    
                    <?php
                        //checks if the branch has any customers
                        if(($customer->rowCount() !== 0))
                        {
                            //heading before table
                            echo '<div class="col-lg-6 col-md-6 col-sm-6 col-sm-6"><h1 class="viewbr">' .
                                    $brRow['branchName'] .' Branch Customers 
                            </h1></div>';
                            
                            //customer search bar
                            echo '<div class="col-lg-6 col-md-6 col-sm-12 col-sm-12 feild brcust">
                                    <input type="text" class="search" id="filter" placeholder="Search Customers">
                                     <label class="search_lab">
                                        Enter the details to find a customer.        
                                    </label>
                                </div>';
                            
                            //this table displays all the customers of this branch
                            require 'tables/customerTable.php'; 
                           
                        }
                        else 
                        {
                            //if the branch has no customers
                            echo"<h2>This branch currently has no customers</h2>";
                        }
                    ?>
                    
                    <!--table lable pushes footer down 30px-->
                    <h3 class="pushfoot center-all-content">Use the view and edit buttons to edit enter or modify a Customer</h3>
                
                </div><!--close brcustomers-->
            </div><!--close r3-->
            
        </div><!--close container-->
        <?php require 'utils/footer.php'; ?>
        <!--imports my javascript files-->
        <?php  require 'utils/scripts.php'; ?>
        <!--alerts confirmation on delete-->
        <script type="text/javascript" src="scripts/deleteConfirm.js"></script>
    </body>
</html>



<?php
    
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    
    
    start_session();

    if (!is_logged_in()) 
    {
        header("Location: login_form.php");
    }
    //creates connection
     
    $connection = Connection::getInstance();
    //uses the conect in the cCustomerTableGateway
    $customergateway = new CustomerTableGateway($connection);

    //gets all customers from the customer table using the getCustomer() method
    $customer = $customergateway->getCustomer();
    
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
        <title>View our Customers</title>
        <!--CSS stylesheets  used my css is the last style to give it first preference-->
        <?php  require 'utils/styles.php'; ?>

    </head><!--close head-->
    
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
                    <h1> Clients </h1>
                </div><!--close heading text-->
                
            </div><!--close row push top row under nav-->
            
           <!-- second row of content under the heading  with the table and 
           the search this is the main body of content for this page-->
            <div class="row row2">
                
                <!--sets the main_cont to the full use of the grid -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 main_cont">
                    
                    <!-- This is the add new customer button it is postioned above the table under
                    the heading on a table or mobile i push this div up and align it with
                    the header -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sm-6 add">
                        <div>
                             <!-- button used to link to the add new Customer form-->
                         
                            <a href="createCustomerForm.php" class="myButton">Add Client</a>
                        </div>
                        <!--positioned under add button on left-->
                        <label>Click here to add a new Customer</label>
                    </div><!--close add-->
                    
                    <!--search box on the right above the table next to the add customer button-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sm-6 feild sea">
                        <!--this is a search box that allows the stock table to be searched to
                        find a stock using the footable library-->
                        <input type="text" class='search' id="filter" placeholder="Search Customers">
                        <!--advise label-->
                        <label class='search_lab'>
                            Enter the first name to find a customer.        
                        </label><!--search_lab-->
                    </div><!--close sea-->
                    
                    <!--this is the table that displays the customer info-->
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 table-row">
                        
                        <!--imports the customer table-->
                        
                        <?php require 'tables/customerTable.php'; ?>
                        
                    </div><!--close table-row-->
                    <!--description text user the table-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 center-all-content ">
                        <h3 class="pushfoot">Use the view and edit buttons to edit enter of modify a Customer</h3>
                    </div><!--close center-all-content-->
                        
                </div><!--close main_cont-->
                
            </div><!-- close row 2-->
        </div> <!--close container-->
        <!--imports my javascript files-->
        <?php  require 'utils/scripts.php'; ?>
       
        <!--alerts confirmation on delete-->
        <script type="text/javascript" src="scripts/deleteCustomer.js"></script>
        <!--imports my footer-->
        <?php  require 'utils/footer.php'; ?>  
        
    </body><!--close body-->

</html><!--close this html doc-->


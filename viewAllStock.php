<?php

    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require_once 'classes/StockTableGateway.php';

    /*starts a cookie session*/
    start_session();

    /*redirects to login if the user is not logged in  or if is a hr of customer
      as they have no access to this page    
    */
    if (!is_logged_in() || $_SESSION['role'] === 'hr' || $_SESSION['role'] === 'customer')     
    {
        //loads log on screen
        header("Location: login_form.php");
    }

    //creates connection
    $connection = Connection::getInstance();
    //passses the connection to the StockTableGateway
    $gateway = new StockTableGateway($connection);
    //gets all stock from the stock table using the getStock() method preforms sql
    $stock = $gateway->getStock();
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
        <title>View our Stocks</title>
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
                    <h1> Stock </h1>
                </div><!--close heading text-->
                
            </div><!--close row push top row under nav-->
            
           <!-- second row of content under the heading  with the table and 
           the search this is the main body of content for this page-->
            <div class="row row2">
                
                <!--sets the main_cont to the full use of the grid -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 main_cont">
                    
                    <!-- This is the add new stock button it is postioned above the table under
                    the heading on a table or mobile i push this div upa nd align it with
                    the header -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sm-6 add">
                        <div>
                             <!-- button used to link to the add new stock form-->
                            <a href="createStockForm.php" class="myButton">Add Stock</a>
                        </div>
                        <!--positioned under add button on left-->
                        <label>Click here to add a new stock</label>
                    </div><!--close add-->
                    
                    <!--search box on the right above the table next to the add stock button-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sm-6 feild sea">
                        <!--this is a search box that allows the stock table to be searched to
                        find a stock using the footable library-->
                        <input type="text" class='search' id="filter" placeholder="Search Stocks">
                        <!--advise label-->
                        <label class='search_lab'>
                            Enter the stock name to find a stock.        
                        </label><!--search_lab-->
                    </div><!--close sea-->
                    
                    <!--this is the table that displays the stock info-->
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 table-row">
                        
                        <!--This table is used to display all the stocks 
                        The sort and filters use the footable library with jquery and css">-->

                        <!-- displays a max of 5 stocks at a time text to display in the pagination bar 
                        also includes filters-->
                        
                        <table class="footable" data-filter="#filter" data-filter-minimum="4" data-page-size="5" data-first-text="<<" data-next-text=">" data-previous-text="<" data-last-text=">>" >
                            <!--Table headings -->
                            <thead>
                                <tr>
                                    <!--Table headings for the stock table-->
                                    
                                    <!--Name displayed on all screen sizes-->
                                    <th data-toggle="true">Name</th>
                                    <!--Code hidden on tablet,phone-->
                                    <th data-hide="tablet,phone">Code</th>
                                    <!--qty hidden on tablet,phone-->
                                    <th data-hide="tablet,phone">qty</th>
                                    <!--Open price hidden on tablet,phone-->
                                    <th data-hide="phone">Open price</th>
                                    <!--View current Price on all screen sizes-->
                                    <th data-toggle="true">Current Price</th>
                                    <!--View displayed on all screen sizes-->
                                    <th data-toggle="true">View</th>
                                    <!--Edit displayed on all screen sizes-->
                                    <th data-toggle="true">Edit</th>
                                    <!--Delete hidden on tablet,phone-->
                                    <th data-hide="tablet,phone">Delete</th>
                                </tr><!--close this row of the table-->
                            </thead><!--close table headings-->
                            
                            <!-- the tbody data is filled in from the database with all the stocks-->
                            <tbody>
                                
                                <?php 
                               
                                    //gets the current row (first row using the stock var above)
                                    $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
                                    //loops through all the rows of this table on the database
                                    while($stockRow)                            
                                    {
                                        
                                       
                                        //creates a html table row to match this row on the database
                                        echo '<tr>';
                                        //fills in the columns with this rows data
                                        //echo '<td>' . $row['stockId'] . '</td>';
                                        echo '<td>' . $stockRow['stockName'] . '</td>';
                                        echo '<td>' . $stockRow['stockCode'] . '</td>';
                                        echo '<td>' . $stockRow['qty'] . '</td>';
                                        echo '<td>&euro;' . $stockRow['openPrice'] . '</td>';
                                        echo '<td>&euro;' . $stockRow['currentPrice'] . '</td>';
                                        /*
                                         * This are links to view edit or delete a stock
                                        */
                                        echo '<td><a class="myButton small" href="viewStock.php?stockId='.$stockRow['stockId'].'">View</a> </td>';
                                        echo '<td><a class=" myButton small" href="editStockForm.php?stockId='.$stockRow['stockId'].'">Edit</a> </td>';
                                        echo '<td><a class="delete myButton small" href="deletes/deleteStock.php?stockId='.$stockRow['stockId'].'">Delete</a> </td>';
                                        echo '</tr>';
                                        //ends the statement to stop an infinate loop on this row
                                        //gets the next row(using the stock var above
                                        $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
                                    }

                                //close while
                                ?>
                            </tbody><!--close table body-->
                            
                           <!-- the pagination -->
                           <!-- hide-if-no-paging = hide the pagination control -->
                           <tfoot class="hide-if-no-paging">
                           <td colspan="8">
                               <div class="pagination"></div>
                           </td>
                           </tfoot>
                           
                        </table><!--close stock table-->
                        
                    </div><!--close table-row-->
                    <!--description text user the table-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 center-all-content">
                        <h3 class = "pushfoot">Use the view and edit buttons to edit enter of modify a stock</h3>
                    </div><!--close center-all-content-->
                        
                </div><!--close main_cont-->
                
            </div><!-- close row 2-->
        </div> <!--close container-->
        <!--imports my javascript files-->
        <?php  require 'utils/scripts.php'; ?>
        <!--alerts confirmation on delete-->
        <script type="text/javascript" src="scripts/deleteStock.js"></script>
        <!--imports my footer-->
        <?php  require 'utils/footer.php'; ?>  
        
    </body><!--close body-->

</html><!--close this html doc-->
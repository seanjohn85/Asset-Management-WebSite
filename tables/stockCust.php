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
        </div>
        <!--close add-->
        <!--search box on the right above the table next to the add stock button-->
        <div class="col-lg-6 col-md-6 col-sm-6 col-sm-6 feild sea">
            <!--this is a search box that allows the stock table to be searched to
                find a stock using the footable library-->
            <input type="text" class='search' id="filter" placeholder="Search Stocks">
            <!--advise label-->
            <label class='search_lab'>
            Enter the stock name to find a stock.        
            </label><!--search_lab-->
        </div>
        <!--close sea-->
        <!--this is the table that displays the stock info-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 table-row">
            <!--This table is used to display all the stocks 
                The sort and filters use the footable library with jquery and css">-->
            <!-- displays a max of 5 stocks at a time text to display in the pagination bar 
                also includes filters-->
            <?php require 'tables/customerStockTable.php'; ?>
        </div>
        <!--close table-row-->
        <!--description text user the table-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 center-all-content">
            <h3>Use the view and edit buttons to edit enter of modify a stock</h3>
        </div>
        <!--close center-all-content-->
    </div>
    <!--close main_cont-->
</div>
<!-- close row 2-->
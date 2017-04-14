<?php
    
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Branch.php';
    require_once 'classes/DB.php';
    require_once 'classes/BranchTableGateway.php';
    
    
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
     
    //gets a database connection
    $connection = Connection::getInstance();
    //uses the connect in the BranchTableGateway
    $gateway = new BranchTableGateway($connection);

    //gets all branches from the branch table using the getBranches() method sql
    $branch = $gateway->getBranches();
    
?>

<!DOCTYPE html>
<!--
    This is the html page to view all branches for the staff menu
Copyright John Kenny N00145905 2016
-->
<html>
    <head>
        <!--Meta Tags-->
	<?php require 'utils/meta.php'; ?>
        
        <!--browser page title-->
        <title>View our Branches</title>
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
                    <h1>Branches</h1>
                </div><!--close heading text-->
                
            </div><!--close row push top row under nav-->
            
           <!-- second row of content under the heading  with the table and 
           the search this is the main body of content for this page-->
            <div class="row row2">
                
                <!--sets the main_cont to the full use of the grid -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 main_cont">
                    
                    <!-- This is the add new branch button it is postioned above the table under
                    the heading on a table or mobile i push this div upa nd align it with
                    the header -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sm-6 add">
                        <div>
                             <!-- button used to link to the add new branch form-->
                             <a href="createBranchForm.php" class="myButton">Add branch</a>
                        
                        </div>
                        <!--positioned under add button on left-->
                        <label>Click here to add a new Branch</label>
                    </div><!--close add-->
                    
                    <!--search box on the right above the table next to the add branch button-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sm-6 feild sea">
                        <!--this is a search box that allows the branch table to be searched to
                        find a stock using the footable library-->
                        <input type="text" class='search' id="filter" placeholder="Search Branches">
                        <!--advise label-->
                        <label class='search_lab'>
                            Enter the branch name to find a Branch        
                        </label><!--search_lab-->
                    </div><!--close sea-->
                    
                    <!--this is the table that displays the branch info-->
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 table-row">
                        
                        <!--This table is used to display all the branch 
                        The sort and filters use the footable library with jquery and css">-->

                        <!-- displays a max of 5 branches at a time text to display in the pagination bar 
                        also includes filters-->
                        
                        <table class="footable" data-filter="#filter" data-filter-minimum="4" data-page-size="5" data-first-text="<<" data-next-text=">" data-previous-text="<" data-last-text=">>" >
                            <!--Table headings -->
                            <thead>
                                <tr>
                      
                                    <!--Table headings for the stock table-->
                                    
                                    <!--Number hidden on tablet,phone-->
                                    <th data-hide="tablet,phone">Number</th>
                                    <!--Name displayed on all screen sizes-->
                                    <th data-toggle="true">Name</th>
                                    <!--Address hidden on tablet,phone-->
                                    <th data-hide="tablet,phone">Address</th>
                                    <!--Phone displayed on all screen sizes-->
                                    <th data-toggle="true">Phone No</th>
                                    <!--Open Hours hidden on phone-->
                                    <th data-hide="phone">Open Hours</th>
                                    <!--Open Date hidden on tablet,phone-->
                                    <th data-hide="tablet, phone">Open Date</th>
                                    <!--View hidden on phone-->
                                    <th data-hide="phone">View</th>
                                    <!--Edit displayed on all screen sizes-->
                                    <th data-toggle="true">Edit</th>
                                    <!--Delete displayed on all screen sizes-->
                                    <th data-toggle="true">Delete</th>
                                </tr><!--close this row of the table-->
                            </thead><!--close table headings-->
                            
                            <!-- the tbody data is filled in from the database with all the stocks-->
                            <tbody>
                                
                                <?php 
                                    //gets the first row of of data from the branch table
                                    $brRow = $branch->fetch(PDO::FETCH_ASSOC);

                                    //loops through all the rows of this table on the database

                                    while($brRow)
                                    {
                                        //is the database has no opendate on this row set open to Currently not open"

                                        $open = $brRow['openDate'];
                                        if ($open === NULL || $open ==='')
                                        {
                                            $open = "Currently not open";
                                        }
                                        else 
                                        {   //this reformats the date from yyyy-mm-dd to dd/mm/yy
                                             $date = explode('-', $open);
                                             $open = $date [2] . "/" . $date [1] . "/" . $date [0];
                                        }

                                        //creates a html table row to match this row on the database

                                        echo '<tr>';
                                        //fills in the columns with this rows data
                                        echo '<td>' . $brRow['branchNo'] . '</td>';
                                        echo '<td>' . $brRow['branchName'] . '</td>';
                                        echo '<td>' . $brRow['address'] . '</td>';
                                        echo '<td>' . $brRow['phoneNo'] . '</td>';
                                        echo '<td>' . $brRow['openHours'] . '</td>';
                                        //this row will insert the database info but an a case that there is no open date on this 
                                        //row it will insert Currently not open
                                        echo '<td>' . $open . '</td>';

                                        /*
                                         * This are links to view edit or delete a branch
                                         */

                                        echo '<td><a class="myButton small" href="viewBranch.php?branchNo='.$brRow['branchNo'].'">View</a> </td>';
                                        echo '<td><a class=" myButton small" href="editBranchForm.php?branchNo='.$brRow['branchNo'].'">Edit</a> </td>';
                                        echo '<td><a class="delete myButton small" href="deleteBranch.php?branchNo='.$brRow['branchNo'].'">Delete</a> </td>';
                                        echo '</tr>';

                                        //ends the statement to stop an infinate loop on this row
                                        
                                        //gets the next row of the branch table
                                        $brRow = $branch->fetch(PDO::FETCH_ASSOC);

                                    }//close while

                                ?>
                                

                            </tbody><!--close table body-->
                            
                           <!-- the pagination -->
                           <!-- hide-if-no-paging = hide the pagination control -->
                           <tfoot class="hide-if-no-paging">
                           <td colspan="9">
                               <div class="pagination"></div>
                           </td>
                           </tfoot>
                           
                        </table><!--close stock table-->
                        
                    </div><!--close table-row-->
                    <!--description text user the table-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 center-all-content">
                        <h3 class="pushfoot">Use the view and edit buttons to edit enter of modify a branch</h3>
                    </div><!--close center-all-content-->
                        
                </div><!--close main_cont-->
                
            </div><!-- close row 2-->
        </div> <!--close container-->
        
        <!--imports my footer-->
        <?php  require 'utils/footer.php'; ?>  
        
        <!--imports my javascript files-->
        <?php  require 'utils/scripts.php'; ?>
        <!--alerts confirmation on delete-->
        <script type="text/javascript" src="scripts/deleteConfirm.js"></script>
        
    </body><!--close body-->

</html><!--close this html doc-->


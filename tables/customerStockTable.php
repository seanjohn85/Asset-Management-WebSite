<!-- second row of content under the heading  with the table and 
    the search this is the main body of content for this page-->
<div class="row row2">
    <!--sets the main_cont to the full use of the grid -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 custstotop">
        <!-- This is the add new customer button it is positioned above the table under
            the heading on a table or mobile i push this div up and align it with
            the header -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-sm-12">
            <div>
                <!--heading under the nav-->
                <?php  echo "<h1 class='viewstock-custhead'>".
                    $stockRow['stockName']. 
                    " Client Shares 
                    </h1>";?>
            </div>
        </div>
        <!--close add-->
        <!--search box on the right above the table next to the add customer button-->
        <div class="col-lg-6 col-md-6 col-sm-12 col-sm-12 feild stock-cust-search">
            <!--this is a search box that allows the stock table to be searched to
                find a stock using the footable library-->
            <input type="text" class='search' id="filter" placeholder="Search Customers">
            <!--advise label-->
            <label class='search_lab'>
            Enter the details to find a customer.        
            </label><!--search_lab-->
        </div>
        <!--close stock-cust-search-->
        <!--this is the table that displays the customer info-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 table-row">
            <!--This table is used to display all the stocks 
                The sort and filters use the footable library with jquery and css">-->
            <!-- displays a max of 3 customers at a time text to display in the pagination bar 
                also includes filters-->
            <table class="footable" data-filter="#filter" data-filter-minimum="2" data-page-size="3" data-first-text="<<" data-next-text=">" data-previous-text="<" data-last-text=">>" >
                <!--Table headings -->
                <thead>
                    <tr>
                        <!--Table headings for the stock table-->
                        <!--Cust No hidden on tablet,phone-->
                        <th data-hide="tablet,phone">Cust No</th>
                        
                        <!--branch name hidden on tablet,phone-->
                        <th data-hide="tablet,phone">Branch Name</th>
                        <!--First Name displayed on all screen sizes-->
                        <th data-toggle="true">First Name</th>
                        <!--SurName displayed on all screen sizes-->
                        <th data-toggle="true">SurName</th>
                        <!--email hidden on tablet,phone-->
                        <th data-hide="tablet,phone">Email</th>
                        <!--mobile hidden on tablet,phone-->
                        <th data-hide="tablet,phone">Mobile No</th>
                        <!--qty hidden on tablet,phone-->
                        <th data-hide="phone">Qty</th>
                        <!--value hidden on tablet,phone-->
                        <th data-hide="phone">Value</th>
                        <!--View hidden on phone-->
                        <th data-hide="phone">View</th>
                        <!--Edit displayed on all screen sizes-->
                        <th data-toggle="true">Edit</th>
                        <!--Delete hidden on tablet,phone-->
                        <th data-hide="tablet,phone">Delete</th>
                    </tr>
                    <!--close this row of the table-->
                </thead>
                <!--close table headings-->
                <!-- the tbody data is filled in from the database with all the stocks-->
                <tbody>
                    <?php
                        $cust = $customer->fetch(PDO::FETCH_ASSOC);
                        
                        //loops through all the rows of this table on the database
                        
                        while ($cust) {
                            //creates a html table row to match this row on the database
                            echo '<tr>';
                            //fills in the columns with this rows data
                            echo '<td>' . $cust['customerNo'] . '</td>';
                            echo '<td>' . $cust['branchName'] . '</td>';
                            echo '<td>' . $cust['fName'] . '</td>';
                            echo '<td>' . $cust['lName'] . '</td>';
                            echo '<td>' . $cust['email'] . '</td>';
                            echo '<td>' . $cust['mobileNo'] . '</td>';
                            echo '<td>' . $cust['qty'] . '</td>';
                            //calulates the current value of the shares of this stock
                            echo '<td>' ."$". $cust['qty'] * $cust['currentPrice'] . '</td>';
                            /*
                             * This are links to view edit or delete a customer
                             */
                        
                            echo '<td><a class="myButton small" href="viewCustomer.php?customerNo=' . $cust['customerNo'] . '">View</a> </td>';
                            echo '<td><a class=" myButton small" href="editCustomerForm.php?customerNo=' . $cust['customerNo'] . '">Edit</a> </td>';
                            echo '<td><a class="delete myButton small" href="deleteCustomer.php?customerNo=' . $cust['customerNo'] . '">Delete</a> </td>';
                            echo '</tr>';
                        
                            //ends the statement to stop an infinate loop on this row
                        
                            $cust = $customer->fetch(PDO::FETCH_ASSOC);
                        }//close while
                        ?>
                </tbody>
                <!-- the pagination -->
                <!-- hide-if-no-paging = hide the pagination control -->
                <tfoot class="hide-if-no-paging">
                    <td colspan="11">
                        <div class="pagination"></div>
                    </td>
                </tfoot>
            </table>
            <!--close stock table-->
        </div>
        <!--close table-row-->
        <!--description text user the table-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 center-all-content">
            <h3 class="pushfoot">Use the view and edit buttons to edit enter or modify a Customer</h3>
        </div>
        <!--close center-all-content-->
    </div>
    <!--close main_cont-->
</div>
<!-- close row 2-->


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
            <!--First Name displayed on all screen sizes-->
            <th data-toggle="true">First Name</th>
            <!--SurName displayed on all screen sizes-->
            <th data-toggle="true">SurName</th>
            <!--gender hidden on tablet,phone-->
            <th data-hide="tablet,phone">Gender</th>
            <!--Address hidden on tablet,phone-->
            <th data-hide="tablet,phone">Address</th>
            <!--Email hidden on tablet,phone-->
            <th data-hide="tablet,phone">Email</th>
            <!--Mobile hidden on tablet,phone-->
            <th data-hide="phone">Mobile</th>
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
    //gets first customer row from the database
        $cust = $customer->fetch(PDO::FETCH_ASSOC);

        //loops through all the rows of this table on the database

        while ($cust) 
        {
            //creates a html table row to match this row on the database

            echo '<tr>';
            //fills in the columns with this rows data
            echo '<td>' . $cust['customerNo'] . '</td>';
            //echo '<td>' . $cust['branchNo'] . '</td>';
            echo '<td>' . $cust['fName'] . '</td>';
            echo '<td>' . $cust['lName'] . '</td>';
            echo '<td>' . $cust['gender'] . '</td>';
            echo '<td>' . $cust['address'] . '</td>';
            echo '<td>' . $cust['email'] . '</td>';
            echo '<td>' . $cust['mobileNo'] . '</td>';


            /*
            * This are links to view edit or delete a branch
            */

            echo '<td><a class="myButton small" href="viewCustomer.php?customerNo=' . $cust['customerNo'] . '">View</a> </td>';
            echo '<td><a class=" myButton small" href="editCustomerForm.php?customerNo=' . $cust['customerNo'] . '">Edit</a> </td>';
            echo '<td><a class="delete myButton small" href="deleteCustomer.php?customerNo=' . $cust['customerNo'] . '">Delete</a> </td>';
            echo '</tr>';

            //ends the statement to stop an infinate loop on this row

            //gets next row from database
            $cust = $customer->fetch(PDO::FETCH_ASSOC);
        }//close while
    ?>
    </tbody><!--close table body-->

    <!-- the pagination -->
    <!-- hide-if-no-paging = hide the pagination control -->
    <tfoot class="hide-if-no-paging">
         <td colspan="10">
             <div class="pagination"></div>
         </td>
    </tfoot>

</table><!--close stock table-->





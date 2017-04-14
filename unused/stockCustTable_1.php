<!--This table is used to display all the branches 
                the th rows mirror the rows  on the database
                <table class="fullscreen" id="recap">-->
<table class="fullscreen">
    <thead>
        <tr>
            <!--<th class="ss">Cust No</th>-->
            <th>Name</th>
            <th>Code</th>
            
            <th>Open price</th>
            <th>Current Price</th>
            <th>Cust Qty</th>
            <th>Current Value</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php


        //loops through all the rows of this table on the database

        while ($stockRow) {
            //creates a html table row to match this row on the database

            echo '<tr>';
            //fills in the columns with this rows data
            //echo '<td>' . $row['stockId'] . '</td>';
            echo '<td>' . $stockRow['stockName'] . '</td>';
            echo '<td>' . $stockRow['stockCode'] . '</td>';
            
            echo '<td>&euro;' . $stockRow['openPrice'] . '</td>';
            echo '<td>&euro;' . $stockRow['currentPrice'] . '</td>';
            echo '<td>' . $stockRow['qty'] . '</td>';
            echo '<td>&euro;' . $stockRow['currentPrice']*$stockRow['qty'] . '</td>';

            /*
             * This are links to view edit or delete a branch
             */

            echo '<td><a class="myButton small" href="viewStock.php?stockId=' . $stockRow['stockId'] . '">View</a> </td>';
            echo '<td><a class=" myButton small" href="editStockForm.php?stockId=' . $stockRow['stockId'] . '">Edit</a> </td>';
            echo '<td><a class="delete myButton small" href="deleteStock.php?stockId=' . $stockRow['stockId'] . '">Delete</a> </td>';
            echo '</tr>';
            //print_r($stockRow);

            //ends the statement to stop an infinate loop on this row

            $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
        }//close while
        ?>
    </tbody>

</table>
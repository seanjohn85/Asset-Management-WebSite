<!--heading lable for table-->
<div class="col-lg-6 col-md-6 col-sm-6 col-sm-6">
    <h1>My Stock Portfolio</h1>
</div>
<!--close add-->
<!--search box on the right above the table next to the add stock button-->
<div class="col-lg-6 col-md-6 col-sm-6 col-sm-6 feild sea">
    <!--this is a search box that allows the stock table to be searched to
        find a stock using the footable library-->
    <input type="text" class='search custsto' id="filter" placeholder="Search My Stocks">
    <!--advise label-->
    <label class='search_lab'>
    Enter the stock name to find a stock.        
    </label><!--search_lab-->
</div><!--close sea-->

<!--fullscreen responsive table-->
<div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 table-row">
    <!--This table is used to display all the branches 
        the th rows mirror the rows  on the database
        <table class="fullscreen" id="recap">-->
    <table class="footable rad" data-filter="#filter" data-filter-minimum="4" data-page-size="5" data-first-text="<<" data-next-text=">" data-previous-text="<" data-last-text=">>" >
        <!--Table headings -->
        <thead>
            <tr>
                <!--Table headings for the stock table-->
                <!--Name displayed on all screen sizes-->
                <th data-toggle="true">Name</th>
                <!--Code hiddedn on tablet,phone-->
                <th data-hide="tablet, phone">Code</th>
                <!--Open price hidden on tphone-->
                <th data-hide="phone">Open price</th>
                <!--current price displayed on all screen sizes-->
                <th data-toggle="true">Current Price</th>
                <!--arrow displayed on all screen sizes-->
                <th data-toggle="true"></th>
                <!--cust qty hidden on phone-->
                <th data-hide="phone">Cust Qty</th>
                <!--current price hidden on tablet,phone-->
                <th data-hide="tablet, phone">Current Value</th>
                <!--buy displayed on all screen sizes-->
                <th data-toggle="true">Buy</th>
                <!--sell displayed on all screen sizes-->
                <th data-toggle="true">Sell</th>
                
            </tr>
            <!--close this row of the table-->
        </thead>
        <!--close table headings-->
        <!--<th class="ss">Cust No</th>-->
        </tr>
        </thead>
        <tbody>
            <?php
                //loops through all the rows of this table on the database
                $current;
                while ($stockRow) 
                {
                    //creates a html table row to match this row on the database
                    echo '<tr>';
                    //fills in the columns with this rows data
                    //echo '<td>' . $row['stockId'] . '</td>';
                    echo '<td>' . $stockRow['stockName'] . '</td>';
                    echo '<td>' . $stockRow['stockCode'] . '</td>'; 
                    echo '<td>&euro;' . $stockRow['openPrice'] . '</td>';
                    echo '<td>&euro;' . $stockRow['currentPrice'] . '</td>';
                    if($stockRow['openPrice'] <$stockRow['currentPrice'])
                    {
                        //if the price is up create an up arrow -- links to modal of graph- data-id used as label
                        echo '<td>
                        <button type="button" data-toggle="modal"  data-target="#myModal" class="open" data-id= "'
                        .$stockRow['stockName'].' Graph"><div class="arrow-up_gr "></div></button>
                            </td>';
                    }
                    else 
                    {
                        //if the price is down create a down arrow -- links to modal of graph- data-id used as label
                        echo '<td>
                            
                            <button type="button" data-toggle="modal"  data-target="#myModal" class="open" data-id= "'
                        .$stockRow['stockName'].' Graph"><div class="arrow-down_red "></div></button>
                            </td>';
                        
                    }
                    echo '<td>' . $stockRow['qty'] . '</td>';
                    echo '<td>&euro;' . $stockRow['currentPrice']*$stockRow['qty'] . '</td>';
                    //link to buy
                    echo'<td><form action="addShare.php" method="post" >'.
                    '<input type="hidden" name="customerNo" value="'.$custRow['customerNo'].'">'.
                    '<input type="hidden" name="stockId" value="'.$stockRow['stockId'].'">'
                    . '<button type="submit" id="submit"  value ="submit" class="buy_btn"><i class="fa fa-cart-plus"></button></form></td>';
                    //link to sell
                    echo'<td><form action="sellShare.php" method="post" >'.
                    '<input type="hidden" name="customerNo" value="'.$custRow['customerNo'].'">'.
                    '<input type="hidden" name="stockId" value="'.$stockRow['stockId'].'">'
                    . '<button type="submit" id="submit"  value ="submit" class="sell_btn" ><i class="fa fa-cart-arrow-down"></button></form></td>';
                
                    echo '</tr>';
                    //clsoe this row of the table
                
                    //ends the statement to stop an infinate loop on this row
                
                    $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
                }//close while
            ?>
        </tbody>
        <!--close table body-->
        <!-- the pagination -->
        <!-- hide-if-no-paging = hide the pagination control -->
        <tfoot class="hide-if-no-paging">
            <td colspan="9">
                <div class="pagination"></div>
            </td>
        </tfoot>
    </table>
    <!--close stock table-->
    
</div><!--close tablerow-->
<div class="clearfix"></div>


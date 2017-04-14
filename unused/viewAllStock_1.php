<?php
    
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require_once 'classes/StockTableGateway.php';
    
    
    start_session();

    if (!is_logged_in()) 
    {
        header("Location: login_form.php");
    }
    //creates connection
     

    $connection = Connection::getInstance();
    $gateway = new StockTableGateway($connection);

    //gets all branches from the branch table using the getBranches() method
    $stock = $gateway->getStock();
    
?>



<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Asset Management Branches</title>
        
        <!--CSS stylesheets  used my css is the last style to give it first preference-->
        <?php require 'utils/styles.php'; ?>
        
        <script language="javascript" type="text/javascript" src="scripts/tablefilter.js"></script>
        
        <!--script with delete-->
        
        
    </head>
    <body>
        
        
        <div class="container">
            <?php require 'utils/header.php'; ?>
            <?php require 'utils/toolbar.php'; ?>
            
            <!--prints any error messages -->
            <?php 
            if (isset($message)) {
                echo '<p>'.$message.'</p>';
            }
            ?>
            
            <!--heading-->
            <div class="grid_10 top">
                <h1> Stock </h1>
            </div>
            
            <!-- button used to link to the add new branch form-->
            
            <div class="grid_2 top">
                <a href="createStockForm.php" class="myButton">Add Stock</a>
            </div>
            
            <div class="clear"></div>
            
            
            <div class="grid_12">
                
                <!--This table is used to display all the branches 
                the th rows mirror the rows  on the database
                <table class="fullscreen" id="recap">-->
                <table class="fullscreen footable toggle-arrow-alt">
                    <thead>
                        <tr>
                            <!--<th class="ss">Cust No</th>-->
                            <th data-toggle="true">Name</th>
                            <th data-hide="tablet,phone">Code</th>
                            <th data-hide="tablet,phone">qty</th>
                            <th data-toggle="true">Open price</th>
                            <th data-hide="phone">Current Price</th>
                            <th data-hide="tablet,phone">View</th>
                            <th data-toggle="true">Edit</th>
                            <th data-toggle="true">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

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
                                 * This are links to view edit or delete a branch
                                 */
                                
                                echo '<td><a class="myButton small" href="viewStock.php?stockId='.$stockRow['stockId'].'">View</a> </td>';
                                echo '<td><a class=" myButton small" href="editStockForm.php?stockId='.$stockRow['stockId'].'">Edit</a> </td>';
                                echo '<td><a class="delete myButton small" href="deleteStock.php?stockId='.$stockRow['stockId'].'">Delete</a> </td>';
                                echo '</tr>';

                                //ends the statement to stop an infinate loop on this row

                                $stockRow = $stock->fetch(PDO::FETCH_ASSOC);

                            }//close while

                        ?>
                    </tbody>

                </table>
                
            </div><!--close grid_12-->
            
        </div><!--close container-->
        <?php require 'utils/footer.php'; ?>
   
   <?php require 'utils/scripts.php'; ?>
	
        
    </body>
  
	 <script type="text/javascript">
     $(document).ready(function(){
         
         $('.footable').footable();
         
     });
    </script>

  
</html>

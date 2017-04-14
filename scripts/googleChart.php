<?php
     
    //gets the customers stock
    $top =$stockgateway->getstoByCustomerNo($custRow['customerNo']);
    //if the customer has stock draw a pie chart 
    if( $top->rowCount()!== 0)
    {
      $var = "show";
?>
      <!-- loads google chart api -->
      <script type="text/javascript" src="http://www.google.com/jsapi"></script>
      <script type="text/javascript">
        //loads package for the api
        google.load('visualization', '1', {packages: ['corechart']});
      </script>
      <!--script to draw graph-->
      <script type="text/javascript">
          //function to draw google chart
         function drawVisualization() 
         {
            // Create and populate the data table.
            var data = google.visualization.arrayToDataTable([
            ['Stocks', 'price'],

            <?php
                //loops through all the customers stock adding them to the js array
                while( $row = $top->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row);
                    //fills the array with the stock name and qty of shares
                    echo "['{$stockName}', {$qty}],";
                }
            ?>
             ]);//close array
             
             //sets chart properties
             var options = 
             {
                
                width: '100%',
                height: '100%',
                pieSliceText: 'percentage',
                legend: {color: 'blue',position: 'bottom', textStyle: {fontSize: 14, color: 'white'}},
                chartArea:{height: "85%",width: "85%"}
            };//close options

            // Create and draw the visualization in the div with the visualization id.
            new google.visualization.PieChart(document.getElementById('visualization')).
            draw(data, options);
         }//close

        //calls function to draw chart 
        google.setOnLoadCallback(drawVisualization);
      </script>
      <?php
         }
         //if the customer has no stock
         else
         {
            //hides the div
            $var = "hide";
         }
         ?>
      <script type="text/javascript">
        //sets x to ¢var value
        var x = "<?php echo $var;?>";
        //if x is hide hide the div with the id inner
        if(x == "hide")
        {
        $('#inner').hide();
    }
    </script>
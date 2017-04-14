<!--javascrip files to generate modal window graph-->
<script type="text/javascript" src="scripts/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
    
//stock name will be set here  
var stock;
  
//click event on open(open class objects also opens the model window)  
$(document).on('click', '.open', function()
{
    //the stock name set in data-id in the stockCustTable
    stock = $(this).attr('data-id');
    //console.log(stock); tester
    //sets the stock name clicked to the heading of the modal window
    document.getElementById('stockName').innerHTML = stock;
});

//ensure graph is redrawn every time modal opens
//this is needed to redrawn the graph and for
//future if i wanted to pass in the datapoints
$(window).on('shown.bs.modal', function() 
{ 
    //this function draws the graph
    $(function () 
    {
        //Better to construct options first and then pass it as a parameter
        var options = 
        {
            //sets graph to animate in
            animationEnabled: true,
            data: [
            {
                //type of graph set here
                type: "spline", //change it to line, area, column, pie, etc
                //datapoints used to set the points of th graph
                //each point repesents a month
                dataPoints: 
                [
                    { x: 1, y: 100.00 },
                    { x: 2, y: 98.64 },
                    { x: 3, y: 58.12 },
                    { x: 4, y: 72.12 },
                    { x: 5, y: 64.87 },
                    { x: 6, y: 71.93 },
                    { x: 7, y: 91.12},
                    { x: 8, y: 120.12 },
                    { x: 9, y: 31.21 },
                    { x: 10, y: 63.12 },
                    { x: 11, y: 89.12 },
                    { x: 12, y: 141.12 }
                ]
            } ]//close data
        };
        //draws the chart in the stock-chart div
        $("#stock-chart").CanvasJSChart(options);

    });

//console.log(stock);
});
</script>

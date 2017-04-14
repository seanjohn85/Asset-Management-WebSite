<?php

    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Stock.php';
    require_once 'classes/DB.php';
    require_once 'classes/StockTableGateway.php';
    
    
    
    start_session();
    //kicks the user out of this page if they are not logged in
    if (!is_logged_in()) 
    {
        header("Location: login_form.php");
    }

    require 'utils/formFiller.php';
    
    
    
?>   
<!DOCTYPE html>
<!--
John Kenny N00145905
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Asset Management Add Branch</title>
        
        <!--CSS stylesheets  used my css is the last style to give it first preference-->
        
        <?php require 'utils/styles.php'; ?>
        
       
    </head>
    <body class="forms-bg">
        
        <?php require 'functions/firstForm.php'; ?>
        <?php require 'utils/toolbar.php'; ?>
        
        <div class="container ">
            <div class="row">
            <div class="form">

		<div id="col-lg-12 ">
 
            
            <!-- id to be used by js name by php-->
            
            <h1 class="top center">Enter the Stock details</h1>
            <!-- 
            This form is sent to the valiate.php page to check for  errors
            if errors are found they will be returned and placed into the errors
            div relevant to the field. Correct fields will displayed so the user 
            will not have to reenter the data.
            If all is correct valiate.php will call a script to add this element
            to the branch table
            -->
            
            <form action="createStock.php" method="post">
                
            <?php require 'forms/stockForm.php'; ?>
             </div><!--close container-->
            </div>
        </div>
        <?php require 'utils/scripts.php'; ?>
            <script type="text/javascript" src="scripts/validateStock.js"></script>
                
        </div><!--close container-->
    </body>
</html>
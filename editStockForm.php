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
    
    //customer and hr have no access to this page so they are redirected home here
    if ($_SESSION['role'] === 'customer' || $_SESSION['role'] === 'hr') 
    {
        header("Location: homepage.php");
    }

    //fills in from formdata
    require 'utils/formFiller.php';
    //gets details of this form from the database
    require 'functions/getStock.php';
    
?> 

<!DOCTYPE html>
<!--
John Kenny 
N00145905 
Asset Management
Edit Stock Form
-->
<html>
    <head>
        <!--Meta Tags-->
        <?php  require 'utils/meta.php'; ?>
        <!--page title-->
        <title>Asset Management Edit Stock</title>
        
        <!--CSS stylesheets  used my css is the last style to give it first preference-->
        <?php require 'utils/styles.php'; ?>
        
    </head>
    <!--sets bg color-->
    <body class="forms-bg">
        
        <!--for first form load empty formdata and error arrays-->
        <?php require 'functions/firstForm.php'; ?>
        <!--navbar-->
        <?php require 'utils/toolbar.php'; ?>
        
        <!--main content-->
        <div class="container ">
            <div class="row push">
                <!--this class positions all content of form centered and
                sets all input properties see the css for details -->
                <div class="form">

                    <div id="col-lg-12 ">

                    <!--page heading-->

                        <h1 class="center-all-content">Update <?php echo $formdata['stockName']?> Stock details </h1>
                        <!--submits to edit stock.php-->
                        <form action="editStock.php" method="post"  enctype="multipart/form-data">

                        <!-- 
                        this loads the stock form. on this page the form is validated by js 
                        and is then validated by php and the stock is updated is there are no
                        issues otherwise the user will remain on this page with error messages
                        displayed. once stock is updated user is redirected to view all stock
                        -->
                        <?php require 'forms/stockForm.php'; ?>
                         <!--form instructions-->
                        <p class="center-all-content">
                           Any changed details will update on our system.
                           Warning all changes are final!
                        </p> 

                     </div><!--close container-->
                </div>
            </div><!--close row-->
        </div><!--close container-->
        
        <!--imports the footer-->
        <?php  require 'utils/footer.php'; ?>
        
        <!--main js files-->
        <?php require 'utils/scripts.php'; ?>
        <!--validates this form-->
        <script type="text/javascript" src="scripts/validateStock.js"></script>
    </body>
</html>
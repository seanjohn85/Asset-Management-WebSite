<?php

    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Customer.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    
    start_session();

    if (!is_logged_in()) 
    {
        header("Location: login_form.php");
    }

    require 'utils/formFiller.php';
    require 'functions/getCustomer.php';
    

    
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
        <title>Asset Management Edit Customer</title>
        
        <!--CSS stylesheets  used my css is the last style to give it first preference-->

       <?php require 'utils/styles.php'; ?>
        
        <!--my js to validate-->
        <script src="validate.js"></script>
    </head>
    <body>

        
        <div class="container container_12">
            
            <!--page heading-->

            <h1 class="top center">Update <?php echo $formdata['fName']." ".$formdata['lName']?> Customer details </h1>
            <form action="editCustomer.php" method="post" class="pure-form">
            
            <?php require 'forms/customerForm.php'; ?>
                <div class ="submitter top grid_3 prefix_4">
        <input type="submit" id="submit" name ="sumbit" value ="submit" class="myButton">
    </div><!-- close submit button-->
</form>
            <div class="clear"></div>
            <?php require 'utils/footer.php'; ?>
        </div><!--close container-->
      
    </body>
</html>

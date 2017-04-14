<?php

    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Customer.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    
    
    
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
        <title>Asset Management Add Customer</title>
        
        <!--CSS stylesheets  used my css is the last style to give it first preference-->
        
        <?php require 'utils/styles.php'; ?>
       <!-- <script src="validateCustomer.js"></script>-->
    </head>
    <body>
        
        <?php require 'functions/firstForm.php'; ?>
        
        <div class="container container_12">
 
            
            <!-- id to be used by js name by php-->
            
            <h1 class="top center">Enter the Customer details</h1>
            <!-- 
            This form is sent to the valiate.php page to check for  errors
            if errors are found they will be returned and placed into the errors
            div relevant to the field. Correct fields will displayed so the user 
            will not have to reenter the data.
            If all is correct valiate.php will call a script to add this element
            to the branch table
            -->
            
            <form action="createCustomer.php" method="post" class="pure-form">
                
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

<?php
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Customer.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    
    start_session();
    
    /*redirects to login if the user is not logged in  or if is a hr of customer
      as they have no access to this page    
    */
    if (!is_logged_in() || $_SESSION['role'] === 'hr')     
    {
        //loads log on screen
        header("Location: login_form.php");
    }
    
    
    require 'utils/formFiller.php';
    //gets customer details from db
    require 'functions/getCustomer.php';  
    
    
?>   
<!DOCTYPE html>
<!--
    John Kenny N00145905
    -->
<html>
    <head>
        <!--Meta Tags-->
        <?php require 'utils/meta.php'; ?>
        <title>Update <?php echo $formdata['fName']." ".$formdata['lName']?> </title>
        <!--CSS stylesheets  used my css is the last style to give it first preference-->
        <?php require 'utils/styles.php'; ?>
    </head>
    <!--sets page bg colour-->
    <body class="forms-bg">
        <!--for first form load empty formdata and error arrays-->
        <?php require 'functions/firstForm.php'; ?>
        <!--navbar-->
        <?php require 'utils/toolbar.php'; ?>
        <!--main content-->
        <div class="container ">
            <!--moves space between navbar-->
            <div class="row push">
                <!--this class positions all content of form centered and
                    sets all input properties see the css for details -->
                <div class="form">
                    <div id="col-lg-12 ">
                        <!-- form heading-->
                        <h1 class="center-all-content">
                            Update <?php echo $formdata['fName']." ".$formdata['lName']?> Customer details 
                        </h1>
                        <!--posts to  editCustomer.php-->
                        <form action="editCustomer.php" method="post" >
                            <!--
                                This form is sent to the valiateCustomer.php page to check for  errors
                                if errors are found they will be returned and placed into the errors
                                div relevant to the field. Correct fields will displayed so the user 
                                will not have to reenter the data.
                                If all is correct it will edit the customer and redirect to the view all 
                                    customers or my account page for customers
                                -->
                            <fieldset>
                                <?php require 'forms/customerForm.php'; ?>
                                <div class="col-lg-12  col-md-12 field">
                                    <label>
                                    Cant Update UserName
                                    </label>
                                    <input class ="inbox" readonly="readonly" type="text" id="email" name="email" value="<?php returnVal($formdata, 'email') ?>">
                                </div>
                                <div class="col-lg-12  col-md-12 field">
                                    <button type="submit" id="submit" value="Submit" class="button button-block" />Submit</button>
                                </div>
                            </fieldset>
                        </form>
                        <!--info text under the form-->
                        <p class="center-all-content">
                            Please note on submit a new customer will be created.
                            You will be redirected to view all customers.
                        </p>
                    </div>
                    <!--close col-lg-12-->
                </div>
                <!--close form-->
            </div>
            <!--close row push-->
        </div><!--close container-->
        
        <!--imports the footer-->
        <?php  require 'utils/footer.php'; ?>
        <!-- js scripts used-->
        <?php require 'utils/scripts.php'; ?>
        <script src="scripts/radioStyle.js"></script>
        <!--validates this form-->
        <script src="scripts/validateCustomer.js"></script>
    </body>
</html>
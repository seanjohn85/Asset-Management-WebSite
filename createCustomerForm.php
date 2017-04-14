<?php
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Customer.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    
    
    
    /*redirects to login if the user is not logged in  or if is a hr of customer
      as they have no access to this page    
    */
    if (!is_logged_in() || $_SESSION['role'] === 'hr' || $_SESSION['role'] === 'customer')     
    {
        //loads log on screen
        header("Location: login_form.php");
    }
    //refills form 
    require 'utils/formFiller.php';
    
    
?>   
<!DOCTYPE html>
<!--
    John Kenny N00145905
    
    -->
<html>
    <head>
        <!--Meta Tags-->
        <?php require 'utils/meta.php'; ?>
        <title>Create a Customer</title>
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
                        <h1>Enter Customer Information</h1>
                        <!-- 
                            This form is sent to the valiateCustomer.php page to check for  errors
                            if errors are found they will be returned and placed into the errors
                            div relevant to the field. Correct fields will displayed so the user 
                            will not have to reenter the data.
                            If all is correct createCustomer.php will call a script to add this element
                            to the customer table and a user account in the user table.
                            -->
                        <!--form data posts to createCustomer.php -->
                        <form  action="createCustomer.php" method="post">
                            <fieldset>
                                
                                <!--majority of the form feilds-->
                                <?php require 'forms/customerForm.php'; ?>
                                
                                <!--this is the email also used for the user name-->
                                <div class="col-lg-12  col-md-12 field">
                                    
                                    <!--label for email and error sits in text box repositioned on point of input-->
                                    <label>
                                        Email(UserName)<span class="req">*</span>
                                        <span class="error" id="emailError">  <?php error($errors, 'email') ?>  </span>
                                    </label>
                                    <!--input for email username-->
                                    <input class ="inbox" type="text" id="email" name="email" value="<?php returnVal($formdata, 'email') ?>">
                                </div>
                                
                                <!--this is the password also used for the user account-->
                                <div class="col-lg-12  col-md-12 field">
                                    <!--label for password and error sits in text box repositioned on point of input-->
                                    <label>
                                        Password<span class="req">*</span>
                                        <span class="error" id="webpageError">  <?php error($errors, 'password') ?>  </span>
                                    </label>
                                    <!--input for password-->
                                    <input class ="inbox" type="password" id="password" name="password" value="" />
                                </div>
                                
                                <!--the previous password needs to be confirmed here-->
                                <div class="col-lg-12  col-md-12 field">
                                    <!--label for cpassword and error sits in text box repositioned on point of input-->
                                    <label>
                                        Confirm Password<span class="req">*</span>
                                        <span class="error" id="webpageError">  <?php error($errors, 'cpassword') ?>  </span>
                                    </label>
                                    <!--input to confrim password-->
                                    <input class ="inbox" <input type="password" id="cpassword" name="cpassword" value=""  />
                                </div>
                                
                                <!--submit button for form-->
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
                    </div><!--close col-lg-12-->
                    
                </div><!--close form-->
            </div><!--close row push-->
        </div><!--close container-->
        <!--imports the footer-->
        <?php  require 'utils/footer.php'; ?>
        <?php require 'utils/scripts.php'; ?>
        <script src="scripts/radioStyle.js"></script>
        <!--validates this form-->
        <script src="scripts/validateCustomer.js"></script>
    </body>
</html>
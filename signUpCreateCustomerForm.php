<?php
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Customer.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    
    
    //redirects users to home page
    if (is_logged_in()) 
    {
        header("Location: homepage.php");
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

        <div class="container ">
            <div class="row pushfoot">
                <div class="form">
                    <div id="col-lg-12 ">
                        <!-- id to be used by js name by php-->
                        <h1 class="center-all-content">Your Account is almost set up</h1>
                        <!-- 
                            This form is sent to the valiateCustomer.php page to check for  errors
                            if errors are found they will be returned and placed into the errors
                            div relevant to the field. Correct fields will displayed so the user 
                            will not have to reenter the data.
                            If all is correct createCustomer.php will call a script to add this element
                            to the customer table and a user account in the user table.
                            -->
                        <!--form data posts to createAccount.php -->
                        <form  action="createAccount.php" method="post">
                            <fieldset>
                                <!--feild headings-->
                                <h2 class="fs-title">Personal Details</h2>
                                <h3 class="fs-subtitle">We ensure this will remain confidential</h3>
                                <!--majority of the form feilds-->
                                <?php require 'forms/customerForm.php'; ?>
                                
                                <!--this is the email also used for the user name-->
                                <div class="col-lg-12  col-md-12 field">
                                    <!--label for email and error sits in text box repositioned on point of input-->
                                    <label>
                                        Email(UserName)<span class="req">*</span>
                                    <span class="error" id="webpageError">  <?php error($errors, 'email') ?>  </span>
                                    </label>
                                    <!--input for email-->
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
                                    <button type="submit" id ="submit" value="Submit" class="button button-block" />Submit</button>
                                </div>
                            </fieldset>
                        </form>
                    </div><!--close col-lg-12-->
                    <!--cancel from button for form-->
                    <div class="col-lg-12  col-md-12 field">
                        <a href="homepage.php" class="button button-block red" />Cancel</a>
                    </div>
                </div><!--close form-->
                
            </div><!--clsoe row-->
        </div><!--close container-->
        <!--adds footer-->
        <?php  require 'utils/footer.php'; ?>
        <!--adds js-->
        <?php require 'utils/scripts.php'; ?>
        <script src="scripts/radioStyle.js"></script>
        <!--validates this form-->
        <script src="scripts/validateCustomer.js"></script>
    </body>
</html>
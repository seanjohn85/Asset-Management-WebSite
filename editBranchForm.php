<?php

    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Branch.php';
    require_once 'classes/DB.php';
    require_once 'classes/BranchTableGateway.php';
    
    start_session();

    /*redirects to login if the user is not logged in  or if is a hr of customer
      as they have no access to this page    
    */
    if (!is_logged_in() || $_SESSION['role'] === 'hr' || $_SESSION['role'] === 'customer')     
    {
        //loads log on screen
        header("Location: login_form.php");
    }
    //fills in form with details
    require 'utils/formFiller.php';
    //gets branch deatils from db
    require 'functions/getBranch.php';
    

    
?>   
<!DOCTYPE html>
<!--
John Kenny
N00145905
-->
<html>
    <head>
        <?php require 'utils/meta.php'; ?>
        <title>Asset Management Edit Branch</title>
        
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

                    <div class="col-lg-12 ">
			
                        <!--form heading-->

                        <h1 class="center-all-content">Update the <?php echo $formdata['name']; ?> Branch details </h1>
                        
                        <!--posts form data to the editBranch.php script-->
                        <form action="editBranch.php" method="post">
                            <!-- 
                        This form is sent to the valiate.php page to check for  errors
                        if errors are found they will be returned and placed into the errors
                        div relevant to the field. Correct fields will displayed so the user 
                        will not have to reenter the data.
                        If all is correct valiate.php will call a script to edit this element
                        in the branch table
                        -->


                        <?php require 'forms/branchForm.php'; ?>
                        
                         <!--info text under the form-->
                        <p class="center-all-content">
                            Please note on submit this branch details will be updated.
                            You will be redirected to view all branches.
                        </p> 

                     </div><!--close col-lg-12-->

                </div><!--close form-->
            </div><!--close row-->
        </div><!--close container-->
        
        <!--imports the footer-->
        <?php  require 'utils/footer.php'; ?>
        
        <!--main js files-->
        <?php require 'utils/scripts.php'; ?>
        <script src="scripts/radioStyle.js"></script>
        <!--validates this form-->
        <script src="scripts/validate.js"></script>
      
    </body>
</html>

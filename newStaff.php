<?php
    //files required by this page database connections, gatewaytables and functions
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require_once 'classes/UserTable.php';
    
    //starts session
    start_session();
    
    //if the user is not logged in redirect to login_form
    if (!is_logged_in() && $_SESSION['role'] != 'hr') 
    {
        header("Location: login_form.php");
    }
    
    //sets the session user in this session
    $user = $_SESSION['user'];
    //used by the toolbar to display the correct menu
    $_SESSION['role'] = $user->getRole();
    
    //if the user is not a customer redirect to home
    if($_SESSION['role'] !="hr")
    {
        header("Location: login_form.php");
    }
    
    require 'utils/formFiller.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <!--Meta Tags-->
        <?php  require 'utils/meta.php'; ?>
        <!--sets the title to user name of the user logged in-->
        <title><?php  echo $user->getUsername() . " hr add staff"; ?></title>
        <!--imports css styles see styles.php-->
        <?php  require 'utils/styles.php'; ?>
    </head>
    <!--class used to sed bg colour-->
    <body class="logOn">
        <!-- this is the nav bar loded-->
        <div class="row">
            <?php require 'functions/firstForm.php'; ?>
            <?php  require 'utils/toolbar.php'; ?>
        </div>
        <!--main content under nav-->
        <div class="container">
            <div class="row push">
                <!--centers form with form styles-->
                <div class="form">
                    <div id="col-lg-12 ">
                        <!--form heading-->
                        <h1> add a new staff member</h1>
                        <!--checks for error messages-->
                        <?php
                            if (isset($errorMessage))
                            {
                                //prints errors
                                echo "<p>$errorMessage</p>";
                            }
                            ?>
                        <!--submits from to resister.php-->
                        <form action="register.php" method="POST">
                            <!--staff user name-->
                            <div class="col-lg-12  col-md-12 field">
                                <!--label for staff user name-->
                                <label>
                                    UserName<span class="req">*</span>
                                    <span class="error" id="usernameError">  <?php if (isset($errors['username'])) echo $errors['username']; ?> </span>
                                </label>
                                <!--username input-->
                                <input class ="inbox" type="text" id="username" name="username" value="<?php returnVal($formdata, 'email') ?>">
                            </div>
                            
                            <!--staff job type-->
                            <div class="col-lg-12  col-md-12 field select">
                                <!--label for staff job type-->
                                <label class="selectBelow">
                                    Job type<span class="req">*</span>
                                    <span class="error"  id="jobError"> <?php if (isset($errors['job'])) echo error($errors, 'job') ?> </span>
                                </label>
                                <!--select dropdown with various job types-->
                                <select class ="inbox" id="job" name="job">
                                    <option class="sel-text" value= "hr" <?php selected($formdata, 'opening', "hr") ?> >Hr</option>
                                    <option class="sel-text" value= "Manager" <?php selected($formdata, 'opening', "Manager") ?> >Manager</option>
                                    <option class="sel-text" value= "Admin" <?php selected($formdata, 'opening', "Admin") ?> >Admin</option>
                                    <option class="sel-text" value= "Branch staff" <?php selected($formdata, 'opening', "Branch staff") ?> >Branch Staff</option>
                                </select>
                            </div>
                            
                            <!--staff password-->
                            <div class="col-lg-12  col-md-12 field">
                                <!--label for staff password-->
                                <label>
                                    Password<span class="req">*</span>
                                    <span class="error" id="webpageError"> <?php if (isset($errors['password'])) echo $errors['password']; ?></span>
                                </label>
                                <!--password input-->
                                <input class ="inbox" type="password" id="password" name="password" value="" />
                            </div>
                            
                            <!--staff confirm password-->
                            <div class="col-lg-12  col-md-12 field">
                                <!--label for confirm password-->
                                <label>
                                    Confirm Password<span class="req">*</span>
                                    <span class="error" id="webpageError"> <?php if (isset($errors['cpassword'])) echo $errors['cpassword']; ?> </span>
                                </label>
                                <!--confirm password input-->
                                <input class ="inbox" <input type="password" id="cpassword" name="cpassword" value=""  />
                            </div>
                            
                            <!--buttom to submit this new staff member-->
                            <div class="col-lg-12  col-md-12 field">
                                <button type="submit" value="Submit" class="button button-block" />Submit</button>
                            </div>
                        </form>
                    </div><!---close col-lg-12-->
                </div><!--close from-->
            </div><!--close row-->
        </div><!--close container-->
        <!--loads js-->
        <?php require 'utils/scripts.php'; ?>
        <!--loads footer-->
        <?php  require 'utils/footer.php'; ?>
    </body>
</html>
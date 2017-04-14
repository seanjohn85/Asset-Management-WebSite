<?php
    //files required by this page database connections, gatewaytables and functions
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require_once 'classes/UserTable.php';
    
    //starts session
    start_session();
    
    //if the user is not logged in redirect to login_form
    if (!is_logged_in()) 
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

    $newStaff = $_SESSION['newStaff'];
    
    require 'utils/formFiller.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <!--Meta Tags-->
	<?php  require 'utils/meta.php'; ?>
        <!--sets the title to user name of the user logged in-->
	<title><?php  echo $newStaff->getUsername() . " account created"; ?></title>
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
        <div class="container center-all-content">
            <div class ="row push">
                <!--confirmation staff added message-->
                <section class="col-lg-12">
                    <h1>A new staff member has been added</h1>

                    <h2><?php echo "UserName: " . $newStaff->getUsername() ?></h2>
                    <h2><?php echo"Account Type: " . $newStaff->getRole() ?></h2>
                </section>
            </div><!--close row-->
        </div><!--close container-->
     
        <!--imports footer-->
        <?php  require 'utils/footer.php'; ?>

    </body>
</html>
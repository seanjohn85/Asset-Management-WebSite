<!--nav bar from the home page-->

<header>  
    <!--open nav setting-->
    <nav class="navbar  navbar-default navbar-fixed-top home" data-spy="affix" data-offset-top="300px"role="navigation" id="myNavbar">
        <!--restricts content to 1197px-->
        <div class="container">
            <!--heading section-->
            <div class="navbar-header">
                <!--used to shrink menu on mobole devices-->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--links to homepage-->
                <a class="navbar-brand" href="homepage.php">
                    <!--logo branding-->
                    <img src="image/logo.png" > <h6>Mason Assets</h6>
                </a>

            </div><!-- navbar-header -->
        <!--collapsible nav menu-->    
        <div class="collapse navbar-collapse" id="collapse">
            <!--buttons to sign in log out-->
            <?php
                //checks if the user is loged in
                if (is_logged_in()) 
                {
                    //if logged in shows log out button
                    echo '<a href="logout.php" class="btn border_btn btn-default navbar-btn navbar-right">Log Out</a>';
                } 
                else 
                {   
                    //if not logged in shows sign in button
                    echo '<a href="login_form.php" class="btn border_btn btn-default navbar-btn navbar-right">Sign In</a>';
                }
            ?>
            <!--main menu list-->
            <ul class="nav navbar-nav ">
                <!--nav menu links-->
                <li><a class="smooth" href="#services">Services</a></li>
                <li><a class="smooth" href="#device">Why Us</a></li>
                <li><a class="smooth" href="#branches">Branches</a></li>
                <li><a  class="smooth"href="#about">About Us</a></li>
                <li><a class="smooth" href="#directors">Directors</a></li>
                <!--adds an account link if the users logged in-->
                <?php

                 if (is_logged_in()) 
                   {
                       //used as href for the link
                       $account;
                       if ($_SESSION['role'] === "customer")
                       {
                           $account= 'myAccount.php';
                       }
                       else if ($_SESSION['role'] === "hr")
                       {
                           $account= 'newStaff.php';
                       }
                       else
                       {
                           $account= 'viewAllBranches.php';
                       }
                       //adds the link
                       echo '<li><a href="'.$account.'">My Account</a></li>';
                   }

                ?>
            </ul><!--close menu list-->
          </div><!-- collapse navbar-collapse -->
        </div><!-- container -->
   </nav><!--close nav-->
</header> <!---close header-->
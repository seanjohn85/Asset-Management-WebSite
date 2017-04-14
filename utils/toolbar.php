<?php
require_once 'utils/functions.php';


?>

<!--nav bar from the home page-->

<header>     
    <!--create nav-->
    <nav class="navbar  navbar-default navbar-fixed-top account" data-spy="affix" data-offset-top="300px"role="navigation">
        <!--content doesnt spill over 1197px-->
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
              
              <!--branding-->
            <a class="navbar-brand" href="homepage.php">
                  <img src="image/logo.png" > <h6>Mason Assets</h6>
            </a>

          </div><!-- navbar-header -->
          <div class="collapse navbar-collapse" id="collapse">
              <!--log out button-->
              <a href="logout.php" class="btn border_btn btn-default navbar-btn navbar-right">Log Out</a>
            <!--main menu list-->
            <ul class="nav navbar-nav ">
              <li><a href="homepage.php">Home</a></li>
             <!-- <li class="active"><a href="#mission">Mission</a></li>-->
            <?php
              
            //hr user  
            if($_SESSION['role'] === 'hr')
            {
                //only option is to add staff
                echo '<li><a href="newStaff.php">Add Staff</a></li>';
            }
            //customer account
            else if($_SESSION['role'] === 'customer')
            {
                //account overview
                echo '<li><a href="myAccount.php">My Account</a></li>';
                //buy stock
                echo '<li><a href="buyStock.php">Buy Stock</a></li>';
                 
                //adds cart link if cart har items
                //checks if cart is set
                if(isset($_SESSION['cart']))
                { 
                    //ENSURES CART IS NOT EMPTY AS STOCK MAY HAVE BEEN REMOVED
                    if (!empty($_SESSION['cart']))
                    {
                        
                        //calculated by the for each loop
                        $total = 0;
                        //loops through each stock changing id to the current stock of the loop
                        foreach($_SESSION['cart'] as $id => $value) 
                        {
                            //sets total to increment by o0ne every run of this loop
                            $total ++;
                        }
                        //link to cart
                        echo '<li><a href="viewCart.php"><span class="badge">'.$total.'</span><i class="fa fa-shopping-cart"></i> Cart</a></li>';
                    }
                }

            }
            //staff member 
            else 
            {
                //brasnch table
                echo '<li><a href="viewAllBranches.php">Branches</a></li>';
                //customer table
                echo '<li><a href="viewAllCustomers.php">Customers</a></li>';
                //stock table
                echo '<li><a href="viewAllStock.php">Stock</a></li>';

            }
            ?>
            </ul><!--close menu list-->
          </div><!-- collapse navbar-collapse -->
        </div><!-- container -->
   </nav><!--close nave-->
</header> <!---close header-->



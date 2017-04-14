<?php

    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/Customer.php';
    require_once 'classes/DB.php';
    require_once 'classes/CustomerTableGateway.php';
    
    
    
   
//    if (is_logged_in()) 
//    {
//        header("Location: login_form.php");
//    }

    require 'utils/formFiller.php';
    
    
?>   
<!DOCTYPE html>
<!--
John Kenny N00145905
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Asset Management Sign Up</title>
        
        <!--CSS stylesheets  used my css is the last style to give it first preference-->
        
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
        <script src='http://thecodeplayer.com/uploads/js/jquery.easing.min.js'></script>
      
    </head>
    <body>
        
        <?php require 'functions/firstForm.php'; ?>
        
        <div class="container">
 
            
            <!-- id to be used by js name by php-->
            
            <h1 >Your Account is almost set up</h1>
            <!-- 
            This form is sent to the valiate.php page to check for  errors
            if errors are found they will be returned and placed into the errors
            div relevant to the field. Correct fields will displayed so the user 
            will not have to reenter the data.
            If all is correct valiate.php will call a script to add this element
            to the branch table
            -->
         <!-- multistep form -->
         <form id="msform" action="createAccount.php" method="post">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Account Setup</li>
		<li>Personal Details</li>
	</ul>
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">Personal Details</h2>
		<h3 class="fs-subtitle">We ensure this will remain confidental</h3>
		<?php
    
    //files used by this page
    require_once 'classes/DB.php';
    require_once 'classes/BranchTableGateway.php';
     

    $connection = Connection::getInstance();
    $gateway = new BranchTableGateway($connection);

    //gets all branches from the branch table using the getBranches() method
    $branches = $gateway->getBranches();
    
?>

<!-- This is the row for the Opening Hours  -->

    <div class="row grid_12 top">
        <feildset>
         <input type="hidden" name="customerNo" value="<?php echo $formdata['customerNo']; ?>" />
        <div class ="userPrompt grid_4 alpha">
            <label for="branchNo">Select a branch</label>
        </div>
        <div class="userInput grid_2">

            <select id="branchNo" name="branchNo">
                <?php
                    foreach ($branches as $branch) 
                    {
                        if ($branch['branchNo'] === $formdata['branchNo']) 
                        {
                            $selected = 'selected';
                        }
                        else 
                        {
                            $selected = '';
                        }
                        echo '<option value="'.$branch['branchNo'].'" '.$selected.'>'.$branch['branchName'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class ="error grid_3 omega">
            <span id="branchNoError"> <?php error($errors, 'opening') ?> </span>
        </div>
    </div><!-- close grid_12 ends opening row on the grid-->

    <div class="row grid_12 top">

        <!--this is the br no to update this field is hidden so it can't be edited
        In the edit form the get request stores the branch no in formdata and it is used here -->

       
   
        
        <!-- This is the row for the Branch Name -->
        
        <div class ="userPrompt grid_4 alpha">
            <label for="fName">First Name</label><span class="req">*</span>
        </div>
        <div class="userInput grid_2">
            <input type="text" id="name" name="fName" required autocomplete="off" value="<?php returnVal($formdata, 'fName') ?>" />
        </div>
        <div class ="error grid_3 omega">
            <span id="nameError"> <?php error($errors, 'fName') ?> </span>
        </div>
    </div><!-- close grid_12 ends name row on the grid-->
    
    <div class="row grid_12 top">

        <!--this is the br no to update this field is hidden so it can't be edited
        In the edit form the get request stores the branch no in formdata and it is used here -->

        <!-- This is the row for the Branch Name -->
        
        <div class ="userPrompt grid_4 alpha">
            <label for="lName">SurName</label>
        </div>
        <div class="userInput grid_2">
            <input type="text" id="name" name="lName" value="<?php returnVal($formdata, 'lName') ?>" />
        </div>
        <div class ="error grid_3 omega">
            <span id="nameError"> <?php error($errors, 'lName') ?> </span>
        </div>
    </div><!-- close grid_12 ends name row on the grid-->
    

    <!-- This is the row for the Branch Address  -->

    <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for="address">Address</label>
        </div>
        <div class="userInput grid_2">
            <textarea  id="address" name="address" ><?php returnVal($formdata, 'address') ?></textarea>
        </div>
        <div class ="error grid_3 omega">
            <span id="addressError"> <?php error($errors, 'address') ?> </span>
        </div>
    </div><!-- close grid_12 ends address on row the grid-->

    <!-- This is the row for the Opening Hours  -->
    
     <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for ="gender">Gender</label>
        </div>
        <div class="userInput man grid_2">
            <input type="radio" id="male" class="gender" name="gender" value="male" <?php checked($formdata, 'gender', 'male') ?> />
            <label>Male</label>
            <input type="radio" id="female" class="gender" name="gender" value="female" <?php checked($formdata, 'gender', 'female') ?> />
            <label>Female</label>
        </div>
        <div class ="error grid_3 omega">
            <span id="managerError"> <?php error($errors, 'gender') ?> </span>
        </div>
    </div><!-- close grid_12 ends manager row on the grid-->
    
    

    <!-- This is the row for the Branch phone  -->

    <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for="mobileNo">Mobile No 000-0000000</label>
        </div>
        <div class="userInput grid_2">
            <input type="text" id="phone" name="mobileNo" value="<?php returnVal($formdata, 'mobileNo') ?>" />
        </div>
        <div class ="error grid_3 omega">
            <span id="phoneError"> <?php error($errors, 'mobileNo') ?> </span>
        </div>
    </div><!-- close grid_12 ends phone row on the grid-->


    <!-- This is the submit button for the form -->

    
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>

	<fieldset>
		<h2 class="fs-title">Create your account</h2>
		<h3 class="fs-subtitle">Used to access your account online</h3>
		<label for="username">Username: </label>
            <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for="webpage">Email</label>
        </div>
        <div class="userInput grid_2">
            <input type="text" id="webpage" name="email" value="<?php returnVal($formdata, 'email') ?>">
        </div>
        <div class ="error grid_3 omega">
            <span id="webpageError">  <?php error($errors, 'email') ?>  </span>
        </div>
    </div><!-- close grid_12 ends webpage row  on the grid-->
            <label for="password">Password: </label>
            <input type="password"
                   id="password"
                   name="password"
                   value=""
                   />
            <label for="password">Confirm Password: </label>
            <input type="password"
                   id="cpassword"
                   name="cpassword"
                   value=""
                   />
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="submit" id="submit" name ="sumbit" value ="submit" class="submit action-button" value="Submit" />
	</fieldset>
</form>
     
            
                
        </div><!--close container-->
        
     
        <script>
            
            
            // online tutorial from http://codepen.io/atakan/pen/gqbIz?ref=designsfree
            
 //varibles used to  repersent stages of the form states
var current, next, previous; 
//properties to animate
var left, opacity, scale; 
//used to handle animation
var animating;

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current = $(this).parent();
	next = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next)).addClass("active");
	
	//show the next fieldset
	next.show(); 
	//hide the current fieldset with style
	current.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current = $(this).parent();
	previous = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current)).removeClass("active");
	
	//show the previous fieldset
	previous.show(); 
	//hide the current fieldset with style
	current.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current.css({'left': left});
			previous.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
                //animation of shanging state 1 second
		duration: 1000, 
		complete: function(){
			current.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	//return false;
})
    
            </script>
    </body>
</html>

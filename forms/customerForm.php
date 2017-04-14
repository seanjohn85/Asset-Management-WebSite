<?php
    
   //files used by this page
    require_once 'classes/DB.php';
    require_once 'classes/BranchTableGateway.php';
     
    //connects to db
    $connection = Connection::getInstance();
    //pass connection
    $gateway = new BranchTableGateway($connection);

    //gets all branches from the branch table using the getBranches() method
    $branches = $gateway->getBranches();
    
?>

<!-- This is hidden used by the edit form to hold the customer number -->

<input type="hidden" name="customerNo" value="<?php echo $formdata['customerNo']; ?>" />

<!--only if js is not active-->

<div class="col-lg-12  col-md-12 field">
   
    <input class ="inbox" type="text" value="Please turn on Javascript" disabled="disabled"/>

</div>

<!--first name -->   

<div class="col-lg-12  col-md-12 field">
    
    <!--label for first name and error sits in text box repositioned on point of input-->
    <label>
            First Name<span class="req">*</span>
            <span class="error" id="fnameError"> <?php error($errors, 'fName') ?> </span>
    </label>
    <!--input for first name-->
    <input class ="inbox" type="text" id="fname" name="fName" required autocomplete="off" value="<?php returnVal($formdata, 'fName') ?>" />

</div><!--close first name-->


<!--surname-->
<div class="col-lg-12  col-md-12 field">
    
    <!--label for surName and error sits in text box repositioned on point of input-->
    <label>
             SurName<span class="req">*</span>
            <span class="error" id="snameError"> <?php error($errors, 'lName') ?> </span>
    </label>
    <!--input for surname-->
    <input class ="inbox" type="text" id="sname" name="lName" value="<?php returnVal($formdata, 'lName') ?>" />

</div><!--close surname-->
        

   
<!-- This is the row for the customer Address  -->
 <div class="col-lg-12  col-md-12 field">
     
     <!--label for address and error sits in text box repositioned on point of input-->
    <label>
        Address<span class="req">*</span>
            <span class="error" id="addressError"> <?php error($errors, 'address') ?> </span>
    </label>
     <!--textarea for customers address-->
    <textarea  class ="inbox" id="address" name="address" ><?php returnVal($formdata, 'address') ?></textarea>

</div> <!-- close customer Address  -->


<!-- This is the row for the gender -->   
<div class="col-lg-12  col-md-12 field select">
    <div class="col-lg_6">
        
        <!--label for email and error sits beside radio boxes-->
        <label class="radioGen">
            <p>
                Gender<span class="req">*</span>
                <span class="error" id="genderError"> <?php error($errors, 'gender') ?> </span>
            <p>
        </label>
    </div>
    
    <!-- gender radio options-->
    <div class="col-lg_6 userInput man">
        <input type="radio" id="male" class="gender" name="gender" value="male" <?php checked($formdata, 'gender', 'male') ?> />
        <label for="Male">Male</label>
    
        <input type="radio" id="female" class="gender" name="gender" value="female" <?php checked($formdata, 'gender', 'female') ?> />
        <label for="Femail">Female</label>
    </div>
        
</div><!--close gender row-->
    
      
<!--selects a branch for this customer-->    
<div class="col-lg-12  col-md-12 field select">
    
    <!--label for branch and error sits below text box--> 
     <label class="selectBelow">
            Select a branch<span class="req">*</span>
            <span class="error"  id="branchNoError"> <?php error($errors, 'opening') ?> </span>
    </label>
    <!--options created from the db-->
    <select  class ="inbox" id="branchNo" name="branchNo">
                <?php
                    //lops through all the branches on the ddb
                    foreach ($branches as $branch) 
                    {
                        //if previously submitted the form remembers user selected branch
                        if ($branch['branchNo'] === $formdata['branchNo']) 
                        {
                            $selected = 'selected';
                        }
                        else 
                        {
                            $selected = '';
                        }
                        //adds each branch as an option
                        echo '<option class="sel-text" value="'.$branch['branchNo'].'" '.$selected.'>'.$branch['branchName'].'</option>';
                    }
                ?>
        </select>
     
</div><!--close select branch-->

<!--mobile feild-->
    
<div class="col-lg-12  col-md-12 field">
    
    <!--label for mobile and error sits in text box repositioned on point of input-->
    <label>
             Mobile No 000-0000000<span class="req">*</span>
            <span class="error" id="phoneError"> <?php error($errors, 'mobileNo') ?> </span>
    </label>
    <!--input for mobile-->
    <input class ="inbox" type="text" id="phone" name="mobileNo" value="<?php returnVal($formdata, 'mobileNo') ?>" />

</div><!--close select mobile-->

    
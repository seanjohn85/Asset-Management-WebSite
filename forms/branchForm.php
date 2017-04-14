<!--all labels sit in text box and move on data entry using js and css-->

<!--input for edit holds branch no to identify branch-->
<input type="hidden" name="branchNo" value="<?php echo $formdata['branchNo']; ?>" />

<!--hidden row on form-->
<div class="col-lg-12  col-md-12 field">
   
    <input class ="inbox" type="text" value="Please turn on Javascript" disabled="disabled"/>

</div><!--close hidden  row on form-->

<!--first row on form-->
<div class="col-lg-12  col-md-12 field">
    <!--label and errors for branch name-->
    <label>
            Branch Name<span class="req">*</span>
            <span class="error" id="nameError"><?php error($errors, 'name') ?></span>
    </label>
    <!--this input is for the branch name-->
    <input class ="inbox" type="text" id="name" name="name" value="<?php returnVal($formdata, 'name') ?>"/>

</div><!-- close first row on form-->

<!--second row on form-->
<div class="col-lg-12  col-md-12 field">
    <!--lable and errors for branch addresss-->
    <label>
            Branch Address<span class="req">*</span>
            <span class="error" id="addressError"> <?php error($errors, 'address') ?> </span>
    </label>
     <!-- This is the input for the Branch Address  -->
    <textarea  class ="inbox" id="address" name="address" ><?php returnVal($formdata, 'address') ?></textarea>

</div><!--close second row on form-->

<!--third row on form input boxes-->
<div class="col-lg-12  col-md-12 field select">
    <!--input lable positioned right of the buttons-->
    <div class="col-lg_6">
        <label class="radio">
            <p>
                Would you like to add a branch manager<span class="req">*</span>
                <span class="error" id="managerError"> <?php error($errors, 'manager') ?> </span>
            <p>
        </label>
    </div>
    <!--input radio buttons-->
    <div class="col-lg_6 userInput man">
        <!--yes button lable on button-->
        <input type="radio" id="yes" id="radio1"class="manager" name="manager" value="yes" <?php checked($formdata, 'manager', 'yes') ?> />
        <label for="yes">Yes</label>
    
        <!--no button label on button-->
        <input type="radio" id="no" class="manager" name="manager" value="no" <?php checked($formdata, 'manager', 'no') ?> />
        <label for="no">No</label>
    </div>
        
</div><!--close third row on form input boxes-->

<!-- This is the fourth row for the Opening Hours  -->
 <div class="col-lg-12  col-md-12 field select">
     
     <!--opening hours label and errrors-->
     <label class="selectBelow">
            Opening Hours<span class="req">*</span>
            <span class="error"  id="openingError"> <?php error($errors, 'opening') ?> </span>
    </label>
     
    <!--opening hours select boxes-->
    <select class ="inbox" id="opening" name="opening">
        <!--options to select for opening hours-->
        <option class="sel-text" value= "8 to 4" <?php selected($formdata, 'opening', "8 to 4") ?> >8 to 4</option>
        <option class="sel-text" value= "8 to 6" <?php selected($formdata, 'opening', "8 to 6") ?> >8 to 6</option>
        <option class="sel-text" value= "9 to 4" <?php selected($formdata, 'opening', "9 to 4") ?> >9 to 4</option>
        <option class="sel-text" value= "9 to 6" <?php selected($formdata, 'opening', "9 to 6") ?> >9 to 6</option>
        <option class="sel-text" value= "10 to 6" <?php selected($formdata, 'opening', "10 to 6") ?> >10 to 6</option>
        <option class="sel-text" value= "10 to 8" <?php selected($formdata, 'opening', "10 to 8") ?> >10 to 8</option>
    </select>
     
</div><!-- This is the fourth row for the Opening Hours  -->

<!-- This is the fifth row  -->    
<div class="col-lg-12  col-md-12 field">
    
    <!--label and errors for branch phone number -->
    <label>
            Branch phone 000-0000000<span class="req">*</span>
            <span class="error" id="phoneError"> <?php error($errors, 'phone') ?> </span>
    </label>
    
    <!-- This is the input for the Branch phone  -->
    <input class ="inbox" type="text" id="phone" name="phone" value="<?php returnVal($formdata, 'phone') ?>" />

</div><!-- close fifth row  --> 
    
<!-- This is the sixth row  -->          
<div class="field-col-lg-12  col-md-12 field">
    
    <!--label for date-->
    <label>
             Branch Open Date dd/mm/yyyy<span class="req">*</span>
            <span class="error" id="openDateError">  <?php error($errors, 'openDate') ?>  </span>
    </label>
    
    <!-- This is the input for the Branch Open Date  -->
    <input class ="inbox" type="text"id="openDate" name="openDate" value="<?php returnVal($formdata, 'openDate') ?>" />

</div><!-- close sixth row  --> 

<!-- This is the seventh row  --> 
<div class="col-lg-12  col-md-12 field">
    
    <!--label and errors for webpage-->
    <label>
            Branch Webpage<span class="req">*</span>
            <span class="error" id="webpageError">  <?php error($errors, 'webpage') ?>  </span>
    </label>
    
    <!--input for webpage -->
    <input class ="inbox" type="url" id="webpage" name="webpage" value="<?php returnVal($formdata, 'webpage') ?>">

</div><!-- close seventh row  --> 

    
<!--final row submit button -->
<div class="col-lg-12  col-md-12 field">
  
    <!--submits this form id used by JS-->
    <button type="submit" value="Submit" id="submit" class="button button-block" />Submit</button>

</div><!--close submit-->
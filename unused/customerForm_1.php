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
            <label for="fName">ForeName</label>
        </div>
        <div class="userInput grid_2">
            <input type="text" id="name" name="fName" value="<?php returnVal($formdata, 'fName') ?>" />
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

    <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for="webpage">Email</label>
        </div>
        <div class="userInput grid_2">
            <input type="text" readonly="readonly" id="webpage" name="email" value="<?php returnVal($formdata, 'email') ?>">
        </div>
        <div class ="error grid_3 omega">
            <span id="webpageError">  <?php error($errors, 'email') ?>  </span>
        </div>
    </div><!-- close grid_12 ends webpage row  on the grid-->

    <!-- This is the submit button for the form -->

    
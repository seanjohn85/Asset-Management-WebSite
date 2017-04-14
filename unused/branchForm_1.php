


    <div class="row grid_12 top">

        <!--this is the br no to update this field is hidden so it can't be edited
        In the edit form the get request stores the branch no in formdata and it is used here -->

        <input type="hidden" name="branchNo" value="<?php echo $formdata['branchNo']; ?>" />
        
        <!-- This is the row for the Branch Name -->
        
        <div class ="userPrompt grid_4 alpha">
            <label for="name">Branch Name</label>
        </div>
        <div class="userInput grid_2">
            <input type="text" id="name" name="name" value="<?php returnVal($formdata, 'name') ?>" />
        </div>
        <div class ="error grid_3 omega">
            <span id="nameError"> <?php error($errors, 'name') ?> </span>
        </div>
    </div><!-- close grid_12 ends name row on the grid-->

    <!-- This is the row for the Branch Address  -->

    <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for="address">Branch Address</label>
        </div>
        <div class="userInput grid_2">
            <textarea  id="address" name="address" ><?php returnVal($formdata, 'address') ?></textarea>
        </div>
        <div class ="error grid_3 omega">
            <span id="addressError"> <?php error($errors, 'address') ?> </span>
        </div>
    </div><!-- close grid_12 ends address on row the grid-->

    <!-- This is the row for the Branch Address  -->

    <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for ="managerbut">Would you like to add a branch manager</label>
        </div>
        <div class="userInput man grid_2">
            <input type="radio" id="yes" class="manager" name="manager" value="yes" <?php checked($formdata, 'manager', 'yes') ?> />
            <label>Yes</label>
            <input type="radio" id="no" class="manager" name="manager" value="no" <?php checked($formdata, 'manager', 'no') ?> />
            <label>No</label>
        </div>
        <div class ="error grid_3 omega">
            <span id="managerError"> <?php error($errors, 'manager') ?> </span>
        </div>
    </div><!-- close grid_12 ends manager row on the grid-->

    <!-- This is the row for the Opening Hours  -->

    <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for="opening">Opening Hours</label>
        </div>
        <div class="userInput grid_2">

            <select id="opening" name="opening">
                <option value= "8 to 4" <?php selected($formdata, 'opening', "8 to 4") ?> >8 to 4</option>
                <option value= "8 to 6" <?php selected($formdata, 'opening', "8 to 6") ?> >8 to 6</option>
                <option value= "9 to 4" <?php selected($formdata, 'opening', "9 to 4") ?> >9 to 4</option>
                <option value= "9 to 6" <?php selected($formdata, 'opening', "9 to 6") ?> >9 to 6</option>
                <option value= "10 to 6" <?php selected($formdata, 'opening', "10 to 6") ?> >10 to 6</option>
                <option value= "10 to 8" <?php selected($formdata, 'opening', "10 to 8") ?> >10 to 8</option>
            </select>
        </div>
        <div class ="error grid_3 omega">
            <span id="openingError"> <?php error($errors, 'opening') ?> </span>
        </div>
    </div><!-- close grid_12 ends opening row on the grid-->

    <!-- This is the row for the Branch phone  -->

    <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for="phone">Branch phone 000-0000000</label>
        </div>
        <div class="userInput grid_2">
            <input type="text" id="phone" name="phone" value="<?php returnVal($formdata, 'phone') ?>" />
        </div>
        <div class ="error grid_3 omega">
            <span id="phoneError"> <?php error($errors, 'phone') ?> </span>
        </div>
    </div><!-- close grid_12 ends phone row on the grid-->

    <!-- This is the row for the Branch Open Date  -->

    <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for="openDate">Branch Open Date dd/mm/yyyy</label>
        </div>
        <div class="userInput grid_2">
            <input type="text"id="openDate" name="openDate" value="<?php returnVal($formdata, 'openDate') ?>" />
        </div>
        <div class ="error grid_3 omega">
            <span id="openDateError">  <?php error($errors, 'openDate') ?>  </span>
        </div>
    </div><!-- close grid_12 ends openDate row  on the grid-->

    <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for="webpage">Branch Webpage</label>
        </div>
        <div class="userInput grid_2">
            <input type="url" id="webpage" name="webpage" value="<?php returnVal($formdata, 'webpage') ?>">
        </div>
        <div class ="error grid_3 omega">
            <span id="webpageError">  <?php error($errors, 'webpage') ?>  </span>
        </div>
    </div><!-- close grid_12 ends webpage row  on the grid-->

    <!-- This is the submit button for the form -->

    <div class ="submitter top grid_3 prefix_4">
        <input type="submit" id="submit" name ="sumbit" value ="submit" class="myButton">
    </div><!-- close submit button-->
</form>
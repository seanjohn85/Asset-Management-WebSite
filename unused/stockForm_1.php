<?php

function echoValue($array, $fieldName) {
    if (isset($array) && isset($array[$fieldName])) {
        echo $array[$fieldName];
    }
}

if (!isset($errors)) {
    $errors = array();
}
?>

<!-- This is the row for the Opening Hours  -->
<input type="hidden" name="stockId" value="<?php echo $formdata['stockId']; ?>" />

    <div class="row grid_12 top">

        <!--this is the br no to update this field is hidden so it can't be edited
        In the edit form the get request stores the branch no in formdata and it is used here -->
        
        
        <!-- This is the row for the Branch Name -->
        
        <div class ="userPrompt grid_4 alpha">
            <label for="stockName">Stock Name</label>
        </div>
        <div class="userInput grid_2">
            <input type="text" id="name" name="stockName" value="<?php returnVal($formdata, 'stockName') ?>" />
        </div>
        <div class ="error grid_3 omega">
            <span id="nameError"> <?php error($errors, 'stockName') ?> </span>
        </div>
    </div><!-- close grid_12 ends name row on the grid-->
    
    <div class="row grid_12 top">

        <!--this is the br no to update this field is hidden so it can't be edited
        In the edit form the get request stores the branch no in formdata and it is used here -->

        <!-- This is the row for the Branch Name -->
        
        <div class ="userPrompt grid_4 alpha">
            <label for="lName">Stock Code</label>
        </div>
        <div class="userInput grid_2">
            <input type="text" id="name" name="stockCode" value="<?php returnVal($formdata, 'stockCode') ?>" />
        </div>
        <div class ="error grid_3 omega">
            <span id="codeError"> <?php error($errors, 'stockCode') ?> </span>
        </div>
    </div><!-- close grid_12 ends name row on the grid-->
    

    <!-- This is the row for the Branch Address  -->

    <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for="qty">qty shares</label>
        </div>
        <div class="userInput grid_2">
            <input type="text" id="qty" name="qty" value="<?php returnVal($formdata, 'qty') ?>" />
        </div>
        <div class ="error grid_3 omega">
            <span id="addressError"> <?php error($errors, 'qty') ?> </span>
        </div>
    </div><!-- close grid_12 ends address on row the grid-->

    <!-- This is the row for the Branch phone  -->

    <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for="openPrice">Open Price</label>
        </div>
        <div class="userInput grid_2">
            <input type="text" id="phone" name="openPrice" value="<?php returnVal($formdata, 'openPrice') ?>" />
        </div>
        <div class ="error grid_3 omega">
            <span id="phoneError"> <?php error($errors, 'openPrice') ?> </span>
        </div>
    </div><!-- close grid_12 ends phone row on the grid-->
    
    <!-- This is the row for the Branch phone  -->

    <div class="row grid_12 top">
        <div class ="userPrompt grid_4 alpha">
            <label for="currentPrice">Current Price</label>
        </div>
        <div class="userInput grid_2">
            <input type="text" id="currentPrice" name="currentPrice" value="<?php returnVal($formdata, 'currentPrice') ?>" />
        </div>
        <div class ="error grid_3 omega">
            <span id="phoneError"> <?php error($errors, 'currentPrice') ?> </span>
        </div>
    </div><!-- close grid_12 ends phone row on the grid-->
        
    <div class="row">
                    <div class="label">
                        <label for="filename">Select image to upload:</label>
                    </div>
                    <div class="control">
                       
    <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                    <div class="error">
                        <span id="usernameError">
                            <?php echoValue($errors, 'filename'); ?>
                        </span>
                    </div>
                </div>


    <!-- This is the submit button for the form -->

    <div class ="submitter top grid_3 prefix_4">
        <input type="submit" id="submit" name ="sumbit" value="Submit" class="myButton">
    </div><!-- close submit button-->
</form>
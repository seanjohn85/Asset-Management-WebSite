
<!-- This is the row for the stock Id used by edit only this fieldd is always hidden from the use  -->
<input type="hidden" name="stockId" value="<?php echo $formdata['stockId']; ?>" />


<!--first input row-->
<div class="col-lg-12  col-md-12 field">
    
    <!--label and error message for stock name, repositions on data entry see js and css-->
    <label>
            Stock Name<span class="req">*</span>
            <span class="error" id="nameError"> <?php error($errors, 'stockName') ?> </span>
    </label>
    
    <!--input box for stock name-->
    <input class ="inbox" type="text" id="stockName" name="stockName" value="<?php returnVal($formdata, 'stockName') ?>"/>

</div><!--close first input row-->

<!--second input row-->
<div class="col-lg-12  col-md-12 field">
    
    <!--label and error message for stock code, repositions on data entry see js and css-->
    <label>
            Stock Code<span class="req">*</span>
            <span class="error" id="codeError"> <?php error($errors, 'stockCode') ?> </span>
    </label>
    
    <!--input box for stock code-->
    <input class ="inbox" type="text" id="stockCode" name="stockCode" value="<?php returnVal($formdata, 'stockCode') ?>" />

</div><!--close second input row-->

<!--third input row-->
<div class="col-lg-12  col-md-12 field">
    
    <!--label and error message for qty, repositions on data entry see js and css-->
    <label>
            Qty shares<span class="req">*</span>
            <span class="error" id="qtyError"> <?php error($errors, 'qty') ?> </span>
    </label>
    
    <!--input box for qty-->
    <input class ="inbox" type="text" id="qty" name="qty" value="<?php returnVal($formdata, 'qty') ?>" />

</div> <!--close third input row-->
    
<!--fourth input row-->
<div class="col-lg-12  col-md-12 field">
    
    <!--label and error message for open Price, repositions on data entry see js and css-->
    <label>
            Open Price<span class="req">*</span>
            <span class="error" id="openError"> <?php error($errors, 'openPrice') ?> </span>
    </label>
    <input class ="inbox" type="text" id="openPrice" name="openPrice" value="<?php returnVal($formdata, 'openPrice') ?>" />

</div><!--close fourth input row-->

<!--fifth input row-->
<div class="col-lg-12  col-md-12 field">
    
    <!--label and error message for current Price, repositions on data entry see js and css-->
    <label>
            Current Price
            <span class="error" id="currentError"> <?php error($errors, 'currentPrice') ?> </span>
    </label>
    <input class ="inbox" type="text" id="currentPrice" name="currentPrice" value="<?php returnVal($formdata, 'currentPrice') ?>" />

</div><!--close fifth input row-->

    <!-- This is the row for the Opening Hours  -->
<div class="col-lg-12  col-md-12 field file">
    <label class="selectBelow " for="filename">Select image to upload:
        <span class="error"  id="filenameError">
            <?php error($errors, 'filename') ?></span>
    </label>
    
    <div class="control">
                       
    <input type="file" name="fileToUpload" id="fileToUpload" value="<?php returnVal($formdata, 'logo') ?>" >
                    </div>

</div>

<!--final row submit button -->
<div class="col-lg-12  col-md-12 field">
  
    <!--submits this form id used by JS-->
    <button type="submit" value="Submit" id="submit" class="button button-block" />Submit</button>

</div>


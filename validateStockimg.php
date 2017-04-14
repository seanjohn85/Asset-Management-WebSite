<?php

//print_r($_POST);
function validate(&$formdata, &$errors) {

    $input_met = INPUT_POST;

    //sanatize data
    //creates a new array
    $formdata = array();


    //fills the array by geting the input by the name reference on the form and sanitizing to ensure a string was entered

    $formdata['stockId'] = filter_input($input_met, "stockId", FILTER_SANITIZE_STRING);
    $formdata['stockName'] = filter_input($input_met, "stockName", FILTER_SANITIZE_STRING);
    $formdata['stockCode'] = filter_input($input_met, "stockCode", FILTER_SANITIZE_STRING);
    $formdata['qty'] = filter_input($input_met, "qty", FILTER_SANITIZE_NUMBER_INT);
    $formdata['openPrice'] = filter_input($input_met, "openPrice", FILTER_SANITIZE_STRING);
    $formdata['currentPrice'] = filter_input($input_met, "currentPrice", FILTER_SANITIZE_STRING);
    $formdata['logo'] = filter_input($input_met, "fileToUpload");


    /* If this was an array an array
      $formdata['openDate'] = filter_input($input_met, "openDate", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
     */
    //print_r($formdata);
    //cretates the errors array
    $errors = array();


    //checks address and if void input error
    if ($formdata['stockName'] === Null || $formdata['stockName'] === False || $formdata['stockName'] === "") {
        $errors['stockName'] = "Stock Name is required";
    }
    
    //checks address and if void input error
    if ($formdata['stockCode'] === Null || $formdata['stockCode'] === False || $formdata['stockCode'] === "") {
        $errors['stockCode'] = "Stock Code is required";
    }

    //checks address and if void input error
    if ($formdata['qty'] === Null || $formdata['qty'] === False || $formdata['qty'] === "") {
        $errors['qty'] = "Qty shares is required";  
    }
    else if(!is_numeric($formdata['qty']))
    {
        $errors['qty'] = "Qty needs to be a whole number";
    }
    
    
    //checks address and if void input error
    if ($formdata['openPrice'] === Null || $formdata['openPrice'] === False || $formdata['openPrice'] === "") {
        $errors['openPrice'] = "Open Price is required";
    }
    else if(!is_numeric($formdata['openPrice']))
    {
        $errors['openPrice'] = "Open Price needs to be a number";
    }
    else
    {
        $formdata['openPrice'] =  number_format((float)$formdata['openPrice'], 2, '.', '');
    }
    
    //checks address and if void input error
    if ($formdata['currentPrice'] === Null || $formdata['currentPrice'] === False || $formdata['currentPrice'] === "") {
        $formdata['currentPrice'] = $formdata['openPrice'];
    }
    else if(!is_numeric($formdata['currentPrice']))
    {
        $errors['currentPrice'] = "Current Price needs to be a number";
    }
    else
    {
        $formdata['currentPrice'] =  number_format((float)$formdata['currentPrice'], 2, '.', '');
    }
    
    if (empty($errors)) 
    {
    
        $target_dir = "image/logos";

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $errors['f'] ="File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}


?>


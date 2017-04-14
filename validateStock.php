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
    $formdata['logo'] = filter_input($input_met, "filename");


    //print_r($formdata);
    //cretates the errors array
    $errors = array();


    //checks stockName and if void input error
    if ($formdata['stockName'] === Null || $formdata['stockName'] === False || $formdata['stockName'] === "") {
        $errors['stockName'] = "Stock Name is required";
    }
    
    //checks stockCode and if void input error
    if ($formdata['stockCode'] === Null || $formdata['stockCode'] === False || $formdata['stockCode'] === "") {
        $errors['stockCode'] = "Stock Code is required";
    }

    //checks qty and if void input error
    if ($formdata['qty'] === Null || $formdata['qty'] === False || $formdata['qty'] === "") {
        $errors['qty'] = "Qty shares is required";  
    }
    else if(!is_numeric($formdata['qty']))
    {
        $errors['qty'] = "Qty needs to be a whole number";
    }
    
    
    //checks openPrice and if void input error
    if ($formdata['openPrice'] === Null || $formdata['openPrice'] === False || $formdata['openPrice'] === "") {
        $errors['openPrice'] = "Open Price is required";
    }
    else if(!is_numeric($formdata['openPrice']))
    {
        $errors['openPrice'] = "Open Price needs to be a number";
    }
    else
    {
        //formats openPrice
        $formdata['openPrice'] =  number_format((float)$formdata['openPrice'], 2, '.', '');
    }
    
    //checks currentPrice and if void input error
    if ($formdata['currentPrice'] === Null || $formdata['currentPrice'] === False || $formdata['currentPrice'] === "") {
        $formdata['currentPrice'] = $formdata['openPrice'];
    }
    else if(!is_numeric($formdata['currentPrice']))
    {
        $errors['currentPrice'] = "Current Price needs to be a number";
    }
    else
    {
        //formats currentPrice
        $formdata['currentPrice'] =  number_format((float)$formdata['currentPrice'], 2, '.', '');
    }


$fileUploadError = array();
//image error msss
$fileUploadError[2] = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";

try {
    //checks for post method
    if ($_SERVER['REQUEST_METHOD'] !== "POST") {
        throw new Exception('Invalid request');
    }

    //checks if image is added
    if (!isset($_FILES["filename"])) {
        $errors['filename'] = "Filename required";
        throw new Exception("Filename required");
    }
    //checks for errors with the file
    if ($_FILES['filename']['error'] !== 0) {
        $errors['filename'] = $fileUploadError[$_FILES['filename']['error']];
        throw new Exception($fileUploadError[$_FILES['filename']['error']]);
    }

    //checks if file can be uploaded
    if (!is_uploaded_file($_FILES["filename"]["tmp_name"])) {
        $errors['filename'] = "Filename is not an uploaded file";
        throw new Exception("Filename is not an uploaded file");
    }
    //
    $imageInfo = getimagesize($_FILES["filename"]["tmp_name"]);
    if ($imageInfo === false) {
        $errors['filename'] = "File is not an image.";
        throw new Exception("File is not an image.");
    }

    //sets image properties
    $width = $imageInfo[0];
    $height = $imageInfo[1];
    $sizeString = $imageInfo[3];
    $mime = $imageInfo['mime'];

    //sets where the file will be stored
    $target_dir = "image/logos/";
    $target_file = $target_dir . basename($_FILES["filename"]["name"]);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    //checks if the file already excists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    //error if file excits 
    if (file_exists($target_file)) {
        $errors['filename'] = "Sorry, file already exists.";
        throw new Exception("Sorry, file already exists.");
    }
    //checks file size, sets max size
    if ($_FILES["filename"]["size"] > 1000000) {
        $errors['filename'] = "Sorry, your file is too large.";
        throw new Exception("Sorry, your file is too large.");
    }

    //sets file types
    if ($imageFileType != "jpg" &&
            $imageFileType != "png" &&
            $imageFileType != "jpeg" &&
            $imageFileType != "gif")
    {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }

    //uploads the file
    if (!move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
        $errors['filename'] = "Sorry, there was an error uploading your file.";
        throw new Exception("Sorry, there was an error uploading your file.");
    }

    //not usesd
    //echo '<img src="'.$target_file.'" '.$sizeString.'>';
    }
    catch (Exception $e) 
    {
        if (!empty($errors)) 
        {
            //require 'index.php';
            //$formdata['logo'] = $_FILES["filename"];
        }
        else 
        {
            die($e->getMessage());
        }
    }
}

?>


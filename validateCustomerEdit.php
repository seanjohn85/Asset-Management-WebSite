<?php

//print_r($_POST);
function validate(&$formdata, &$errors) {

    $input_met = INPUT_POST;

    //sanatize data
    //creates a new array
    $formdata = array();


    //fills the array by geting the input by the name reference on the form and sanitizing to ensure a string was entered

    $formdata['customerNo'] = filter_input($input_met, "customerNo", FILTER_SANITIZE_STRING);
    $formdata['branchNo'] = filter_input($input_met, "branchNo", FILTER_SANITIZE_STRING);
    $formdata['fName'] = filter_input($input_met, "fName", FILTER_SANITIZE_STRING);
    $formdata['lName'] = filter_input($input_met, "lName", FILTER_SANITIZE_STRING);
    $formdata['address'] = filter_input($input_met, "address", FILTER_SANITIZE_STRING);
    $formdata['gender'] = filter_input($input_met, "gender", FILTER_SANITIZE_STRING);
    $formdata['mobileNo'] = filter_input($input_met, "mobileNo", FILTER_SANITIZE_STRING);
    $formdata['email'] = filter_input($input_met, "email", FILTER_SANITIZE_EMAIL);

    /* If this was an array an array
      $formdata['openDate'] = filter_input($input_met, "openDate", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
     */
    //print_r($formdata);
    //cretates the errors array
    $errors = array();

    //checks for a name and if no name input error
    if ($formdata['fName'] === Null || $formdata['fName'] === False || $formdata['fName'] === "") {
        $errors['fName'] = "Forename required";
    }
    
    //checks for a name and if no name input error
    if ($formdata['lName'] === Null || $formdata['lName'] === False || $formdata['lName'] === "") {
        $errors['lName'] = "Forename required";
    }

    //checks address and if void input error
    if ($formdata['address'] === Null || $formdata['address'] === False || $formdata['address'] === "") {
        $errors['address'] = "Branch Address is required";
    }

    //checks if a valid option is entered for manager if not imputs error

    $gender = array("male", "female");

    if ($formdata['gender'] === Null || $formdata['gender'] === False || $formdata['gender'] === "") {
        $errors['gender'] = "Please select if you would like to add a gender";
    } elseif (!in_array($formdata['gender'], $gender)) {
        $errors['gender'] = "Please select male or female";
    }


    //checks for a valid webpage and inputs error

    if ($formdata['email'] !== Null || $formdata['email'] !== False || $formdata['email'] !== "") {
        if (!filter_var($formdata['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email";
        }
    }

    //checks for valid phone no and if in valid inputs error

    if ($formdata['mobileNo'] != Null || $formdata['mobileNo'] != False || $formdata['mobileNo'] !== "") {
        $phone = ($formdata['mobileNo']);
        if (!preg_match("/^[0-9]{3}-[0-9]{7}$/", $phone)) {
            $errors['mobileNo'] = "Mobile number must in format eg 087-5555555";
        }
    }


}

?>


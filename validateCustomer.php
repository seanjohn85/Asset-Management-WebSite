<?php
require_once 'classes/User.php';
require_once 'classes/DB.php';
require_once 'classes/UserTable.php';

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
    $formdata['username'] = filter_input($input_met, "username", FILTER_SANITIZE_STRING);
    $formdata['password'] = filter_input($input_met, "password", FILTER_SANITIZE_STRING);
    $formdata['cpassword'] = filter_input($input_met, "cpassword", FILTER_SANITIZE_STRING);

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

    

    //checks for valid phone no and if in valid inputs error

    if ($formdata['mobileNo'] != Null || $formdata['mobileNo'] != False || $formdata['mobileNo'] !== "") {
        $phone = ($formdata['mobileNo']);
        if (!preg_match("/^[0-9]{3}-[0-9]{7}$/", $phone)) {
            $errors['mobileNo'] = "Mobile number must in format eg 087-5555555";
        }
    }
    
     // throw an exception if any of the form fields 
    // are empty
    if ($formdata['email'] === Null || $formdata['email'] === False || $formdata['email'] === "") {
        if (!filter_var($formdata['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email";
        }
        else{
        $errors['email'] = "email required";
    }
    
    }
 else {
        $connection = Connection::getInstance();
        
        $userTable = new UserTable($connection);
        $user = $userTable->getUserByUsername($formdata['email']);

        // since password fields match, see if the username
        // has already been registered - if it is then throw
        // and exception
        if ($user != null) 
        {
            $errors['email'] = "Username already registered";
        }
    }
    //$email = filter_var($formdata['username'], FILTER_VALIDATE_EMAIL);
    //if ($email != $formdata['username']) {
    //    $errors['username'] = "Valid email required required";
    //}

    if (empty($formdata['password'])) {
        $errors['password'] = "Password required";
    }
    if (empty($formdata['cpassword'])) {
        $errors['cpassword'] = "Confirm password required";
    }
    // if the password fields do not match 
    // then throw an exception
    if (!empty($formdata['password']) && !empty($formdata['cpassword']) 
            && $formdata['password'] != $formdata['cpassword']) {
        $errors['password'] = "Passwords must match";
    }


}

?>


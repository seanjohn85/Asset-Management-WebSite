<?php

//print_r($_POST);
function validate(&$formdata, &$errors) {

    $input_met = INPUT_POST;

    //sanatize data
    //creates a new array
    $formdata = array();


    //fills the array by geting the input by the name reference on the form and sanitizing to ensure a string was entered

    $formdata['branchNo'] = filter_input($input_met, "branchNo", FILTER_SANITIZE_STRING);
    $formdata['name'] = filter_input($input_met, "name", FILTER_SANITIZE_STRING);
    $formdata['address'] = filter_input($input_met, "address", FILTER_SANITIZE_STRING);
    $formdata['manager'] = filter_input($input_met, "manager", FILTER_SANITIZE_STRING);
    $formdata['opening'] = filter_input($input_met, "opening", FILTER_SANITIZE_STRING);
    $formdata['openDate'] = filter_input($input_met, "openDate", FILTER_SANITIZE_STRING);
    $formdata['phone'] = filter_input($input_met, "phone", FILTER_SANITIZE_STRING);
    $formdata['webpage'] = filter_input($input_met, "webpage", FILTER_SANITIZE_URL);

    /* If this was an array an array
      $formdata['openDate'] = filter_input($input_met, "openDate", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
     */
    //print_r($formdata);
    //cretates the errors array
    $errors = array();

    //checks for a name and if no name input error
    if ($formdata['name'] === Null || $formdata['name'] === False || $formdata['name'] === "") {
        $errors['name'] = "Branch name required";
    }

    //checks address and if void input error
    if ($formdata['address'] === Null || $formdata['address'] === False || $formdata['address'] === "") {
        $errors['address'] = "Branch Address is required";
    }

    //checks if a valid option is entered for manager if not imputs error

    $manager = array("yes", "no");

    if ($formdata['manager'] === Null || $formdata['manager'] === False || $formdata['manager'] === "") {
        $errors['manager'] = "Please select if you would like to add a manager";
    } elseif (!in_array($formdata['manager'], $manager)) {
        $errors['manager'] = "Please select yes or no";
    }

    //checks if a valid opening hours is entered and inputs error if not valid

    $openHours = array("8 to 4", "8 to 6", "9 to 4", "9 to 6", "10 to 6", "10 to 8");

    if ($formdata['opening'] === Null || $formdata['opening'] === False || $formdata['opening'] === "") {
        $errors['opening'] = "Please enter the opening hours";
    } elseif (!in_array($formdata['opening'], $openHours)) {
        $errors['opening'] = "Please select open hours from the provided list";
    }

    //checks for a valid open date and inputs error

    if ($formdata['openDate'] !== NULL && $formdata['openDate'] !== FALSE && $formdata['openDate'] !== "") {
        $date = explode('/', $formdata['openDate']);
        if (count($date) !== 3 || !checkdate($date[1], $date[0], $date[2])) {
            $errors['openDate'] = "Invalid date format: dd/mm/yyyy expected";
        }
    }

    //checks for a valid webpage and inputs error

    if ($formdata['webpage'] !== Null || $formdata['webpage'] !== False || $formdata['webpage'] !== "") {
        if (!filter_var($formdata['webpage'], FILTER_VALIDATE_URL)) {
            $errors['webpage'] = "Invalid webpage";
        }
    }

    //checks for valid phone no and if in valid inputs error

    if ($formdata['phone'] != Null || $formdata['phone'] != False || $formdata['phone'] !== "") {
        $phone = ($formdata['phone']);
        if (!preg_match("/^[0-9]{3}-[0-9]{7}$/", $phone)) {
            $errors['phone'] = "Phone number must in format eg 021-5555555";
        }
    }

    //reformats the date if there are no errors on the form
    if (empty($errors)) {
    $formdata['openDate'] = $date[2] . "-" . $date[1] . "-" . $date[0];
    }

}

?>


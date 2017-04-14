<?php

/*checks to see if the form has already been submitted 
using the formdata array in the validate php file if not formdata and 
errors are created to avoid php errors*/
  
//if formadat is not set it is created here
if (!isset($formdata)) 
{
    $formdata = array();
    $formdata['webpage'] = "http://";
}
//if the errors arry is not set ti is created here
if (!isset($errors)) 
{
    $errors = array();
}
?>

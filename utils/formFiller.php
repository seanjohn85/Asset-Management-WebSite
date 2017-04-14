<?php

//checks if an item is set from a multiple select feild
 function returnVal($array, $feildName) 
    {
        if (isset($array) && isset($array[$feildName])) 
        {
            echo $array[$feildName];
        }
    }

    //checks for checked
    function checked($list, $formdata, $value) 
    {
        if (isset($list[$formdata]) && $list[$formdata] == $value) 
        {
            echo 'checked = "checked"';
        }
    }

    //checks for selected
    function selected($array, $fieldName, $value) 
    {
        if ((isset($array[$fieldName])) && $array[$fieldName] == $value) 
        {
            echo 'selected="selected"';
        }
    }
    
    //checks for errors

    function error($errors, $feild) 
    {
        if (isset($errors[$feild])) 
        {
            echo $errors[$feild];
        }
    }
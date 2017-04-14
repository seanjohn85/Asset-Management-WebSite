/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//this is true when no errors are found
var valid = true;

window.onload = function ()
{
    //checks if input is correct 
    function checkText(value, error, message)
    {
        if (value === "" || value === null)
        {
            error.innerHTML = message;
            //alert (name);
            return false;
        }
        else {
            return true;
        }
    }

    //checks if a phone numer is valid removes everything except numbers and makes sure max lenght is 10
    function phoneNo(phoneNum)
    {
        var val = /^\d{3}-\d{7}$/;
        return val.test(phoneNum);
    }

    //checks if a number is valid not used
//   function isNum(n)
//   {
//       return !isNaN(parseInt(n) && isFinite(n));
//   }

    //checks if the date is valid format
    function dateFormat(date)
    {
        var check = /^\d{2}\/\d{2}\/\d{4}$/;
        return check.test(date);
    }

    //checks if its a leap year
    function validDate(date)
    {
        var parts = date.split("/");
        var day = parseInt(parts[0], 10);
        var month = parseInt(parts[1], 10);
        var year = parseInt(parts[2], 10);

        var monthLength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        if (year % 400 === 0 || (year % 100 !== 0 && year % 4 === 0))
        {
            monthLength[1] = 29;
        }

        return (year >= 1000 && year <= 3000 && month >= 1 && month
                <= 12 && day >= 1 && day <= monthLength[month - 1]);
    }

    //checks for valid url
    function validSite(url)
    {
        var pattern = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
        return pattern.test(url);
    }
    
    //gets the submit button
    var submit = document.getElementById('submit');

    //checks if submit is clicked
    submit.addEventListener("click", function (event)
    {
        //alert("tester");



        //error elements in the form
        var nameErrorEl = document.getElementById("nameError");
        var addressErrorEl = document.getElementById("addressError");
        var managerErrorEl = document.getElementById("managerError");
        var openingErrorE = document.getElementById("openingError");
        var phoneErrorEl = document.getElementById("phoneError");
        var openDateErrorEl = document.getElementById("openDateError");
        var webpageErrorEl = document.getElementById("webpageError");

        //clear previous errors
        nameErrorEl.innerHTML = "";
        addressErrorEl.innerHTML = "";
        managerErrorEl.innerHTML = "";
        openingErrorE.innerHTML = "";
        phoneErrorEl.innerHTML = "";
        openDateErrorEl.innerHTML = "";
        webpageErrorEl.innerHTML = "";

        //input elements

        var nameFeild = document.getElementById("name");
        var addressFeild = document.getElementById("address");
        var managerFeild = document.getElementsByName('manager');

        var openingFeild = document.getElementsByName('opening');
        //console.log(openingFeild);
        var phoneFeild = document.getElementById("phone");
        var openDateFeild = document.getElementById("openDate");
        var webpageFeild = document.getElementById("webpage");
//        
//        //get values from veilds
        var name = nameFeild.value;
        var address = addressFeild.value;
        var phone = phoneFeild.value;
        var openDate = openDateFeild.value;
        var webpage = webpageFeild.value;


        //check if input is checked in managerfeild
        var selected = false;
        for (var i = 0; i !== managerFeild.length; i++)
        {
            if (managerFeild[i].checked)
            {
                selected = true;

                break;
            }
        }
        if (!selected)
        {
            managerErrorEl.innerHTML = "Please select yes or no js";
            valid = false;
        }


        //checks if something is selected in openingFeild

        if (openingFeild.selectedIndex === -1)
        {
            openingErrorE.innerHTML = "Please select an option js";
            valid = false;
        }


        //check if phone number is input

        if (phone !== "")
        {
            if (!phoneNo(phone))
            {

                phoneErrorEl.innerHTML = "Phone number must in format eg 021-5555555 js";
                valid = false;
            }

        }

        //checks the date using the date format above
        if (openDate === "" && !dateFormat(openDate))
        {
            openDateErrorEl.innerHTML = "Invalid date format: dd/mm/yyyy expected js";
            valid = false;
        }
        else if (openDate === "" && !validDate(openDate))
        {
            openDateErrorEl.innerHTML = "Invalid date js";
            valid = false;
        }

        if (webpage !== "" && !validSite(webpage))
        {
            webpageErrorEl.innerHTML = "Invalid webpage js";
        }

        //checks normal text feilds
        valid = checkText(name, nameErrorEl, "Branch name required js");
        valid = checkText(address, addressErrorEl, "Branch address required js");



        ///if errors are found block submit button
        if (!valid)
        {
            event.preventDefault();
        }
    });

};
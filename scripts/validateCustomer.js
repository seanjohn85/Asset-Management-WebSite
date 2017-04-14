
/* 
 * John Kenny N00145905
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
            valid = false;
        }

    }
    
    //checks if a number is valid not used
    function isNum(n)
    {
        return !isNaN(parseInt(n) && isFinite(n));
    }


    //gets the submit button
    var submit = document.getElementById('submit');

    //checks if submit is clicked
    submit.addEventListener("click", function (event)
    {
        //alert("tester");


        console.log("valid");

        //error elements in the form
        var fnameErrorEl = document.getElementById("fnameError");
        var snameErrorEl = document.getElementById("snameError");
        var addressErrorEl = document.getElementById("addressError");
        var genderErrorEl = document.getElementById("genderError");
        var branchNoErrorEl = document.getElementById("branchNoError");
        var phoneErrorEl = document.getElementById("phoneError");
        var emailErrorEl = document.getElementById("emailError");


        //clear previous errors
        fnameErrorEl.innerHTML = "";
        snameErrorEl.innerHTML = "";
        addressErrorEl.innerHTML = "";
        genderErrorEl.innerHTML = "";
        branchNoErrorEl.innerHTML = "";
        phoneErrorEl.innerHTML = "";
        emailErrorEl.innerHTML = "";

        //input elements
        var fNameFeild = document.getElementById("fname");
        var sNameFeild = document.getElementById("sname");
        var addressFeild = document.getElementById("address");
        var genderFeild = document.getElementsByName('gender');
        var branchNoFeild = document.getElementsByName("branchNo");
        var phoneFeild = document.getElementById("phone");
        var emailFeild = document.getElementById("email");

        
        //get values from veilds
        var fname = fNameFeild.value;
        var sname = fNameFeild.value;
        var address = addressFeild.value;
        var phone = phoneFeild.value;
        var email = emailFeild.value;


        //checks normal text feilds
        checkText(fname, fnameErrorEl, "First name required");

        checkText(sname, snameErrorEl,  "Surname required");

        checkText(address, addressErrorEl, "Address is required");
        
        
        
        //check if input is checked in genderfeild
        var selected = false;
        for (var i = 0; i !== genderFeild.length; i++)
        {
            //checks each radio button
            if (genderFeild[i].checked)
            {
                //if one is selected sets selected to true breaks the loop
                selected = true;
                break;
            }
        }
        //if no gender is selected
        if (!selected)
        {
            //inputs error valid to fales
            genderErrorEl.innerHTML = "Please select male of female ";
            valid = false;
        }
        
        //checks normal text feilds
        checkText(phone, phoneErrorEl, "Phone is required");
        
        
        console.log(valid);

        valid= false;
        
        //checks ifa branch is selected from the dropdown as index will be greater than -1 if selected
        if (branchNoFeild.selectedIndex === -1)
        {
            branchNoErrorEl.innerHTML = "Please select a branch";
            valid = false;
        }
        
        //email validator
        //finds @ symbol
        var atpos = email.indexOf("@");
        //finds the last . of the email string
        var dotpos = email.lastIndexOf(".");
        //checks the @ is not the first char and the . is after the @ symbol
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) 
        {
            //alert("Not a valid e-mail address");
            emailErrorEl.innerHTML = "Not a valid e-mail address";
            valid = false;
        }

        ///if errors are found block submit button
        if (!valid)
        {
            event.preventDefault();
        }
    });

};
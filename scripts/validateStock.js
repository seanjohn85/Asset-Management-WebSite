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
            valid = false;
        }

    }
    
    function validateImage(image, filenameErrorEl)
{
var extensions = new Array("jpg","jpeg","gif","png");

 
var image_file = image;
 
var image_length = image.length;
 
var pos = image_file.lastIndexOf('.') + 1;
 
var ext = image_file.substring(pos, image_length);
 
var final_ext = ext.toLowerCase();
 
for (i = 0; i < extensions.length; i++)
{
    if(extensions[i] == final_ext)
    {
        return true;
    }
}
    
   filenameErrorEl.innerHTML =
        "You must upload an image file with one of the following extensions: "+ extensions.join(', ') +".";
    return false;
}

    function validateFile(file, error, message)
    {
        var allowedExt = ['jpeg', 'jpg', 'gif', ''];
        var fileExtension = file.value.split('.').pop().toLowerCase();


        for (var index in allowedExt) {

            if (fileExtension !== allowedExt[index]) {
                error.innerHTML = message;
                valid = false;
                break;
            }
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
        var nameErrorEl = document.getElementById("nameError");
        var codeErrorEl = document.getElementById("codeError");
        var qtyErrorEl = document.getElementById("qtyError");
        var openErrorEl = document.getElementById("openError");
        var currentErrorEl = document.getElementById("currentError");
        var filenameErrorEl = document.getElementById("filenameError");


        //clear previous errors
        nameErrorEl.innerHTML = "";
        codeErrorEl.innerHTML = "";
        qtyErrorEl.innerHTML = "";
        openErrorEl.innerHTML = "";
        currentErrorEl.innerHTML = "";
        filenameErrorEl.innerHTML = "";

        //input elements

        var stockNameFeild = document.getElementById("stockName");
        var stockCodeFeild = document.getElementById("stockCode");
        var qtyFeild = document.getElementById("qty");
        var openPriceFeild = document.getElementById("openPrice");
        var currentPriceFeild = document.getElementById("currentPrice");
        var fileToUploadFeild = document.getElementById("fileToUpload");

//        
//        //get values from veilds
        var name = stockNameFeild.value;
        var code = stockCodeFeild.value;
        var qty = qtyFeild.value;
        var file = fileToUploadFeild.value;
        var openPrice = openPriceFeild.value;
        var currentPrice = currentPriceFeild.value;


        // alert(isNum(qty));

        checkText(name, nameErrorEl, "Stock name is required");
        checkText(code, codeErrorEl, "Stock code is required");

        //checks if qty is blank
        if (qty === "" || qty === null)
        {
            //qty error
            qtyErrorEl.innerHTML = "Please enter a qty of available shares";
            //sets vaild to false
            valid = false;
        }
        //ensures the qty entered is a number using the number function above
        else if (!isNum(qty))
        {
            //qty error
            qtyErrorEl.innerHTML = "Qty must be a whole number";
            //sets vaild to false
            valid = false;
        }

        //checks if qty is blank
        if (openPrice === "" || openPrice === null)
        {
            //qty error
            openErrorEl.innerHTML = "Open price must be set to a number";
            //sets vaild to false
            valid = false;
        }
        //ensures the qty entered is a number using the number function above
        else if (!isNum(openPrice))
        {
            //qty error
            openErrorEl.innerHTML = "Qty must be a number (max 2 decimal places)";
            //sets vaild to false
            valid = false;
        } 
        
        
        //checks if qty is blank
        if (currentPrice === "" || currentPrice === null)
        {
            
        }
        else if (!isNum(currentPrice))
        {
            //qty error
            currentErrorEl.innerHTML = "Qty must be a number (max 2 decimal places)";
            //sets vaild to false
            valid = false;
        }
   
      
        var temp = validateImage(file, filenameErrorEl);
        if(temp == false)
        {
            valid = false;
        }
        
        console.log(valid);



        ///if errors are found block submit button
        if (!valid)
        {
            event.preventDefault();
        }
    });

};
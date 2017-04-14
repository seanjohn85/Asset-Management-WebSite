/*
 * This function handels inputs and textareas of the form class
 * when the user enters data in real time to a from element the
 * labels are moved by adding a ccs class to them. conituesly loops
*/
$('.form').find('input, textarea').on('keyup blur focus', function (e) 
{
    'use strict';

    //checks the current lable matching the input on this run of the loop
    var $this = $(this),
        label = $this.prev('label');
    //if a key is pressed    
    if (e.type === 'keyup') 
    {
        //if the input feild is blank
        if ($this.val() === '') 
        {
            //remove class leaving label in text box
            label.removeClass('active highlight');
        } 
        else 
        {
            //add class to move the label
            label.addClass('active highlight');
        }
    } 
    //if input leaves focus
    else if (e.type === 'blur') 
    {
        if ($this.val() === '') 
        {
            //remove class leaving label in text box
            label.removeClass('active highlight');
        } 
        else 
        {
            //add class to move the label
            label.removeClass('highlight');
        }
    } 
    //if page is focued on this input
    else if (e.type === 'focus') 
    {

        if ($this.val() === '') 
        {
            //remove class leaving label in text box
            label.removeClass('highlight');
        } 
        else if ($this.val() !== '') 
        {
            //add class to move the label
            label.addClass('highlight');
        }
    }

});//end of this function

/* this function is used to move the lables under the text box if the text box contains data
 * if data is contained in an input box a class is added and css for this class moves the 
 * label. Mainly used for edit or failed valiation where input when have a value on page load
 * */
$(function () 
{
    $(document).ready(function () 
    {
        //gets all the inputs and textareas from the form class and loops through them
        $(".form input, textarea").each(function () 
        {
            //checks the current lable matching the input on this run of the loop
            var $this = $(this),
            label = $this.prev('label');

            //checks to see if the input box has any value
            if ($this.val() === '') 
            {
                /*if there is no value the class active highlight is removed meaning
                 * the lablle will be placed in the input box
                 * */
                label.removeClass('active highlight');
            } 
            else 
            {
                /*if there is a value in the input the class active highlight is added meaning
                 * the label will be placed in the input box by the css suing these classes
                 * */
                label.addClass('active highlight');
            }

        });
        return false;
    });
});

/*this is used to active the footable library on 
 * tables with the class footable*/
$(document).ready(function()
{
    $('.footable').footable();
         
});

/*this is used to active the owlCarousel by using the 
 * our-stocks id as an indicator */
$(document).ready(function() 
{
    $("#our-stocks").owlCarousel();  
});

/*fixes broken images*/
$(window).bind('load', function() 
{
    //selects each img tag
    $('img').each(function() 
    {
        //checks for image loading errors
        if((typeof this.naturalWidth != "undefined" &&
            this.naturalWidth == 0 ) 
            || this.readyState == 'uninitialized' ) 
        {
            //if an image doesnt load replace it with this image
            $(this).attr('src', 'image/logos/stock.png');
        }
    }); 
});//close this function
window.onload = function () 
{
    /*
     * this fuction checks if a delete stock is clicked and alerts a confrim when clicked
     */
    
    //gets all delete links
    var deleteLinks = document.getElementsByClassName("delete");
    //loops through each link
    for (var i = 0; i != deleteLinks.length; i++) 
    {
        var link = deleteLinks[i];
        //waits for a click event
        link.addEventListener("click", function (event) 
        {
            //alerts confirm message
            var deleteConfirmed = confirm("Are you sure you want to delete this stock?");
            //if not confirmed blocks delete
            if (!deleteConfirmed) 
            {
                event.preventDefault();
            }
        });
    }
  
}//close function
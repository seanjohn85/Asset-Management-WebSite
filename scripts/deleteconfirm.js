window.onload = function () 
{
    /*
     * this fuction checks if a delete stock is clicked and alerts a confrim when clicked
     */
    
    var deleteLinks = document.getElementsByClassName("delete");
    for (var i = 0; i != deleteLinks.length; i++) 
    {
        var link = deleteLinks[i];
        link.addEventListener("click", function (event) 
        {
            var deleteConfirmed = confirm("Are you sure you want to delete this branch?");
            if (!deleteConfirmed) 
            {
                event.preventDefault();
            }
        });
    }
    
    
}
   
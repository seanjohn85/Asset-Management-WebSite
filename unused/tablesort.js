
window.onload = function()
{

// This is a search filter I found  an online turorial 

	var recapFilters = {
		sort_select: true,
		loader: true,
		col_1: "select", 
		on_change: true,
		display_all_text: " [ Show all ] ",
		rows_counter: true,
		btn_reset: true,
		alternate_rows: true,
		btn_reset_text: "Clear",
		col_width: ["150px","150px",null,null]
	}
	setFilterGrid("recap",recapFilters);
//]]>


     /*
     * this fuction checks if a delete bos is clicked and alerts a confrim when clicked
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



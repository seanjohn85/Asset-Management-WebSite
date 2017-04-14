//used to style radio buttons
$(document).ready(function()
{
  //;oops through each input box  
  $('input').each(function()
  {
    //gets the label of the current inpur
    var self = $(this),
      label = self.next(),
      label_text = label.text();

    //removes label  
    label.remove();
    //uses icheck css and script to style if its a radio or check box
    self.iCheck(
    {
      checkboxClass: 'icheckbox_line-green',
      radioClass: 'iradio_line-green',
      insert: '<div class="icheck_line-icon"></div>' + label_text
    });
  });
});//end function


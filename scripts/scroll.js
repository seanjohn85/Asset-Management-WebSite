

// Add scrollspy to <body> with an offset off 50px size of shrinked nav
//reloads section animation with new wow
$('body').scrollspy({target: ".navbar", offset: 50}, $(".scrollTop a").scrollTop(),(new WOW).init());

/* function to resize the nav bar on scroll*/
$(window).scroll(function() 
{
    //if the page scrolls over 50px
    if ($(document).scrollTop() > 50) 
    {
       //add the shink class new css styles applied 
      $('nav').addClass('shrink');
    } 
    //required for reverse scrolling
    else 
    {
      //if not below 50px remove this class going back to default
      $('nav').removeClass('shrink');
    }
});


// Add smooth scrolling to all links inside a navbar with the smooth class
//only used for internal page links
$(".smooth").on('click', function(event)
{

  // Prevent default anchor click behavior
  event.preventDefault();

  // Store hash (#)
  var hash = this.hash;

  // Using jQuery's animate() method to add smooth page scroll
  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area (the speed of the animation)
  $('html, body').animate(
  {
    scrollTop: $(hash).offset().top
  }, 800, function()
  {
    // Add hash (#) to URL when done scrolling (default click behavior)
    window.location.hash = hash;
  });
});

/*collapses menu when link selected on mobile menus*/
$(document).on('click','.navbar-collapse.in',function(e) 
{
    //if a link is selected from dropdown-toggle menu
    if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) 
    {
        //collapse this menu
        $(this).collapse('hide');
    }
});
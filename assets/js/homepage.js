//sliding photos
$(document).ready(function() {
 
  $("#banner-slider").owlCarousel({
 
      navigation : true, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
      autoPlay : true,
 
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
      
      navigationText : ["<i class='fa fa-3x fa-arrow-circle-left'></i>","<i class='fa fa-3x fa-arrow-circle-right'></i>"]
  });
 
});
// for the events slider

$(document).ready(function()
{
    $("#events").tinycarousel({
       animation : true,
       animationTime: 1000,
       interval : true,
       intervalTime : 3000, 
       axis: 'y',
    });

    $("#news").tinycarousel({
       animation : true,
       animationTime: 1000,
       interval : true,
       intervalTime : 3000, 
       axis: 'y',
    });

    $("#minutes").tinycarousel({
       animation : true,
       animationTime: 1000,
       interval : true,
       intervalTime : 3000, 
       axis: 'y',
    });
     $("#discussion").tinycarousel({
       animation : true,
       animationTime: 1000,
       interval : true,
       intervalTime : 3000, 
       axis: 'y',
    });
});
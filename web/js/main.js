/*Headhesive.js An on-demand sticky header. https://github.com/markgoodyear/headhesive.js/tree/master*/
// Options
var options = {offset: 500}

// Create a new instance of Headhesive
var header = new Headhesive('.menu', options);




/*Resume section timeline animation*/
$(window).scroll(function(){				 
	$('.timeline_container p').each(function(){
    	var scrollTop     = $(window).scrollTop(),
        	elementOffset = $(this).offset().top,
       		distance      = (elementOffset - scrollTop),
			    windowHeight  = $(window).height(),
			    breakPoint    = windowHeight*0.9;

			if(distance > breakPoint) {
				$(this).addClass("more-padding");	
			}  if(distance < breakPoint) {
				$(this).removeClass("more-padding");	
			}
	});
});
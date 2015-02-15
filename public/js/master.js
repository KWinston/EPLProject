var config = 
{
	'.chosen-select'           : {},
  	'.chosen-select-deselect'  : {allow_single_deselect: true},
  	'.chosen-select-no-single' : {disable_search_threshold:10},
  	'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
  	'.chosen-select-width'     : {width:"95%"}
}

$('.slideout-menu-toggle').on('click', function(event){
	event.preventDefault();
	// create menu variables
	var slideoutMenu = $('.slideout-menu');
	var slideoutMenuWidth = $('.slideout-menu').width();
	
	// toggle open class
	slideoutMenu.toggleClass("open");
	
	// slide menu
	if (slideoutMenu.hasClass("open")) {
    	slideoutMenu.animate({
	    	right: "0px"
    	});	
	} else {
    	slideoutMenu.animate({
	    	right: -slideoutMenuWidth
    	}, 250);	
	}
});
		    
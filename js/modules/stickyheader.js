$(window).scroll(function(){
	if ($(this).scrollTop() > 100) {
	$('nav').addClass("sticky");
	} else {
	$('nav').removeClass("sticky");
	}
});
$(function(){
	//Keep track of last scroll
	var lastScroll = 0;
	$(window).scroll(function(event){
	 //Sets the current scroll position
	 var st = $(this).scrollTop();
	 //Determines up-or-down scrolling
	 if (st > lastScroll){
	    //Replace this with your function call for downward-scrolling
	    $('nav').addClass("sticky");
	 }
	 else {
	    //Replace this with your function call for upward-scrolling
	    $('nav').removeClass("sticky");
	 }
	 //Updates scroll position
	 lastScroll = st;
	});
});
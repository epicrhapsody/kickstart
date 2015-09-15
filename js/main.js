$(function() {
    FastClick.attach(document.body);
});

$(document).ready(function() {
	$('section').fitVids();
	$('input, textarea').placeholder();
});

$("").on('touch click', function(){
    var $this = $("");
    if ($this.hasClass("inactive")) {
		//Do stuff
    }
    else {
		//Do stuff
    }
});

$(window).on('load resize', function(){
	if ($(window).width() <= 767){
		//Do stuff
	} else {
		//Do stuff
	}
});

$(document).keyup(function(e) {
     if (e.keyCode == 27) { // escape key maps to keycode `27`
		//Do stuff
    }
});

$(document).keyup(function(e) {
     if (e.keyCode == 80) { // escape key maps to keycode `80`
		//Do stuff
    }
});
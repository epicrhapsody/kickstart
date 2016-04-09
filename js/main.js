$(document).ready(function() {
	$('.scrollToTop').toggleClass("hide");
	$('section').fitVids();
	$('input, textarea').placeholder();
	$('#form').validate();
});

$(window).scroll(function(){
	if ($(this).scrollTop() > 300) {
		$('.scrollToTop').addClass("show").removeClass("hide").removeClass('fadeOutRight').addClass('animated fadeInRight');
		$('nav').addClass("sticky");
	} else {
		$('.scrollToTop').addClass("hide").removeClass("show").removeClass("fadeInRight").addClass('fadeOutRight');
		$('nav').removeClass("sticky");
	}
});

$('.scrollToTop').click(function(){
	$('html, body').animate({scrollTop : 0},350);
	return false;
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

$(document).ready(function() {
    if ($.cookie('cookiename')) $('').hide();
    else {
        $('').click(function() {
            $('').addClass("hidden");
			var date = new Date();
			date.setTime(date.getTime() + (60 * 1000));
            $.cookie('cookiename', true, { expires: date });    
        });
    }
});

$('').on('touch click', function(){
    $.removeCookie('cookiename');
});
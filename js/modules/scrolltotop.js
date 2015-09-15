$(document).ready(function() {
	$('.scrollToTop').toggleClass("hide");
});

$(window).scroll(function(){
	if ($(this).scrollTop() > 300) {
$('.scrollToTop').addClass("show").removeClass("hide").removeClass('fadeOutRight').addClass('animated fadeInRight');
	} else {
$('.scrollToTop').addClass("hide").removeClass("show").removeClass("fadeInRight").addClass('fadeOutRight');
	}
});

$('.scrollToTop').click(function(){
	$('html, body').animate({scrollTop : 0},350);
	return false;
});
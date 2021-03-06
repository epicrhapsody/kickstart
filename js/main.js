$(document).ready(function() {
	$('.scrollToTop').toggleClass("hide");
	$('section').fitVids();
	$('input, textarea').placeholder();
	$('#form').validate();
	$.extend( $.validator.messages, {
	required: "Pflichtangabe",
	maxlength: $.validator.format( "Geben Sie bitte maximal {0} Zeichen ein." ),
	minlength: $.validator.format( "Geben Sie bitte mindestens {0} Zeichen ein." ),
	rangelength: $.validator.format( "Geben Sie bitte mindestens {0} und maximal {1} Zeichen ein." ),
	email: "Keine gültige E-Mail Adresse.",
	url: "Geben Sie bitte eine gültige URL ein.",
	date: "Bitte geben Sie ein gültiges Datum ein.",
	number: "Geben Sie bitte eine Nummer ein.",
	digits: "Geben Sie bitte nur Ziffern ein.",
	equalTo: "Bitte denselben Wert wiederholen.",
	range: $.validator.format( "Geben Sie bitte einen Wert zwischen {0} und {1} ein." ),
	max: $.validator.format( "Geben Sie bitte einen Wert kleiner oder gleich {0} ein." ),
	min: $.validator.format( "Geben Sie bitte einen Wert größer oder gleich {0} ein." ),
	creditcard: "Geben Sie bitte eine gültige Kreditkarten-Nummer ein."
});
$.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg != value;
 }, "Value must not equal arg.");

 // configure your validation
 $("#form").validate({
  rules: {
   SelectName: { valueNotEquals: "-1" }
  },
  messages: {
   SelectName: { valueNotEquals: "Please select an item!" }
  }
 });
});

$(window).scroll(function(){
	if ($(this).scrollTop() > 100) {
		$('.scrollToTop').addClass("show").removeClass("hide").removeClass('fadeOutRight').addClass('animated fadeInRight');
		$('nav,.toolbar').addClass("sticky");
	} else {
		$('.scrollToTop').addClass("hide").removeClass("show").removeClass("fadeInRight").addClass('fadeOutRight');
		$('nav,.toolbar').removeClass("sticky");
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

[].forEach.call(document.links, function(link) { link.addEventListener("click", function(event) { event.preventDefault(); window.location = this.href; }) });

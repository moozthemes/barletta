jQuery(function($) {
  "use strict";

// hide #back-top first
$("#back-top").hide();

// fade in #back-top

$(window).scroll(function () {
	if ($(this).scrollTop() > 100) {
		$('#back-top').fadeIn();
	} else {
		$('#back-top').fadeOut();
	}
});

// scroll body to 0px on click
$('#back-top a').on("click", function(){
	$('body,html').animate({
		scrollTop: 0
	}, 800);
	return false;
});

// add third menu for navwalker
$(document).ready(function(){
	$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
		event.preventDefault(); 
		event.stopPropagation(); 
		$(this).parent().siblings().removeClass('open');
		$(this).parent().toggleClass('open');
	});
});



});
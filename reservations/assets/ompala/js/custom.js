jQuery(document).ready(function($){
	$('#mainSlider ul').slick({
		dots:true,
		arrows:true,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		centerMode: true,
		autoplaySpeed: 2000,
		fade: true,
		cssEase: 'linear'
	});
});
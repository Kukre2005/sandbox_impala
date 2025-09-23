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
	
	$('.form-control').on('focus blur', function (e) {
		$(this).parents('.form-group').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
	}).trigger('blur');
});
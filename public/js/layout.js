$(document).ready(function(){
	$('.alert').delay(5000).fadeOut(1000);
	$('.home').hover(function(){
		$('.home .slideUp').animate({top:'-100'},'fast');
	},function(){
		$('.home .slideUp').animate({top:'-50'});
	});
	$('.user').hover(function(){
		$('.user .slideUp').animate({top:'-100'},'fast');
	},function(){
		$('.user .slideUp').animate({top:'-50'});
	});
	$('.memo').hover(function(){
		$('.memo .slideUp').animate({top:'-100'},'fast');
	},function(){
		$('.memo .slideUp').animate({top:'-50'});
	});
	$('.commentSlide').hover(function(){
		$('.commentSlide .slideUp').animate({top:'-100'},'fast');
	},function(){
		$('.commentSlide .slideUp').animate({top:'-50'});
	});
});
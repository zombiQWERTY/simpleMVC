function detectBrowser(){
	var body = $('body');
	if($.browser.chrome) {
		body.addClass('chrome');
	} else if ($.browser.mozilla) {
		body.addClass('firefox');
	} else if ($.browser.safari) {
		body.addClass('safari');
	} else if ($.browser.opera) {
		body.addClass('opera');
	} else if ($.browser.msie) {
		body.addClass('ie');
		if ($.browser.version == 6){
			body.addClass('ie6');
		} else if($.browser.version == 7){
			body.addClass('ie7');
		} else if($.browser.version == 8){
			body.addClass('ie8');
		} else if($.browser.version == 9){
			body.addClass('ie9');
		} else if($.browser.version == 10){
			body.addClass('ie10');
		} else if($.browser.version == 11){
			body.addClass('ie11');
		}
	}
};

function fixMargin(){
	$('.portfolio').find('.image').find('img').each(function(){
		var height = $(this).height();
		if (height < 200) {
			var fixHeight = (200 - height) / 2;
			$(this).css({'margin-top': fixHeight});
		}
	});
};

$(function() {
	fixMargin();
	var now = new Date();
	var month = now.getMonth();
	if (month == 0 || month == 1 || month == 11){
		$('.snow').let_it_snow({
			speed: 1,
			size: 15,
			count: 26,
			image: './assets/images/snowflake.png'
		});
	}
	$('#photoSlider').awShowcase({
		content_width:			880,
		content_height:			470,
		fit_to_parent:			false,
		auto:					false,
		continuous:				false,
		loading:				true,
		arrows:					true,
		buttons:				false,
		keybord_keys:			true,
		pauseonover:			true,
		transition:				'hslide',
		transition_delay:		0,
		transition_speed:		500,
		dynamic_height:			true,
		speed_change:			true,
		custom_function:		null
	});
});
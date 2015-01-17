
jQuery(function($) {'use strict',

	//#main-slider
	$(function(){
		$('.carousel').carousel({
			interval: 10,
			pause: false
		});
	});

					
	


	// accordian
	$('.accordion-toggle').on('click', function(){
		$(this).closest('.panel-group').children().each(function(){
		$(this).find('>.panel-heading').removeClass('active');
		 });

	 	$(this).closest('.panel-heading').toggleClass('active');
	});

	//Initiat WOW JS
	new WOW().init();

	// portfolio filter
	$(window).load(function(){'use strict';
		var $portfolio_selectors = $('.portfolio-filter >li>a');
		var $portfolio = $('.portfolio-items');
		$portfolio.isotope({
			itemSelector : '.portfolio-item',
			layoutMode : 'fitRows'
		});
		
		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	});

	// Contact form
	var form = $('#main-contact-form');
	form.submit(function(event){
		event.preventDefault();
		var form_status = $('<div class="form_status"></div>');
		$.ajax({
			url: $(this).attr('action'),

			beforeSend: function(){
				form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn() );
			}
		}).done(function(data){
			form_status.html('<p class="text-success">' + data.message + '</p>').delay(3000).fadeOut();
		});
	});
	
	//goto top
	$('.gototop').click(function(event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: $("body").offset().top
		}, 500);
	});	

	//Pretty Photo
	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: false
	});	
					
					
	$(".form-control").focus(function(){
		$(this).parent().find(".wpcf7-not-valid-tip").remove();
	});
					
	$(".form-submit").addClass("form-group");
	$(".form-submit .submit").addClass("btn btn-primary btn-lg");
		
	$(".img-responsive.wow.fadeInDown").attr("data-wow-duration","1000ms");
	$(".img-responsive.wow.fadeInDown").attr("data-wow-delay","300ms");
	$(".img-responsive.wow.fadeInDown img").prop("width","");
	$(".img-responsive.wow.fadeInDown img").prop("height","");
	
	$('.breadcrumb li.active').html($('.breadcrumb li.active').html().replace("Статьи автора ", ""));
					
	$(".blog_category .badge").each(function(){
		var width = $(this).parent().width();
		$(this).css("left", width+55+"px");
		
	});
	$(".pull-left img").addClass("img-responsive");
							
});

$(document).ready(function(){
	$(".select_answer").click(function(){
		
		$(".select_block").removeClass("active");
		var id = $(this).prop("id");
		$(".sel"+id).addClass("active");
	});
});



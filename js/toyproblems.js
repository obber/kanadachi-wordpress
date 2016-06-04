jQuery(function( $ ){

	$(document).ready(function() {

		// hints and solutions
		var $hints = $('.hints');
		var $solution = $('.solution');

		$('.hints > p:first-child, .solution > p:first-child').remove();

		$('.hints, .solution').hide();

		$('.tplink').click(function(e) {
			e.preventDefault();
			var linkname = $(this).attr("id");
			// slide toggle
			$('.' + linkname).slideToggle();
			$(this).toggleClass('active');
		});

	});

});

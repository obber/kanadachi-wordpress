jQuery(function( $ ){

	$(document).ready(function() {

		// hints and solutions
		var $hints = $('.hints').nextUntil('p.tplink-stop');
		var $solution = $('.solution').nextAll();

		// append to respective areas & hide
		$('.hints').append($hints);
		$('.solution').append($solution);
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
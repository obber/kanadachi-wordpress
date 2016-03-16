jQuery(function( $ ){

	$(document).ready(function() {

		// hints and solutions
		var $hints = $('.hints').nextUntil('p.tplink-stop');
		var $solution = $('.solution').nextAll();

		// append to respective areas & hide
		$('.hints').append($hints);
		$('.solution').append($solution);
		$('.hints, .solution').hide();

		// listen for clicks on 'solutions' and 'hints' link
		var arrowUp = true;

		$('.tplink').click(function(e) {
			e.preventDefault();
			var linkname = $(this).attr("id");
			// slide toggle
			$('.' + linkname).slideToggle();
			// turn arrow upside down
			var arrow = arrowUp ? '&#8593;' : '&#8595;';
			arrowUp = !arrowUp;
			$(this).children('span').html(arrow);
			
		});

	});

});
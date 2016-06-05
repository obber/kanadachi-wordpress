jQuery(function( $ ){

	$(document).ready(function() {

		// // remove unnecessary breaks for code blocks
		// $('pre > code > br:first-child, pre > code > br:last-child').remove();
		$('.custom-sc').each(function() {
			$(this).text($(this).text().replace(/^\s+/g, ''));
		});

		// hints and solutions
		var $hints = $('.hints');
		var $solution = $('.solution');

		// remove empty paragraphs

		$('.sc p').each(function() {
			if ($(this).text() === '') {
				$(this).remove()
			}
		})

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

const SHOW_MORE_TEXT = 'Afficher plus';
const SHOW_LESS_TEXT = 'Afficher moins';
const MIN_ELEMENTS_COUNT = 4; 

$(document).ready(function() {
	$('#vertical-breadcrumb ul').each(function() {
		if($(this).find('> li').length >= MIN_ELEMENTS_COUNT)
		{
			$(this).find('> li:nth-child(n+' + MIN_ELEMENTS_COUNT + ')').wrapAll('<div></div>');
			$(this).find('> div').hide();
			$(this).append('<span class="showMore">' + SHOW_MORE_TEXT + '</span>');

			$(this).find('> span.showMore').click(function() {
				$(this).prev().slideToggle('fast');

				if($(this).text() == SHOW_MORE_TEXT)
					$(this).text(SHOW_LESS_TEXT);
				else
					$(this).text(SHOW_MORE_TEXT);
			});
		}
	});
});

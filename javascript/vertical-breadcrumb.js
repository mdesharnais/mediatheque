const SHOW_MORE_TEXT = 'Afficher plus';
const SHOW_LESS_TEXT = 'Afficher moins';
const MAX_ELEMENT_COUNT = 3; 

$(document).ready(function() {
	$('#vertical-breadcrumb ul').each(function() {
		if($(this).find('> li').length > MAX_ELEMENT_COUNT)
		{
			$(this).find('> li:nth-child(n+' + (MAX_ELEMENT_COUNT + 1) + ')').wrapAll('<div></div>');
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

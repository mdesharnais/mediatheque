$(document).ready(function() {
	$('form#media table tbody tr').dblclick(openSubform);
	$('form#media table tbody tr:first-child').trigger('dblclick');
});

function openSubform()
{
	$('body').append('<div id="overlay"></div>');
	$('#overlay').hide().css({
		'width': '100%',
		'height': '100%',
		'background-color': 'black',
		'z-index': '99',
		'position': 'fixed',
		'top': '0',
		'left': '0',
		'opacity': '0.75'
	}).fadeIn();

	//$('body').append('<div id="subform"></div>');
	$('#subform').css({
		'width': '40em',
		'height': '35em',
		'background-color': 'white',
		'z-index': '100',
		'position': 'fixed',
		'top': '50%',
		'left': '50%',
		'margin-top': '-17.5em',
		'margin-left': '-20em'
	}).fadeIn();

	$('#subform div.niveau3').hide();
	$('#subform div.niveau3 select').after('<input type="button" value="-"><br>');
	$('#subform div.niveau3 select + input:last').after('<input type="button" value="+">');
	$('#subform div.niveau3').before('<span class="niveau3"></span>');

	$('#subform div.niveau3').each(function() {
		var $span = $(this).prev('span.niveau3');

		$(this).find('select').each(function() {
			if($span.text() == '')
				$span.append($(this).val());
			else
				$span.append(', ' + $(this).val());
		});
	});

	$('#subform span.niveau3').click(function() {
		$(this).next('div.niveau3').slideToggle('fast');
	});

}

function closeSubform()
{
}

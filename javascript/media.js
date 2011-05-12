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
	$('#subform div.niveau3').before('<span class="niveau3">Aucun</span>');

	$('#subform div.niveau3').each(function() {
		updateDivDetails($(this));
	});

	$('#subform div.niveau3 select').change(function() {
		updateDivDetails($(this).closest('div.niveau3'));
	});

	$('#subform div.niveau3 input[type=button][value=-]').click(removeElement);

	$('#subform span.niveau3').click(function() {
		$(this).next('div.niveau3').slideToggle('fast');
	});

}

function closeSubform()
{
}

function removeElement()
{
	$(this).prev('select').remove();
	$(this).next('br').remove();

	updateDivDetails($(this).closest('div.niveau3'));

	$(this).remove();
}

function updateDivDetails($div)
{
	var $span = $div.prev('span.niveau3');
	$span.text('Aucun');

	$div.find('select').each(function() {
		if($span.text() == 'Aucun')
			$span.text($(this).find('option[value=' + $(this).val() + ']').text());
		else
			$span.append(', ' + $(this).find('option[value=' + $(this).val() + ']').text());
	});
}

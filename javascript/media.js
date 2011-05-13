$(document).ready(function() {
	$('form#media table tbody tr').dblclick(openSubform);
	//$('form#media table tbody tr:first-child').trigger('dblclick');
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

	$('#subform div.level3').hide();
	$('#subform div.level3 div.rowLevel3').append('<input type="button" value="-">');
	$('#subform div.level3 div.rowLevel3:last-child').after('<input type="button" value="+">');
	$('#subform div.level3').before('<span class="level3">Aucun</span>');

	$('#subform div.level3').each(function() {
		updateDivDetails($(this));
	});

	$('#subform div.level3 div.rowLevel3 :input').change(function() {
		updateDivDetails($(this).closest('div.level3'));
	});

	$('#subform div.level3 div.rowLevel3 input[type=button][value=-]').click(removeElement);
	$('#subform div.level3 div.rowLevel3 + input[type=button][value=+]').click(addElement);

	$('#subform span.level3').click(function() {
		$(this).next('div.level3').slideToggle('fast');
	});

}

function closeSubform()
{
}

function removeElement()
{
	$div = $(this).closest('div.level3');
	$(this).closest('div.rowLevel3').remove();
	updateDivDetails($div);
}

function addElement()
{
	$newRow = $(this).prev('div.rowLevel3').clone();
	$newRow.find('select').val(0);
	$newRow.insertBefore($(this));
	$newRow.find('input[type=button][value=-]').click(removeElement);
	$newRow.find(':input').change(function() {
		updateDivDetails($(this).closest('div.level3'));
	});

	updateDivDetails($(this).closest('div.level3'));
}

function updateDivDetails($div)
{
	var $span = $div.prev('span.level3');
	$span.text('Aucun');

	$div.find('select').each(function() {
		if($span.text() == 'Aucun')
			$span.text($(this).find('option[value=' + $(this).val() + ']').text());
		else
			$span.append(', ' + $(this).find('option[value=' + $(this).val() + ']').text());
	});
}

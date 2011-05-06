$(document).ready(function() { 
	initDrivingTable();

	$('form#driving-table tbody :input').change(function() {
		var $tr = $(this).closest('tr');
		var $inputRowState = $tr.find('td[headers=col_row_state] input');

		if($inputRowState.val() != 2)
			$inputRowState.val(4);

		// Refresh table sorting values
		$('table').trigger('update');
	});

	$('form#driving-table *[type=reset]').click(function() {
		//alert('reset');
		$('form#driving-table table tr td[headers=col_row_state] input[value=3]').closest('tr').show();
	});

	$('table').tablesorter({
		sortList: [[1,0]],
		textExtraction: extractInputValue
	}); 
}); 

function initDrivingTable()
{
	var $table = $('form#driving-table table');
	$table.find('thead tr:first-child').append('<th id="col_add_remove_buttons">Ajouter/Supprimer</th>');
	$table.find('thead tr#new-row').append('<td headers="col_add_remove_buttons"><input type="button" value="Ajouter"></td>');
	$table.find('tbody tr').append('<td headers="col_add_remove_buttons"><input type="button" value="Supprimer"></td>');

	$table.find('thead tr td[headers=col_add_remove_buttons] input[type=button]').click(addRow);
	$table.find('tbody tr td[headers=col_add_remove_buttons] input[type=button]').click(removeRow);
}

var extractInputValue = function(node) {
	return $(node).find(':input').val();
}

function addRow() {
	var $newRow = $(this).closest('tr').clone();
	var $button = $newRow.find('td[headers="col_add_remove_buttons"] input[type=button]');

	$newRow.removeAttr('id');
	$button.click(removeRow);
	$button.attr('value', 'Supprimer');

	$('form#driving-table table tbody').append($newRow);

	// Refresh table sorting values
	$('table').trigger('update');

	// Reset new row values
	var $columns = $(this).closest('tr').find('td:not([headers=col_row_state]):not([headers=col_add_remove_buttons])');
	$columns.find(':input').each(function() {
		switch(this.type) {
			case 'password':
			case 'select-multiple':
			case 'select-one':
			case 'text':
			case 'textarea':
				$(this).val('');
				break;
			case 'checkbox':
			case 'radio':
				this.checked = false;
		}
	});
}

function removeRow() {
	var $tr = $(this).closest('tr');
	var $input = $tr.find('td[headers=col_row_state] input');

	switch($input.val()) {
		case '1':
		case '4':
			$input.val('3');
			$tr.hide();
			break;
		case '2':
			$tr.remove();
	}

	// Refresh table sorting values
	$('table').trigger('update');
}

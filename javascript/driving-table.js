$(document).ready(function() { 
	initDrivingTable();

	$('form#driving-table tbody :input').change(function() {
		var $tr = $(this).closest('tr');
		var $input = $tr.find('td[headers=col_row_state] input');

		if($input.val() != 2)
			$input.val(4);
	});

	$('table').tablesorter({
		sortList: [[1,0]],
		textExtraction: extractInputValue
	}); 
}); 

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

	//alert($input.val());

	switch($input.val()) {
		case '1':
		case '4':
			$input.val('3');
			break;
		case '2':
			$tr.remove();
	}
}

function initDrivingTable()
{
	var $table = $('form#driving-table table');
	$table.find('thead tr:first-child').append('<th id="col_add_remove_buttons">Ajouter/Supprimer</th>');
	$table.find('thead tr#new-row').append('<td headers="col_add_remove_buttons"><input type="button" value="Ajouter"></td>');
	$table.find('tbody tr').append('<td headers="col_add_remove_buttons"><input type="button" value="Supprimer"></td>');

	$table.find('thead tr td[headers=col_add_remove_buttons] input[type=button]').click(addRow);
	$table.find('tbody tr td[headers=col_add_remove_buttons] input[type=button]').click(removeRow);

	/*
	var drivingTable = document.getElementById('driving-table');

	// Add "delete" buttons
	var tbody = drivingTable.getElementsByTagName('tbody')[0];
	var rows = tbody.getElementsByTagName('tr');
	
	for(var i = 0; i < rows.length; ++i)
	{
		var tr = rows[i];
		var td = document.createElement('td');
		var deleteButton = document.createElement('button');
		var deleteButtonText = document.createTextNode('Supprimer');

		deleteButton.type = 'button';
		deleteButton.appendChild(deleteButtonText);
		deleteButton.addEventListener('click', deleteRow, false);

		td.appendChild(deleteButton);
		tr.appendChild(td);
	}

	// Add "add" button effect
	var tr = document.getElementById('new-row');
	var td = document.createElement('td');
	var addButton = document.createElement('button');
	var addButtonText = document.createTextNode('Ajouter');

	addButton.type = 'button';
	addButton.appendChild(addButtonText);
	addButton.addEventListener('click', addRow, false);

	td.appendChild(addButton);
	tr.appendChild(td);
	*/
}

/*
function addRow(e)
{
	var drivingTable = document.getElementById('driving-table');
	var tbody = drivingTable.getElementsByTagName('tbody')[0];

	var button = e.target;
	var td = button.parentNode;
	var tr = td.parentNode;
	var newRow = tr.cloneNode(true);
	var deleteButtonTd= document.createElement('td');
	var deleteButton = document.createElement('button');
	var deleteButtonText = document.createTextNode('Supprimer');

	deleteButton.type = 'button';
	deleteButton.appendChild(deleteButtonText);
	deleteButton.addEventListener('click', deleteRow, false);

	deleteButtonTd.appendChild(deleteButton);

	newRow.removeChild(newRow.lastElementChild);
	newRow.appendChild(deleteButtonTd);

	newRow.removeAttribute('id');

	tbody.appendChild(newRow);

	inputs = tr.getElementsByTagName('input');
	for(var i = 0; i < inputs.length; ++i)
		inputs[i].value = null;

	$('table').trigger('update');
}

function deleteRow(e)
{
	var button = e.target;
	var td = button.parentNode;
	var tr = td.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
	$('table').trigger('update');
}
*/

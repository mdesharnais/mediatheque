$(document).ready(function() { 
	initDrivingTable();

	$("table").tablesorter({
		sortList: [[1,0]],
		textExtraction: extractInputValue
	}); 
}); 

var extractInputValue = function(node) {
	return $(node).find(':input').val();
}

function initDrivingTable()
{
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
}

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

	newRow.id = null;

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
}

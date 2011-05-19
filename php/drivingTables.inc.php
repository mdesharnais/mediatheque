<?php
require_once('Application.class.php');

function printDrivingTable($tableName)
{
	global $application;

	foreach($application->database->query("SHOW FULL COLUMNS FROM $tableName") as $row)
		$columns[$row['Field']] = $row;

	/*
	row_state:
	1 = Unchanged
	2 = Added
	3 = Deleted
	4 = Modified
	*/

	echo '<form id="driving-table" method="POST" action="php/saveDrivingTable.php">';
	echo '	<table>';
	echo '		<caption>'.$tableName.'</caption>';
	echo '		<thead>';
	echo '			<tr>';
	echo '				<th id="col_row_state">Row state</th>';

	foreach($columns as $column)
		echo '<th id="col_'.$column['Field'].'">'.$column['Comment'].'</th>';

	echo '			</tr>';
	echo '			<tr id="new-row">';
	echo '				<td headers="col_row_state"><input type="number" id="row_state" name="row_state" value="2" required disabled></td>';

	foreach($columns as $column)
		echo '<td headers="col_'.$column['Field'].'"><input type="text" id="'.$column['Field'].'" name="'.$column['Field'].'"></td>';

	echo '				</tr>';
	echo '			</thead>';
	echo '			<tbody>';

	foreach($application->database->query("SELECT * FROM $tableName") as $row)
	{
		echo '				<tr>';
		echo '					<td headers="col_row_state"><input type="number" id="row_state1" name="row_state1" value="1" required disabled></td>';

		foreach($columns as $column)
		{
			echo '<td headers="col_'.$column['Field'].'">';
			generateField($column, $row[$column['Field']]);
			echo '</td>';
		}

		echo '				</tr>';
	}

	echo '			</tbody>';
	echo '	</table>';
	echo '	<button type="submit">Enregistrer</button>';
	echo '	<button type="reset">Annuler</button>';
	echo '</form>';
}

function generateField($column, $value)
{
	switch(substr($column['Type'], 0, strpos($column['Type'], '(')))
	{
	case 'tinyint':
	case 'smallint':
	case 'mediumint':
	case 'int':
	case 'bigint':
	case 'float':
	case 'double':
	case 'decimal':
	case 'numeric':
		$type = 'number';
		break;

	default:
		$type = 'text';
	}
	echo '	<input type="'.$type.'" id="'.$column['Field'].'" name="'.$column['Field'].'" value="'.$value.'">';
}
?>

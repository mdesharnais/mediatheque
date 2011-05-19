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
	{
		echo '<td headers="col_'.$column['Field'].'">';
		generateField($column);
		echo '</td>';
	}

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

function generateField($column, $value = null)
{
	$type = getInputType($column['Type']);
	$required = ($column['Field'] != 'ID' && $column['Null'] == 'NO') ? ' required' : '';

	switch($type)
	{
		case 'checkbox':
			if(is_null($value) || $value == 0)
				echo '	<input type="checkbox" id="'.$column['Field'].'" name="'.$column['Field'].'">';
			else
				echo '	<input type="checkbox" id="'.$column['Field'].'" name="'.$column['Field'].'" checked>';
			break;

		default:
			if(is_null($value))
				$valueAttribute = '';
			else
				$valueAttribute = " value=\"$value\"";

			echo '	<input type="'.$type.'" id="'.$column['Field'].'" name="'.$column['Field'].'"'.$valueAttribute.$required.'>';
	}
}

function getInputType($dataType)
{
	if($dataType == 'tinyint(1)')
		return 'checkbox';

	switch(substr($dataType, 0, strpos($dataType, '(')))
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

	return $type;
}
?>

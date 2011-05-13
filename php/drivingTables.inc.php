<?php
function printDrivingTable($tableName)
{
	/*
	row_state:
	1 = Unchanged
	2 = Added
	3 = Deleted
	4 = Modified
	*/
	echo '<form id="driving-table">
				<table>
					<caption>'.$tableName.'</caption>
					<thead>
						<tr>
							<th id="col_row_state">Row state</th>
							<th id="col_id">ID</th>
							<th id="col_nom">Nom</th>
							<th id="col_description">Description</th>
							<th id="col_inactif">Inactif</th>
						</tr>
						<tr id="new-row">
							<td headers="col_row_state"><input type="number" id="row_state" name="row_state" value="2" required disabled></td>
							<td headers="col_id"><input type="number" id="id" name="id" disabled></td>
							<td headers="col_nom"><input type="text" id="nom" name="nom"></td>
							<td headers="col_description"><input type="text" id="description" name="description"></td>
							<td headers="col_inactif"><input type="checkbox" id="inactif" name="inactif"></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td headers="col_row_state"><input type="number" id="row_state1" name="row_state1" value="1" required disabled></td>
							<td headers="col_id"><input type="number" id="id1" name="id1" value="1" disabled></td>
							<td headers="col_nom"><input type="text" id="nom1" name="nom1" value="AAA" required></td>
							<td headers="col_description"><input type="text" id="description1" name="description1" value="Lorem ipsum dolor sit amet."></td>
							<td headers="col_inactif"><input type="checkbox" id="inactif1" name="inactif1"></td>
						</tr>
						<tr>
							<td headers="col_row_state"><input type="number" id="row_state1" name="row_state1" value="1" required disabled></td>
							<td headers="col_id"><input type="number" id="id2" name="id2" value="2" disabled></td>
							<td headers="col_nom"><input type="text" id="nom2" name="nom2" value="DDD" required></td>
							<td headers="col_description"><input type="text" id="description2" name="description2"></td>
							<td headers="col_inactif"><input type="checkbox" id="inactif2" name="inactif2"></td>
						</tr>
						<tr>
							<td headers="col_row_state"><input type="number" id="row_state1" name="row_state1" value="1" required disabled></td>
							<td headers="col_id"><input type="number" id="id3" name="id3" value="3" disabled></td>
							<td headers="col_nom"><input type="text" id="nom3" name="nom3" value="CCC" required></td>
							<td headers="col_description"><input type="text" id="description3" name="description3" value="Consectetur adispsing elit."></td>
							<td headers="col_inactif"><input type="checkbox" id="inactif3" name="inactif3"></td>
						</tr>
					</tbody>
				</table>
				<button type="submit">Enregistrer</button>
				<button type="reset">Annuler</button>
			</form>';
}
?>

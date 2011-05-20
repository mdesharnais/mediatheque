<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title>Médiatech du département de musique du cégep de Trois-Rivières</title>

		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
		<script src="javascript/media.js"></script>
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<form id="media">
				<label for="ID">ID</label>
				<input type="number" id="ID" name="ID">
				<br>
				<label for="titre">Titre</label>
				<input type="text" id="titre" name="titre" maxlength="50">
				<br>
				<label for="annee_publication">Année de publication</label>
				<input type="number" id="annee_publication" name="annee_publication">
				<br>
				<label for="image">Image</label>
				<input type="file" id="image" name="image" accept="image/*">
				<br>
				<label for="quantite">Quantite</label>
				<input type="number" id="quantite" name="quantite" min="0">
				<br>
				<label for="reference">Référence</label>
				<input type="text" id="reference" name="reference" maxlength="50">
				<br>
				<label for="notes">Notes</label>
				<textarea id="notes" name="notes"></textarea>
				<br>
				<label for="maison_editionID">Maison d'édition</label>
				<select id="maison_editionID" name="maison_editionID">
					<option value="0" selected></option>
					<option value="1">AAAAA</option>
					<option value="2">BBBBB</option>
					<option value="3">CCCCC</option>
					<option value="4">DDDDD</option>
					<option value="5">EEEEE</option>
				</select>
				<br>
				<label for="categorieID">Catégorie</label>
				<select id="categorieID" name="categorieID">
					<option value="0" selected></option>
					<option value="1">AAAAA</option>
					<option value="2">BBBBB</option>
					<option value="3">CCCCC</option>
					<option value="4">DDDDD</option>
					<option value="5">EEEEE</option>
				</select>
				<br>
				<label for="collectionID">Collection</label>
				<select id="collectionID" name="collectionID">
					<option value="0" selected></option>
					<option value="1">AAAAA</option>
					<option value="2">BBBBB</option>
					<option value="3">CCCCC</option>
					<option value="4">DDDDD</option>
					<option value="5">EEEEE</option>
				</select>
				<br>
				<label for="position_collection">Position</label>
				<input type="number" id="position_collection" name="position_collection" min="0">
				<br>
				<label for="CUP">CUP</label>
				<input type="number" id="CUP" name="CUP" min="0">
				<br>
				<label for="nationaliteID">Collection</label>
				<select id="collectionID" name="collectionID">
					<option value="0" selected></option>
					<option value="1">AAAAA</option>
					<option value="2">BBBBB</option>
					<option value="3">CCCCC</option>
					<option value="4">DDDDD</option>
					<option value="5">EEEEE</option>
				</select>
				<br>
				<label for="nationaliteID">Nationalité</label>
				<select id="nationaliteID" name="nationaliteID">
					<option value="0" selected></option>
					<option value="1">AAAAA</option>
					<option value="2">BBBBB</option>
					<option value="3">CCCCC</option>
					<option value="4">DDDDD</option>
					<option value="5">EEEEE</option>
				</select>
				<br>

				<div>
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>Titre</th>
								<th>Position</th>
								<th>Année d'enregistrement</th>
								<th>Durée</th>
								<th>Catalogue</th>
								<th>Époque</th>
								<th>Forme</th>
								<th>Genre</th>
								<th>Instrumentation</th>
								<th>Tonalité</th>
								<th>Notes</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Lorem ipsum</td>
								<td>1</td>
								<td>2010</td>
								<td>PT4M09S</td>
								<td>Lorem lorem</td>
								<td>Ipsum ipsum</td>
								<td>Dolor dolor</td>
								<td>Sit sit</td>
								<td>Amet amet</td>
								<td>Consectetur</td>
								<td>Lorem ipsum Dolor sit amet, consectetur adipsing elit.</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Lorem ipsum</td>
								<td>2</td>
								<td>2010</td>
								<td>PT4M09S</td>
								<td>Lorem lorem</td>
								<td>Ipsum ipsum</td>
								<td>Dolor dolor</td>
								<td>Sit sit</td>
								<td>Amet amet</td>
								<td>Consectetur</td>
								<td>Lorem ipsum Dolor sit amet, consectetur adipsing elit.</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Lorem ipsum</td>
								<td>3</td>
								<td>2010</td>
								<td>PT4M09S</td>
								<td>Lorem lorem</td>
								<td>Ipsum ipsum</td>
								<td>Dolor dolor</td>
								<td>Sit sit</td>
								<td>Amet amet</td>
								<td>Consectetur</td>
								<td>Lorem ipsum Dolor sit amet, consectetur adipsing elit.</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Lorem ipsum</td>
								<td>4</td>
								<td>2010</td>
								<td>PT4M09S</td>
								<td>Lorem lorem</td>
								<td>Ipsum ipsum</td>
								<td>Dolor dolor</td>
								<td>Sit sit</td>
								<td>Amet amet</td>
								<td>Consectetur</td>
								<td>Lorem ipsum Dolor sit amet, consectetur adipsing elit.</td>
							</tr>
							<tr>
								<td>5</td>
								<td>Lorem ipsum</td>
								<td>5</td>
								<td>2010</td>
								<td>PT4M09S</td>
								<td>Lorem lorem</td>
								<td>Ipsum ipsum</td>
								<td>Dolor dolor</td>
								<td>Sit sit</td>
								<td>Amet amet</td>
								<td>Consectetur</td>
								<td>Lorem ipsum Dolor sit amet, consectetur adipsing elit.</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div id="subform" style="display: none">
					<label for="details_ID">ID</label>
					<input type="number" id="details_ID" name="details_ID">
					<br>
					<label for="details_titre">Titre</label>
					<input type="text" id="details_titre" name="details_titre">
					<br>
					<label for="details_position_media">Position</label>
					<input type="number" id="details_position_media" name="details_position_media">
					<br>
					<label for="details_annee_enregistrement">Année d'enregistrement</label>
					<input type="number" id="details_annee_enregistrement" name="details_annee_enregistrement">
					<br>
					<label for="details_duree">Durée</label>
					<input type="text" id="details_duree" name="details_duree">
					<br>
					<label for="details_arrangeurs">Arrangeurs</label>
					<div id="details_arrangeurs" class="level3">
						<div class="rowLevel3">
							<select id="details_arrangeurs" name="details_arrangeurs">
								<option value="0"></option>
								<option value="1" selected>AAAAA</option>
								<option value="2">BBBBB</option>
								<option value="3">CCCCC</option>
								<option value="4">DDDDD</option>
								<option value="5">EEEEE</option>
							</select>
						</div>
						<div class="rowLevel3">
							<select id="details_arrangeurs" name="details_arrangeurs">
								<option value="0"></option>
								<option value="1">AAAAA</option>
								<option value="2">BBBBB</option>
								<option value="3" selected>CCCCC</option>
								<option value="4">DDDDD</option>
								<option value="5">EEEEE</option>
							</select>
						</div>
						<div class="rowLevel3">
							<select id="details_arrangeurs" name="details_arrangeurs">
								<option value="0"></option>
								<option value="1">AAAAA</option>
								<option value="2">BBBBB</option>
								<option value="3">CCCCC</option>
								<option value="4" selected>DDDDD</option>
								<option value="5">EEEEE</option>
							</select>
						</div>
					</div>
					<br>
					<label for="details_artistes">Artistes</label>
					<div id="details_artistes" class="level3">
						<div class="rowLevel3">
							<select id="details_arrangeurs" name="details_artistes">
								<option value="0"></option>
								<option value="1" selected>AAAAA</option>
								<option value="2">BBBBB</option>
								<option value="3">CCCCC</option>
								<option value="4">DDDDD</option>
								<option value="5">EEEEE</option>
							</select>
						</div>
						<div class="rowLevel3">
							<select id="details_artistes" name="details_artistes">
								<option value="0"></option>
								<option value="1">AAAAA</option>
								<option value="2">BBBBB</option>
								<option value="3" selected>CCCCC</option>
								<option value="4">DDDDD</option>
								<option value="5">EEEEE</option>
							</select>
						</div>
					</div>
					<br>
					<label for="details_compositeurs">Compositeurs</label>
					<div id="details_compositeurs" class="level3">
						<div class="rowLevel3">
							<select id="details_compositeurs" name="details_compositeurs">
								<option value="0"></option>
								<option value="1" selected>AAAAA</option>
								<option value="2">BBBBB</option>
								<option value="3">CCCCC</option>
								<option value="4">DDDDD</option>
								<option value="5">EEEEE</option>
							</select>
						</div>
						<div class="rowLevel3">
							<select id="details_compositeurs" name="details_compositeurs">
								<option value="0"></option>
								<option value="1">AAAAA</option>
								<option value="2">BBBBB</option>
								<option value="3" selected>CCCCC</option>
								<option value="4">DDDDD</option>
								<option value="5">EEEEE</option>
							</select>
						</div>
					</div>
					<br>
					<label for="details_parolier">Parolier</label>
					<div id="details_parolier" class="level3">
						<div class="rowLevel3">
							<select id="details_parolier" name="details_parolier">
								<option value="0"></option>
								<option value="1" selected>AAAAA</option>
								<option value="2">BBBBB</option>
								<option value="3">CCCCC</option>
								<option value="4">DDDDD</option>
								<option value="5">EEEEE</option>
							</select>
						</div>
						<div class="rowLevel3">
							<select id="details_parolier" name="details_parolier">
								<option value="0"></option>
								<option value="1">AAAAA</option>
								<option value="2">BBBBB</option>
								<option value="3" selected>CCCCC</option>
								<option value="4">DDDDD</option>
								<option value="5">EEEEE</option>
							</select>
						</div>
					</div>
					<br>
					<label for="details_interpretes">Interprètes</label>
					<div id="details_interpretes" class="level3">
						<div class="rowLevel3">
							<select id="details_interpretes" name="details_interpretes">
								<option value="0"></option>
								<option value="1" selected>AAAAA</option>
								<option value="2">BBBBB</option>
								<option value="3">CCCCC</option>
								<option value="4">DDDDD</option>
								<option value="5">EEEEE</option>
							</select>
						</div>
						<div class="rowLevel3">
							<select id="details_interpretes" name="details_interpretes">
								<option value="0"></option>
								<option value="1">AAAAA</option>
								<option value="2">BBBBB</option>
								<option value="3" selected>CCCCC</option>
								<option value="4">DDDDD</option>
								<option value="5">EEEEE</option>
							</select>
						</div>
					</div>
					<br>
					<label for="details_catalogueID">Catalogue</label>
					<select id="details_catalogueID" name="details_catalogueID">
						<option value="0" selected></option>
						<option value="1">AAAAA</option>
						<option value="2">BBBBB</option>
						<option value="3">CCCCC</option>
						<option value="4">DDDDD</option>
						<option value="5">EEEEE</option>
					</select>
					<br>
					<label for="details_epoqueID">Époque</label>
					<select id="details_epoqueID" name="details_epoqueID">
						<option value="0" selected></option>
						<option value="1">AAAAA</option>
						<option value="2">BBBBB</option>
						<option value="3">CCCCC</option>
						<option value="4">DDDDD</option>
						<option value="5">EEEEE</option>
					</select>
					<br>
					<label for="details_formeID">Forme</label>
					<select id="details_formeID" name="details_formeID">
						<option value="0" selected></option>
						<option value="1">AAAAA</option>
						<option value="2">BBBBB</option>
						<option value="3">CCCCC</option>
						<option value="4">DDDDD</option>
						<option value="5">EEEEE</option>
					</select>
					<br>
					<label for="details_genreID">Genre</label>
					<select id="details_genreID" name="details_genreID">
						<option value="0" selected></option>
						<option value="1">AAAAA</option>
						<option value="2">BBBBB</option>
						<option value="3">CCCCC</option>
						<option value="4">DDDDD</option>
						<option value="5">EEEEE</option>
					</select>
					<br>
					<label for="details_instrumentationID">Instrumentation</label>
					<select id="details_instrumentationID" name="details_instrumentationID">
						<option value="0" selected></option>
						<option value="1">AAAAA</option>
						<option value="2">BBBBB</option>
						<option value="3">CCCCC</option>
						<option value="4">DDDDD</option>
						<option value="5">EEEEE</option>
					</select>
					<br>
					<label for="details_tonaliteID">Tonalité</label>
					<select id="details_tonaliteID" name="details_tonaliteID">
						<option value="0" selected></option>
						<option value="1">AAAAA</option>
						<option value="2">BBBBB</option>
						<option value="3">CCCCC</option>
						<option value="4">DDDDD</option>
						<option value="5">EEEEE</option>
					</select>
				</div>
				<button type="submit">Enregistrer</button>
				<button type="reset">Annuler</button>
			</form>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>

<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Samuel Milette Lacombe">

		<title>Carcajou - Résultats de la recherche</title>

		<?php
		  include('sharedFiles/style.inc.php'); 
		  include('sharedFiles/javascript.inc.php'); 
		  require('php/search-results.inc.php');
		  require('php/breadcrumb.inc.php')
		?>
		<link rel="stylesheet" href="css/search-result.css">
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<div id="vertical-breadcrumb">
				<h3>Affinez votre recherche</h3>
				<?php 
				if (isset($_GET['presentation']) || !empty($_GET['presentation']))
					printBreadCrumb(createFromWhereClause($_GET['presentation']));
				else 
					printBreadCrumb(createFromWhereClause(1)); 
				?>
			</div>
			<div id="search-results">
		
			<?php
				
				//code utilisée pour la présentation de la conception seulement
				if (isset($_GET['presentation']) || !empty($_GET['presentation']))
				{
					printSearchResults(createFromWhereClause($_GET['presentation'])); 
				
				}
				else 
					printSearchResults(createFromWhereClause(1)); 
				//fin du code utilisé pour la présentation
				
				/*	if (isset($_POST) || !empty($_POST))
					{
						printSearchResults(createFromWhereClause($_POST));
			
					}
					else
						printSearchResults('all'); */
						
			?>	
			
			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>


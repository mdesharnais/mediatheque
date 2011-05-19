<header>
	<div id="user-bar">
		<?php
		if($application->currentUser->isVisitor())
		{
			echo '<a href="#">Inscription</a>'.' ';
			echo '<a href="connexion.php">Connexion</a>';
		}
		else
		{
			echo 'Bonjour '.$application->currentUser->getName().' ';
			echo '<a href="php/userLogOut.php">Déconnexion</a>';
		}
		?>
	</div>
	<h1><a href="index.php" title="Retour à l'accueil">Carcajou</a></h1>
	<img alt="Logo du Cégep de Trois-Rivières" src="images/logo.png">
	<form method="post" action="searchResults.php">
		<input type="search" id="keyWords" name="keyWords" placeholder="Entrez votre recherche">
		<button type="submit"><img src="images/icons/search32x32.png" alt="Rechercher"></button>
		<p id="moresearches"><a href="advancedSearch.php">Recherche avancée</a></p>
	</form>
</header>

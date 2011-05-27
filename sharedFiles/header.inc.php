<header>
	<h1><a href="index.php">Carcajou</a></h1>
	<nav>
		<ul id="nav">
			<li>
				<h2><a href="">À propos</a></h2>
				<ul>
					<li><a href="aboutMusicalDepartment.php">Du département de musique</a></li>
					<li><a href="aboutMediaLibrary.php">De la médiathèque</a></li>
					<li><a href="aboutOpenHours.php">Des heures d'ouverture</a></li>
					<li><a href="">De la règlementation</a></li>
				</ul>
			</li><!--
			--><li>
				<h2><a href="#">Médiathèque</a></h2>
				<ul>
					<li><a href="advancedSearch.php">Recherche avancée</a></li>
					<li><a href="searchResults.php">Parcourir</a></li>
					<li><a href="">Suggestions</a></li>
				</ul>
			</li><!--
			--><li>
				<h2><a href="">Zone utilisateur</a></h2>
				<ul>
					<?php
					if($application->currentUser->isVisitor())
					{
						echo '<li><a href="connexion.php">Connexion</a></li>';
						echo '<li><a href="inscription.php">Inscription</a></li>';
					}
					else
					{
						echo '<li><a href="my_reservation.php">Mes réservations</a></li>';
						echo '<li><a href="emprunt_cours.php">Mes emprunts en cours</a></li>';
						echo '<li><a href="histo_emprunt.php">Mon historique d\'emprunts</a></li>';
						echo '<li><a href="php/userLogOut.php">Déconnexion</a></li>';
					}
					?>
				</ul>
			</li><!--
			-->
			<?php
			if($application->currentUser->haveRights('administration', $application->rights['read']))
			{
			?>
				<li>
					<h2><a href="">Administration</a></h2>
					<ul>
						<li><a href="emprunt.php">Emprunt</a></li>
						<li><a href="retour.php">Retour</a></li>
					</ul>
				</li>
			<?php
			}
			?>
		</ul>
	</nav>
	<form id="search" method="post" action="searchResults.php">
		<input type="search" placeholder="Rechercher">
		<button type="button">Rechercher</button>
	</form>
</header>

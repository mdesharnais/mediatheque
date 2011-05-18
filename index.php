<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title>Médiatech du département de musique du cégep de Trois-Rivières</title>

		<link rel="stylesheet" href="css/style1.css">
		<link rel="icon" href="images/logoCegep.svg">

		<script src="javascript/jquery/jquery.js"></script>
		<script src="javascript/vertical-breadcrumb.js"></script>

		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<div>
				<?php
				if(isset($_SESSION['matricule']))
					echo $_SESSION['matricule'];
				?>
				<h2>Lorem ipsum</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit lectus ac nulla dictum commodo. Curabitur nisl tellus, volutpat pellentesque ultricies id, tincidunt in nisl. In in nisi vitae nibh porttitor scelerisque eu ut tortor. Vivamus commodo, mi ac convallis imperdiet, magna erat convallis mauris, nec auctor ante augue non urna. Ut quis enim quis mauris congue semper sed ac elit. Sed porta tellus eget ante facilisis et feugiat sapien placerat. Nunc posuere ante quis orci vulputate volutpat. Nulla eu ipsum enim, id gravida nibh. Donec imperdiet tristique pellentesque. Vivamus fringilla euismod felis vel varius.</p>
				<p>Donec lobortis leo eget velit dictum cursus. In dictum magna ac ligula accumsan adipiscing. Donec venenatis faucibus purus nec sagittis. Praesent rhoncus lacus in ante auctor fermentum. Nunc leo leo, luctus non vestibulum eget, porta vitae diam. Nullam id nisi nec nunc condimentum auctor vel in libero. Mauris tempus luctus nisi, at sodales nisl porta sit amet. Donec feugiat tempus posuere. Ut consectetur leo ut diam porttitor iaculis. Fusce rhoncus mauris sit amet mauris scelerisque hendrerit. Duis ultrices pretium risus, at tincidunt ligula pulvinar ac. Vestibulum dapibus tristique leo sed ultricies. Mauris tristique justo non augue ultrices hendrerit. Quisque enim leo, elementum non laoreet nec, vulputate ac elit. Maecenas sit amet ipsum enim, non tempor tellus. Sed volutpat eleifend mauris et ornare. Phasellus ipsum velit, pretium sit amet interdum eu, vulputate eget lacus. Vivamus rutrum, mauris eu vulputate tempus, augue ante luctus dui, nec pellentesque sem risus vitae ligula. Etiam elementum rutrum velit in pretium. Duis ut leo eget metus tempor feugiat vel vel lacus.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit lectus ac nulla dictum commodo. Curabitur nisl tellus, volutpat pellentesque ultricies id, tincidunt in nisl. In in nisi vitae nibh porttitor scelerisque eu ut tortor. Vivamus commodo, mi ac convallis imperdiet, magna erat convallis mauris, nec auctor ante augue non urna. Ut quis enim quis mauris congue semper sed ac elit. Sed porta tellus eget ante facilisis et feugiat sapien placerat. Nunc posuere ante quis orci vulputate volutpat. Nulla eu ipsum enim, id gravida nibh. Donec imperdiet tristique pellentesque. Vivamus fringilla euismod felis vel varius.</p>
				<p>Donec lobortis leo eget velit dictum cursus. In dictum magna ac ligula accumsan adipiscing. Donec venenatis faucibus purus nec sagittis. Praesent rhoncus lacus in ante auctor fermentum. Nunc leo leo, luctus non vestibulum eget, porta vitae diam. Nullam id nisi nec nunc condimentum auctor vel in libero. Mauris tempus luctus nisi, at sodales nisl porta sit amet. Donec feugiat tempus posuere. Ut consectetur leo ut diam porttitor iaculis. Fusce rhoncus mauris sit amet mauris scelerisque hendrerit. Duis ultrices pretium risus, at tincidunt ligula pulvinar ac. Vestibulum dapibus tristique leo sed ultricies. Mauris tristique justo non augue ultrices hendrerit. Quisque enim leo, elementum non laoreet nec, vulputate ac elit. Maecenas sit amet ipsum enim, non tempor tellus. Sed volutpat eleifend mauris et ornare. Phasellus ipsum velit, pretium sit amet interdum eu, vulputate eget lacus. Vivamus rutrum, mauris eu vulputate tempus, augue ante luctus dui, nec pellentesque sem risus vitae ligula. Etiam elementum rutrum velit in pretium. Duis ut leo eget metus tempor feugiat vel vel lacus.</p>
			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>


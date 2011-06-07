<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Marc-Andre Destrempes">

		<title><?php echo Application::APPLICATION_NAME; ?> - Générateur de code QR</title>

		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
		<script src="javascript/jquery/QRCode.js"></script>
		<script src="javascript/generateQRCode.js"></script>
		<style type="text/css">div img, input.qr {display:block; margin:auto;}</style>
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<div>
				<form id="media" action="#" method="get">					
				</form>
			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>


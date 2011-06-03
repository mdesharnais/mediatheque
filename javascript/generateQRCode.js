$(document).ready(function() {
	$('form#media').append('<div id="QRCode"><input id="code" type="text" name="code" class="qr"/><input type="button" name="generate" value="Générer" class="qr"/><br/></div>');
	$('form#media input[type=button][value=Générer]').click(function() { $('form#media img').remove(); $("#QRCode").QRCode($('form#media input[type=text][name=code]').val(), {width:200, height:200}); });
})

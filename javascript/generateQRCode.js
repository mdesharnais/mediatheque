$(document).ready(function() {
	$('form#media').append('<div id="QRCode">Code: <input type="text" name="code" /><input type="button" name="generate" value="Generate" /><br/></div>');
	$('form#media input[type=button][value=Generate]').click(function() { $('form#media img').remove(); $("#QRCode").QRCode($('form#media input[type=text][name=code]').val(), {width:200, height:200}); });
})

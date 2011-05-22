$(document).ready(function() {
	$('#media .detailsLevel2Row').hide();
	createDetailsLevel2Summary();

	createDetailsLevel3Summary();
	$detailsLevel3.delegate('.rowLevel3 input[type="button"][value="-"]', 'click', removeElement);
	$detailsLevel3.delegate('.rowLevel3 + input[type="button"][value="+"]', 'click', addElement);


});

function createDetailsLevel2Summary()
{
	$('#media .detailsLevel2Row').each(function() {
		$(this).before('<div class="detailsLevel2Summary"></div>');
		$summary = $(this).prev();
		$summary.append('<div class="summaryPosition">' + $(this).find('input[id^="details_position_media"]').val() + '</div>');
		$summary.append('<div class="summaryTitle">' + $(this).find('input[id^="details_titre"]').val() + '</div>');
		$summary.append('<div class="summaryDuration">' + $(this).find('input[id^="details_duree"]').val() + '</div>');
	});
	$('#media').delegate('.detailsLevel2Summary', 'click', function() {
		$(this).next('.detailsLevel2Row').slideToggle();
	});
}

function createDetailsLevel3Summary()
{
	$detailsLevel3 = $('#media .detailsLevel2 .detailsLevel3');
	$detailsLevel3.hide();
	$detailsLevel3.find('.rowLevel3').append('<input type="button" value="-">');
	$detailsLevel3.find('.rowLevel3:last-child').after('<input type="button" value="+">');
	$detailsLevel3.before('<span class="detailsLevel3Summary">Aucun</span>');

	$detailsLevel3.each(function() {
		updateDetailsLevel3Summary($(this));
	});

	$detailsLevel3.find('.rowLevel3 :input').change(function() {
		updateDetailsLevel3Summary($(this).closest('.detailsLevel3'));
	});

	$('#media .detailsLevel2').delegate('.detailsLevel3Summary', 'click', function() {
		$(this).next('.detailsLevel3').slideToggle('fast');
	});

	$('#media .detailsLevel2 .detailsLevel3').delegate(':input', 'change', function() {
		updateDetailsLevel3Summary($(this).closest('.detailsLevel3'));
	});
}

function updateDetailsLevel3Summary($detailsLevel3)
{
	var $summary = $detailsLevel3.prev('.detailsLevel3Summary');
	$summary.text('Aucun');

	$detailsLevel3.find('select').each(function() {
		if($(this).val() != 0)
			if($summary.text() == 'Aucun')
				$summary.text($(this).find('option[value=' + $(this).val() + ']').text());
			else
				$summary.append(', ' + $(this).find('option[value=' + $(this).val() + ']').text());
	});
}

function removeElement()
{
	$detailsLevel3 = $(this).closest('.detailsLevel3');
	$(this).closest('.rowLevel3').remove();
	updateDivDetails($detailsLevel3);
}

function addElement()
{
	$newRow = $(this).prev('.rowLevel3').clone();
	$newRow.find('select').val(0);
	$newRow.insertBefore($(this));
	$newRow.find('input[type=button][value=-]').click(removeElement);
	updateDetailsLevel3Summary($(this).closest('.detailsLevel3'));
}

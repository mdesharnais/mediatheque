$(document).ready(function() {
	$('#media .detailsLevel2Row').hide();
	createDetailsLevel2Summary();
	$('#media .detailsLevel2').delegate('.detailsLevel2Summary button.removeRow', 'click', removeLevel2Element);
	$('#media .detailsLevel2').delegate('button.addRow', 'click', addLevel2Element);

	createDetailsLevel3Summary();
	$('#media .detailsLevel2 .detailsLevel3').delegate('.rowLevel3 button.removeRow', 'click', removeLevel3Element);
	$('#media .detailsLevel2 .detailsLevel3').delegate('.rowLevel3 + button.addRow', 'click', addLevel3Element);


});

function createDetailsLevel2Summary()
{
	$('#media .detailsLevel2Row').each(function() {
		$(this).before('<span class="detailsLevel2Summary"></span>');
		$summary = $(this).prev();
		$summary.append('<div class="summaryPosition">' + $(this).find('input[id^="details_position_media"]').val() + '</div>');
		$summary.append('<div class="summaryTitle">' + $(this).find('input[id^="details_titre"]').val() + '</div>');
		$summary.append('<div class="summaryDuration">' + $(this).find('input[id^="details_duree"]').val() + '</div>');
		$summary.append('<button type="button" class="removeRow">-</button>');
	});

	$('#media .detailsLevel2 li:last-child').after('<button type="button" class="addRow">+</button>');

	$('#media').delegate('.detailsLevel2Summary [class^="summary"]', 'click', function() {
		$directlyNext = $(this).closest('.detailsLevel2Summary').next('.detailsLevel2Row');

		if($directlyNext.length == 1)
			$directlyNext.slideToggle();
		else
			$(this).closest('.detailsLevel2Summary').nextUntil('.detailsLevel2Row').next().slideToggle();
	});
}

function createDetailsLevel3Summary()
{
	$detailsLevel3 = $('#media .detailsLevel2 .detailsLevel3');
	$detailsLevel3.hide();
	$detailsLevel3.find('.rowLevel3').append('<button type="button" class="removeRow">-</button>');
	$detailsLevel3.find('.rowLevel3:last-child').after('<button type="button" class="addRow">+</button>');
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

function addLevel2Element()
{
	$newRow = $(this).prev('li').clone();
	$newRow.find('select').val(0);
	$newRow.insertBefore($(this));
}

function removeLevel2Element()
{
	$(this).closest('li').remove();
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

function removeLevel3Element()
{
	$detailsLevel3 = $(this).closest('.detailsLevel3');
	$(this).closest('.rowLevel3').remove();
	updateDetailsLevel3Summary($detailsLevel3);
}

function addLevel3Element()
{
	$newRow = $(this).prev('.rowLevel3').clone();
	$newRow.find('select').val(0);
	$newRow.insertBefore($(this));
	$newRow.find('input[type=button][value=-]').click(removeLevel3Element);
	updateDetailsLevel3Summary($(this).closest('.detailsLevel3'));
}

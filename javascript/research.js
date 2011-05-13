		$(document).ready(function() {
			initSearchCriterias();
		
			var zIndexNumber = 1000;
			jQuery.each($('.jqTransformSelectWrapper'), function(i, el) {
				$(this).css("z-index",zIndexNumber);
				zIndexNumber -= 10;
			});
		});  
		
	function initSearchCriterias()
	{

	
		var $lastRowSearch = $('form#advanced-search div.row-search:last-of-type');
		$lastRowSearch.after('<span class="buttonAdd" title="Ajouter un autre champ" >[+]</span>');
		$lastRowSearch.next('span.buttonAdd').click(add_field);
	}
  
    /* This function allows to display a new field to search.
    */
    function add_field() {
	
	var $newLine = $(this).prev('div.row-search').clone();
	
	if($newLine.find('span.buttonRemove').length == 0)
		$newLine.append('<span class="buttonRemove" title="Supprimer le champ" >[-]</span>');
	
	$newLine.find('input[type=text]').val('');	
	$newLine.find('span.buttonRemove').click(removeField);

	
	$(this).before($newLine);
    }
    
 
    function removeField() {
   
	$(this).closest('div.row-search').remove();

	};
		
		$(document).ready(function() {
			var zIndexNumber = 1000;
			jQuery.each($('.jqTransformSelectWrapper'), function(i, el) {
				$(this).css("z-index",zIndexNumber);
				zIndexNumber -= 10;
			});
		});

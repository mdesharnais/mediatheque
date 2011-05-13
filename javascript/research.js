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

		sortOptions($('select[name=idx]')[0]);
		sortOptions($('select[name=idx]')[1]);
		sortOptions($('select[name=idx]')[2]);
		
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
		
	function compareOptionText(a,b) {
    /*
      * return >0 if a>b
      * 0 if a=b
      * <0 if a<b
      */
    // textual comparison
   return a.text!=b.text ? a.text<b.text ? -1 : 1 : 0;
    // numerical comparison
    // return a.text - b.text;
     
    }
  
    function sortOptions(list) {
    var items = list.options.length;
    // create array and make copies of options in list
    var tmpArray = new Array(items);
    for ( i=0; i<items; i++ )
    tmpArray[i] = new
    Option(list.options[i].text,list.options[i].value);
    // sort options using given function
    tmpArray.sort(compareOptionText);
    // make copies of sorted options back to list
    for ( i=0; i<items; i++ )
    list.options[i] = new Option(tmpArray[i].text,tmpArray[i].value);
     
    }

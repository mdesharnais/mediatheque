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
	var $lastRowSearch = $('form#advanced-search div.row-search:last-child');
	$lastRowSearch.append('<a href="Javascript:add_field();" id="ButtonPlus" title="Ajouter un autre champ" >[+]</a>');
	}
  
    /* This function allows to display a new field to search.
    */
    function add_field() {
	//var ButtonPlus = document.getElementById('ButtonPlus');
	//var line       = ButtonPlus.parentNode;
	//line.parentNode.appendChild(line.cloneNode(true));
	//line.removeChild(ButtonPlus);
	
	var ButtonPlus = jQuery('#ButtonPlus');
	var line = ButtonPlus.parent();
	line.after(line.clone(false));
	line.append('<a href="Javascript:delete_field();" id="ButtonMoins" title="Supprimer le champ" >[-]</a>');	
	ButtonPlus.remove();

	/*	// ADD FORCE RELOAD JQTRANSFORM SYS-TECH
		
		jQuery.each($("#ButtonPlus").parent(".row-search").find(".jqTransformSelectWrapper select"), function(index){
			
			var jqTransformGetLabel = function(objfield){
				var selfForm = $(objfield.get(0).form);
				var oLabel = objfield.next();
				if(!oLabel.is('label')) {
					oLabel = objfield.prev();
					if(oLabel.is('label')){
						var inputname = objfield.attr('id');
						if(inputname){
							oLabel = selfForm.find('label[for="'+inputname+'"]');
						} 
					}
				}
				if(oLabel.is('label')){return oLabel.css('cursor','pointer');}
				return false;
			};
			
			var jqTransformHideSelect = function(oTarget){
				var ulVisible = $('.jqTransformSelectWrapper ul:visible');
				ulVisible.each(function(){
					var oSelect = $(this).parents(".jqTransformSelectWrapper:first").find("select").get(0);
					//do not hide if click on the label object associated to the select
					if( !(oTarget && oSelect.oLabel && oSelect.oLabel.get(0) == oTarget.get(0)) ){$(this).hide();}
				});
			};
			
			var $wrapper = $(this).parent(".jqTransformSelectWrapper");
			var $ul = $('ul', $wrapper).css('width',$(this).width()).hide();
			var oLabel  =  jqTransformGetLabel($(this));
			
			
			$ul.find('a').click(function(){
					$('a.selected', $wrapper).removeClass('selected');
					$(this).addClass('selected');	
					
					if ($(this)[0].selectedIndex != $(this).attr('index') && $(this)[0].onchange) { $(this)[0].selectedIndex = $(this).attr('index'); $(this)[0].onchange(); }
					$(this)[0].selectedIndex = $(this).attr('index');
					$('span:eq(0)', $wrapper).html($(this).html());
					$ul.hide();
					return false;
			});
			
			
			$('a:eq('+ this.selectedIndex +')', $ul).click();
			$('span:first', $wrapper).click(function(){$("a.jqTransformSelectOpen",$wrapper).trigger('click');});
			oLabel && oLabel.click(function(){$("a.jqTransformSelectOpen",$wrapper).trigger('click');});
			this.oLabel = oLabel;
			
			
			var oLinkOpen = $('a.jqTransformSelectOpen', $wrapper)
				.click(function(){
					//Check if box is already open to still allow toggle, but close all other selects
					if( $ul.css('display') == 'none' ) {jqTransformHideSelect();} 
					if($(this).attr('disabled')){return false;}
	
					$ul.slideToggle('fast', function(){					
						var offSet = ($('a.selected', $ul).offset().top - $ul.offset().top);
						$ul.animate({scrollTop: offSet});
					});
					return false;
				})
			;
				
		});*/
		
		

	
	// /ADD FORCE RELOAD JQTRANSFORM SYS-TECH
	
    }
    
        /* This function allows to delete a new field to search.
    */
    function delete_field() {
	//var ButtonPlus = document.getElementById('ButtonPlus');
	//var line       = ButtonPlus.parentNode;
	//line.parentNode.appendChild(line.cloneNode(true));
	//line.removeChild(ButtonPlus);
	
	var ButtonMoins = jQuery('#ButtonMoins');
	var line = ButtonMoins.parent();
	line.remove();

		};
		
		$(document).ready(function() {
			var zIndexNumber = 1000;
			jQuery.each($('.jqTransformSelectWrapper'), function(i, el) {
				$(this).css("z-index",zIndexNumber);
				zIndexNumber -= 10;
			});
		});

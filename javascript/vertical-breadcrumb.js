const SHOW_MORE_TEXT = 'Afficher plus';
const SHOW_LESS_TEXT = 'Afficher moins';
const MIN_ELEMENTS_COUNT = 4; 

window.onload = initVerticalBreadcrumb;

function initVerticalBreadcrumb()
{
	var verticalBreadcrumb = document.getElementById('vertical-breadcrumb');
	var unorderedLists = verticalBreadcrumb.getElementsByTagName('ul');

	for(var i = 0; i < unorderedLists.length; ++i)
	{
		var ul = unorderedLists[i];
		var listItems = ul.getElementsByTagName('li');
		
		if(listItems.length >= MIN_ELEMENTS_COUNT)
		{
			for(var j = MIN_ELEMENTS_COUNT - 1; j < listItems.length; ++j)
			{
				var li = listItems[j];
				li.style.display = 'none';
			}

			var link = document.createElement('span');
			var linkText = document.createTextNode(SHOW_MORE_TEXT);

			link.appendChild(linkText);
			link.className = 'showMore';

			link.addEventListener('click', showMoreOrLess, false);

			ul.appendChild(link);
		}
	}
}

function showMoreOrLess(e)
{
	if(e.target.textContent == SHOW_MORE_TEXT)
		showMore(e);
	else if(e.target.textContent == SHOW_LESS_TEXT)
		showLess(e);
	else
		alert('An error occured in showMoreOrLess()');
}

function showMore(e)
{
	e.target.textContent = SHOW_LESS_TEXT;
	var listItems = e.target.parentNode.getElementsByTagName('li');

	for(var i = MIN_ELEMENTS_COUNT - 1; i < listItems.length; ++i)
	{
		var li = listItems[i];
		li.style.display = 'list-item';
	}
}

function showLess(e)
{
	e.target.textContent = SHOW_MORE_TEXT;
	var listItems = e.target.parentNode.getElementsByTagName('li');

	for(var i = MIN_ELEMENTS_COUNT - 1; i < listItems.length; ++i)
	{
		var li = listItems[i];
		li.style.display = 'none';
	}
}

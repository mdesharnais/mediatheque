<?php
class Pagination
{
    private $itemsPerPage;
    private $destinationPage;
    private $pagesRangeShow;
    private $fromClause;
    private $whereClause;
    private $currentPage;
    private $db;
    private $itemsCount;
	private static $paginationID;
	private $showCount;

    //////////////////////////////////////////////////
    // Constructor(s)
    //////////////////////////////////////////////////

    public function __construct()
    {
        $this->setItemsPerPage(5);
        $this->setPagesRangeShow(9);
		self::$paginationID++;
    }

    //////////////////////////////////////////////////
    // Get(s)
    //////////////////////////////////////////////////

    public function itemsPerPage()
    {
        return $this->itemsPerPage;
    }

    public function destinationPage()
    {
        return $this->destinationPage;
    }

    public function pagesRangeShown()
    {
        return $this->pagesRangeShow;
    }

    public function fromClause()
    {
        return $this->fromClause;
    }

    public function whereClause()
    {
        return $this->whereClause;
    }

    public function completQuery()
    {
        if(is_null($this->whereClause()))
            return "SELECT COUNT(*) AS number FROM ".$this->fromClause();
        else
            return "SELECT COUNT(*) AS number FROM ".$this->fromClause()." WHERE ".$this->whereClause();
    }

    public function ItemsCount()
    {
        if(isset($this->itemsCount))
        {
            return $this->itemsCount;
        }
        else
        {
            $query = $this->db->prepare($this->completQuery());
            $queryFailed = !$query->execute();

            if($queryFailed)
                throw new Exception("Items count query failed.");

            $result = $query->fetch();
            return $result['number'];
        }
    }

    public function pagesCount()
    {
        $count = ceil($this->itemsCount() / $this->itemsPerPage());

        if($count == 0)
            return 1;
        else
            return $count;
    }

    public function firstPageShown()
    {
        $firstPageShown = $this->currentPage() - floor($this->pagesRangeShown() / 2);

        if($firstPageShown > ($this->pagesCount() - $this->pagesRangeShown() + 1))
            $firstPageShown = $this->pagesCount() - $this->pagesRangeShown() + 1;

        if($firstPageShown <= 0)
            $firstPageShown = 1;

        return $firstPageShown;
    }

    public function currentPage()
    {
        return $this->currentPage;
    }

    public function currentPageFirstItemNumber()
    {
        return ($this->currentPage() - 1) * $this->itemsPerPage();
    }

	public function currentPageLastItemNumber()
	{
		return ($this->currentPageFirstItemNumber() + $this->itemsPerPage() - 1);
	}

    public function lastPageShown()
    {
        return $this->firstPageShown() + $this->pagesRangeShown() - 1;
    }
	
	private function firstPaginationShownID()
	{
		return "pagination-".self::$paginationID."-".$this->showCount;
	}

    //////////////////////////////////////////////////
    // Set(s)
    //////////////////////////////////////////////////

    public function setItemsPerPage($value)
    {
        if(!is_numeric($value))
            throw new Exception("'ItemCountPerPage' must be a numeric value.");

        if($value < 1)
            throw new Exception("'ItemCountPerPage' must be bigger or equals to one.");

        $this->itemsPerPage = intval($value);
    }

    public function setDestinationPage($value)
    {
        $this->destinationPage = $value;
    }

    public function setPagesRangeShow($value)
    {
        if(!is_numeric($value))
            throw new Exception("'PagesRangeShow' must be a numeric value.");

        if($value < 1)
            throw new Exception("'PagesRangeShow' must be bigger or equals to one.");

        $this->pagesRangeShow = intval($value);
    }

    public function setFromClause($value)
    {
        $this->fromClause = $value;
    }

    public function setWhereClause($value)
    {
        $this->whereClause = $value;
    }

    public function setCurrentPage($value)
    {
        if(is_numeric($value) && ($value % 1) == 0)
        {
            if($value < 1)
                $value = 1; 
            elseif($value > $this->pagesCount())
                $value = $this->pagesCount();
        }
        else
            $value = 1;

        $this->currentPage = $value;
    }

    public function setDataBase(PDO $value)
    {
        $this->db = $value;
    }

    //////////////////////////////////////////////////
    // Method(s)
    //////////////////////////////////////////////////

    public function show()
    {
		$this->showCount++;

		if($this->showCount == 1)
			echo "<div id=\"".$this->firstPaginationShownID()."\" class=\"pagination\">\n";
		else
			echo "<div class=\"pagination\">\n";
			
        $this->printPreviousLink();

        $pageShown = $this->firstPageShown();
        while($pageShown <= $this->pagesCount() && $pageShown <= $this->lastPageShown())
        {
            if($pageShown == $this->currentPage())
                echo "<span class=\"currentPage\">$pageShown</span>\n";
            else
			{
				if(strpos($this->destinationPage(), '?' == FALSE))
					echo '<a class="page" href="'.$this->destinationPage()."?page=$pageShown#".$this->firstPaginationShownID()."\">$pageShown</a>\n";
				else
					echo '<a class="page" href="'.$this->destinationPage()."&page=$pageShown#".$this->firstPaginationShownID()."\">$pageShown</a>\n";
			}

            $pageShown++;
        }

        $this->printNextLink();
        echo "</div>\n";
    }

    private function printPreviousLink()
    {
        if($this->currentPage() == 1)
            echo "<span>Précédent</span>\n";
        else
            echo '<a href="'.$this->destinationPage().'?page='.($this->currentPage() - 1)."#".$this->firstPaginationShownID()."\">Précédent</a>\n";
    }

    private function printNextLink()
    {
        if($this->currentPage() == $this->pagesCount())
            echo "<span>Suivant</span>\n";
        else
            echo '<a href="'.$this->destinationPage().'?page='.($this->currentPage() + 1)."#".$this->firstPaginationShownID()."\">Suivant</a>\n";
    }
}
?>

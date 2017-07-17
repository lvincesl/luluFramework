<?php
namespace Luluframework\Client\View\Table;

/**
 * Pager handler for HTML Table
 * @author Lionel Vinceslas <lionel.vinceslas@laposte.net>
 * @package Luluframework\Client\View\Table
 */
class Pager
{
    private $amplitude;
    private $lowerBound;
    private $upperBound;

    private $action;
    private $currentPage;
    private $pageCount;
    private $sourceCode;


    public function __construct($action, $currentPpage, $pageCount)
    {
        $this->amplitude    = 5;
        $this->lowerBound   = null;
        $this->upperBound   = null;
        $this->sourceCode   = null;
        $this->action       = $action;
        $this->currentPage  = $currentPage;
        $this->pageCount    = $pageCount;

        if ($pageCount > 1) 
        {
	        $this->lowerBound = max(1, $currentPpage-$this->amplitude);
	        $this->upperBound = min($pageCount, $currentPpage+$this->amplitude+($this->lowerBound-($currentPpage-$this->amplitude)));
	        $this->sourceCode = "<ul class='pagination pagination-sm'>";

	        if ($currentPpage == 1) {
	        	$this->sourceCode .= "<li class='disabled'><span data-toggle='tooltip' title='Première page'>
                                        <i class='fa fa-angle-double-left' aria-hidden='true'></i></span>
                                    </li>
	        					    <li class='disabled'><span data-toggle='tooltip' title='Page précédente'>
                                        <i class='fa fa-angle-left' aria-hidden='true'></i></span>
                                    </li>";
	        } else {
	        	$this->sourceCode .= "<li><a href='#' onclick='$.redirect(\"$action\",{ page: 1});' data-toggle='tooltip' title='Première page'><i class='fa fa-angle-double-left' aria-hidden='true'></i></a></li>
	                            <li><a href='#' onclick='$.redirect(\"$action\",{ page: ".max($currentPpage-1, 1)."});' data-uk-tooltip title='Page précédente'>
	                            	<i class='fa fa-angle-left' aria-hidden='true'></i>
	                            </a></li>\n";
	        }

	        for ($i=$this->lowerBound;$i<=$this->upperBound;$i++) {
	        	if ($currentPpage==$i) {
	            	$this->sourceCode .= "<li class='active'><span>$i</span></li>\n";
	        	} else {
	                $this->sourceCode .= "<li><a href='#' onclick='$.redirect(\"$action\",{ page: \"$i\"});' data-toggle='tooltip' title='Page $i'>$i</a></li>\n";
	        	}
	        }

	       	if ($currentPpage == $pageCount) {
	       		$this->sourceCode .= "<li class='disabled'><span data-toggle='tooltip' title='Page suivante'><i class='fa fa-angle-right' aria-hidden='true'></i></li>
	       						<li class='disabled'><span data-toggle='tooltip' title='Dernière page'><i class='fa fa-angle-double-right' aria-hidden='true'></i></li>";
	       	} else {
	       		$this->sourceCode .= "<li><a href='#' onclick='$.redirect(\"$action\",{ page: ".min($currentPpage+1, $pageCount)."});' data-toggle='tooltip' title='Page suivante'>
	       							<i class='fa fa-angle-right' aria-hidden='true'></i></a>
	                        	</li>
	                        	<li><a href='#' onclick='$.redirect(\"$action\",{ page: $pageCount});' data-toggle='tooltip' title='Dernière page'>
	                            	<i class='fa fa-angle-double-right' aria-hidden='true'></i></a>
	                        	</li>";
	       	}
	        
            $this->sourceCode .= '</ul>';
	    }
    }

    /**
     * Set the pager amplitude
     *
     * @param integer $amplitude
     * @return void
     */
    public function setAmplitude($amplitude)
    {
        $this->amplitude = $amplitude;
    }

    /**
     * Return the pager source code
     *
     * @return string
     */
	public static function getSourceCode()
	{
        return $this->sourceCode;
	}


    /**
     * Alias of getSourceCode() function
     *
     * @return string
     */
    public function toString()
    {
        return $this->sourceCode;
    }
}
<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2012 Thomas Nussbaumer <info@thomasnu.ch>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * A section
 */
class Tx_Thomasnu_Domain_Model_Section extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var Tx_Thomasnu_Domain_Model_Content The page the section belongs to
	 **/
	protected $page;
	
	/**
	 * The section's id
	 *
	 * @var integer $section
	 */
	protected $section;

	/**
	 * The section's name (anchor and options)
	 *
	 * @var string $name
	 */
	protected $name = '';

	/**
	 * The section's main content
	 *
	 * @var string $main
	 */
	protected $main = '';

	/**
	 * The section's top margin
	 *
	 * @var string $margin
	 */
	protected $margin = '';

	/**
	 * The section's bottom margin
	 *
	 * @var string $bottom
	 */
	protected $bottom = '';

	/*
	 * Constructs a new section
	 *
	 * @param integer $section
	*/ 
	public function __construct($section = 67108864) {
		$this->setSection($section);
	}
	
	/**
	 * Sets the page of the section
	 *
	 * @param Tx_Thomasnu_Domain_Model_Content The page the section belongs to
	 * @return void
	 */
	public function setPage(Tx_Thomasnu_Domain_Model_Content $page = NULL) {
		$this->page = $page;
	}

	/**
	 * Returns the page of the section
	 * 
	 * @return Tx_Thomasnu_Domain_Model_Content The page the section belongs to
	 */
	public function getPage() {
		if ($this->page instanceof Tx_Thomasnu_Persistence_LazyLoadingProxy) {
			$this->page->_loadRealInstance();
		}
		return $this->page;
	}
	
	/**
	 * Sets this section's id
	 *
	 * @param integer $section
	 * @return void
	 */
	public function setSection($section) {
		$this->section = $section;
	}

	/**
	 * Returns the section's id
	 *
	 * @return integer $section
	 */
	public function getSection() {
		return $this->section;
	}

	/**
	 * @param strig $name
	 * @return void
	 */
	public function setName($name) {
		$name = $GLOBALS['TSFE']->csConvObj->specCharsToASCII($GLOBALS['TSFE']->defaultCharSet, $name);
		$this->name = strtolower(preg_replace('%[^a-z0-9*+/]%i', '-', $name));
	}

	/**
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}
		
	/**
	 * Sets this section's main content
	 *
	 * @param string $main
	 * @return void
	 */
	public function setMain($main) {
		$this->main = $main;
	}

	/**
	 * Returns the section's main content
	 *
	 * @return string $text
	 */
	public function getMain() {
		return $this->main;
	}
	
	/**
	 * Sets this section's top margin
	 *
	 * @param string $margin
	 * @return void
	 */
	public function setMargin($margin) {
		$this->margin = $margin;
	}

	/**
	 * Returns the section's top margin
	 *
	 * @return string $margin
	 */
	public function getMargin() {
		return $this->margin;
	}
	
	/**
	 * Sets this section's bottom margin
	 *
	 * @param string $bottom
	 * @return void
	 */
	public function setBottom($bottom) {
		$this->bottom = $bottom;
	}

	/**
	 * Returns the section's bottom margin
	 *
	 * @return string $bottom
	 */
	public function getBottom() {
		return $this->bottom;
	}
}
?>

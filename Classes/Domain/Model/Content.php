<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2012 Thomas Nussbaumer <info@thomasnu.ch>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project isinteger
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
 * Content of a page
 */
class Tx_Thomasnu_Domain_Model_Content extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * The Page
	 *
	 * @var integer $page The page id
	 */
	protected $page;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Thomasnu_Domain_Model_Section> The sections of the page
	 * @lazy
	 * @cascade remove
	 **/
	protected $sections;

	/*
	 * Constructs a new page
	 *
	 * @param integer $page The page id
	*/ 
	public function __construct($page = 0) {
		$this->setPage($page);
		$this->sections = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Sets this page id
	 *
	 * @param integer $page The page id
	 * @return void
	 */
	public function setPage($page) {
		$this->page = $page;
	}

	/**
	 * Returns the page id
	 *
	 * @return integer $page
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * Sets the sections of the page
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Thomasnu_Domain_Model_Section> The sections of the page
	 */
	public function setSections(Tx_Extbase_Persistence_ObjectStorage $sections) {
		$this->sections = $sections;
	}

	/**
	 * Returns the sections of the page
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Thomasnu_Domain_Model_Section> The sections of the page
	 */
	public function getSections() {
		return clone $this->sections;
	}

	/**
	 * Adds an section to the page
	 *
	 * @param Tx_Thomasnu_Domain_Model_Section The section to be added
	 * @return void
	 */
	public function addSection(Tx_Thomasnu_Domain_Model_Section $section) {
		$this->sections->attach($section);
	}

	/**
	 * Remove an section from the page
	 *
	 * @param Tx_Thomasnu_Domain_Model_Section The section to be removed
	 * @return void
	 */
	public function removeSection(Tx_Thomasnu_Domain_Model_Section $section) {
		$this->sections->detach($section);
	}

	/**
	 * Remove all sections from this page
	 *
	 * @return void
	 */
	public function removeAllSections() {
		$this->sections = new Tx_Extbase_Persistence_ObjectStorage();
	}

}
?>

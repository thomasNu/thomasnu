<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2010 Thomas Nussbaumer <info@thomasnu.ch>
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
 * A Photo
 */
class Tx_Thomasnu_Domain_Model_Photo extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var Tx_Thomasnu_Domain_Model_Gallery The gallery the photo belongs to
	 **/
	protected $gallery;
	
	/**
	 * The photos's id
	 *
	 * @var string $id
	 */
	protected $id;

	/**
	 * The photos's text
	 *
	 * @var string $text
	 */
	protected $text;

	/**
	 * The photos's caption
	 *
	 * @var string $caption
	 */
	protected $caption;

	/*
	 * Constructs a new Photo
	 *
	 * @param string $id
	*/ 
	public function __construct($id = '') {
		$this->setId($id);
	}
	
	/**
	 * Sets the gallery of the photo
	 *
	 * @param Tx_Thomasnu_Domain_Model_Gallery The gallery the photo belongs to
	 * @return void
	 */
	public function setGallery(Tx_Thomasnu_Domain_Model_Gallery $gallery = NULL) {
		$this->gallery = $gallery;
	}

	/**
	 * Returns the gallery of the photo
	 * 
	 * @return Tx_Thomasnu_Domain_Model_Gallery The gallery the photo belongs to
	 */
	public function getGallery() {
		if ($this->gallery instanceof Tx_Thomasnu_Persistence_LazyLoadingProxy) {
			$this->gallery->_loadRealInstance();
		}
		return $this->gallery;
	}
	
	/**
	 * Sets this photo's id
	 *
	 * @param string $id
	 * @return void
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * Returns the photo's id
	 *
	 * @return string $id
	 */
	public function getId() {
		return $this->id;
	}
		
	/**
	 * Sets this photo's text
	 *
	 * @param string $text
	 * @return void
	 */
	public function setText($text) {
		$this->text = $text;
	}

	/**
	 * Returns the photo's text
	 *
	 * @return string $text
	 */
	public function getText() {
		return $this->text;
	}
	
	/**
	 * Sets this photo's caption
	 *
	 * @param string $caption
	 * @return void
	 */
	public function setCaption($caption) {
		$this->caption = $caption;
	}

	/**
	 * Returns the photo's caption
	 *
	 * @return string $caption
	 */
	public function getCaption() {
		return $this->caption;
	}
}
?>

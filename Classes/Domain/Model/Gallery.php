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
 * A Photogallery
 */
class Tx_Thomasnu_Domain_Model_Gallery extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * The gallery's header
	 *
	 * @var string $header The pagetitle of the gallery
	 */
	protected $header;

	/**
	 * The gallery's link
	 *
	 * @var string $link
	 */
	protected $link;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Thomasnu_Domain_Model_Photo> The photos the gallery has to offer
	 * @lazy
	 * @cascade remove
	 **/
	protected $photos;

	/*
	 * Constructs a new Gallery
	 *
	 * @param string $header The pagetitle of the gallery
	*/ 
	public function __construct($header = '') {
		$this->setHeader($header);
	}

	/**
	 * Sets this gallery's pagetitle
	 *
	 * @param string $header The pagetitle of the gallery
	 * @return void
	 */
	public function setHeader($header) {
		$this->header = $header;
	}

	/**
	 * Returns the gallery's header
	 *
	 * @return string $header
	 */
	public function getHeader() {
		return $this->header;
	}

	/**
	 * Sets this gallery's link
	 *
	 * @param string $link
	 * @return void
	 */
	public function setLink($link) {
		$this->link = $link;
	}

	/**
	 * Returns the gallery's link
	 *
	 * @return string $link
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * Sets the photos of the gallery
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Thomasnu_Domain_Model_Photo> The photos of the gallery
	 */
	public function setPhotos(Tx_Extbase_Persistence_ObjectStorage $photos) {
		$this->photos = $photos;
	}

	/**
	 * Returns the photos of the gallery
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Thomasnu_Domain_Model_Photo> The photos of the gallery
	 */
	public function getPhotos() {
		return clone $this->photos;
	}

	/**
	 * Adds an photo to the gallery
	 *
	 * @param Tx_Thomasnu_Domain_Model_Photo The photo to be added
	 * @return void
	 */
	public function addPhoto(Tx_Thomasnu_Domain_Model_Photo $photo) {
		$this->photos->attach($photo);
	}

	/**
	 * Remove an photo from the gallery
	 *
	 * @param Tx_Thomasnu_Domain_Model_Photo The photo to be removed
	 * @return void
	 */
	public function removePhoto(Tx_Thomasnu_Domain_Model_Photo $photo) {
		$this->photos->detach($photo);
	}

	/**
	 * Remove all photos from this gallery
	 *
	 * @return void
	 */
	public function removeAllPhotos() {
		$this->photos = new Tx_Extbase_Persistence_ObjectStorage();
	}

}
?>

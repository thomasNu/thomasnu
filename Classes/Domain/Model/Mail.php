<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2013 Thomas Nussbaumer <info@thomasnu.ch>
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
 * A Mail Form Service
 */
class Tx_Thomasnu_Domain_Model_Mail extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var DateTime
	 */
	protected $date;

	/**
	 * @var string
	 */
	protected $form;

	/**
	 * @var string
	 */
	protected $hash;

	/**
	 * @var string
	 */
	protected $subject;

	/**
	 * @var string
	 */
	protected $content;

	/**
	 * @var Tx_Thomasnu_Domain_Model_Poster
	 */
	protected $poster;

	/**
	 * @var  Tx_Extbase_Persistence_ObjectStorage<Tx_Thomasnu_Domain_Model_Mail>
	 * @lazy
	 */
	protected $replies;

	/**
	 * @var boolean
	 */
	protected $published;

	/**
	 * Constructs this mail form
	 */
	public function __construct() {
		$this->date = new DateTime();
	}

	/**
	 * Setter for date
	 *
	 * @param DateTime
	 * @return void
	 */
	public function setDate(DateTime $date) {
		$this->date = $date;
	}

	/**
	 * Getter for date
	 *
	 * @return DateTime
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * Setter for selected form
	 *
	 * @param string
	 * @return void
	 */
	public function setForm($form) {
		$this->form = $form;
	}

	/**
	 * Getter for form
	 *
	 * @return string
	 */
	public function getForm() {
		return $this->form;
	}

	/**
	 * Sets the hash
	 *
	 * @param string
	 * @return void
	 */
	public function setHash($hash) {
		$this->hash = $hash;
	}

	/**
	 * Getter for hash
	 *
	 * @return string
	 */
	public function getHash() {
		return $this->hash;
	}

	/**
	 * Sets the subject
	 *
	 * @param string
	 * @return void
	 */
	public function setSubject($subject) {
		$this->subject = $subject;
	}

	/**
	 * Getter for subject
	 *
	 * @return string
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * Sets the content
	 *
	 * @param string
	 * @return void
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * Getter for content
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Sets the poster
	 *
	 * @param Tx_Thomasnu_Domain_Model_Poster $poster
	 * @return void
	 */
	public function setPoster(Tx_Thomasnu_Domain_Model_Poster $poster) {
		$this->poster = $poster;
	}

	/**
	 * Getter for poster
	 *
	 * @return Tx_Thomasnu_Domain_Model_Poster
	 */
	public function getPoster() {
		return $this->poster;
	}

	/**
	 * Sets the replies
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Thomasnu_Domain_Model_Mail> $replies
	 * @return void
	 */
	public function setReplies(Tx_Extbase_Persistence_ObjectStorage $replies) {
		$this->replies = $replies;
	}

	/**
	 * Returns the replies
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Thomasnu_Domain_Model_Mail> $replies
	 */
	public function getReplies() {
		$storage = new Tx_Extbase_Persistence_ObjectStorage();
		foreach ($this->replies as $reply) {
			if ($reply->getPublished()) {
				$storage->attach($reply);
			}
		}
		return $this->replies;
	}

	/**
	 * Setter for published
	 *
	 * @param boolean $published
	 */
	public function setPublished($published) {
		$this->published = $published;
	}

	/**
	 * Getter for published
	 *
	 * @return boolean
	 */
	public function getPublished() {
		return $this->published;
	}

}
?>

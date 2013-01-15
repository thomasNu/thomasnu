<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Claus Due <claus@wildside.dk>, Wildside A/S
 *  (c) 2013 Thomas Nussbaumer <info@thomasnu.ch>

 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Poster of emails and comments
 *
 * @package thomasnu
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Thomasnu_Domain_Model_Poster extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * @var string
	 * @validate EmailAddress
	 * @validate NotEmpty
	 */
	protected $email;

	/**
	 * @var string
	 */
	protected $web;

	/**
	 * @var string
	 */
	protected $subscript;

	/**
	 * @var string
	 */
	protected $identifier;

	/**
	 * CONSTRUCTOR
	 */
	public function __construct() {

	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getWeb() {
		return $this->web;
	}

	/**
	 * @param $web
	 */
	public function setWeb($web) {
		$this->web = $web;
	}

	/**
	 * @return string
	 */
	public function getIdentifier() {
		return $this->identifier;
	}

	/**
	 * @param $subscript
	 */
	public function setSubscript($subscript) {
		$this->subscript = $subscript;
	}

	/**
	 * @return string
	 */
	public function getSubscript() {
		return $this->subscript;
	}

	/**
	 * @param $identifier
	 */
	public function setIdentifier($identifier) {
		$this->identifier = $identifier;
	}

	/**
	 * @return string
	 */
	public function getGravatar() {
		$md5 = md5(trim(strtolower($this->email)));
		return 'http://www.gravatar.com/avatar/' . $md5;
	}
}
?>

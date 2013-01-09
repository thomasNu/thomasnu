<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2011 Thomas Nussbaumer <info@thomasnu.ch>
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
	 * @var int
	 */
	protected $form;

	/**
	 * @var string
	 */
	protected $gender;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $address;

	/**
	 * @var string
	 */
	protected $place;

	/**
	 * @var string
	 */
	protected $email;

	/**
	 * @var string
	 */
	protected $remark;

	/**
	 * @var int
	 */
	protected $mark;

	/**
	 * @var string
	 */
	protected $phone;

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
	 * @param int
	 * @return void
	 */
	public function setForm($form) {
		$this->form = $form;
	}

	/**
	 * Getter for form
	 *
	 * @return int
	 */
	public function getForm() {
		return $this->form;
	}

	/**
	 * Sets the senders gender
	 *
	 * @param string
	 * @return void
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}

	/**
	 * Getter for senders gender
	 *
	 * @return string
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * Sets the senders name
	 *
	 * @param string
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Getter for senders name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the senders address
	 *
	 * @param string
	 * @return void
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Getter for senders address
	 *
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the senders place
	 *
	 * @param string
	 * @return void
	 */
	public function setPlace($place) {
		$this->place = $place;
	}

	/**
	 * Getter for senders place
	 *
	 * @return string
	 */
	public function getPlace() {
		return $this->place;
	}

	/**
	 * Sets the senders email
	 *
	 * @param string
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Getter for senders email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the senders remark
	 *
	 * @param string
	 * @return void
	 */
	public function setRemark($remark) {
		$this->remark = $remark;
	}

	/**
	 * Getter for senders remark
	 *
	 * @return string
	 */
	public function getRemark() {
		return $this->remark;
	}

	/**
	 * Setter for marked option
	 *
	 * @param int
	 * @return void
	 */
	public function setMark($mark) {
		$this->mark = $mark;
	}

	/**
	 * Getter for option
	 *
	 * @return int
	 */
	public function getMark() {
		return $this->mark;
	}

	/**
	 * Sets the senders phone
	 *
	 * @param string
	 * @return void
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * Getter for senders phone
	 *
	 * @return string
	 */
	public function getPhone() {
		return $this->phone;
	}

}
?>

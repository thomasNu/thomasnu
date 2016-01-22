<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2015 Thomas Nussbaumer <typo3@thomasnu.ch>
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
 * A News Service
 */
class Tx_Thomasnu_Domain_Model_News extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * The news term
	 *
	 * @var integer $term
	 */
	protected $term;

	/**
	 * The news endterm
	 *
	 * @var integer $endterm
	 */
	protected $endterm = 0;

	/**
	 * The news sort
	 *
	 * @var integer $sort
	 */
	protected $sort = 0;

	/**
	 * The news category
	 *
	 * @var string $category
	 */
	protected $category = '';

	/**
	 * The news subject
	 *
	 * @var string $subject
	 */
	protected $subject = '';

	/**
	 * The news title
	 *
	 * @var string $title
	 */
	protected $title = '';

	/**
	 * The news teaser
	 *
	 * @var string $teaser
	 */
	protected $teaser = '';

	/**
	 * The news margin
	 *
	 * @var string $margin
	 */
	protected $margin;

	/**
	 * The news portal
	 *
	 * @var string $portal
	 */
	protected $portal = '';

	/**
	 * The news agenda
	 *
	 * @var string $agenda
	 */
	protected $agenda = '';

	/**
	 * The news link
	 *
	 * @var string $link
	 */
	protected $link = '';

	/*
	 * Constructs a new News entry
	 *
	 * @param integer $term
	*/ 
	public function __construct($term = 0) {
		if ($term == 0) $term = mktime(0, 0, 0);
		$this->term = $term;
	}

	/**
	 * Sets the term of the news
	 *
	 * @param string $term
	 * @return void
	 */
	public function setTerm($term) {
		$this->term = $this->normalizeValue($term);
	}

	/**
	 * Returns the term of the news
	 *
	 * @return integer $term
	 */
	public function getTerm() {
		return $this->term;
	}

	/**
	 * Sets the endterm of the news
	 *
	 * @param string $endterm
	 * @return void
	 */
	public function setEndterm($endterm) {
		$this->endterm = $this->normalizeValue($endterm);
	}

	/**
	 * Returns the endterm of the news
	 *
	 * @return integer $endterm
	 */
	public function getEndterm() {
		return $this->endterm;
	}
	/**
	 * Sets the sort of the news
	 *
	 * @param integer $sort
	 * @return void
	 */
	public function setSort($sort) {
		$this->sort = $sort;
	}

	/**
	 * Returns the sort of the news
	 *
	 * @return integer $sort
	 */
	public function getSort() {
		return $this->sort;
	}


	/**
	 * Sets the category of the news
	 *
	 * @param string $category
	 * @return void
	 */
	public function setCategory($category) {
		$this->category = $category;
	}

	/**
	 * Returns the category of the news
	 *
	 * @return string $category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets the subject of the news
	 *
	 * @param string $subject
	 * @return void
	 */
	public function setSubject($subject) {
		$this->subject = $subject;
	}

	/**
	 * Returns the subject of the news
	 *
	 * @return string $subject
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * Sets the title of the news
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the title of the news
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the teaser of the news
	 *
	 * @param string $teaser
	 * @return void
	 */
	public function setTeaser($teaser) {
		$this->teaser = $teaser;
	}

	/**
	 * Returns the teaser of the news
	 *
	 * @return string $teaser
	 */
	public function getTeaser() {
		return $this->teaser;
	}

	/**
	 * Sets the margin of the news
	 *
	 * @param string $margin
	 * @return void
	 */
	public function setMargin($margin) {
		$this->margin = $margin;
	}

	/**
	 * Returns the margin of the news
	 *
	 * @return string $margin
	 */
	public function getMargin() {
		return $this->margin;
	}

	/**
	 * Sets the portal of the news
	 *
	 * @param string $portal
	 * @return void
	 */
	public function setPortal($portal) {
		$this->portal = $portal;
	}

	/**
	 * Returns the portal of the news
	 *
	 * @return string $portal
	 */
	public function getPortal() {
		return $this->portal;
	}

	/**
	 * Sets the agenda of the news
	 *
	 * @param string $agenda
	 * @return void
	 */
	public function setAgenda($agenda) {
		$this->agenda = $agenda;
	}

	/**
	 * Returns the agenda of the news
	 *
	 * @return string $agenda
	 */
	public function getAgenda() {
		return $this->agenda;
	}

	/**
	 * Sets the link of the news
	 *
	 * @param string $link
	 * @return void
	 */
	public function setLink($link) {
		$this->link = $link;
	}

	/**
	 * Returns the link of the news
	 *
	 * @return string $link
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * This method is called every time a date should be set. It is used to convert the 
	 * given string 'd.m.Y H:i' to a timestamp.
	 *
	 * @param string $value The value to be normalized
	 * @return integer The normalized value
	 */
	protected function normalizeValue($value) {
		if ($value != '') {
			preg_match_all('%\d+%', $value, $arr);
			$arr = array_pad($arr[0], 6, 0);
			$value = mktime($arr[3], $arr[4], $arr[5], $arr[1], $arr[0], $arr[2]);
			if ($value === FALSE) $value = mktime(0, 0, 0);
		}
		return (integer)$value;
	}

}
?>

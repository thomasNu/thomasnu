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
 * A repository for News entries
 */
class Tx_Thomasnu_Domain_Repository_NewsRepository extends Tx_Extbase_Persistence_Repository {
	
	/**
	 * Finds portal news ordered by term, sort
	 *
	 * @return array Portal news ordered
	 */
	public function findPortalNews() {
		$query = $this->createQuery();
		$constraints = array();
		$constraints[] = $query->greaterThan('portal', '');
		$constraints[] = $query->logicalNot($query->like('portal', '*%'));
		$constraints[] = $query->logicalNot($query->like('category', 'WB%'));
		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array(
			'term' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING,
			'sort' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
		));
		return $query->execute();
	}
	/**
	 * Finds portal courses ordered by term, sort
	 *
	 * @return array Portal courses ordered
	 */
	public function findPortalCourses() {
		$query = $this->createQuery();
		$constraints = array();
		$constraints[] = $query->greaterThan('portal', '');
		$constraints[] = $query->logicalNot($query->like('portal', '*%'));
		$constraints[] = $query->like('category', 'WB%');
		$constraints[] = $query->greaterThanOrEqual('term', time() + 86400 * 3);
		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array(
			'term' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
			'sort' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
		));
		return $query->execute();
	}
	/**
	 * Finds banner news ordered by term, sort
	 *
	 * @return array Banner news ordered
	 */
	public function findBannerNews() {
		$query = $this->createQuery();
		$constraints = array();
		$constraints[] = $query->equals('category', 'WB,Lst');
		$constraints[] = $query->greaterThanOrEqual('endterm', time());
		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array(
			'term' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
			'sort' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
		));
		return $query->execute();
	}
	/**
	 * Finds agenda entries ordered by term, sort
	 *
	 * @param string $category Category of school holidays news e. g. BZU, SF
	 * @return array Agenda entries ordered
	 */
	public function findAgendaEntries($category) {
		$query = $this->createQuery();
		$constraints = array();
		$constraints[] = $query->logicalOr($query->greaterThanOrEqual('term', time() - 86400 * (date('w') == 0 ? -1 : date('w'))), $query->greaterThanOrEqual('endterm', time()));
		$constraints[] = $query->greaterThan('agenda', '');
		$constraints[] = $query->logicalNot($query->equals('category', $category));
		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array(
			'term' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
			'sort' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
		));
		return $query->execute();
	}
	/**
	 * Finds school holidays entries ordered by term, sort
	 *
	 * @param string $category Category of school holidays news e. g. BZU, SF
	 * @return array school holidays entries ordered
	 */
	public function findSchoolEntries($category) {
		$query = $this->createQuery();
		$constraints = array();
		$constraints[] = $query->greaterThan('term', time() - 86400 * 50);
		$constraints[] = $query->lessThan('term', time() + 86400 * 100);
		$constraints[] = $query->equals('category', $category);
		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array(
			'term' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
			'sort' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
		));
		return $query->execute();
	}
	/**
	 * Finds group entries ordered by term, sort
	 *
	 * @param string $category Category of group news e. g. HGF, FA
	 * @return array group entries ordered
	 */
	public function findGroupEntries($category) {
		$query = $this->createQuery();
		$constraints = array();
		$constraints[] = $query->greaterThanOrEqual('term', time() - 86400 * (date('w') == 0 ? -1 : date('w')));
		$constraints[] = $query->greaterThan('agenda', '');
		$constraints[] = $query->equals('category', $category);
		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array(
			'term' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
			'sort' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
		));
		return $query->execute();
	}
	/**
	 * Finds course entries ordered by term, sort
	 *
	 * @param string $category Category of course news e. g. WB%
	 * @return array Course entries ordered
	 */
	public function findCourseEntries($category) {
		$query = $this->createQuery();
		$constraints = array();
		$constraints[] = $query->greaterThanOrEqual('term', time() - 86400 * (date('w') == -1 ? 0 : date('w')));
		$constraints[] = $query->greaterThan('agenda', '');
		$constraints[] = $query->like('category', $category);
		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array(
			'term' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
			'sort' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
		));
		return $query->execute();
	}
	
	/**
	 * Finds list of news ordered by term, sort
	 *
	 * @param array $range Range of current news (+days, -days)
	 * @param array $cats Access restricted categories of current news
	 * @return array List of News ordered
	 */
	public function findNewsList($range, $cats) {
		$query = $this->createQuery();
		$constraints = array();
		$constraints[] = $query->lessThan('term', time() + 86400 * $range[0]);
		$constraints[] = $query->greaterThanOrEqual('term', time() + 86400 * $range[1]);
		$constraints[] = $query->greaterThan('title', '');
		$constraints[] = $query->logicalNot($query->like('category', 'WB%'));
		if (!empty($cats) && $cats[0] != '') $constraints[] = $query->logicalNot($query->in('category', $cats));
		$constraintsC = array();
		$constraintsC[] = $query->lessThan('term', time() + 86400 * $range[0]);
		$constraintsC[] = $query->greaterThan('term', time());
		$constraintsC[] = $query->like('category', 'WB%');
		$constraintsC[] = $query->logicalNot($query->like('category', 'WB,Fpr'));
		$query->matching($query->logicalOr($query->logicalAnd($constraints), $query->logicalAnd($constraintsC)));
		$query->setOrderings(array(
			'term' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING,
			'sort' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
		));
		return $query->execute();
	} 
	
	/**
	 * Finds list of news archives ordered by term, sort
	 *
	 * @param array $range Range of current news (+days, -days)
	 * @param array $cats Access restricted categories of current news
	 * @return array List of News ordered
	 */
	public function findNewsArchives($range, $cats) {
		$query = $this->createQuery();
		$constraints = array();
		$constraints[] = $query->lessThan('term', time() + 86400 * $range[1]);
		$constraints[] = $query->greaterThan('title', '');
		$constraints[] = $query->logicalNot($query->like('category', 'WB%'));
		$constraints[] = $query->logicalNot($query->like('category', 'BO%'));
		if (!empty($cats) && $cats[0] != '') $constraints[] = $query->logicalNot($query->in('category', $cats));
		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array(
			'term' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING,
			'sort' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
		));
		return $query->execute();
	} 

	/**
	 * Finds list of infos ordered by term, sort
	 *
	 * @param string $category Category of info news e. g. GS%, GA
	 * @return array List of News ordered
	 */
	public function findInfos($category) {
		$query = $this->createQuery();
		if ($this->frontendUserHasRole('Editor') && $category != 'BLOG') {
			$query->matching($query->logicalNot($query->equals('category', 'BLOG')));
		} else {
			$constraints = array();
			$constraints[] = $query->greaterThan('teaser', '');
			$constraints[] = $query->like('category', $category);
			$query->matching($query->logicalAnd($constraints));
		}
		$query->setOrderings(array(
			'term' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING,
			'sort' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
		));
		return $query->execute();
	} 
	
	/**
	 * Finds host courses ordered by term
	 *
	 * @return array Host courses ordered
	 */
	public function findHostCourses() {
		$weekday = (date('w') == 0) ? 1 : date('w');
		$start = time() - 86400 * ($weekday - 1);
		$query = $this->createQuery();
		$constraints = array();
		$constraints[] = $query->like('category', 'WB,F%');
		$constraints[] = $query->logicalOr($query->greaterThanOrEqual('term', $start), $query->greaterThanOrEqual('endterm', $start));
		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array('term' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING));
		return $query->execute();
	}
	/**
	 * Determines whether the currently logged in FE user belongs to the specified usergroup
	 *
	 * @param string $role The usergroup (either the usergroup uid or its title)
	 * @return boolean TRUE if the currently logged in FE user belongs to $role
	 */
	protected function frontendUserHasRole($role) {
		if (!isset($GLOBALS['TSFE']) || !$GLOBALS['TSFE']->loginUser) {
			return FALSE;
		}
		if (is_numeric($role)) {
			return (is_array($GLOBALS['TSFE']->fe_user->groupData['uid']) && in_array($role, $GLOBALS['TSFE']->fe_user->groupData['uid']));
		} else {
			return (is_array($GLOBALS['TSFE']->fe_user->groupData['title']) && in_array($role, $GLOBALS['TSFE']->fe_user->groupData['title']));
		}
	}
}
?>

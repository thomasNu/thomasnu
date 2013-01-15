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
 * A repository for mail forms
 */
class Tx_Thomasnu_Domain_Repository_MailRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * Finds list of comments ordered by date
	 *
	 * @param integer $uid Uid of displayed news detail
	 * @return array List of comments ordered
	 */
	public function findComments($uid) {
		$query = $this->createQuery();
		$constraints = array();
		$constraints[] = $query->equals('form', 'COMMENT');
		$constraints[] = $query->equals('hash', $uid);
		$constraints[] = $query->greaterThan('published', 0);
		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array(
			'date' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
		));
		return $query->execute();
	} 
//	protected $defaultOrderings = array('date' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING);
}
?>

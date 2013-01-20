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
 * A repository for poster of mail forms
 */
class Tx_Thomasnu_Domain_Repository_PosterRepository extends Tx_Extbase_Persistence_Repository {

	protected $defaultOrderings = array('name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING);

	/**
	 * Gets the current user's Poster entity or create
	 * a new Poster entity for a logged in user. If no
	 * user is logged in, NULL is returned.
	 *
	 * @param boolean $autoAddIfFrontendUserLoggedIn
	 * @return Tx_Thomasnu_Domain_Model_Poster | NULL
	 */
	public function getOrCreatePoster($autoAddIfFrontendUserLoggedIn = FALSE) {
		$poster = NULL;
		if ($_SESSION['thomasnu_poster_identifier'] != '' || $_COOKIE['thomasnu_poster_identifier'] != '') {
			$poster = $this->findOneByIdentifier($_COOKIE['thomasnu_poster_identifier'] ? $_COOKIE['thomasnu_poster_identifier'] : $_SESSION['thomasnu_poster_identifier']);
		} elseif ($GLOBALS['TSFE']->fe_user->user) {
			$userRecord = $GLOBALS['TSFE']->fe_user->user;
			$poster = $this->findOneByEmail($userRecord['email']);
			if (!$poster) {
				$poster = $this->objectManager->create('Tx_Thomasnu_Domain_Model_Poster');
				$poster->setName($userRecord['name']);
				$poster->setEmail($userRecord['email']);
				if ($autoAddIfFrontendUserLoggedIn === TRUE) {
					$this->add($poster);
				}
			}
		}
		return $poster;
	}
}
?>

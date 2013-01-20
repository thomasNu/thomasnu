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
 * The controller for actions related to mail forms
 */
class Tx_Thomasnu_Controller_MailController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_Thomasnu_Domain_Model_MailRepository
	 */
	protected $mailRepository;

	/**
	 * Dependency injection of the Mail Repository
	 *
	 * @param Tx_Thomasnu_Domain_Repository_MailRepository $mailRepository
	 * @return void
	 */
	public function injectMailRepository(Tx_Thomasnu_Domain_Repository_MailRepository $mailRepository) {
		$this->mailRepository = $mailRepository;
	}
	/**
	 * Displays a form for creating a new mail
	 *
	 * @param Tx_Thomasnu_Domain_Model_News $news The news the mail belogs to
	 * @param Tx_Thomasnu_Domain_Model_Mail $newMail A fresh mail object taken as a basis for the rendering
     * @return void
	 * @dontvalidate $newMail
	 */
	public function newAction(Tx_Thomasnu_Domain_Model_News $news, Tx_Thomasnu_Domain_Model_Mail $newMail = NULL) {
		$this->view->assign('newMail', $newMail);
		$this->view->assign('news', $news);
	}
	/**
	 * Creates a new mail
	 *
	 * @param Tx_Thomasnu_Domain_Model_Mail $newMail A fresh mail object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Thomasnu_Domain_Model_Mail $newMail) {
		$this->mailRepository->add($newMail);
		$this->redirect('show', 'Mail', NULL, array('mail' => $newMail->getUid()));
	}
}
?>

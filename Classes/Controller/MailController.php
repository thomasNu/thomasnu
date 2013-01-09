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
    * @var Tx_Extbase_Persistence_Manager
    */
    protected $persistanceManager;
 
 	/**
	 * @var Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 */
	protected $configurationManager;
   
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
	 * Dependency injection of the Persistence Manager
	 *
     * @param Tx_Extbase_Persistence_Manager $persistanceManager
     * @return void
     */
    public function injectPersistanceManager(Tx_Extbase_Persistence_Manager $persistanceManager) {
      $this->persistanceManager = $persistanceManager;
    }
	/**
	 * @param Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 */
	public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;
	}
	/**
	 * Displays a form for creating a new mail
	 *
	 * @param Tx_Thomasnu_Domain_Model_Mail $newMail A fresh mail object taken as a basis for the rendering
     * @return void
	 * @dontvalidate $newMail
	 */
	public function newAction(Tx_Thomasnu_Domain_Model_Mail $newMail = NULL) {
		$page = $GLOBALS['TSFE']->page;
//		$configuration = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase']['extensions']['Thomasnu']['plugins']['Mail']['controllers'];
//		$configuration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$this->view->assign('page', $page);
		$this->view->assign('debug', $configuration);
		$this->view->assign('newMail', $newMail);
	}
	/**
	 * Creates a new mail
	 *
	 * @param Tx_Thomasnu_Domain_Model_Mail $newMail A fresh mail object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Thomasnu_Domain_Model_Mail $newMail) {
		$this->mailRepository->add($newMail);
		$this->persistanceManager->persistAll();
		$this->redirect('show', 'Mail', NULL, array('mail' => $newMail->getUid()));
	}
	/**
	 * Displays a single mail
	 *
	 * @param Tx_Thomasnu_Domain_Model_Mail $mail The mail to display
	 * @return void
	 */
	public function showAction(Tx_Thomasnu_Domain_Model_Mail $mail) {
		$page = $GLOBALS['TSFE']->page;
	//	$this->sendTemplateEmail(array('info@thomasnu.ch' => 'Thomas Nussbaumer'), array('sender@domain.tld' => 'Sender Name', 'Email Subject', 'TemplateName', array('mail' => $mail));
		$this->view->assign('page', $page);
		$this->view->assign('mail', $mail);
	}
	/**
	 * Fluid Standalone view to render template based emails
	 *
	 * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
	 * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
	 * @param string $subject subject of the email
	 * @param string $templateName template name (UpperCamelCase)
	 * @param array $variables variables to be passed to the Fluid view
	 * @return boolean TRUE on success, otherwise false
	 */
	protected function sendTemplateEmail(array $recipient, array $sender, $subject, $templateName, array $variables = array()) {
		$emailView = $this->objectManager->create('Tx_Fluid_View_StandaloneView');
		$emailView->setFormat('html');
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
		$templatePathAndFilename = $templateRootPath . 'Email/' . $templateName . '.html';
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);
		$emailView->assignMultiple($variables);
		$emailBody = $emailView->render();

		$message = t3lib_div::makeInstance('t3lib_mail_Message');
		$message->setTo($recipient)
			  ->setFrom($sender)
			  ->setSubject($subject);

		// Possible attachments here
		//foreach ($attachments as $attachment) {
		//	$message->attach($attachment);
		//}

		// Plain text example
		$message->setBody($emailBody, 'text/plain');

		// HTML Email
		#$message->setBody($emailBody, 'text/html');

		$message->send();
		return $message->isSent();
	}
}
?>

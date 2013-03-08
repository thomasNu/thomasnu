<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Thomas Nussbaumer <info@thomasnu.ch>
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
 * The controller for actions related to page content
 */
class Tx_Thomasnu_Controller_ContentController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_Thomasnu_Domain_Model_ContentRepository
	 */
	protected $contentRepository;

	/**
	 * @var Tx_Thomasnu_Domain_Model_SectionRepository
	 */
	protected $sectionRepository;

    /**
    * @var Tx_Extbase_Persistence_Manager
    */
    protected $persistanceManager;

	/**
	 * Dependency injection of the Content Repository
	 *
	 * @param Tx_Thomasnu_Domain_Repository_ContentRepository $contentRepository
	 * @return void
	 */
	public function injectContentRepository(Tx_Thomasnu_Domain_Repository_ContentRepository $contentRepository) {
		$this->contentRepository = $contentRepository;
	}
	/**
	 * Dependency injection of the Section Repository
	 *
	 * @param Tx_Thomasnu_Domain_Repository_SectionRepository $sectionRepository
	 * @return void
	 */
	public function injectSectionRepository(Tx_Thomasnu_Domain_Repository_SectionRepository $sectionRepository) {
		$this->sectionRepository = $sectionRepository;
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
	 * Index action for this controller. Displays content of current page.
	 *
	 * @return string The rendered view
	 */
	public function indexAction() {
		$page = $GLOBALS['TSFE']->page;
		while (($pageContent = $this->contentRepository->findOneByPage($page['uid'])) == NULL) {
			$this->contentRepository->add(new Tx_Thomasnu_Domain_Model_Content($page['uid']));
			$this->persistanceManager->persistAll();
			}
		$this->view->assign('page', $pageContent);
		$this->view->assign('print', t3lib_div::_GP('print'));
		$sections = $pageContent->getSections();
		$this->view->assign('sections', $sections);
		$references = array();
		foreach ($sections as $section) {
			if (preg_match('%<!--ref(\d+)-->%', $section->getMain(), $parts)) {
				$ref = $this->sectionRepository->findByUid($parts[1]);
				if ($ref !== NULL && $ref->getMain() != '') {
					$references[$parts[1]] = $ref->getMain();
				}
			}
			if (trim($section->getMargin()) == '/') {
				$section->setName('/' . str_replace('/', '', $section->getName()));
			} else if (preg_match('%<!--ref(\d+)-->%', $section->getMargin(), $parts)) {
				$ref = $this->sectionRepository->findByUid($parts[1]);
				if ($ref !== NULL && $ref->getMargin() != '') {
					$references[20000 + $parts[1]] = $ref->getMargin();
				}
			}
			if (preg_match('%<!--ref(\d+)-->%', $section->getBottom(), $parts)) {
				$ref = $this->sectionRepository->findByUid($parts[1]);
				if ($ref !== NULL && $ref->getBottom() != '') {
					$references[40000 + $parts[1]] = $ref->getBottom();
				}
			}
		}
		$this->view->assign('references', count($references) ? $references : NULL);
	}
}
?>

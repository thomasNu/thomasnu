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
 * The controller for actions related to page section
 */
class Tx_Thomasnu_Controller_SectionController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var t3lib_pageSelect
	 */
	protected $pageSelect;

	/**
	 * @var Tx_Thomasnu_Domain_Model_SectionRepository
	 */
	protected $sectionRepository;

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
	 * Displays the content of a page
	 *
	 * @param Tx_Thomasnu_Domain_Model_Content $page The page the content belogs to
	 * @param Tx_Thomasnu_Domain_Model_Section $insertSection  The original of section to insert
	 * @param integer $insert  The insert mode: 1 = copy, -1 move, 0 = none
	 * @return void
	 */
	public function indexAction(Tx_Thomasnu_Domain_Model_Content $page, Tx_Thomasnu_Domain_Model_Section $insertSection = NULL, $insert = 0) {
		$sections = $this->sectionRepository->findByPage($page);
		$this->view->assign('sections', $sections);
		$this->view->assign('page', $page);
		$this->view->assign('insertSection', $insertSection);
		$this->view->assign('insert', $insert);
		$this->pageSelect = new t3lib_pageSelect();
		$this->pageSelect->init(FALSE);
		$references = array();
		foreach ($sections as $section) {
			if (preg_match('%<!--ref(\d+)-->%', $section->getMain(), $parts)) {
				$ref = $this->sectionRepository->findByUid($parts[1]);
				if ($ref !== NULL && $ref->getMain() != '') {
					$references[$parts[1]] = $this->makeSectionLink($ref); 
				}
			}
			if (trim($section->getMargin()) == '/') {
				$section->setName('/' . str_replace('/', '', $section->getName()));
			} else if (preg_match('%<!--ref(\d+)-->%', $section->getMargin(), $parts)) {
				$ref = $this->sectionRepository->findByUid($parts[1]);
				if ($ref !== NULL && $ref->getMargin() != '') {
					$references[20000 + $parts[1]] = $this->makeSectionLink($ref); 
				}
			}
			if (preg_match('%<!--ref(\d+)-->%', $section->getBottom(), $parts)) {
				$ref = $this->sectionRepository->findByUid($parts[1]);
				if ($ref !== NULL && $ref->getBottom() != '') {
					$references[40000 + $parts[1]] = $this->makeSectionLink($ref); 
				}
			}
		}
		$this->view->assign('references', count($references) ? $references : NULL);
	}
	/**
	 * Make section link in wiki code.
	 * 
	 * @param Tx_Thomasnu_Domain_Model_Section $ref The reference to the section
	 * @return string Wiki section link
	 */
	protected function makeSectionLink(Tx_Thomasnu_Domain_Model_Section $ref) {
		$refPage = $ref->getPage();
		$rootLine = array_reverse($this->pageSelect->getRootLine($refPage->getPage()));
		array_shift($rootLine);
		$sectionPath = '';
		foreach ($rootLine as $row) {
			$sectionPath .= ' /' . $row['title'];
		}
		$sectionName = str_replace('*', '', str_replace('+', '', $ref->getName()));
		$sectionPath .= $sectionName ? ' #' . $sectionName : '';
		return '[ref:' . $refPage->getPage() . ':' . $refPage->getUid() . ':' . $ref->getUid() . ':' . $ref->getSection() 
			. '|' . $sectionPath . '|' . Tx_Extbase_Utility_Localization::translate('LLL:EXT:lang/locallang_common.xml:edit', '') . ']';
	}	
	/**
	 * Displays a form for creating a new section
	 *
	 * @param integer $sectionId  The Id of the new section
	 * @param Tx_Thomasnu_Domain_Model_Content $page The page the section belogs to
	 * @param Tx_Thomasnu_Domain_Model_Section $newSection A fresh section object taken as a basis for the rendering
	 * @return void
	 * @dontvalidate $newSection
	 */
	public function newAction($sectionId, Tx_Thomasnu_Domain_Model_Content $page, Tx_Thomasnu_Domain_Model_Section $newSection = NULL) {
		$this->view->assign('sectionId', $sectionId);
		$this->view->assign('page', $page);
		$this->view->assign('newSection', $newSection);
	}
	/**
	 * Creates a new section
	 *
	 * @param Tx_Thomasnu_Domain_Model_Content $page The page the section belogns to
	 * @param Tx_Thomasnu_Domain_Model_Section $newContent A fresh Content object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Thomasnu_Domain_Model_Content $page, Tx_Thomasnu_Domain_Model_Section $newSection) {
		$page->addSection($newSection);
		$newSection->setPage($page);
		$this->redirect('index', NULL, NULL, array('page' => $page));
	}
	/**
	 * Displays a form to edit an existing section
	 *
	 * @param integer $sectionId  The Id of the section
	 * @param Tx_Thomasnu_Domain_Model_Content $page The page the section belogs to
	 * @param Tx_Thomasnu_Domain_Model_Section $section The original section
	 * @return void
	 * @dontvalidate $section
	 */
	public function editAction($sectionId, Tx_Thomasnu_Domain_Model_Content $page, Tx_Thomasnu_Domain_Model_Section $section) {
		$this->view->assign('sectionId', $sectionId);
		$this->view->assign('page', $page);
		$this->view->assign('section', $section);
	}
	/**
	 * Updates an existing section
	 *
	 * @param Tx_Thomasnu_Domain_Model_Content $page The page the section belongs to
	 * @param Tx_Thomasnu_Domain_Model_Section $section A clone of the original section with the updated values already applied or section to move or copy
	 * @param mixed $modify  The case of modifikation or new sectionId or NULL if update with formular
	 * @return void
	 */
	public function updateAction(Tx_Thomasnu_Domain_Model_Content $page, Tx_Thomasnu_Domain_Model_Section $section, $modify = NULL) {
		$insert = 0;
		if ($modify == NULL) {
			$this->sectionRepository->update($section);
		} else if (is_numeric($modify)) {
			$sectionId = (int)$modify;
			if ($sectionId < 0) {
				$section->setSection(abs($sectionId));
			} else {
				$newSection = new Tx_Thomasnu_Domain_Model_Section($sectionId);
				$newSection->setPage($page);
				$page->addSection($newSection);
				$newSection->setMain($section->getMain());
				$newSection->setMargin($section->getMargin());
				$newSection->setBottom($section->getBottom());
			}
		} else {
			switch ($modify) {
				case 'pager':
					$name = $section->getName();
					$section->setName(strpos($name, '+') === FALSE ? '+' . $name : str_replace('+', '', $name));
					break;
				case 'hide':
					$name = $section->getName();
					$section->setName(strpos($name, '*') === FALSE ? '*' . $name : str_replace('*', '', $name));
					break;
				case 'copy':
					$insert = 1;
					break;
				case 'cut':
					$insert = -1;
					break;
			}
		}
		$this->redirect('index', NULL, NULL, array('page' => $page, 'insertSection' => $section, 'insert' => $insert));
	}
	/**
	 * Deletes an existing section
	 *
	 * @param Tx_Thomasnu_Domain_Model_Content $page The page the section belongs to
	 * @param Tx_Thomasnu_Domain_Model_Section $section The section to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Thomasnu_Domain_Model_Content $page, Tx_Thomasnu_Domain_Model_Section $section) {
		$this->sectionRepository->remove($section);
		$this->redirect('index', NULL, NULL, array('page' => $page));
	}
}
?>

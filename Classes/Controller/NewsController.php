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
 * The controller for actions related to News
 */
class Tx_Thomasnu_Controller_NewsController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_Thomasnu_Domain_Model_NewsRepository
	 */
	protected $newsRepository;

	/**
	 * @var Tx_Thomasnu_Domain_Model_MailRepository
	 */
	protected $mailRepository;

	/**
	 * @var string
	 */
	protected $category;

	/**
	 * Dependency injection of the News Repository
	 *
	 * @param Tx_Thomasnu_Domain_Repository_NewsRepository $newsRepository
	 * @return void
	 */
	public function injectNewsRepository(Tx_Thomasnu_Domain_Repository_NewsRepository $newsRepository) {
		$this->newsRepository = $newsRepository;
	}
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
	 * Gets category from settings
	 *
	 * @return void
	 */
	public function initializeAction() {
		$this->category = str_replace('+', '', $this->settings['newsCategory']);
	}
	/**
	 * Index action for this controller. Displays news and courses on portal.
	 *
	 * @return string The rendered view
	 */
	public function indexAction() {
		$loginUser = $GLOBALS['TSFE']->loginUser;
		$page = $GLOBALS['TSFE']->page;
		$this->view->assign('page', $page);
		switch ($page['alias']) { 
			case 'test':
				$this->view->assign('portalNews', $this->newsRepository->findPortalNews());
				$this->view->assign('portalCourses', $this->newsRepository->findPortalCourses());
				break;
			case 'portal':
				$this->view->assign('portalNews', $this->newsRepository->findPortalNews());
				$this->view->assign('portalCourses', $this->newsRepository->findPortalCourses());
				break;
			case 'agenda':
				$categories = explode(';', str_replace(' ', '', $this->settings['agCategories']));
				$this->view->assign('agendaEntries', $this->newsRepository->findAgendaEntries($categories[0]));
				$this->view->assign('today', date('ymd'));
				$this->view->assign('week', date('W'));
				$this->view->assign('group', $categories[1]);
				$this->view->assign('course', str_replace('%', '', $categories[2]));
				$this->view->assign('course0', $categories[3]);
				break;
			case 'aktuell':
				if (!$loginUser) $accessRestrictedCategories = explode(';', str_replace(' ', '', $this->settings['newsCategory']));
				$range = explode('/', $this->settings['dayRange']);
				$this->view->assign('newsList', $this->newsRepository->findNewsList($range, $accessRestrictedCategories));
				$this->view->assign('newsArchives', $this->newsRepository->findNewsArchives($range, $accessRestrictedCategories));
				break;
			case 'kursdaten':
				$courses = $this->newsRepository->findHostCourses();
				$this->view->assign('firstCourse', $courses->getFirst());
				foreach ($courses as $course) {
					$lastCourse = $course;
				}
				$this->view->assign('lastCourse', $lastCourse);
				$this->view->assign('hostCourses', $courses);
				break;
		}
	}
	/**
	 * Info action for this controller. Displays infos.
	 *
	 * @param Tx_Thomasnu_Domain_Model_News $insertNews  The original of news to insert
	 * @param integer $insert  The insert mode: 1 = copy, -1 move, 0 = none
	 * @param boolean $blog  Back to list for blog
	 * @return string The rendered view
	 */
	public function infoAction(Tx_Thomasnu_Domain_Model_News $insertNews = NULL, $insert = 0, $blog = FALSE) {
		$infos = $this->newsRepository->findInfos($this->category);
		if (count($infos) > 0 && !$blog && $this->category == 'BLOG') {
			$this->redirect('detail', NULL, NULL, array('news' => $infos->getFirst()));
		} else {
			$this->view->assign('infos', $infos);
			$this->view->assign('insertNews', $insertNews);
			$this->view->assign('insert', $insert);
			$this->view->assign('blog', $blog);
			$comments = array();
			if (strpos($this->settings['newsCategory'], '+') !== FALSE) {
				foreach ($infos as $news) {
					$count = $this->mailRepository->countComments($news->getUid());
					if ($count > 0) {
						$comments[] = array('hash' => $news->getUid(), 'count' => $count);
					}
				}
				$this->view->assign('comments', $comments);
			}
		}
	}
	/**
	 * Detail action for this controller. Displays details of an info.
	 *
	 * @param Tx_Thomasnu_Domain_Model_News $news  The news to display
	 * @return string The rendered view
	 */
	public function detailAction(Tx_Thomasnu_Domain_Model_News $news) {
		$this->view->assign('news', $news);
		$this->view->assign('blog', $this->category == 'BLOG');
		$infos = $this->newsRepository->findInfos($this->category, $news->getUid());
		$this->view->assign('infos', $infos);
		if (strpos($this->settings['newsCategory'], '+') !== FALSE) {
			$comments = $this->mailRepository->findComments($news->getUid());
			$this->view->assign('comments', $comments);
		}
	}
	/**
	 * Displays a form for creating a new news
	 *
	 * @param integer $newTerm  The Term of the new news
	 * @param Tx_Thomasnu_Domain_Model_News $newNews A fresh news object taken as a basis for the rendering
	 * @return void
	 * @dontvalidate $newNews
	 */
	public function newAction($newTerm, Tx_Thomasnu_Domain_Model_News $newNews = NULL) {
		$this->view->assign('newTerm', $newTerm);
		$this->view->assign('newNews', $newNews);
		$this->view->assign('blog', $this->category == 'BLOG');
		if ($this->category == 'BLOG') {
			$userInfos = $GLOBALS['TSFE']->fe_user->user;
			$this->view->assign('author', $userInfos['name']);
			$this->view->assign('email', $userInfos['email']);
		}
	}
	/**
	 * Creates a new news
	 *
	 * @param Tx_Thomasnu_Domain_Model_News $newNews A fresh news object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Thomasnu_Domain_Model_News $newNews) {
		$this->newsRepository->add($newNews);
		$GLOBALS['TSFE']->clearPageCacheContent();
		$this->redirect('info', NULL, NULL, array('blog' => $this->category == 'BLOG'));
	}
	/**
	 * Displays a form to edit an existing news
	 *
	 * @param Tx_Thomasnu_Domain_Model_News $news The original news
	 * @param string $error
	 * @return void
	 * @dontvalidate $news
	 */
	public function editAction(Tx_Thomasnu_Domain_Model_News $news, $error = '') {
		$this->view->assign('news', $news);
		$this->view->assign('blog', $this->category == 'BLOG');
		$this->view->assign('error', $error);
	}
	/**
	 * Updates an existing news
	 *
	 * @param Tx_Thomasnu_Domain_Model_News $news A clone of the original news with the updated values already applied
	 * @param mixed $modify  The case of modifikation or new term or NULL if update with formular
	 * @return void
	 */
	public function updateAction(Tx_Thomasnu_Domain_Model_News $news, $modify = NULL) {
		$insert = 0;
		if ($modify == NULL) {
			$this->newsRepository->update($news);
			if ($imageFile = $this->request->getArgument('imageFile')) {
				if ($imageFile['type'] == 'image/jpeg') {
					$imageProperties = $this->request->getArgument('imageProperties');
					$imageName = $imageProperties['name'] ? $imageProperties['name'] : $imageFile['name'];
					$parts = explode('.', $imageName);
					$imageName = strtolower(preg_replace('%[^a-z0-9]%i', '-', 
						$GLOBALS['TSFE']->csConvObj->specCharsToASCII($GLOBALS['TSFE']->defaultCharSet, str_replace(' ', '', $parts[0])))) . '.jpg';
					$tempFile = t3lib_div::getFileAbsFileName('fileadmin/user_upload/' . $imageName);
					t3lib_div::upload_copy_move($imageFile['tmp_name'], $tempFile);
					$imageTag = t3lib_div::makeInstance('tslib_cObj')->IMAGE(array('file' => 'fileadmin/user_upload/' . $imageName, 'file.' => array('width' => $imageProperties['width'])));
					preg_match('%src="(.+)".+width="(.+)"%U', $imageTag, $imageParams);
					if ($imageProperties['overwrite'] || !in_array($imageName, t3lib_div::getFilesInDir('fileadmin/images/news/', 'jpg'))) {
						@copy(t3lib_div::getFileAbsFileName($imageParams[1]), t3lib_div::getFileAbsFileName('fileadmin/images/news/' . $imageName));
						$error = 'news/' . $imageName . '(' . $imageParams[2] . 'px)';
					} else {
						$error = 'news/' . $imageName;
					}
					@unlink($tempFile);
				} else {
					$error = $imageFile['type'];
				}
			}
		} else if (is_numeric($modify)) {
			$term = (integer)$modify;
			$delta = $news->getEndterm() - $news->getTerm();
			$newTerm = date('d.m.Y ', abs($term)) . date('H:i', $news->getTerm());
			$endTerm = $news->getEndterm() ? date('d.m.Y ', abs($term) + $delta) . date('H:i', $news->getEndterm()) : 0;
			if ($term < 0) {
				$news->setTerm($newTerm);
				$news->setEndterm($endTerm);
			} else {
				$newNews = new Tx_Thomasnu_Domain_Model_News();
				$newNews->setTerm($newTerm);
				$newNews->setEndterm($endTerm);
				$newNews->setSort($news->getSort());
				$newNews->setCategory($news->getCategory());
				$newNews->setSubject($news->getSubject());
				$newNews->setTitle($news->getTitle());
				$newNews->setTeaser($news->getTeaser());
				$newNews->setMargin($news->getMargin());
				$newNews->setPortal($news->getPortal());
				$newNews->setAgenda($news->getAgenda());
				$newNews->setLink($news->getLink());
				$this->newsRepository->add($newNews);
			}
		} else {
			switch ($modify) {
				case 'copy':
					$insert = 1;
					break;
				case 'cut':
					$insert = -1;
					break;
			}
		}
		$GLOBALS['TSFE']->clearPageCacheContent();
		if ($error) {
			$this->redirect('edit', NULL, NULL, array('news' => $news, 'error' => $error));
		} else {
			$this->redirect('info', NULL, NULL, array('insertNews' => $news, 'insert' => $insert, 'blog' => $this->category == 'BLOG'));
		}
	}
	/**
	 * Deletes an existing news
	 *
	 * @param Tx_Thomasnu_Domain_Model_News $news The news to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_Thomasnu_Domain_Model_News $news) {
		$this->newsRepository->remove($news);
		$GLOBALS['TSFE']->clearPageCacheContent();
		$this->redirect('info', NULL, NULL, array('blog' => $this->category == 'BLOG'));
	}
	/**
	 * Banner action for this controller. Displays news on banner.
	 *
	 * @return string The rendered view
	 */
	public function bannerAction() {
		$this->view->assign('bannerNews', $this->newsRepository->findBannerNews());
	}
	/**
	 * Calendar action for this controller. Displays navigation calendar.
	 *
	 * @return string The rendered view
	 */
	public function calendarAction() {
		$month = date('n');
		$year = $y = date('Y');
		$weeks = array();
		for ($i = 0; $i < 3; $i++) {
			$m = $month + $i;
			if ($m > 12) {
				$m -= 12;
				if ($y == $year) $y++;
			}
			$first = mktime(0, 0, 0, $m, 1, $y);
			$w = date('w', $first);
			$monday = $first - 86400 * (($w == 0) ? 6 : $w - 1);
			while (date('Ym', $monday) <= 100 * $y + $m) {
				$weeks[] = array('monday' => $monday, 'month' => $m, 'first' => $first);
				$monday += 7 * 86400;
			}
		}
		$this->view->assign('weeks', $weeks);

		$categories = explode(';', str_replace(' ', '', $this->settings['agCategories']));
		$dayLinks = '';
		$monthLinks = '';
		$ymdUnique = "";
		$ymUnique = "";
		$entries = $this->newsRepository->findAgendaEntries($categories[0]);
		foreach ($entries as $entry) {
			$ymd = date('ymd', Tx_Extbase_Reflection_ObjectAccess::getProperty($entry, 'term'));
			if ($ymd != $ymdUnique) {
				$dayLinks .= '#' . $ymd;
				$ymdUnique = $ymd;
				$ym = substr($ymd, 0, 4);
				if ($ym != $ymUnique) {
					$monthLinks .= '#' . $ymd;
					$ymUnique = $ym;
				}
			}
		}
				
		$easterdays = explode(',', str_replace(' ', '', $this->settings['agEasterdays']));
		foreach ($easterdays as $delta) {
			$dayLinks .= date('£\Hmd', easter_date($year) + 86400 * $delta);
		}
		$dayLinks .= $this->settings['agHolidays'];
		$holidays = $this->newsRepository->findSchoolEntries($categories[0]);
		foreach ($holidays as $entry) {
			$start = Tx_Extbase_Reflection_ObjectAccess::getProperty($entry, 'term');
			$end = Tx_Extbase_Reflection_ObjectAccess::getProperty($entry, 'endterm');
			for ($i = $start; $i < 60 + $end; $i += 86400) {
				if (date('w', $i) > 0) {
					$dayLinks .= date('£\Smd', $i);
				} 
			}
		}
		$this->view->assign('dayLinks', $dayLinks);
		$this->view->assign('monthLinks', $monthLinks);
		if ($month > 9) $year++;
		$this->view->assign('year', $year);
		$this->view->assign('year1', $year + 1);
		
		$groups = $this->newsRepository->findGroupEntries($categories[1]);
		$this->view->assign('firstGroup', $groups->getFirst());
		$courses = $this->newsRepository->findCourseEntries($categories[2]);
		foreach ($courses as $firstCourse) {
			if (Tx_Extbase_Reflection_ObjectAccess::getProperty($firstCourse, 'category') != $categories[3]) break;
		}
		$this->view->assign('firstCourse', $firstCourse);
	}
}

?>

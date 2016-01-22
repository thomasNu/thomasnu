<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2014 Thomas Nussbaumer <typo3@thomasnu.ch>
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

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The controller for actions related to Banner
 */
class Tx_Thomasnu_Controller_BannerController extends ActionController  {
	/**
	 * Index action for this controller. Displays banner.
	 *
	 * @return string The rendered view
	 */
	public function indexAction() {
        if (($pageUid = $this->settings['bannerPage']) < 10000) {
            foreach (Tx_Thomasnu_Utility_Database::getRows('pages', 'uid = ' . $pageUid) as $row) {
                if (($title = $row['subtitle']) == '') {
                    $title = $row['title'];
                }
        		$this->view->assign('pageUid', $pageUid);
        		$this->view->assign('title', html_entity_decode($title));
                if (($linkPageUid = $this->settings['bannerLink']) != $pageUid) {
                    foreach (Tx_Thomasnu_Utility_Database::getRows('pages', 'uid = ' . $linkPageUid) as $row) {
            		    $this->view->assign('uri', $row['url']);
                    }
                }
                $files = GeneralUtility::getFilesInDir('fileadmin/images/design/banner/', 'jpg', 1);
        		$this->view->assign('image', array_shift($files));
            }
        }
	}
}
?>

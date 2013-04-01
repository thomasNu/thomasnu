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
 * The controller for actions related to photos
 */
class Tx_Thomasnu_Controller_PhotoController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_Thomasnu_Domain_Model_PhotoRepository
	 */
	protected $photoRepository;

	/**
	 * Dependency injection of the Photo Repository
	 *
	 * @param Tx_Thomasnu_Domain_Repository_PhotoRepository $photoRepository
	 * @return void
	 */
	public function injectPhotoRepository(Tx_Thomasnu_Domain_Repository_PhotoRepository $photoRepository) {
		$this->photoRepository = $photoRepository;
	}
	/**
	 * Displays a form for creating a new photo
	 *
	 * @param Tx_Thomasnu_Domain_Model_Gallery $gallery The gallery the photo belogs to
	 * @param Tx_Thomasnu_Domain_Model_Photo $newPhoto A fresh photo object taken as a basis for the rendering
	 * @return void
	 * @dontvalidate $newSection
	 */
	public function newAction(Tx_Thomasnu_Domain_Model_Gallery $gallery, Tx_Thomasnu_Domain_Model_Photo $newPhoto = NULL) {
		$this->view->assign('gallery', $gallery);
		$this->view->assign('newPhoto', $newPhoto);
	}
	/**
	 * Creates a new photo
	 *
	 * @param Tx_Thomasnu_Domain_Model_Gallery $gallery The gallery the photo belogns to
	 * @param Tx_Thomasnu_Domain_Model_Photo $newPhoto A fresh photo object which has not yet been added to the repository
	 * @param string $start Startphoto
	 * @param string $back Back to page
	 * @return void
	 */
	public function createAction(Tx_Thomasnu_Domain_Model_Gallery $gallery, Tx_Thomasnu_Domain_Model_Photo $newPhoto, $start, $back) {
//		$gallery->addPhoto($newPhoto);
//		$newPhoto->setGallery($gallery);
		$this->redirect('slideshow', 'Gallery', NULL, array('start' => $start, 'back' => $back));
	}
	/**
	 * Displays a form to edit an existing photo
	 *
	 * @param Tx_Thomasnu_Domain_Model_Gallery $gallery The gallery the photo belogs to
	 * @param Tx_Thomasnu_Domain_Model_Photo $photo The original photo
	 * @param string $start Startphoto
	 * @param string $back Back to page
	 * @return void
	 * @dontvalidate $photo
	 */
	public function editAction(Tx_Thomasnu_Domain_Model_Gallery $gallery, Tx_Thomasnu_Domain_Model_Photo $photo, $start, $back) {
		$this->view->assign('gallery', $gallery);
		$this->view->assign('photo', $photo);
		$this->view->assign('start', $start);
		$this->view->assign('back', $back);
//		$this->view->assign('debug', t3lib_div::getFileAbsFileName('fileadmin/images/gallery/ko223.jpg'));
	}
	/**
	 * Updates an existing photo
	 *
	 * @param Tx_Thomasnu_Domain_Model_Gallery $gallery The gallery the photo belogs to
	 * @param Tx_Thomasnu_Domain_Model_Photo $photo A clone of the original photo with the updated values already applied
	 * @param string $oldId Old id of photo
	 * @param string $start Id startphoto
	 * @param string $back Back to page
	 * @param string $modify  The case of modifikation
	 * @return void
	 */
	public function updateAction(Tx_Thomasnu_Domain_Model_Gallery $gallery, Tx_Thomasnu_Domain_Model_Photo $photo, $start, $back, $oldId = '', $modify = '') {
		if ($modify === '') {
			if ($photo->getId() != $oldId) {
				$start = $photo->getId();
//				$path = t3lib_div::getFileAbsFileName(''); 
//				rename('http://nu60.thomasnu.ch/fileadmin/images/gallery/' . $oldId . '.jpg', 'http://nu60.thomasnu.ch/fileadmin/images/gallery/' . $start . '.jpg');
			}
			$this->photoRepository->update($photo);
			$galleryProperties = $this->request->getArgument('galleryProperties');
    		$gallery->setHeader($galleryProperties['header']);
    		$gallery->setLink($galleryProperties['link']);
		} else {
			switch ($modify) {
				case 'pager':
					$text = $photo->getText();
					$photo->setText(strpos($text, '+') === FALSE ? '+' . $text : str_replace('+', '', $text));
					break;
				case 'hide':
					$text = $photo->getText();
					$photo->setText(strpos($text, '*') === FALSE ? '*' . $text : str_replace('*', '', $text));
					break;
			}
		}
		$this->redirect('slideshow', 'Gallery', NULL, array('start' => $start, 'back' => $back));
	}
	/**
	 * Deletes an existing photo
	 *
	 * @param Tx_Thomasnu_Domain_Model_Photo $photo The photo to be deleted
	 * @param string $start Startphoto
	 * @param string $back Back to page
	 * @return void
	 */
	public function deleteAction(Tx_Thomasnu_Domain_Model_Photo $photo, $start, $back) {
		$this->photoRepository->remove($photo);
		$this->redirect('slideshow', 'Gallery', NULL, array('start' => $start, 'back' => $back));
	}
}
?>

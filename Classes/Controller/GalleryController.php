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
 * The controller for actions related to Galleries
 */
class Tx_Thomasnu_Controller_GalleryController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_Thomasnu_Domain_Model_GalleryRepository
	 */
	protected $galleryRepository;

	/**
	 * @var Tx_Thomasnu_Domain_Model_PhotoRepository
	 */
	protected $photoRepository;

	/**
	 * Dependency injection of the Gallery Repository
	 *
	 * @param Tx_Thomasnu_Domain_Repository_GalleryRepository $galleryRepository
	 * @return void
	 */
	public function injectGalleryRepository(Tx_Thomasnu_Domain_Repository_GalleryRepository $galleryRepository) {
		$this->galleryRepository = $galleryRepository;
	}

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
	 * Index action for this controller. Displays a album for printing.
	 *
	 * @param string $start Startphoto
	 * @param string $back Back to page
	 * @return string The rendered view
	 */
	public function indexAction($start, $back) {
		$startPhoto = $this->photoRepository->findOneById($start);
		$gallery = $startPhoto->getGallery();
		$numberPerPage = (int)$gallery->getLink();
		$numberPerPage = $numberPerPage >= 1 && $numberPerPage <= 5 ? $numberPerPage : 3;
		$images = array();
		foreach ($gallery->getPhotos() as $img) {
			$text = $img->getText();
			$caption = $img->getCaption();
			$id = $img->getId();
			$images[$id] = array('text' => ltrim($text, '+*'), 'caption' => $caption, 'id' => $id,
				'pager' => (strpos($text, '+') === FALSE) ? 0 : 1, 'hide' => strpos($text, '*') === FALSE ? 0 : 1);
		}
		ksort($images);
		$photos = array();
		foreach ($images as $photo) {
			if ($photo['text'] == '') {	
				$photo['text'] = $groupText;
			} else {
				$groupText = $photo['text'];
			}
			if (!$photo['hide']) $photos[] = $photo;
		}
		for ($i = 0; $i < count($photos); ++$i) {
			++$j;
			if ($j > $numberPerPage || $photos[$i]['pager']) {
				$photos[$i]['pager'] = 1;
				$j = 1;
			}
		}
		$this->view->assign('photos', $photos);
		$this->view->assign('gallery', $gallery);
		$this->view->assign('back', $back);
	}
	/**
	 * Slideshow action for this controller. Displays a slideshow with startphoto.
	 *
	 * @param string $start Startphoto
	 * @param string $back Back to page
	 * @return string The rendered view
	 */
	public function slideshowAction($start, $back) {
		$startPhoto = $this->photoRepository->findOneById($start);
		$gallery = $startPhoto->getGallery();
		$images = array();
		foreach ($gallery->getPhotos() as $img) {
			$text = $img->getText();
			$caption = $img->getCaption();
			$id = $img->getId();
			$images[$id] = array('text' => ltrim($text, '+*'), 'caption' => $caption, 'id' => $id,
				'pager' => (!$this->frontendUserHasRole('Editor') || strpos($text, '+') === FALSE) ? 0 : 1, 'hide' => strpos($text, '*') === FALSE ? 0 : 1);
		}
		ksort($images);
		$photos = array();
		foreach ($images as $photo) {
			if ($photo['text'] == '') {	
				$photo['text'] = $groupText;
			} else {
				$groupText = $photo['text'];
				$groups .= ",'" . $photo['id'] . "'";
				++$groupCount;
			}
			if ($this->frontendUserHasRole('Editor') || !$photo['hide']) $photos[] = $photo;
		}
		$this->view->assign('groupedPhotos', $photos);
		$this->view->assign('startPhoto', $startPhoto);
		$this->view->assign('firstPhoto', $photos[0]);
		$this->view->assign('lastPhoto', $photo);
		$this->view->assign('lastText', $groupText);
		$this->view->assign('groups', substr($groups, 1));
		$this->view->assign('groupCount', $groupCount);
		$this->view->assign('gallery', $gallery);
		$this->view->assign('back', $back);
		$print = 'http://' . t3lib_div::getIndpEnv('TYPO3_HOST_ONLY') . '/album.html?tx_thomasnu_gallery[start]=' . $start
			. '&tx_thomasnu_gallery[back]=' . $back . '&tx_thomasnu_gallery[action]=index&tx_thomasnu_gallery[controller]=Gallery&print=1&no_cache=1';
		$this->view->assign('print', $print);
	}
	/**
	 * Lightbox action for this controller. Displays photos with a lightbox.
	 *
	 * @return string The rendered view
	 */
	public function lightboxAction() {
		$startPhoto = $this->photoRepository->findOneById($this->settings['startPhoto']);
		$gallery = Tx_Extbase_Reflection_ObjectAccess::getProperty($startPhoto, 'gallery');
		$images = array();
		foreach (Tx_Extbase_Reflection_ObjectAccess::getProperty($gallery, 'photos') as $img) {
			$text = Tx_Extbase_Reflection_ObjectAccess::getProperty($img, 'text');
			$caption = Tx_Extbase_Reflection_ObjectAccess::getProperty($img, 'caption');
			$id = Tx_Extbase_Reflection_ObjectAccess::getProperty($img, 'id');
			$images[$id] = array('text' => $text, 'caption' => $caption, 'id' => $id);
		}
		ksort($images);
		$photos = array();
		foreach ($images as $photo) {
			if ($photo['text'] == '') {	
				$photo['text'] = $groupText;
			} else {
				$groupText = $photo['text'];
			}
			$photos[] = $photo;
		}
		$this->view->assign('photos', $photos);
		$this->view->assign('firstPhoto', $photos[0]);
	}
	/**
	 * Banner action for this controller. Displays photos as banners.
	 *
	 * @return string The rendered view
	 */
	public function bannerAction() {
		$startPhoto = $this->photoRepository->findOneById($this->settings['startPhoto']);
		$gallery = Tx_Extbase_Reflection_ObjectAccess::getProperty($startPhoto, 'gallery');
		$images = array();
		foreach (Tx_Extbase_Reflection_ObjectAccess::getProperty($gallery, 'photos') as $img) {
			$text = Tx_Extbase_Reflection_ObjectAccess::getProperty($img, 'text');
			$caption = Tx_Extbase_Reflection_ObjectAccess::getProperty($img, 'caption');
			$id = Tx_Extbase_Reflection_ObjectAccess::getProperty($img, 'id');
			$images[$id] = array('text' => $text, 'caption' => $caption, 'id' => $id);
		}
		ksort($images);
		$photos = array();
		foreach ($images as $photo) {
			if ($photo['text'] == '') {	
				$photo['text'] = $groupText;
			} else {
				$groupText = $photo['text'];
			}
			$photos[] = $photo;
		}
		$this->view->assign('photos', $photos);
		$this->view->assign('firstPhoto', $photos[0]);
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

<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2016 Thomas Nussbaumer <typo3@thomasnu.ch>
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
 * View helper for rendering background image style.
 */
class Tx_Thomasnu_ViewHelpers_BackgroundImageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @var \TYPO3\CMS\Extbase\Service\ImageService
	 * @inject
	 */
	protected $imageService;

	/**
	 * Render the background image style.
	 *
	 * @param string $src
	 * @param string $width 
	 * @return string Rendered string
	 */
	public function render($src, $width) {
		if ($src) {
            $image = $this->imageService->getImage($src, NULL, NULL);
    		$processingInstructions = array(
    			'width' => $width,
    			'height' => NULL,
    			'minWidth' => NULL,
    			'minHeight' => NULL,
    			'maxWidth' => NULL,
    			'maxHeight' => NULL,
    		);
    		$processedImage = $this->imageService->applyProcessingInstructions($image, $processingInstructions);
    		$src = $this->imageService->getImageUri($processedImage);
        }
        return 'background-image: url(' . $src . ');';
	}
}


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
 * View helper for rendering gallery descriptions.
 */
class Tx_Thomasnu_ViewHelpers_GalleryViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Render the gallery description with supplied content.
	 *
	 * @param string $mode
	 * @param string $caption 
	 * @param string $text
	 * @return string Rendered string
	 */
	public function render($mode, $caption, $text = NULL) {
		if ($text === NULL) $text = $this->renderChildren(); 
		$descr = ltrim($text, '*');
		if ($mode == 'thumbnails') {
			$pattern = "/\{(.*)\}/U";
			preg_match_all($pattern, $descr, $arr, PREG_PATTERN_ORDER);
			foreach ($arr[0] as $value) {
				$descr = str_replace($value, '', $descr);
			}
			return str_replace(array('[', ']', ','), '', $descr);
		}
		if ($caption > '') $descr = $caption;
		$pattern = "/\[(.*)\]/U";
		preg_match_all($pattern, $descr, $arr, PREG_PATTERN_ORDER);
		$alt = '';
		foreach ($arr[1] as $value) {
			$alt .= $value;
		}
		$pattern = "/\{(.*)\}/U";
		preg_match_all($pattern, $alt, $arr, PREG_PATTERN_ORDER);
		foreach ($arr[0] as $value) {
			$descr = str_replace($value, '', $descr);
		}
		if ($alt == '') $alt = $descr;
		if ($mode == 'alt') {
			return str_replace(array('°', '¬', '{', '}'), array(' ', ' ', '', ''), $alt);
		} elseif ($mode == 'lightbox') {
			return str_replace(array('°', '¬', '[', ']', '{', '}'), array(' ', ' ', '', '', '', ''), $descr);
		} else {
			return str_replace(array( '¬','[', ']', '{', '}'), array(' ', '', '', '', ''), $descr);
		}
	}
}
?>

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
 * View helper for rendering s+n wiki.
 */
class Tx_Thomasnu_ViewHelpers_WikiViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Render the text (Code from class parser of s+n wiki).
	 *
	 * @param int $noTags 1: $tags["+"] = "IT"; 2: section.margin; 4: section.bottom
	 * @param array $references References to sections
	 * @param string $text The text to parse
	 * @return string Rendered string
	 */
	public function render($noTags = 0, $references = NULL, $text = NULL) {
		if ($text === NULL) $text = $this->renderChildren(); 
		if ($noTags == 1) $text = '+' . $text;
		if ($references !== NULL) { 
			if (preg_match('%&lt;!--ref(\d+)--&gt;%', $text, $parts)) {
				$text = $references[10000 * $noTags + $parts[1]];
			}
		}
		return Tx_Thomasnu_Service_WikiService::render($text);
		}
	}
?>

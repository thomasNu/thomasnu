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
 * View helper for rendering news teasers.
 */
class Tx_Thomasnu_ViewHelpers_NewsTeaserViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Render the teaser and margin with supplied teaser text (can also include details).
	 *
	 * @param mixed $teaser '/': Margin bottom in <!--xxx--> int:
	 * @param string $text The teaser text (main or margin)
	 * @return string Rendered string
	 */
	public function render($teaser = '', $text = NULL) {
		if ($text === NULL) $text = $this->renderChildren();
		if ($teaser == '/') {
			$text = preg_match('%&lt;!--(.+)--&gt;%Us', $text, $parts) ? $parts[1] : '';
		}
		else if (preg_match('%^[!;](.+)\n%U', $text, $parts)) {
			$text = $parts[1];
		}
		else if (is_numeric($teaser) && strlen($text) > $teaser) {
			$text = substr($text, 0, $teaser);
			$text = preg_replace(array('%\w*$%Us','%\n%s'), ' ', $text) . ' ...';
		}
		return $text;
	}
}
?>

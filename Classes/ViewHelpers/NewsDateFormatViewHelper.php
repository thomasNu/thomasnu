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
 * View helper for rendering the format string of news date.
 */
class Tx_Thomasnu_ViewHelpers_NewsDateFormatViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Render the format for term and sort.
	 *
	 * @param int $term (only for portal; >= current time: with weekday and hour:minutes)
	 * @param int $sort (54, 55, 56: special only for portal, >55: without day)
	 * @param int $portal (only used in portal)
	 * @return string Format string
	 */
	public function render($term, $sort, $portal = 0) {
		$day = ($sort > 55) ? '' : 'j. ';
		if ($portal == 0) {
			return $day . 'M Y';
		}
		if ($sort == 55) {
			$format = '\A\b\s\t\i\m\m\u\n\g, j. M Y';
		}
		elseif ($sort == 54) {
			$format = '\U\p\d\a\t\e, j. M Y';
		}
		elseif ($sort == 56) {
			$format = '\A\k\t\i\o\n, M Y';
		}
		elseif ($sort == 61) {
			$format = '\O\s\t\e\r\n Y';
		}
		elseif ($term < time() || $day == '') {
			$format = $day . 'M Y';
		}
		else {
			$format = 'D, j. M Y';
			if (date('H:i', $term) != '00:00') $format .= ', G.i \h';
		}
		return $format;
	}
	
}
?>

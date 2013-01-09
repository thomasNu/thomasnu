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
 * View helper for rendering agenda entries.
 */
class Tx_Thomasnu_ViewHelpers_AgendaEntryViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Render the agenda entry with supplied content.
	 *
	 * @param string $thisday
	 * @param string $endterm
	 * @param string $subject
	 * @param string $portal
	 * @param string $category
	 * @param string $course
	 * @return string Rendered string
	 */
	public function render($thisday, $endterm, $subject, $portal, $category, $course) {
		$thisday = '20' . $thisday;
		$end = date('Ymd', $endterm);
		$entry = '';
		if ($end > $thisday) {
			$en = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
			$de = array('Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So');
			$s = (($end - $thisday) == 1 || $subject == '2 T.') ? ' °°°und°' : ' °°°bis°';
			$entry .= $s . str_replace($en, $de, date('D°d.m.y', $endterm));
		}
		if (ord($portal) == ord("*") && strpos($category, $course) !== false) {
			$entry .= ' °°°[m:ausgebucht]';
		}
		return $this->renderChildren() . $entry;
	}
}
?>

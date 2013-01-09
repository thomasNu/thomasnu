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
 * View helper for rendering calendar days.
 */
class Tx_Thomasnu_ViewHelpers_CalendarDayViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Render a day in calendar.
	 *
	 * @param int $add  Add to monday ($time) 
	 * @param int $month This month
	 * @param string $links And holidas (#ymd: link, £\Hmd: Holiday, £\Bmd: BZU holiday)
	 * @param int $time Timestamp (monday of this week)
	 * @return string Rendered string
	 */
	public function render($add, $month = NULL, $links = NULL, $time = NULL) {
		if ($time === NULL) {
			$time = $this->renderChildren();
		}
		if ($month === NULL) {
			return $time + 86400 * $add;
		}
		$time += 86400 * $add;
		$day = date('j', $time);
		if (date('n', $time) == $month) {
			$p = strpos($links, date('#ymd', $time));
			if ($p !== false) {
				$day = '<b><a href="javascript:gotoHash(\'' . substr($links, $p + 1, 6) . '\')"><u>' . $day . '</u></a></b>';
			}
			elseif ($add == 6 || strpos($links, date('£\Hmd', $time)) !== false) {
				$day = '<font color="#800000">' . $day . '</font>';
			}
		}
		else {
			$day = '<font color="#808080">' . $day . '</font>';
		}
		if ($add < 6 && strpos($links, date('£\Smd', $time)) !== false) {
			$holiday = ' bgcolor="#FFFFFF"';
		}
		return '<td width="21" align="right" id="' . date('\Tnd', $time) . '"' . $holiday . '>' . $day . '</td>';
	}
}
?>

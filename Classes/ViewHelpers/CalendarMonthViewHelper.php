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
 * View helper for rendering calendar months.
 */
class Tx_Thomasnu_ViewHelpers_CalendarMonthViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Render a month in calendar.
	 *
	 * @param int $add For next months
	 * @param int $year This year
	 * @param string $links #ymd: link
	 * @param int $month First month in quarter
	 * @return string Rendered string
	 */
	public function render($add, $year, $links, $month = NULL) {
		if ($month === NULL) {
			$month = $this->renderChildren();
		}
		$month += $add;
		$p = strpos($links, '#' . (100 * ($year % 100) + $month));
		if ($p !== false) {
			$month = '<b><a href="javascript:gotoHash(\'' . substr($links, $p + 1, 6) . '\')"><u>' . $month . '</u></a></b>';
		}
		return $month;
	}
}
?>

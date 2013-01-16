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
 * View helper for rendering formatted terms.
 */
class Tx_Thomasnu_ViewHelpers_TermViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Render the supplied timestamp as formatted string
	 *
	 * @param string $format The s+n format
	 * @param mixed $term The date value of TYPO3 (integer) or DateTime
	 * @return string Formatted
	 */
	public function render($format = 'd.m.Y', $term = NULL) {
		if ($term === NULL) $term = $this->renderChildren();
		if ($term instanceof DateTime) $term = date_timestamp_get($term);
		if ($format == 'U') return $term; 
		$en = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
		$loc = array();
		if (strpos($format, 'D2') === FALSE && strpos($format, 'M3') === FALSE) {
			$loc = $this->getMonthsWeekdays('date.formatMD');
		}
		else {
			$loc = $this->getMonthsWeekdays('date.formatM3D2');
			$format = str_replace('M3', 'M', str_replace('D2', 'D', $format));
		}		
		return str_replace($en, $loc, date($format, $term));
	}
	/**
	 * Gets the locallang months and weekdays.
	 *
	 * @param string $key The locallang key
	 * @return array The locallang months and weekdays
	 */
	protected function getMonthsWeekdays($key) {
		$request = $this->controllerContext->getRequest();
		return explode(',', Tx_Extbase_Utility_Localization::translate($key, $request->getControllerExtensionName(), NULL));
	}

}
?>

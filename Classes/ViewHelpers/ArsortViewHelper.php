<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2015 Thomas Nussbaumer <typo3@thomasnu.ch>
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
 * View helper to sort an array in reverse order.
 */
class Tx_Thomasnu_ViewHelpers_ArsortViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	/**
	 * Sorts an array in reverse order.
	 *
	 * @param array $input The array to sort in reverse order. 
	 * @param string $as The name of the iteration variable
	 * @return void
	 */
	public function render($input, $as) {
		arsort($input);
    	if ($this->templateVariableContainer->exists($as)) {
    		$this->templateVariableContainer->remove($as);
    	}
		$this->templateVariableContainer->add($as, $input);
	}
}
?>

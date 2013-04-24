<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2013 Thomas Nussbaumer <typo3@thomasnu.ch>
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
 * View helper with evaluation of associative arrays.
 */
class Tx_Thomasnu_ViewHelpers_ValueViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	/**
	 * Initialize
	 */
	public function initializeArguments() {
		$this->registerArgument('key', 'mixed', 'The key in the array to get the value', TRUE);
		$this->registerArgument('as', 'string', 'Template variable name to assign. If not specified returns the value instead');
	}
	/**
	 * Searches the array for a given key and returns the corresponding value.
	 *
	 * @param array $array The array. 
	 * @return mixed
	 */
	public function render($array = NULL) {
		$codeWasSource = FALSE;
		if ($array === NULL) {
			$array = $this->renderChildren();
			$codeWasSource = TRUE;
		}
		$value = NULL;
		$key = $this->arguments['key'];
		if (array_key_exists($key, $array)) {
			$value = $array[$key];
		}
		if ($as = $this->arguments['as']) {
			if ($this->templateVariableContainer->exists($as)) {
				$this->templateVariableContainer->remove($as);
			}
			$this->templateVariableContainer->add($as, $value);
			$content = '';
			if ($codeWasSource === FALSE) {
				$content = $this->renderChildren();
				if ($content) {
					$this->templateVariableContainer->remove($as);
				}
			return $content;
			}
		} else {
			return $value;
		}
	}
}
?>

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
 * View helper for s+n wiki demo.
 */
class Tx_Thomasnu_ViewHelpers_WikiDemoViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Render with supplied Wiki code.
	 *
	 * @param string $code The Wiki code
	 * @return string 
	 */
	public function render($code = NULL) {
		if ($code == NULL) {
			$code = $this->renderChildren();
		}
		if (ord($code) == ord(' ')) {
			$code = str_replace(' ', '·', $code);
		}
	return $code;
	}
}
?>

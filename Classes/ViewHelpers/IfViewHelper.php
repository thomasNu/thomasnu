<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Thomas Nussbaumer <typo3@thomasnu.ch>
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
 * If view helper with evaluation of PHP code.
 */
class Tx_Thomasnu_ViewHelpers_IfViewHelper extends Tx_Fluid_ViewHelpers_IfViewHelper {
	/**
	 * Render on condition of supplied PHP code.
	 *
	 * @param string $condition As PHP code, e.g. "'{news.subject}' && substr('{news.category}', 0, 2) != 'WB'"
	 * @return string Render Then or Else
	 */
	public function render($condition) {
		eval('$result = ' . $condition . ';');
		if ($result) {
			return $this->renderThenChild();
		} else {
			return $this->renderElseChild();
		}
	}
}
?>

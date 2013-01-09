<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Thomas Nussbaumer <typo3@thomasnu.ch>
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
 * View helper with evaluation of PHP code.
 */
class Tx_Thomasnu_ViewHelpers_EvalViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	/**
	 * Initialize
	 */
	public function initializeArguments() {
		$this->registerArgument('as', 'string', 'Template variable name to assign. If not specified returns the result instead');
	}
	/**
	 * Render with supplied PHP code.
	 *
	 * @param string $code The PHP code, e.g. "'{news.subject}' == '2 T.' ? ' und ' : ' bis '"
	 * @return mixed Render result
	 */
	public function render($code = NULL) {
		$codeWasSource = FALSE;
		if (!$code) {
			$code = $this->renderChildren();
			$codeWasSource = TRUE;
		}
		eval('$result = ' . $code . ';');
		if ($this->arguments['as']) {
			if ($this->templateVariableContainer->exists($this->arguments['as'])) {
				$this->templateVariableContainer->remove($this->arguments['as']);
			}
			$this->templateVariableContainer->add($this->arguments['as'], $result);
			$content = '';
			if ($codeWasSource === FALSE) {
				$content = $this->renderChildren();
				if ($content) {
					$this->templateVariableContainer->remove($this->arguments['as']);
				}
			return $content;
			}
		} else {
			return $result;
		}
	}
}
?>

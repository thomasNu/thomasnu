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
	 * Initialize
	 */
	public function initializeArguments() {
		$this->registerArgument('as', 'string', 'Template variable name to assign. If not specified returns the result instead');
	}
	/**
	 * Render with supplied wiki code.
	 *
	 * @param string $code The wiki code
	 * @param string $name The section name
	 * @return string 
	 */
	public function render($code = '', $name = '') {
		if ($this->arguments['as']) {
			preg_match('%^(.*)<!--demo-(.+)-(main|margin)-->(.*)$%s', $code, $parts);
			$demo = array('header' => $parts[1], $parts[3] => $parts[2], 'code' => $parts[2], 'remark' => $parts[4], 'anchor' => str_replace(array('!', '/', '*', '+'), '', $name));
			if ($this->templateVariableContainer->exists($this->arguments['as'])) {
				$this->templateVariableContainer->remove($this->arguments['as']);
			}
			$this->templateVariableContainer->add($this->arguments['as'], $demo);
			$content = $this->renderChildren();
			$this->templateVariableContainer->remove($this->arguments['as']);
			return $content;
		} else {
			if (!$code) {
				$code = $this->renderChildren();
			}
			if (ord($code) == ord(' ')) {
				$code = str_replace(' ', '·', $code);
			}
			return $code;
		}
	}
}
?>

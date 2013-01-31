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
 * View helper for rendering s+n links.
 */
class Tx_Thomasnu_ViewHelpers_NewsLinkViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Render the link with supplied uri from s+n edv.
	 *
	 * @param string $uri The uri (alias[.*][#*])
	 * @param string $mode On 'portal' uri without '#*'
	 * @param string $teaser The teaser to test if where it is a pdf, photogalery or external link
	 * @param string $blog The name of blog entry ($uri = email address)
	 * @return string Rendered string
	 */
	public function render($uri, $mode = '', $teaser = '', $blog = '') {
		if (strpos($uri, '@')) $uri = 'blog#t'. $blog;
		$parts = explode('#', $uri);
		$link = explode('.', $parts[0]);
		if ($parts[1]) {
			if ($mode == 'news') {
				$link = explode('|', $teaser);
				if ($link[1] == '') {
					return '<a target="_blank" name="' . $parts[1] . '" href="fileadmin/pdfs/' . $parts[1] . '.pdf">'
						. '<img border="0" src="typo3conf/ext/thomasnu/Resources/Public/Icons/pdf.gif" width="18" height="16" />'
						. $this->renderChildren() . '</a>';
				} elseif ($link[1] == 'gallery') { 
					return '<a name="' . $parts[1] . '" href="http://' . t3lib_div::getIndpEnv('TYPO3_HOST_ONLY') . '/gallery.html?tx_thomasnu_gallery[start]='
						. $link[2] . '&tx_thomasnu_gallery[back]=' . t3lib_div::getIndpEnv('TYPO3_REQUEST_URL') 
						. '&tx_thomasnu_gallery[action]=slideshow&tx_thomasnu_gallery[controller]=Gallery&no_cache=1">'
						. '<img border="0" src="typo3conf/ext/thomasnu/Resources/Public/Icons/images.gif" width="16" height="16" />'
						. $this->renderChildren() . '</a>';
				} elseif ($link[1] == 'page') { 
					return $link[2];
				} else {
					return '<a target="_blank" name="' . $parts[1] . '" href="' . $link[1] . '">'
						. '<img border="0" src="typo3conf/ext/thomasnu/Resources/Public/Icons/html.gif" width="16" height="16" />'
						. $this->renderChildren() . '</a>';
				}
			}
			if ($mode == 'name') return $parts[1];
			if ($mode != 'portal') {
				$link[0] .= '#' . $parts[1];
			}
		}
		return $link[0];
	}
}
?>

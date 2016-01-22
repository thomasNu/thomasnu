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
 * Based on comvosglobalmarkers ( Global Markers ) extension.
 *
 * @author		Nabil Saleh <saleh@comvos.de>
 * @package     comvosglobalmarkers
 */
class tx_thomasnu_hooks {
    /**
     * Substitution of markers
     */
    public function substituteMarkers($_params, $feObj) {
        $links = array(
            array('„', '“', '´', '`'),
            array('"', '"', "'", "'")
        );
		$feObj->content = str_replace($links[0], $links[1], $feObj->content);
        
        $conf = $feObj->tmpl->setup['tx_thomasnu.'];
        if (isset($conf['markers.']) && is_array($conf['markers.'])) {
        	$noWikiList = $feObj->cObj->cObjGetSingle($conf['markers.']['noWiki'], $conf['markers.']['noWiki.']);
        	$withWikiList = $feObj->cObj->cObjGetSingle($conf['markers.']['withWiki'], $conf['markers.']['withWiki.']);
        	if ($noWikiList != '0' && !t3lib_div::inList($noWikiList, $GLOBALS['TSFE']->id)
        	        || t3lib_div::inList($withWikiList, $GLOBALS['TSFE']->id)) {
		    	$wikiContent = $feObj->cObj->cObjGetSingle($conf['markers.']['wiki'], $conf['markers.']['wiki.']);
		        if (t3lib_div::_GP('print')) {
					$feObj->content = str_replace('<div id="prt-content">', '<div id="prt-content">' . $wikiContent, $feObj->content); 
		        } else {
					$feObj->content = str_replace('<div id="content">', '<div id="content">' . $wikiContent, $feObj->content); 
		        }
            }
            $usedMarkers = $this->getMarkersInContent($feObj->content);
            foreach( $usedMarkers as $markername) {
                $confname = str_replace('£', '', $markername);
                $markercontent = $feObj->cObj->cObjGetSingle($conf['markers.'][$confname], $conf['markers.'][$confname . '.']);
                $feObj->content = str_replace($markername, $markercontent, str_replace('<p>' . $markername . '</p>', $markercontent, $feObj->content));
            }
        }
        if (isset($conf['remove.']) && is_array($conf['remove.'])) {
        	$findList = explode(',', $feObj->cObj->cObjGetSingle($conf['remove.']['emptyLinks'], $conf['remove.']['emptyLinks.']));
			$feObj->content = preg_replace($findList, '', $feObj->content); 
        }
        $matches = array();
        while (preg_match('%<a.+class=\"lightbox\".+>.*<img.+(title=\".+\").+</a>%U', $feObj->content, $matches)) {
			$feObj->content = preg_replace('%class=\"lightbox\"%', $matches[1], $feObj->content, 1);
		} 
 /*       $matches = array();
        $n = preg_match_all('%<a.+href=\"(.+)\".*>%U', $feObj->content, $matches, PREG_PATTERN_ORDER);
 		for ($i = 0; $i < $n; ++$i) {
 			$parts = explode('#', $matches[1][$i]);
 			$href = $parts[0];
			if (strpos($href, 'fileadmin/user_upload') === FALSE && (strpos($href, 'http://') !== FALSE || strpos($href, 'https://') !== FALSE)) {
				preg_match('%//(.+)/%U', $href . '/', $domains);
				$tit = $domains[1];
			} else {
                $pos = strpos($href, 'fileadmin/user_upload');
				if ($pos === FALSE) continue;
				if (strpos($matches[0][$i], 'class="ka-download"')) continue;
                $href = substr($href, $pos);
				$parts = t3lib_div::split_fileref($href);
                if ($fileSize = filesize(t3lib_div::getFileAbsFileName($href))) {
				    $tit = 'Herunterladen: ' . strtoupper($parts['fileext']) . ' ' . t3lib_div::formatSize($fileSize, 'B| kB| MB| GB');
                } else {
      				$links[0][] = $matches[0][$i];
        			$links[1][] = '<a href="' . $GLOBALS['TSFE']->siteScript . '" title="*** Datei fehlt! ***">';
                    continue;
                }
			}
			$links[0][] = $matches[0][$i];
			$links[1][] = preg_replace(array('%target=\".*\"%U', '%title=\".*\"%U', '%href=%'), array('', '', 'target="_blank" title="' . $tit . '" href='), $matches[0][$i]);
		}
		$feObj->content = str_replace($links[0], $links[1], $feObj->content);   */
     }
    /**
     * Get markernames within a stringcontent
     * @param String $content Content with markers
     */
    protected function getMarkersInContent($content) {
        $matches = array();
        preg_match_all('/£[£]+(.+)£[£]+/', $content, $matches);
        return $matches[0];
    }
}
?>

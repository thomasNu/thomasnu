<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Thomas Nussbaumer <info@thomasnu.ch>
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
 * The s+n Wiki Service
 */
class Tx_Thomasnu_Service_WikiService implements t3lib_Singleton {

	/**
	 * Render the text (Code from class parser of s+n wiki).
	 *
	 * @param string $text The text to parse
	 * @return string Rendered string
	 */
	public static function render($text) {
		$para = array();
		$find = array(
			'¬',      '°',      '~',        ' - ',        ' / ', '&lt;&lt;', '&gt;&gt;',
			'£L', '£W', '£M', '£P', '£G', '£A', '£V', '£E', '£U'
			);
		$repl = array(
			'<br />', '&nbsp;', '&ndash;',  ' &ndash; ',  '&nbsp;/ ',   '«', '»',
			'<img border="0" width="15" height="9" src="typo3conf/ext/thomasnu/Resources/Public/Icons/dot.gif" />',
			'<img border="0" width="15" height="14" src="typo3conf/ext/thomasnu/Resources/Public/Icons/web.gif" />',
			'<img border="0" width="15" height="14" src="typo3conf/ext/thomasnu/Resources/Public/Icons/mail.gif" />',
			'<img border="0" width="18" height="16" src="typo3conf/ext/thomasnu/Resources/Public/Icons/pdf.gif" />',
			'<img border="0" width="16" height="16" src="typo3conf/ext/thomasnu/Resources/Public/Icons/images.gif" />',
			'<img border="0" width="16" height="16" src="typo3conf/ext/thomasnu/Resources/Public/Icons/audio.gif" />',
			'<img border="0" width="16" height="16" src="typo3conf/ext/thomasnu/Resources/Public/Icons/video.gif" />',
			'<img border="0" width="16" height="16" src="typo3conf/ext/thomasnu/Resources/Public/Icons/edit.gif" />',
			'<img border="0" width="16" height="16" src="typo3conf/ext/thomasnu/Resources/Public/Icons/user.gif" />'
			);
		$tags = array(
			'+' => 'IT',
			'' => '<p>IT</p>',
			';' => '<p class="bluebox1">IT</p>',
			';;' => '<p class="greenbox1">IT</p>',
			'!' => '<p class="yellowbox1">IT</p>',
			'!!' => '<p class="orangebox1">IT</p>',
			'!!!' => '<p class="redbox1">IT</p>',
			'/' => '<p style="text-align: right;">IT</p>',
			' ' => '<pre>IT</pre>',
			'=' => '<h5>IT</h5>',
			'==' => '<h4>IT</h4>',
			'===' => '<h3>IT</h3>'
			);
		$xtags = array(
			':' => '<dl><dd>IT</dd></dl>',
			'#' => '<ol><li>IT</li></ol>',
			'*' => '<ul><li>IT</li></ul>',
			'-' => '<ul class="dash"><li>IT</li></ul>'    
			);
		$wiki = array(
			'' => '<b>{$a[0]}</b>',
			'a' => '«{$a[0]}»',
			'i' => '<i>{$a[0]}</i>',
			'ib' => '<i><b>{$a[0]}</b></i>',
			'img' => '<img border=\"0\" src=\"fileadmin/images/news/{$a[0]}\" alt=\"{$a[1]}\" title=\"{$a[1]}\" />',
			'imgx' => '<img border=\"0\" width=\"{$a[2]}\" height=\"{$a[3]}\" src=\"fileadmin/images/news/{$a[0]}\" alt=\"{$a[1]}\" title=\"{$a[1]}\" />',
			'imgy' => '<img border=\"0\" width=\"{$a[2]}\" height=\"{$a[3]}\" src=\"fileadmin/images/{$a[0]}\" alt=\"{$a[1]}\" title=\"{$a[1]}\" />',
			'imgl' => '<img style=\"float: left; padding-right: 5px; padding-bottom: 5px;\" width=\"{$a[2]}\" height=\"{$a[3]}\"' 
					. ' src=\"fileadmin/images/news/{$a[0]}\" alt=\"{$a[1]}\" title=\"{$a[1]}\" />',
			'imgr' => '<img style=\"float: right; padding-left: 5px; padding-bottom: 5px;\" width=\"{$a[2]}\" height=\"{$a[3]}\"' 
					. ' src=\"fileadmin/images/news/{$a[0]}\" alt=\"{$a[1]}\" title=\"{$a[1]}\" />',
			'gal' => '<b><a href=\"http://' . t3lib_div::getIndpEnv('TYPO3_HOST_ONLY') . '/gallery.html?tx_thomasnu_gallery[start]={$a[0]}' 
					. '&tx_thomasnu_gallery[back]=' . t3lib_div::getIndpEnv('TYPO3_REQUEST_URL') 
					. '&tx_thomasnu_gallery[action]=slideshow&tx_thomasnu_gallery[controller]=Gallery&no_cache=1\">{$a[1]}</a></b>',
			'lbox' => '<b><a href=\"fileadmin/images/{$a[0]}\" rel=\"lightbox\" title=\"{$a[1]}\">{$a[2]}</a></b>',
			'link' => '<b><a href=\"http://' . t3lib_div::getIndpEnv('TYPO3_HOST_ONLY') . '/{$a[0]}\" title=\"{$a[2]} »\">£L{$a[1]}</a></b>',
			'linkx' => '<b><a href=\"http://' . t3lib_div::getIndpEnv('TYPO3_HOST_ONLY') . '/{$a[0]}\" title=\"{$a[2]} »\">{$a[1]}</a></b>',
			'http' => '<b><a href=\"http://{$a[0]}\" target=\"_blank\" title=\"{$a[2]} »\">£W{$a[1]}</a></b>',
			'httpx' => '<b><a href=\"http://{$a[0]}\" target=\"_blank\" title=\"{$a[2]} »\">{$a[1]}</a></b>',
			'mail' => '<b><a href=\"mailto:{$a[0]}\" title=\"'. self::getMailTitle() . '\">£M{$a[1]}</a></b>',
			'mailx' => '<b><a href=\"mailto:{$a[0]}?subject={$a[2]}\" title=\"'. self::getMailTitle() . ': {$a[2]}\">£M{$a[1]}</a></b>',
			'pdf' => '<b><a href=\"http://' . t3lib_div::getIndpEnv('TYPO3_HOST_ONLY') . '/fileadmin/pdfs/{$a[0]}.pdf\" target=\"_blank\" title=\"{$a[2]}\">£P{$a[1]}</a></b>',
			'media' => '<b><a href=\"http://' . t3lib_div::getIndpEnv('TYPO3_HOST_ONLY') . '/fileadmin/media/{$a[0]}\" target=\"_blank\" title=\"{$a[2]}\">{$a[1]}</a></b>',
			'ref' => '<b><a href=\"ref={$a[0]}\" title=\"{$a[2]}\">£E{$a[1]}</a></b>',
			'java' => '<b><a href=\"javascript:{$a[0]}\">{$a[1]}</a></b>',
			'm' => '<span class=\"mark\">{$a[0]}</span>',
			'mb' => '<span class=\"markblue\">{$a[0]}</span>',
			'mini' => '<span class=\"mini\">{$a[0]}</span>',
			'n' => '<span class=\"note\">{$a[0]}</span>',
			'r' => '<span class=\"red\">{$a[0]}</span>',
			'sub' => '<sub>{$a[0]}</sub>',
			'sup' => '<sup>{$a[0]}</sup>',
			'u' => '<u>{$a[0]}</u>'
			);
		$txt = preg_replace('%&lt;!--.*--&gt;%sU', '', preg_replace('%<!--.*-->%sU', '', $text));
		$txt = str_replace(array('\°', '\¬', '\£', '\[', '\|', '\]', "\n_"), array('&#176;', '&#172;', '&#163;', '&#91;', '&#124;', '&#93;', '¬'), $txt);
		$firstChars = '';
		foreach ($tags as $key => $val) {
			if ($key == '' || substr($key, 0, 1) == '=' || substr($key, 0, 1) == ';' || substr($key, 0, 1) == '!') continue;
			$firstChars .= $key;
			}
		foreach ($xtags as $key => $val) {
			$firstChars .= $key;
			}
		$text = '';
		$pattern = '%^([=]{1,3}|[!]{1,3}|[;]{1,2}|[' . $firstChars . ']?)(.+)$%m';
		preg_match_all($pattern, $txt, $para, PREG_PATTERN_ORDER);
		for ($i = 0; $i < count($para[1]); ++$i) {
			$tgs = array_merge($tags, $xtags);
			$it = rtrim($para[2][$i]);
			if ($it == '' || array_key_exists($it, $tgs)) continue;
			$ht = $tgs[$para[1][$i]];
			$sym = substr($para[1][$i], 0, 1);
			if ($sym == ' ') {
				while ($para[1][$i + 1] == $sym) {
					$s = rtrim($para[2][++$i]);
					if ($s != '') $it .= "\n" . $s;
					}
				}
			else {
				if (strlen($sym) > 0 && array_key_exists($sym, $xtags)) {
					preg_match('%(<[^>]*>)IT(</[^>]*>)%', $ht, $tg);
					while ($para[1][$i + 1] == $sym) {
						$s = rtrim($para[2][++$i]);
						if ($s != '') $it .= $tg[2] . $tg[1] . $s;
						}
					}
				$pattern = '%\[(\w{0,5}):([^[]*)\]%U';
				while (preg_match_all($pattern, $it, $t, PREG_PATTERN_ORDER)) {
					$f = array();
					$r = array();
					for ($j = 0; $j < count($t[1]); ++$j) {
						$a = explode('|', $t[2][$j]);
						eval("\$replace = \"" . $wiki[strtolower($t[1][$j])] . "\";");
						$f[] = $t[0][$j];
						$r[] = self::encodeSpecial($replace);
						}
					$it = str_replace($f, $r, $it);
					}
				$it = str_replace($find, $repl, $it);
				}
			$text .= str_replace('IT', $it, $ht);
			}
		return $text; 
		}
	/**
	 * Encode the mail address or edit link.
	 * 
	 * @param string $text The text to encode
	 * @return string Encoded string
	 */
	protected static function encodeSpecial($text) {
		if (preg_match('%href=\"(mailto:)(.+)\"%U', $text, $parts)) {
			$mail = utf8_decode($parts[1] . $parts[2]);
			for ($i = 0; $i < strlen($mail); $i++) {
				$s = $s . '&#' . ord($mail[$i]) . ';';
				}
			$text = str_replace($mail, $s, $text);
			}
		else if (preg_match('%href=\"ref=(\d+):(\d+):(\d+):(\d+)\"%U', $text, $parts)) {
			$s = 'href="http://' . t3lib_div::getIndpEnv('TYPO3_HOST_ONLY') . '/index.php?id=' . $parts[1] . '&tx_thomasnu_content[page]=' . $parts[2] 
				. '&tx_thomasnu_content[section]=' . $parts[3] . '&tx_thomasnu_content[sectionId]=' . $parts[4] 
				. '&tx_thomasnu_content[action]=edit&tx_thomasnu_content[controller]=Section"';
			$text = str_replace($parts[0], $s, $text);
			}
		return $text;		}
	/**
	 * Get mail title from settings.
	 * 
	 * @return string Mail title
	 */
	protected static function getMailTitle() {
		$setup = $GLOBALS['TSFE']->tmpl->setup;
		$linkTitles = $setup['plugin.']['tx_thomasnu.']['settings.']['linkTitles'];
		$titles = explode('|', $linkTitles);
		return $titles[0];
		}
}
?>

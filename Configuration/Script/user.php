<?php

class user_my {
/**
 * Set symbols im menu
 */
function setMenuIcon($content, $conf) {
	$menu = explode(',', $conf['menu']);
	$icon = explode(',', $conf['icon']);
	$alt = explode(',', $conf['alt']);
	$add = explode(',', $conf['add']);
	$img = array();
	$s1 = '<img src="typo3conf/ext/thomasnu/Resources/Public/Icons/';
	$s2 = '" width="17" height="10" border="0" alt="';
	$s9 = '" width="16" height="16" border="0" align="right" alt="';
	$s3 = '" title="';
	$s4 = '" />&nbsp;';
	$s5 = '" />';
	foreach ($icon as $k => $v) {
		$a = substr($v, 0, 2);
		if ($alt[$k] != '*') {
			$a = $alt[$k];
			$s2 = $s9;
			$s4 = $s5;
			}
		array_push($img, $s1 . $v  . $s2 . $a . $s3 . $a . $s4 . $menu[$k] . $add[$k]);
		}
	return str_ireplace($menu, $img, $content); 
	}
/**
 * Blende im Menü 2. Level bestimmte Items aus.
 * Entferne Steuerzeichen.
 */
function remMenuItem($content, $conf) {
	$ids = explode(',', $conf['id']);
	$ctrls = explode(',', $conf['ctrl']);
	$items = explode('|', str_replace('</div>', '</div>|', $content));
	$content = '';
	foreach ($items as $i) {
		foreach ($ids as $k) {
			if (strpos($i, "id=$k") != false) {
				$i = '';
				break;
				}
			}
		$content .= $i;	
		}
	return str_replace($ctrls, '', $content); 
	}
/**
 * Blende in Navigation doppeltes Item und Link von Shortcut aus.
 * Ersetze Steuerzeichen durch entsprechendes HTML.
 */
function remNavItem($content, $conf) {
	$id = explode(',', $conf['id']);
	$find = explode('|', $conf['find']);
	$repl = explode('|', $conf['repl']);
	$item = explode('|', str_replace('</li>', '</li>|', $content));
	$c = '';
	$b = false;
	foreach ($id as $k) {
		if (strpos($item[1], "id=$k") != false) {
			$item[1] = strip_tags($item[1], '<li>');
			$b = true;
			break;
			}
		}
	if (!$b) $s = str_replace('&nbsp;&#124;&nbsp;',  '', strip_tags($item[1])); 
	foreach ($item as $k => $v) {
		if (!$b && $k > 1 && strpos($v, $s) != false) $b = true;
		if ($b || $k != 1) $c .= $v;
		}
	if ($b) $content = $c;
	return preg_replace($find, $repl, $content);
	}
/**
 * Kein Shortcut Link in Rootline.
 * Entferne Steuerzeichen.
 */
function noShortcutLink($content, $conf) {
	$ids = explode(',', $conf['id']);
	$ctrls = explode(',', $conf['ctrl']);
	$items = explode('|', str_replace('</a>', '</a>|', $content));
	// Entferne Link nach Home, Portal
	if (strpos($content, $ids[0]) !== false) {
		return str_replace('&nbsp;&raquo;&nbsp;' . $ids[0], '', strip_tags(implode('', $items), '<div><h1><title>'));
		}
	// DoNotLinkIt für Shortcuts Level 2
	$b = false;
	foreach ($ids as $k) {
		if (strpos($items[2], "id=$k") != false) {
			$items[2] = strip_tags($items[2]);
			$b = true;
			break;
			}
		}
	if ($b) $content = implode('', $items);
	// Enferne Steuerzeichen für Navigation auf jeder Seite
	return str_replace($ctrls, '', $content); 
	}
/**
 * Ersetze in $content alle $find durch $repl.
 * $find und $repl können je durch | getrennte Paare enthalten.
 */
function replaceInContent($content, $conf) {
	$find = explode('|', $conf['find']);
	$repl = explode('|', $conf['repl']);
	return preg_replace($find, $repl, $content);
	}
/**
 * Hole Inhalt von FronPage Web Seite.
 * $find und $repl können je durch | getrennte Paare enthalten.
 */
function getFpContent($content, $conf) {
	$alis = explode(',', $conf['alis']);
	$phps = explode(',', $conf['phps']);
	$cont = "$content";
	$items = explode('/', $cont);
	if (in_array($items[1], $alis)) {
		$path = str_replace($alis, $phps, ($items[0] == $items[1]) ? $items[1] : $cont);
		}
	else {
		$path = $cont . '.htm';
		}
	$html = utf8_encode(file_get_contents($conf['url'] . $path));
	$find = array(
		'%(<html>.*?<!--webbot bot="Timestamp".*?<tr>)(.*)((<tr>.*?</tr>){1}.*?</html>)%s',
		'%(<html>.*?<body id="t3">)(.*)(</body>.*?</html>)%s',
	);
	$repl = array(
		'<table border="0" cellspacing="0" cellpadding="0" width="600"><tr>\2</table>',
		'\2'
		);
	$html = preg_replace($find, $repl, $html);
    $find = array(
    	'%<!--.*?-->%s', 
    	'%(<img.*?src=")(?!\.\.)%s', 
    	'%src="\.\./%', 
    	'%href="(?!\w*[:&#])%', 
    	'%href="LINK.*/([\-0-9a-z]+)\.htm"%', 
    	'%href="LINK.*/([\-0-9a-z]+)\.htm#(\w+)"%',
    	'%href="LINK.*/([\-0-9a-z]+)\.htm\?m440326"%',
    	'%href="LINK\.\./(.*)\.pdf"%', 
    	'%href="LINK(.*)\.pdf"%' 
    	);
    $repl = array(
    	'', 
    	'\1' . $conf['url'] . $items[0] . '/', 
    	'src="' . $conf['url'], 
    	'href="LINK', 
    	'href="index.php?id=\1"', 
    	'href="index.php?id=\1#\2"',
    	'href="index.php?id=\1"', 
    	'href="' . $conf['url'] . '\1.pdf"', 
    	'href="' . $conf['url'] . $items[0] . '/\1.pdf"' 
    	);
	return '<div style="margin-left:-25px;">' . preg_replace($find, $repl, $html) . '</div>';
	}
function modifyLink($content, $conf) {
	$tits = explode('|', $conf['tits']);
	$find = array(
		'¬',      '°',      '~',        ' - ',        ' / ',      '<<', '>>',
		'£L', '£W', '£M', '£P', '£G', '£A', '£V', '£U', '.pdf/', '.flv/', '<img'
		);
	$repl = array(
		'<br />', '&nbsp;', '&#x2011;', ' &#x2011; ', '&nbsp;/ ', '«',  '»',
		'<img width="15" height="9" src="typo3conf/ext/thomasnu/Resources/Public/Icons/dot.gif" />',
		'<img width="15" height="14" src="typo3conf/ext/thomasnu/Resources/Public/Icons/web.gif" />',
		'<img width="15" height="14" src="typo3conf/ext/thomasnu/Resources/Public/Icons/mail.gif" />',
		'<img width="18" height="16" src="typo3conf/ext/thomasnu/Resources/Public/Icons/pdf.gif" />',
		'<img width="16" height="16" src="typo3conf/ext/thomasnu/Resources/Public/Icons/images.gif" />',
		'<img width="16" height="16" src="typo3conf/ext/thomasnu/Resources/Public/Icons/audio.gif" />',
		'<img width="16" height="16" src="typo3conf/ext/thomasnu/Resources/Public/Icons/video.gif" />',
		'<img width="16" height="16" src="typo3conf/ext/thomasnu/Resources/Public/Icons/user.gif" />',
		'.pdf', '.flv', '<img border="0"'
		);
	$wiki = array(
		'm' => '<span class=\"mark\">{$a[0]}</span>',
		'mb' => '<span class=\"markblue\">{$a[0]}</span>',
		'r' => '<span class=\"red\">{$a[0]}</span>',
		'u' => '<u>{$a[0]}</u>'
		);
	$link = ' »';
	$subject = 0;	
	preg_match('%<a(.+)?>(.*)(</a>)%', utf8_decode($content), $parts);
	$atag = $parts[1];
	$text = trim($parts[2]);
	if (preg_match('%class=\"(.*)\"%U', $atag, $parts)) {
		if (ord($text) == ord('*')) {
			$text = $this->encodeMail(substr($text, 1));
			}
		else {
			$aclass = explode('-', $parts[1]);
			switch ($aclass[0]) {
				case 'internal':
					if (substr($text, 0, 2) == '£U') {
						preg_match('%href=\"(.+)\"%U', $atag, $href);
						array_unshift($find, 'href="' . $href[1] . '"');
						array_unshift($repl, 'href="' . $href[1] . '?return_url=' . t3lib_div::getIndpEnv('TYPO3_REQUEST_URL') . '"');
						}
					else {
						$text = '£L' . $text;
						}
					break;
				case 'external':
					$text = '£W' . $text;
					break;
				case 'download':
					$link = '';
					if (preg_match('%href=\"(.+)\.pdf\"%U', $atag, $parts)) {
						$text = '£P' . $text;
						}
					elseif (preg_match('%href=\"(.+)\.flv\"%U', $atag, $parts)) {
						$text = '£V' . $text;
						}
					elseif (preg_match('%href=\"(.+)/gallery/(.+)\.jpg\"%U', $atag, $parts)) {
						preg_match('%href=\"(.+)\"%U', $atag, $href);
						array_unshift($find, 'href="' . $href[1] . '"');
						array_unshift($repl, 'href="index.php?id=gallery&tx_thomasnu_gallery[start]=' . $parts[2] 
							. '&tx_thomasnu_gallery[back]=' . t3lib_div::getIndpEnv('TYPO3_REQUEST_URL') 
							. '&tx_thomasnu_gallery[action]=slideshow&tx_thomasnu_gallery[controller]=Gallery&no_cache=1"');
						array_unshift($find, 'target="_blank"');
						array_unshift($repl, 'target="_top"');
						}
					else {
						array_unshift($find, 'target="_blank"');
						array_unshift($repl, 'rel="lightbox"');						
						}
					break;
				case 'mail':
					$text = '£M' . $this->encodeMail($text);
					if (preg_match('%title=\"(.*)\"%U', $atag, $parts)) {
						preg_match('%href=\"(.+)\"%U', $atag, $url);
						array_unshift($find, 'href="' . $url[1] . '"');
						array_unshift($repl, 'href="' . $url[1] . '?subject=' . $parts[1] . '"');
						$subject = 1;
						}
					else {
						array_unshift($find, 'class="mail"');
						array_unshift($repl, 'class="mail" title="' . $tits[0] . '"');
						$link = '';
						}
					break;
				}
			}
		}
	if (preg_match('%title=\"(.*)\"%U', $atag, $parts)) {
		$replace = ($subject) ? $tits[0] . ': ' . $parts[1] : $parts[1] . $link;
		if (strpos($replace, 'WWW »') !== false) {
			preg_match('%href=\"http://(.+)/%U', $atag, $url);
			$replace = str_replace('WWW', $url[1], $replace);
			}
		array_unshift($find, 'title="' . $parts[1] . '"');
		array_unshift($repl, 'title="' . $replace . '"');
		}
	$link = '<a' . $atag . '>' . $text . '</a>';
	preg_match_all('%\[(\w{0,5}):(.*)\]%U', $link, $t, PREG_PATTERN_ORDER);
	for ($i = 0; $i < count($t[1]); ++$i) {
		$a = explode("|", $t[2][$i]);
		eval("\$replace = \"" . $wiki[strtolower($t[1][$i])] . "\";");
		array_unshift($find, $t[0][$i]);
		array_unshift($repl, $replace);
		}
	return utf8_encode(str_replace($find, $repl, $link));
	}
/**
 * Encode the visible mail address.
 * 
 */
function encodeMail($text) {
	if (strpos($text, '@')) {
		for ($i = 0; $i < strlen($text); $i++) {
			$s = $s . '&#' . ord($text[$i]) . ';';
			}
		return $s;
		}
	return $text;
	}
}
?>

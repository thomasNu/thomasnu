<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Claus Due <claus@wildside.dk>, Wildside A/S
*  (c) 2014 Thomas Nussbaumer <typo3@thomasnu.ch>
*
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
 * Tabset integration for jQuery UI - remember to load jQueryUI yourself
 * For example through <fed:script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" />
 *
 * Usage example: fed: => tnu:
 *
 * <fed:jQuery.tab animated="TRUE">
 *     <fed:jQuery.tab title="Tab no. 1">
 *         <p>This is the content of the tab</p>
 *     </fed:jQuery.tab>
 *     <fed:jQuery.tab disabled="TRUE" title="Tab no. 2">
 *         <p>This tab is disabled due to disabled=TRUE</p>
 *     </fed:jQuery.tab>
 *     <fed:jQuery.tab active="TRUE" title="Tab no. 3">
 *         <p>This tab is active due to active=TRUE</p>
 *     </fed:jQuery.tab>
 * </fed:jQuery.tab>
 *
 * Note that the same ViewHelpers acts as tab group and tab renderer. The
 * top-level tag is considered group and the following tabs are considered
 * inidividual tabs. At this time nested tab groups are not supported.
 *
 * @author Claus Due, Wildside A/S
 * @package Fed ported into Thomasnu by Thomas Nussbaumer <typo3@thomasnu.ch>
 * @subpackage ViewHelpers\JQuery
 * @uses jQuery
 */

class Tx_Thomasnu_ViewHelpers_JQuery_TabViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractTagBasedViewHelper {

	protected $tagName = 'div';
	protected $uniqId;

	/**
	 * Initialization
	 *
	 * @return void
	 */
	public function initializeArguments() {
		$this->registerUniversalTagAttributes();
		$this->registerArgument('tagName', 'string', 'Tag name to use, default "div"');
		$this->registerArgument('animated', 'boolean', 'Boolean, wether or not to animate tab changes (currently always TRUE)');
		$this->registerArgument('active', 'boolean', 'Set this to TRUE to indicate which tab should be active - use only on a single tab');
		$this->registerArgument('disabled', 'boolean', 'Set this to true to deactivate entire tab sets or individual tabs (currently not used');
		parent::initializeArguments();
	}

	/**
	 * Render method
	 *
	 * @return string
	 */
	public function render() {
		if ($this->templateVariableContainer->exists('tabs') === TRUE) {
			// render one tab
			$index = $this->getCurrentIndex();
			$this->tag->addAttribute('class', 'tnu-tab');
            $active = FALSE;
			if ($this->arguments['active'] === TRUE) {
				$this->setSelectedIndex($index);
                $active = TRUE;
			}
			if ($this->arguments['disabled'] === TRUE) {
				$this->addDisabledIndex($index);
			}
			$this->addTab($this->arguments['title'], $active, $this->renderChildren());
			$this->setCurrentIndex($index + 1);
			return NULL;
		}


		// render tab group
		$this->templateVariableContainer->add('tabs', array());
		$this->templateVariableContainer->add('selectedIndex', NULL);
		$this->templateVariableContainer->add('disabledIndices', array());
		$this->templateVariableContainer->add('currentIndex', 0);
		$content = $this->renderChildren();

		// unique id for this DOM element
		$this->uniqId = 'tnu-jquery-tabs'; // uniqid('tnujquerytabs');
		$tabSelector = $this->renderTabSelector();
		$tabs = $this->renderTabs();
		$html = ($tabSelector . LF . $tabs . LF . $content . LF);
//		$this->addScript();
//		$html .= '<script type="text/javascript">' . LF . '/*<![CDATA[*/' . LF;
//		$html .= $this->addScript() . LF . '/*]]>*/' . LF . '</script>' . LF;
		$this->tag->setContent($html);
		$this->tag->addAttribute('class', 'tnu-tab-group');
		$this->tag->addAttribute('id', $this->uniqId);
		$this->templateVariableContainer->remove('tabs');
		$this->templateVariableContainer->remove('selectedIndex');
		$this->templateVariableContainer->remove('disabledIndices');
		$this->templateVariableContainer->remove('currentIndex');
		return $this->tag->render();
	}

	protected function renderTabSelector() {
		$html = "<ul>" . LF;
		foreach ($this->templateVariableContainer->get('tabs') as $tab) {
			$lid = strtolower(preg_replace('/[^a-z0-9]/i', '_', $tab['title']));
            $html .= $tab['active'] ? '<li class="active">' : '<li>';
			$html .= '<a href="#' . $lid . '" title="' . $lid . '">' . $tab['title'] . '</a></li>' . LF;
		}
		$html .= "</ul>" . LF;
		return $html;
	}

	protected function renderTabs() {
		$html = "";
		foreach ($this->templateVariableContainer->get('tabs') as $tab) {
			$lid = strtolower(preg_replace('/[^a-z0-9]/i', '_', $tab['title']));
            $html .= $tab['active'] ? '<div class="tnu-tab-content tnu-tab-active"' : '<div class="tnu-tab-content"';
			$html .= ' id="' . $lid . '">' . $tab['content'] . '</div>' . LF;
		}
		return $html;
	}

	protected function addTab($title, $active, $content) {
		$tab = array(
			'title' => $title,
            'active' => $active,
			'content' => $content
		);
		$tabs = (array) $this->templateVariableContainer->get('tabs');
		array_push($tabs, $tab);
		$this->templateVariableContainer->remove('tabs');
		$this->templateVariableContainer->add('tabs', $tabs);
	}

	protected function setSelectedIndex($index) {
		$this->templateVariableContainer->remove('selectedIndex');
		$this->templateVariableContainer->add('selectedIndex', $index);
	}

	protected function addDisabledIndex($index) {
		$disabled = (array) $this->templateVariableContainer->get('disabledIndices');
		array_push($disabled, $index);
		$this->templateVariableContainer->remove('disabledIndices');
		$this->templateVariableContainer->add('disabledIndices', $disabled);
	}

	protected function getCurrentIndex() {
		return $this->templateVariableContainer->get('currentIndex');
	}

	protected function setCurrentIndex($index) {
		$this->templateVariableContainer->remove('currentIndex');
		$this->templateVariableContainer->add('currentIndex', $index);
	}

	/**
	 * Attach necessary scripting (currently not used)
	 */
	protected function addScript() {
		$selectedIndex = $this->templateVariableContainer->get('selectedIndex');
		$csvOfDisabledTabIndices = (array) $this->templateVariableContainer->get('disabledIndices');
		$options = array();
		if ($selectedIndex != NULL) {
			$options['selected'] = $selectedIndex;
		}
		if ($this->arguments['animated'] === TRUE) {
			$options['fx'] = array('opacity' => 'toggle');
 		}
		if (count($csvOfDisabledTabIndices) > 0) {
			$options['disabled'] = $csvOfDisabledTabIndices;
		}
		$json = json_encode($options);
		$script = 'jQuery(document).ready(function($) { $("#' . $this->uniqId . '").tabs(' . $json . '); });';
		return $script;
//		$this->documentHead->includeHeader($script, 'js');
	}

}

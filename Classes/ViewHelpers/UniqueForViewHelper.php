<?php

/*                                                                        *
 * This script belongs to the FLOW3 package "Fluid".                      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * View helper for rendering only unique records (or array) elements.
 */
class Tx_Thomasnu_ViewHelpers_UniqueForViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Iterates through elements of $each and renders child nodes. Skip following uniques.
	 *
	 * @param array $each The array or SplObjectStorage to iterated over
	 * @param string $as The name of the iteration variable
	 * @param string $uniqueBy Unique (or sort, toSring for nummeric field) by this property (field[:value]|field:ASC[:toString]|field:DESC[:toString]|)
	 * @param string $uniqueKey The name of the variable to store the current unique key
	 * @param int $max Maximal count of iterations
	 * @return string Rendered string
	 * @author Bastian Waidelich <bastian@typo3.org> (GroupedForViewHelper)
	 * @author Thomas Nussbaumer <typo3@thomasnu.ch>
	 */
	public function render($each, $as, $uniqueBy, $uniqueKey = 'uniqueKey', $max = 10000) {
		$output = '';
		if ($each === NULL) return '';
		if (is_object($each)) {
			if (!$each instanceof Traversable) {
				throw new Tx_Fluid_Core_ViewHelper_Exception('UniqueForViewHelper only supports arrays and objects implementing Traversable interface' , 1253108907);
			}
			$each = iterator_to_array($each);
		}
		$parts = explode(':', $uniqueBy);
		$uniqueBy = $parts[0];
		$uniques = array();
		$uniqueKeys = array();
		$count = 0;
		foreach ($each as $keyValue => $singleElement) {
			if (is_array($singleElement)) {
				$currentUniqueKey = isset($singleElement[$uniqueBy]) ? $singleElement[$uniqueBy] : NULL;
			} elseif (is_object($singleElement)) {
				$currentUniqueKey = Tx_Extbase_Reflection_ObjectAccess::getProperty($singleElement, $uniqueBy);
			} else {
				throw new Tx_Fluid_Core_ViewHelper_Exception('UniqueForViewHelper only supports multi-dimensional arrays and objects' , 1253120365);
			}
			if ($parts[1] != 'ASC' && $parts[1] != 'DESC') {
				if (in_array($currentUniqueKey, $uniqueKeys)) continue;
				if ($parts[1] && $currentUniqueKey != $parts[1]) {
					$currentUniqueKey .= $count;
				}
			} else if ($parts[2]) {
				$currentUniqueKey = sprintf($parts[2], $currentUniqueKey);
			}
			$uniques[$currentUniqueKey][$keyValue] = $singleElement;
			$uniqueKeys[] = $currentUniqueKey;
			if (++$count == $max) break;
		}
		if ($parts[1] == 'ASC') ksort($uniques);
		if ($parts[1] == 'DESC') krsort($uniques);
		foreach ($uniques as $currentUniqueKey => $unique) {
			$this->templateVariableContainer->add($uniqueKey, $currentUniqueKey);
			$this->templateVariableContainer->add($as, $unique);
			$output .= $this->renderChildren();
			$this->templateVariableContainer->remove($uniqueKey);
			$this->templateVariableContainer->remove($as);
		}
		return $output;
	}
}

?>

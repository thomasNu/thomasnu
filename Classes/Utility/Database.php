<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2016 Thomas Nussbaumer <typo3@thomasnu.ch>
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
 * Database utilities.
 */
class Tx_Thomasnu_Utility_Database {

	/**
	 * Reads rows with all fields from a database table.
	 *
	 * @param string $table The database table to select
	 * @param string where The where clausen
	 * @return array $rows The selected rows
	 */
	static public function getRows($table, $where) {
        $rows = array();
        $selectResult = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $table, $where);
        while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($selectResult)) {
            $rows[] = $row;
        }
        return $rows;
	}
}
?>

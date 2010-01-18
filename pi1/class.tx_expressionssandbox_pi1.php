<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Francois Suter (Cobweb) <typo3@cobweb.ch>
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

require_once(PATH_tslib . 'class.tslib_pibase.php');
require_once(t3lib_extMgm::extPath('expressions', 'class.tx_expressions_parser.php'));


/**
 * Plugin 'Expressions sandbox' for the 'expressions_sandbox' extension.
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_expressionssandbox
 *
 * $Id$
 */
class tx_expressionssandbox_pi1 extends tslib_pibase {
	public $prefixId      = 'tx_expressionssandbox_pi1';		// Same as class name
	public $scriptRelPath = 'pi1/class.tx_expressionssandbox_pi1.php';	// Path to this script relative to the extension dir.
	public $extKey        = 'expressions_sandbox';	// The extension key.
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	public function main($content, $conf) {
		$this->pi_USER_INT_obj = 1;	// Configuring so caching is not expected. This value means that no cHash params are ever set. We do this, because it's a USER_INT object!
		$this->init($conf);
		$content = '';

		$expressionsField = $this->conf['expressionsField'];
		$expressions = t3lib_div::trimExplode("\n", $expressionsField, TRUE);
		foreach ($expressions as $anExpression) {
			try {
				$result = tx_expressions_parser::evaluateExpression($anExpression);
				$content .= '<p>' . sprintf($this->pi_getLL('expression_parsed'), '<code>' . $anExpression . '</code>', '<strong>' . $result . '</strong>') . '</p>';
			}
			catch (Exception $e) {
				$content .= '<p>' . sprintf($this->pi_getLL('expression_not_parsed'), '<code>' . $anExpression . '</code>') . '</p>';
			}
		}
		return $this->pi_wrapInBaseClass($content);
	}

	/**
	 * This method performs various initialisations
	 *
	 * @param	array		$conf: plugin configuration, as received by the main() method
	 * @return	void
	 */
	protected function init($conf) {
		$this->pi_loadLL();
			// Base configuration is equal the the plugin's TS setup
		$this->conf = $conf;

			// Load the flexform and loop on all its values to override TS setup values
		$this->pi_initPIflexForm();
		if (is_array($this->cObj->data['pi_flexform']['data'])) {
			foreach ($this->cObj->data['pi_flexform']['data'] as $sheet => $langData) {
				foreach ($langData as $fields) {
					foreach ($fields as $field => $value) {
						$value = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], $field, $sheet);
						if (!empty($value)) {
							$this->conf[$field] = $value;
						}
					}
				}
			}
		}
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/expressions_sandbox/pi1/class.tx_expressionssandbox_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/expressions_sandbox/pi1/class.tx_expressionssandbox_pi1.php']);
}

?>
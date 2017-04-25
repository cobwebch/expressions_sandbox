<?php

namespace Cobweb\ExpressionsSandbox\Controller;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Cobweb\Expressions\ExpressionParser;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Plugin 'Expressions sandbox' for the 'expressions_sandbox' extension.
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 * @subpackage tx_expressionssandbox
 */
class SandboxController extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin
{
    public $prefixId = 'tx_expressionssandbox_pi1';        // Same as class name
    public $scriptRelPath = 'Classes/Controller/SandboxController.php';    // Path to this script relative to the extension dir.
    public $extKey = 'expressions_sandbox';    // The extension key.

    /**
     * The main method of the Plugin
     *
     * @param string $content The Plugin's content (empty in this case)
     * @param array $conf The Plugin configuration
     * @return string The content that is displayed on the website
     */
    public function main($content, $conf)
    {
        $this->pi_USER_INT_obj = 1;    // Configuring so caching is not expected. This value means that no cHash params are ever set. We do this, because it's a USER_INT object!
        $this->init($conf);
        $content = '';

        $expressionsField = $this->conf['expressionsField'];
        $expressions = GeneralUtility::trimExplode("\n", $expressionsField, true);
        foreach ($expressions as $anExpression) {
            try {
                $result = ExpressionParser::evaluateExpression($anExpression);
                if (is_array($result)) {
                    $result = DebugUtility::viewArray($result);
                }
                $content .= '<p>' . sprintf($this->pi_getLL('expression_parsed'), '<code>' . $anExpression . '</code>',
                                '<strong>' . $result . '</strong>') . '</p>';
            } catch (\Exception $e) {
                $content .= '<p>' . sprintf($this->pi_getLL('expression_not_parsed'),
                                '<code>' . $anExpression . '</code>') . '</p>';
            }
        }
        return $this->pi_wrapInBaseClass($content);
    }

    /**
     * This method performs various initialisations
     *
     * @param array $conf Plugin configuration, as received by the main() method
     * @return void
     */
    protected function init($conf)
    {
        $this->pi_loadLL('EXT:expressions_sandbox/Resources/Private/Language/locallang.xlf');
        // Base configuration is equal to the plug-in's TS setup
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

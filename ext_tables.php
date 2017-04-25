<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

// Hide some default fields
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'layout,select_key,pages';

// Add pi1 to the list of plugins
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:expressions_sandbox/locallang_db.xml:tt_content.list_type_pi1',
		$_EXTKEY . '_pi1',
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'ext_icon.png'
	),
	'list_type'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
	'Cobweb.ExpressionsSandbox',
	'setup', '
		plugin.tx_expressionssandbox_pi1 = USER_INT
		plugin.tx_expressionssandbox_pi1.userFunc = Cobweb\\ExpressionsSandbox\\Controller\\SandboxController->main
	'
);

// Activate the display of the plug-in flexform field and set FlexForm definition
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
	$_EXTKEY . '_pi1',
	'FILE:EXT:expressions_sandbox/Configuration/FlexForm/flexform_ds.xml'
);

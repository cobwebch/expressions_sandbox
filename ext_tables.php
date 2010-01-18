<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

	// Hide some default fields
t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'layout,select_key,pages';

	// Add pi1 to the list of plugins
t3lib_extMgm::addPlugin(array(
	'LLL:EXT:expressions_sandbox/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');

	// Activate the display of the plug-in flexform field and set FlexForm defintion
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:expressions_sandbox/flexform_ds.xml');
?>
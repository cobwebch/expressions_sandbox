<?php

########################################################################
# Extension Manager/Repository config file for ext: "expressions_sandbox"
#
# Auto generated 18-01-2010 13:02
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Testing environment for expressions',
	'description' => 'Provides a frontend testing area for expressions parsed by the generic expressions parser.',
	'category' => 'plugin',
	'author' => 'Francois Suter (Cobweb)',
	'author_email' => 'typo3@cobweb.ch',
	'shy' => '',
	'dependencies' => 'expressions',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '1.0.0',
	'constraints' => array(
		'depends' => array(
			'expressions' => '',
			'typo3' => '4.5.0-4.7.99'
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:10:{s:9:"ChangeLog";s:4:"c4ef";s:10:"README.txt";s:4:"ee2d";s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"a5fd";s:14:"ext_tables.php";s:4:"697d";s:16:"locallang_db.xml";s:4:"c673";s:19:"doc/wizard_form.dat";s:4:"f547";s:20:"doc/wizard_form.html";s:4:"a924";s:39:"pi1/class.tx_expressionssandbox_pi1.php";s:4:"71c4";s:17:"pi1/locallang.xml";s:4:"bfc4";}',
);

?>
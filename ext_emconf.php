<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "extrasalt"
 *
 * Auto generated by Extension Builder 2017-07-11
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'extra salt',
	'description' => 'Additional salting methods for salted passwords (Blowfish for php > 5.3.7, hashes starting with "$2y$")',
	'category' => 'services',
	'author' => 'C. Holtermann',
	'author_email' => 'mail@c-holtermann.net',
	'state' => 'experimental',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '0.1.6',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.2.0-7.2.99',
			'php' => '5.3.7-0.0.0'
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);

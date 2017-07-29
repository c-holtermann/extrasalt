<?php
if (!defined('TYPO3_MODE')) {
        die('Access denied.');
}

// Register blowfish salted hashing methods
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/saltedpasswords']['saltMethods']['CHoltermann\\Extrasalt\\BlowfishSaltPhpCrypt2y'] = 'CHoltermann\\Extrasalt\\BlowfishSaltPhpCrypt2y';

// Add descriptions
$GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['EXT:saltedpasswords/locallang.xlf'][] = 'EXT:extrasalt/Resources/Private/Language/saltedpasswords/locallang.xlf';

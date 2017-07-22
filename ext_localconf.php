<?php
if (!defined('TYPO3_MODE')) {
        die('Access denied.');
}

// Register blowfish salted hashing methods
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/saltedpasswords']['saltMethods']['CHoltermann\\Extrasalt\\BlowfishSalt'] = 'CHoltermann\\Extrasalt\\BlowfishSalt';

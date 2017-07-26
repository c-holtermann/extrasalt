<?php

class BlowfishSaltTest extends \TYPO3\CMS\Core\Tests\BaseTestCase {

	const identKey = 'BlowfishSaltTest';
	
	const classnameBlowfish = 'CHoltermann\Extrasalt\BlowfishSalt';

	const blowfishSalt1 = '$2y$14$ZADNl.UOPmN.LN/i/shXco';
	const blowfishSaltInvalid1 = '$2a$14$ZADNl.UOPmN.LN/i/shXco';
	const blowfishSaltInvalid2 = '$2y!14$ZADNl.UOPmN.LN/i/shXco';
	const blowfishSaltInvalid3 = '$2y$14$ZADNl!UOPmN.LN/i/shXco';
	const blowfishPassword1 = 'sausage';
	const blowfishSaltPassword1 = '$2y$14$ZADNl.UOPmN.LN/i/shXceDQw/nWwqWg8/QG26//TdAiawjyrxYgq';
	const blowfishSaltPasswordInvalid1 = '$2a$14$ZADNl.UOPmN.LN/i/shXceDQw/nWwqWg8/QG26//TdAiawjyrxYgq';
	const blowfishSaltPasswordInvalid2 = '$2y$14AZADNl.UOPmN.LN/i/shXceDQw/nWwqWg8/QG26//TdAiawjyrxYgq';
	const blowfishSaltPasswordInvalid3 = '$2y$14$ZADNl.UOPmN.LN/i!shXceDQw/nWwqWg8/QG26//TdAiawjyrxYgq';
	const blowfishPassword2 = 'spam';

	/**
	* @test
	*/
	public function blowfishSaltHasBeenRegistered() {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$availableClasses = TYPO3\CMS\Saltedpasswords\Salt\SaltFactory::getRegisteredSaltedHashingMethods();
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('availableClasses', self::identKey, -1, $availableClasses);
		$classAvailable = in_array(self::classnameBlowfish, $availableClasses);
		$this->assertTrue($classAvailable);
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}

	/**
	* @test
	*/
	public function anInstanceOfBlowfishSaltCanBeConstructed() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		$this->assertInstanceOf('\\TYPO3\\CMS\\Saltedpasswords\\Salt\\SaltInterface', $blowfishInstance);
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}

	/**
	* @test
	*/
	public function blowfishSaltIsAvailable() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		$this->assertTrue($blowfishInstance->isAvailable());
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}


	/**
	* @test
	*/
	public function validBlowfishHashIsAccepted() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		$this->assertTrue($blowfishInstance->isValidSalt(self::blowfishSaltPassword1));
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}

	/**
	* @test
	*/
	public function invalidBlowfishHashIsRejected() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		$this->assertTrue(!$blowfishInstance->isValidSalt(self::blowfishSaltPasswordInvalid1));
		$this->assertTrue(!$blowfishInstance->isValidSalt(self::blowfishSaltPasswordInvalid2));
		$this->assertTrue(!$blowfishInstance->isValidSalt(self::blowfishSaltPasswordInvalid3));
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}	

	/**
	* @test
	*/
	public function blowfishPasswordIsCorrectlyIdentified() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		$this->assertTrue($blowfishInstance->checkPassword(self::blowfishPassword1, self::blowfishSaltPassword1));
		$this->assertTrue(!$blowfishInstance->checkPassword(self::blowfishPassword2, self::blowfishSaltPassword1));
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}

	/**
	* @test
	*/
	public function blowfishGenerateRandomSalt() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		$salt = $blowfishInstance->getRandomSalt();
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog("salt: ".$salt, self::identKey, -1);
		$this->assertTrue(strlen($salt)==22);
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}
	
}

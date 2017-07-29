<?php

class BlowfishSaltPhpCrypt2yTest extends \TYPO3\CMS\Core\Tests\BaseTestCase {

	const identKey = 'BlowfishSaltPhpCrypt2yTest';
	
	const classnameBlowfish = 'CHoltermann\Extrasalt\BlowfishSaltPhpCrypt2y';

	const blowfishSaltPhpCrypt2y1 = '$2y$14$ZADNl.UOPmN.LN/i/shXco';
	const blowfishSaltPhpCrypt2yInvalid1 = '$2a$14$ZADNl.UOPmN.LN/i/shXco';
	const blowfishSaltPhpCrypt2yInvalid2 = '$2y!14$ZADNl.UOPmN.LN/i/shXco';
	const blowfishSaltPhpCrypt2yInvalid3 = '$2y$14$ZADNl!UOPmN.LN/i/shXco';
	const blowfishPassword1 = 'sausage';
	const blowfishSaltPhpCrypt2yPassword1 = '$2y$14$ZADNl.UOPmN.LN/i/shXceDQw/nWwqWg8/QG26//TdAiawjyrxYgq';
	const blowfishSaltPhpCrypt2yPasswordInvalid1 = '$2a$14$ZADNl.UOPmN.LN/i/shXceDQw/nWwqWg8/QG26//TdAiawjyrxYgq';
	const blowfishSaltPhpCrypt2yPasswordInvalid2 = '$2y$14AZADNl.UOPmN.LN/i/shXceDQw/nWwqWg8/QG26//TdAiawjyrxYgq';
	const blowfishSaltPhpCrypt2yPasswordInvalid3 = '$2y$14$ZADNl.UOPmN.LN/i!shXceDQw/nWwqWg8/QG26//TdAiawjyrxYgq';
	const blowfishPassword2 = 'spam';

	/**
	* @test
	*/
	public function blowfishSaltPhpCrypt2yHasBeenRegistered() {
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
	public function anInstanceOfBlowfishSaltPhpCrypt2yCanBeConstructed() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		$this->assertInstanceOf('\\TYPO3\\CMS\\Saltedpasswords\\Salt\\SaltInterface', $blowfishInstance);
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}

	/**
	* @test
	*/
	public function blowfishSaltPhpCrypt2yIsAvailable() {
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
		$this->assertTrue($blowfishInstance->isValidSalt(self::blowfishSaltPhpCrypt2yPassword1));
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}

	/**
	* @test
	*/
	public function invalidBlowfishHashIsRejected() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		$this->assertTrue(!$blowfishInstance->isValidSalt(self::blowfishSaltPhpCrypt2yPasswordInvalid1));
		$this->assertTrue(!$blowfishInstance->isValidSalt(self::blowfishSaltPhpCrypt2yPasswordInvalid2));
		$this->assertTrue(!$blowfishInstance->isValidSalt(self::blowfishSaltPhpCrypt2yPasswordInvalid3));
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}	

	/**
	* @test
	*/
	public function blowfishPasswordIsCorrectlyIdentified() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		$this->assertTrue($blowfishInstance->checkPassword(self::blowfishPassword1, self::blowfishSaltPhpCrypt2yPassword1));
		$this->assertTrue(!$blowfishInstance->checkPassword(self::blowfishPassword2, self::blowfishSaltPhpCrypt2yPassword1));
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

	/**
	* @test
	*/
	public function blowfishGenerateRandomSaltWithSettings() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		$salt = $blowfishInstance->getGeneratedSalt();
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog("salt: ".$salt, self::identKey, -1);
		$this->assertTrue($blowfishInstance->isValidSalt($salt));
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}

	/**
	* @test
	*/
	public function blowfishGenerate1000RandomSaltsWithSettings() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		for ($i=0; $i<1000; $i++)
		{
			$salt = $blowfishInstance->getGeneratedSalt();
			\TYPO3\CMS\Core\Utility\GeneralUtility::devLog("salt(".$i."): ".$salt, self::identKey, -1);
			$this->assertTrue($blowfishInstance->isValidSalt($salt));
		}
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}
	
	/**
	* @test
	*/
	public function blowfishGeneratePassword() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		$password = "testpassword1234";	
		$saltedPassword = $blowfishInstance->getHashedPassword($password);
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog("password: $password -> ".$saltedPassword, self::identKey, -1);
		$this->assertTrue($blowfishInstance->isValidSalt($saltedPassword));
		$this->assertTrue($blowfishInstance->checkPassword($password, $saltedPassword));
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}

	/**
	* @see https://stackoverflow.com/questions/6101956/generating-a-random-password-in-php/31284266#31284266
	**/
	function insecureRandomPassword($length=8) {
    		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    		$pass = array(); //remember to declare $pass as an array
    		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    		for ($i = 0; $i < $length; $i++) {
        		$n = rand(0, $alphaLength);
        		$pass[] = $alphabet[$n];
    		}
    		return implode($pass); //turn the array into a string
	}

	/**
	* @test
	*/
	public function blowfishGenerate20RandomPasswords() {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." START", self::identKey, -1);
		$blowfishInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::getUserObj(self::classnameBlowfish);
		for ($i=0; $i<20; $i++)
		{
			$password = $this->insecureRandomPassword(8);	
			$saltedPassword = $blowfishInstance->getHashedPassword($password);
			\TYPO3\CMS\Core\Utility\GeneralUtility::devLog("password($i): $password -> ".$saltedPassword, self::identKey, -1);
			$this->assertTrue($blowfishInstance->isValidSalt($saltedPassword));
			$this->assertTrue($blowfishInstance->checkPassword($password, $saltedPassword));
		}
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog(__METHOD__." END", self::identKey, -1);
	}
}

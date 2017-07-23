<?php
namespace CHoltermann\Extrasalt;

/**
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

/**
 * Class that implements Blowfish salted hashing based on PHP's
 * crypt() function for php > 5.3.7 for hashes starting with $2y$
 *
 * Credits to 
 * http://www.techrepublic.com/blog/australian-technology/securing-passwords-with-blowfish/
 * http://www.php.net/security/crypt_blowfish.php
 *
 * @author Christoph Holtermann <mail@c-holtermann.net>
 */

class BlowfishSalt extends \TYPO3\CMS\Saltedpasswords\Salt\AbstractSalt implements \TYPO3\CMS\Saltedpasswords\Salt\SaltInterface {

	const identKey = "CHoltermann\Extrasalt\BlowfishSalt";

	/**
	 * Keeps a string for mapping an int to the corresponding
	 * base 64 character.
	 */
	const ITOA64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	
	/**
         * Setting string to indicate type of hashing method (Blowfish).
         *
         * @var string
         */
        static protected $settingBlowfish = '$2y$';

	/**
         * Keeps length of a Blowfish salt in bytes.
         *
         * @var integer
         */
        static protected $saltLengthBlowfish = 22;

	/**
         * Method applies settings (prefix, optional hash count, optional suffix)
         * to a salt.
         *
         * @param string $salt A salt to apply setting to
         * @return string Salt with setting
         */
        protected function applySettingsToSalt($salt)
	{}
        
        /**
         * Generates a random base salt settings for the hash.
         *
         * @return string A string containing settings and a random salt
         */
        protected function getGeneratedSalt()
	{}
        
        /**
         * Returns a string for mapping an int to the corresponding base 64 character.
         *
         * @return string String for mapping an int to the corresponding base 64 character
         */
        protected function getItoa64()
	{
		return self::ITOA64;
	}
        
	/**
         * Returns setting string of Blowfish salted hashes.
         *
         * @return string Setting string of Blowfish salted hashes
         */
        public function getSetting() {
                return self::$settingBlowfish;
        }

	/**
         * Method checks if a given plaintext password is correct by comparing it with
         * a given salted hashed password.
         *
         * @param string $plainPW plain-text password to compare with salted hash
         * @param string $saltedHashPW Salted hash to compare plain-text password with
         * @return boolean TRUE, if plaintext password is correct, otherwise FALSE
         */
        public function checkPassword($plainPW, $saltedHashPW)
	{
		$isCorrect = FALSE;
		if ($this->isValidSalt($saltedHashPW)) {
			$isCorrect = crypt($plainPW, $saltedHashPW) == $saltedHashPW;
		}
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt checkPassword plainPW: '.$plainPW.' saltedHashPW: '.$saltedHashPW.' ok: '.$isCorrect, $this->identKey, -1);
		return $isCorrect;
	}
        
        /**
         * Returns length of required salt.
	 *
	 * @ToDo remove debug log
         * @return integer Length of required salt
         */
        public function getSaltLength()
	{
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt getSaltLength: '.self::$saltLengthBlowfish, $this->identKey, -1);
		return self::$saltLengthBlowfish;
	}
        
        /**
         * Returns whether all prerequisites for the hashing methods are fulfilled
	 *
	 * @ToDo Does this method ever get called ?
	 * @ToDo Further conditions to check ?
         * @return boolean Method available
         */
        public function isAvailable()
	{
		$returnValue1 = version_compare(phpversion(), '5.3.7', '>');
		if (function_exists('parent::isAvailable')) { $returnValue2 = parent::isAvailable(); } else $returnValue2 = TRUE;
		
		return $returnValue1 && $returnValue2;
	}
        
        /**
         * Method creates a salted hash for a given plaintext password
	 *
	 * @ToDo implement
         * @param string $password Plaintext password to create a salted hash from
         * @param string $salt Optional custom salt to use
         * @return string Salted hashed password
         */
        public function getHashedPassword($password, $salt = NULL)
	{
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt getHashedPassword', $this->identKey, -1);
	}
        
        /**
         * Checks whether a user's hashed password needs to be replaced with a new hash.
         *
         * This is typically called during the login process when the plain text
         * password is available.  A new hash is needed when the desired iteration
         * count has changed through a change in the variable $hashCount or
         * HASH_COUNT or if the user's password hash was generated in an bulk update
         * with class ext_update.
	 *
	 * @Todo implement
         * @param string $passString Salted hash to check if it needs an update
         * @return boolean TRUE if salted hash needs an update, otherwise FALSE
         */
        public function isHashUpdateNeeded($passString)
	{
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt isHashUpdateNeeded', $this->identKey, -1);
	}
	
	/**
	 * Method returns TRUE if hash starts with Prefix typical for Blowfish Hashes
	 *
         * @param string $hash Hash to check
         * @return boolean TRUE if hash starts with Blowfish prefix otherwise FALSE
         */
	protected function hashHasPrefixBlowfish($hash)
	{
		$prefixBlowfish = $this->getSetting();
		if (!strncmp($hash, $prefixBlowfish, strlen($prefixBlowfish))) {return TRUE;} else {return FALSE;}
	}
	
	/**
	 * Method returns cost parameter of Blowfish Hash
	 *
         * @param string $hash Hash to check
	 * @return string cost parameter of length 2 or FALSE if invalid
         */
	protected function hashGetCostBlowfish($hash)
	{
		$costBlowfish = FALSE;
		$prefixBlowfish = $this->getSetting();
		$costBlowfishRegion = substr($hash, strlen($prefixBlowfish)-1, 4);
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt hashGetCostBlowfish '.$costBlowfishRegion, $this->identKey, -1);
		if (!strncmp('$', $costBlowfishRegion, 1) && !substr_compare($costBlowfishRegion, '$', -1, 1))
		{
			\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt hashGetCostBlowfish validCostRegion', $this->identKey, -1);
			$costBlowfish = substr($costBlowfishRegion, 1, 2);
		}
		return $costBlowfish;
	}

	/**
	 * Method returns salt part of Blowfish Hash
	 *
	 * return string after prefix and cost, from position 7 to end
	 *
         * @param string $hash Hash to process
	 * @return string salt
         */
	protected function hashGetSaltBlowfish($hash)
	{
		$prefixBlowfish = $this->getSetting();
		$lengthPrefixBlowfish = strlen($prefixBlowfish);
		$lengthCostBlowfish = 3;
		$saltBlowfish = substr($hash, $lengthPrefixBlowfish+$lengthCostBlowfish);
		return $saltBlowfish;
	}

        /**
         * Method determines if a given string is a valid salt
	 *
	 * @ToDo implement
         * @param string $salt String to check
         * @return boolean TRUE if it's valid salt, otherwise FALSE
         */
        public function isValidSalt($salt)
	{
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt isValidSalt', $this->identKey, -1);
		$isValid = FALSE;
		$reqLenBase64 = $this->getLengthBase64FromBytes($this->getSaltLength());
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt isValidSalt reqLenBase64: '.$reqLenBase64, $this->identKey, -1);
		if (strlen($salt) >= $reqLenBase64) {
			\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt isValidSalt reqLenBase64 ok', $this->identKey, -1);
			if ($this->hashHasPrefixBlowfish($salt)) {
				\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt hashHasPrefixBlowfish ok', $this->identKey, -1);
				$costBlowfish = $this->hashGetCostBlowfish($salt);
				\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt hashGetCostBlowfish: '.$costBlowfish, $this->identKey, -1);

				if ($costBlowfish)
				{	
					$saltBlowfish = $this->hashGetSaltBlowfish($salt);
					\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt hashGetSaltBlowfish: '.$saltBlowfish, $this->identKey, -1);
					$lengthSaltBlowfish = strlen($saltBlowfish);
					if ($lengthSaltBlowfish >= 22)
					{
						\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt hashGetSaltBlowfish length>=22 -> ok', $this->identKey, -1);
						// check if salt and PW contain only valid characters
						if (preg_match('/^[' . preg_quote($this->getItoa64(), '/') . ']+$/', $saltBlowfish )) {
							\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt preg_match ok', $this->identKey, -1);
							$isValid = TRUE;
						}
					}
				}
			}
		}

		return $isValid;
	}


	/**
         * Method determines if a given string is a valid salted hashed password.
         *
         * @param string $saltedPW String to check
         * @return boolean TRUE if it's valid salted hashed password, otherwise FALSE
         */
        public function isValidSaltedPW($saltedPW) {
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('BlowFishSalt isValidSaltedPW', $this->identKey, -1, array($saltedPW));
                $isValid = FALSE;
                $isValid = !strncmp($this->getSetting(), $saltedPW, strlen($this->getSetting())) ? TRUE : FALSE;
                if ($isValid) {
                        $isValid = $this->isValidSalt($saltedPW);
                }
                return $isValid;
        }

}

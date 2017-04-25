<?php
require_once("autoload.php");
class Profile implements \JsonSerializable {

	// create state variables up here

	// create accessor + mutator for each state variable
	/**
	 * @var int $profileId
	 **/
	private $profileId;

	/**
	 * @var string $profileActivationToken
	 **/
	private $profileActivationToken;

	/**
	 * @var string $profileAtHandle
	 **/
	private $profileAtHanadle;
	/**
	 * @var string $profileAtHandle
	 **/
	private $profileAtHandle;
	/**
	 * @var string profileEmail
	 **/
	private $profileEmail;
	/**
	 * @var string $profileHash
	 **/
	private $profileHash;
	/**
	 * @var string $profileSalt
	 */
	private $profileSalt;
	/**
	 * @var string $profilePhone
	 */
	private $profilePhone;

	/**
	 * accessor
	 * @return
	 **/
	public function getprofileId(): void {
		return ($this->profileId);
	}

	/**
	 * mutator
	 * @param int|null $profileId new value of tweet
	 * @throws |RangeException if $newprofileId is not positive
	 * @throws |TypeError if $newprofileId is not an integer
	 **/
	public function setprofileId(?int $newprofileId): void {
		if($newprofileId === null) {
			$this->profileId = null;
			return;
		}

		if($newprofileId <= 0) {
			throw(new\RangeException("profile id is not positive"));
		}

		$this->profileId = $newprofileId;
	}

	/**
	 * accessor
	 * @return
	 **/
	public function getprofileAcitvationToken(): string {
		return ($this->profileActivationToken);
	}
	/**
	 * mutator
	 **/
	/**
	 * @param string $newprofileActivationToken new value of profile
	 * @throws |InvalidArgumentException if $newprofileActivationToken is not a string or insecure
	 * @throws |RangeException if $newprofileActivationToken is 140 characters
	 * @throws |TypeError if $newprofileActivationToken is not a string
	 **/
	public function setprofileActivationToken(string $newprofileActivationToken): void {
		$newprofileActivationToken = trim($newprofileActivationToken);
		$newprofileActivationToken = filter_var($newprofileActivationToken, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		if(empty($newprofileActivationToken) === true) {
			throw(new \InvalidArgumentException("profile contentis empty or insecure"));
		}

		if(strlen($newprofileActivationToken) > 32) {
			throw (new \RangeException("profile content too large"));
		}

		$this->profileActivationToken = $newprofileActivationToken;
	}

	/**
	 * accessor
	 * @return
	 **/
	public function getprofileAtHandle(): string {
		return ($this->profileAtHanadle);
	}

	/**
	 * mutator
	 **/
	/**
	 * @param string $newprofileAtHandle new value of profile
	 * @throws |InvalidArgumentException if $newprofileAtHandle is not a string or insecure
	 * @throws |RangeException if $newprofileAtHandle is >32 characters
	 * @throws |TypeError if $newprofileAtHandle is not a string
	 **/
	public function setprofileAtHandle(string $newprofileAtHandle): void {

		$newprofileAtHandle = trim($newprofileAtHandle);
		$newprofileAtHandle = filter_var($newprofileAtHandle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		if(empty($newprofileAtHandle) === true) {
			throw(new \InvalidArgumentException("profile content is empty or insecure"));
		}

		if(strlen($newprofileAtHandle) > 32) {
			throw(new \RangeException("profile content too large"));
		}

		$this->profileAtHandle = $newprofileAtHandle;
	}

	/**
	 * accessor
	 * @return
	 **/
	public function getprofileEmail(): string {
		return ($this->profileEmail);
	}
	/**
	 * mutator
	 **/
	/**
	 * @param string $newprofileEmail new value of content
	 * @throws \InvalidArgumentException if $newprofileEmail is not a string or not insecure
	 * @throws \RangeException if $newprofileEmail is >128 characters
	 * @throws \TypeError id $newprofileEmail is not a string
	 */
	public function setprofileEmail(string $newprofileEmail): void {
		{
			$newprofileEmail = trim($newprofileEmail);
			$newprofileEmail = filter_var($newprofileEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($newprofileEmail) === true) {
				throw(new \InvalidArgumentException("profile content is empty or insecure"));
			}
			if(strlen($newprofileEmail) > 128) {
				throw(new \RangeException("profile content is too large"));
			}
			$this->profileEmail = $newprofileEmail;
		}
	}


	/**
	 * accessor)
	 *
	 *
	 * public function setprofileHash(string $newprofileHash)
	 * return($this->/**
	 * @return string
	 */
	public function getProfileHash(): string {
		return ($this->profileHash);
	}

	/**
	 * mutator
	 */


	/**@param string $newprofileHash new value of content
	 * @throws \InvalidArgumentException if $newprofileHash is not a string or not insecure
	 * @throws \RangeException if $newprofileHash is >128 characters
	 * @throws \TypeError id $newprofileHash is not a string
	 */
	public function setprofileHash(string $newprofileHash): void {
		$newprofileHash = trim($newprofileHash);
		$newprofileHash = filter_var($newprofileHash, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newprofileHash) === true) {
			throw(new \InvalidArgumentException("profile conent is empty or insecure"));
		}
		if(strlen($newprofileHash) > 128) {
			throw(new \RangeException("profile content too large"));
		}
		$this->profileHash = $newprofileHash;
	}

	/**
	 * accessor
	 * @return
	 **/
	public function getprofileSalt(): string {
		return ($this->profileSalt);
	}

	/**@param string $newprofileSalt new value of content
	 * @throws \InvalidArgumentException if $newprofileSalt is not a string or not insecure
	 * @throws \RangeException if $newprofileSalt is >128 characters
	 * @throws \TypeError id $newprofileSalt is not a string
	 */
	public function setprofileSalt(string $newprofileSalt): void {
		$newprofileSalt = trim($newprofileSalt);
		$newprofileSalt = filter_var($newprofileSalt, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newprofileSalt) === true) {
			throw(new\InvalidArgumentException("profile Salt is empty or insecure"));
		}
		if(strlen($newprofileSalt) > 64) {
			throw (new\RangeException("profile Salt is too large"));
		}

		$this->profileSalt = $newprofileSalt;
	}

	/**
	 * accessor
	 * @return
	 **/
	public function getprofilePhone(): string {
		return ($this->profilePhone);
	}

	/**@param string $newprofilePhone new value of content
	 * @throws \InvalidArgumentException if $newprofilePhone is not a string or not insecure
	 * @throws \RangeException if $newprofilePhone is >128 characters
	 * @throws \TypeError id $newprofilePhone is not a string
	 */
	public function setprofilePhone(string $newprofilePhone): void {
		$newprofilePhone = trim($newprofilePhone);
		$newprofilePhone = filter_var($newprofilePhone, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newprofilePhone) === true) {
			throw(new \InvalidArgumentException("profile phone is empty or insecure"));
		}
		if(strlen($newprofilePhone) > 32) {
			throw(new \RangeException("profile phone is too large"));
		}
		$this->profilePhone = $newprofilePhone;
	}


	/**
	 * constructor for this Tweet
	 *
	 * @param int|null $newProfileId id of this product or null if a new productId
	 * @param string $newActivationToken name of the  product that sent this product
	 * 	 * @param string $newprofileEmail name of the  product that sent this product
	 * 	 * @param string $newprofileHash name of the  product that sent this product
	 * 	 * @param string $newprofileSalt name of the  product that sent this product
	 * 	 * @param string $newprofilePhone name of the  product that sent this product
	 * @param string $newprofileAtHandle string containing actual product data
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public
	function __construct(?int $newProfileId, ?string $newActivationToken, string $newprofileEmail, ?string $newprofileHash,?string $newprofileSalt,?string $newprofilePhone, = null) {
		try {
			$this->setprofileId($newProfileId);
			$this->setprofileActivationToken($newActivationToken);
			$this->setprofileEmail($newprofileEmail);
			$this->setprofileHash($newprofileHash);
			$this->setprofileEmail($newprofileEmail);
			$this->setprofileHash($newprofileHash);
			$this->setprofileSalt($newprofileSalt);
			$this->setprofilePhone($newprofilePhone);
		}



/**
 * inserts this Profile into mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
	public function insert(\PDO $pdo): void {
			if($this->profileId !== null) {
				throw(new \PDOException("not a new profile"));
			}

			$query = "INSERT INTO profile(profileActivationToken, profileAtHandle, profileEmail, profileHash, profilePhone, profileSalt) VALUES (:profileActivationToken, :profileAtHandle, :profileEmail, :profileHash, :profilePhone, :profileSalt)";
			$statement = $pdo->prepare($query);
			$parameters = ["profileActivationToken" => $this->profileActivationToken, "profileAtHandle" => $this->profileAtHandle, "profileEmail" => $this->profileEmail, "profileHash" => $this->profileHash, "profilePhone" => $this->profilePhone, "profileSalt" => $this->profileSalt];
			$statement->execute($parameters);
			$this->profileId = intval($pdo->lastInsertId());
		}
/**
 * deletes this Profile from mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
	public function delete(\PDO $pdo): void {
			// enforce the profileId is not null (i.e., don't delete a profile that does not exist)
			if($this->profileId === null) {
				throw(new \PDOException("unable to delete a profile that does not exist"));
			}

			$query = "DELETE FROM profile WHERE profileId = :profileId";
			$statement = $pdo->prepare($query);
			// bind the member variables to the place holders in the template
			$parameters = ["profileId" => $this->profileId];
			$statement->execute($parameters);
		}



		/**
		 * updates this Profile from mySQL
		 *
		 * @param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 **/
	public function update(\PDO $pdo): void {
			// enforce the profileId is not null (i.e., don't update a profile that does not exist)
			if($this->profileId === null) {
				throw(new \PDOException("unable to delete a profile that does not exist"));
			}
			// create query template
			$query = "UPDATE profile SET profileActivationToken = :profileActivationToken, profileAtHandle = :profileAtHandle, profileEmail = :profileEmail, profileHash = :profileHash, profilePhone = :profilePhone, profileSalt = :profileSalt WHERE profileId = :profileId";
			$statement = $pdo->prepare($query);
			// bind the member variables to the place holders in the template
			$parameters = ["profileId" => $this->profileId, "profileActivationToken" => $this->profileActivationToken, "profileAtHandle" => $this->profileAtHandle, "profileEmail" => $this->profileEmail, "profileHash" => $this->profileHash, "profilePhone" => $this->profilePhone, "profileSalt" => $this->profileSalt];
			$statement->execute($parameters);
		}
		/**
		 * gets the Profile by profile id
		 *
		 * @param \PDO $pdo $pdo PDO connection object
		 * @param int $profileId profile id to search for
		 * @return Profile|null Profile or null if not found
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError when variables are not the correct data type
		 **/
	public static function getProfileByProfileId(\PDO $pdo, int $profileId):?Profile {
			// sanitize the profile id before searching
			if($profileId <= 0) {
				throw(new \PDOException("profile id is not postive"));
			}
			// create query template
			$query = "SELECT profileId, profileActivationToken, profileAtHandle, profileEmail, profileHash, profilePhone, profileSalt FROM profile WHERE profileId = :profileId";
			$statement = $pdo->prepare($query);
			// bind the profile id to the place holder in the template
			$parameters = ["profileId" => $profileId];
			$statement->execute($parameters);
			try {
				$profile = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $statement->fetch();
				if($row !== false) {
					$profile = new Profile($row["profileId"], $row["profileActivationToken"], $row["profileAtHandle"], $row["profileEmail"], $row["profileHash"], $row["profilePhone"], $row["profileSalt"]);
				}
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return ($profile);
		}
		/**
		 * gets the Profile by email
		 *
		 * @param \PDO $pdo PDO connection object
		 * @param string $profileEmail email to search for
		 * @return Profile|null Profile or null if not found
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError when variables are not the correct data type
		 **/
	public static function getProfileByProfileEmail(\PDO $pdo, string $profileEmail): ?Profile {
			// sanitize the email before searching
			$profileEmail = trim($profileEmail);
			$profileEmail = filter_var($profileEmail, FILTER_VALIDATE_EMAIL);
			if(empty($profileEmail) === true) {
				throw(new \PDOException("not a valid email"));
			}
			// create query template
			$query = "SELECT profileId, profileActivationToken, profileAtHandle, profileEmail, profileHash, profilePhone, profileSalt FROM profile WHERE profileEmail = :profileEmail";
			$statement = $pdo->prepare($query);
			// bind the profile id to the place holder in the template
			$parameters = ["profileEmail" => $profileEmail];
			$statement->execute($parameters);
			// grab the Profile from mySQL
			try {
				$profile = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $statement->fetch();
				if($row !== false) {
					$profile = new Profile($row["profileId"], $row["profileActivationToken"], $row["profileAtHandle"], $row["profileEmail"], $row["profileHash"], $row["profilePhone"], $row["profileSalt"]);
				}
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return ($profile);
		}
/**
 * gets the Profile by at handle
 *
 * @param \PDO $pdo PDO connection object
 * @param string $profileAtHandle at handle to search for
 * @return \SPLFixedArray of all profiles found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 **/
	public static function getProfileByProfileAtHandle(\PDO $pdo, string $profileAtHandle) : \SPLFixedArray {
			// sanitize the at handle before searching
			$profileAtHandle = trim($profileAtHandle);
			$profileAtHandle = filter_var($profileAtHandle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($profileAtHandle) === true) {
				throw(new \PDOException("not a valid at handle"));
			}
			// create query template
			$query = "SELECT  profileId, profileActivationToken, profileAtHandle, profileEmail, profileHash, profilePhone, profileSalt FROM profile WHERE profileAtHandle = :profileAtHandle";
			$statement = $pdo->prepare($query);
			// bind the profile at handle to the place holder in the template
			$parameters = ["profileAtHandle" => $profileAtHandle];
			$statement->execute($parameters);
			$profiles = new \SPLFixedArray($statement->rowCount());
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			while (($row = $statement->fetch()) !== false) {
				try {
					$profile = new Profile($row["profileId"], $row["profileActivationToken"], $row["profileAtHandle"], $row["profileEmail"], $row["profileHash"], $row["profilePhone"], $row["profileSalt"]);
					$profiles[$profiles->key()] = $profile;
					$profiles->next();
				} catch(\Exception $exception) {
					// if the row couldn't be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
				}
			}
			return ($profiles);
		}
/**
 * get the profile by profile activation token
 *
 * @param string $profileActivationToken
 * @param \PDO object $pdo
 * @return Profile|null Profile or null if not found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 **/
		public
		static function getProfileByProfileActivationToken(\PDO $pdo, string $profileActivationToken) : ?Profile {
			//make sure activation token is in the right format and that it is a string representation of a hexadecimal
			$profileActivationToken = trim($profileActivationToken);
			if(ctype_xdigit($profileActivationToken) === false) {
				throw(new \InvalidArgumentException("profile activation token is empty or in the wrong format"));
			}
			//create the query template
			$query = "SELECT  profileId, profileActivationToken, profileAtHandle, profileEmail, profileHash, profilePhone, profileSalt FROM profile WHERE profileActivationToken = :profileActivationToken";
			$statement = $pdo->prepare($query);
			// bind the profile activation token to the placeholder in the template
			$parameters = ["profileActivationToken" => $profileActivationToken];
			$statement->execute($parameters);
			// grab the Profile from mySQL
			try {
				$profile = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $statement->fetch();
				if($row !== false) {
					$profile = new Profile($row["profileId"], $row["profileActivationToken"], $row["profileAtHandle"], $row["profileEmail"], $row["profileHash"], $row["profilePhone"], $row["profileSalt"]);
				}
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return ($profile);
		}

/**
 * formats the state variables for JSON serialization
 *
 * @return array resulting state variables to serialize
 **/
		public
		function jsonSerialize() {
			return (get_object_vars($this));
		}
	}









































		} // this closes the class Profile




<?php
require_once("autoload.php");

class favorite implements \JsonSerializable {
	use validateDate;


	/**
	 * @var int $favoriteProfileId
	 **/
	private $favoriteProfileId;


	/**
	 * @var int $favoriteProductId
	 **/

	private $favoriteProductId;

	/**
	 * @var string $favoriteDate
	 **/
	private $favoriteDate;

	/**
	 * constructor for this favorite
	 *
	 * @param int|null $newfavoriteProfileId id of this product or null if a new productId
	 * @param int $newfavoriteProductId name of the  product that sent this product
	 * @param \DateTime|string|null $newfavoriteDate date and time Tweet was sent or null if set to current date and time
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newfavoriteProfileId, int $newfavoriteProductId, $newfavoriteDate = null) {
		// use the mutator methods to do the work for us!
		try {
			$this->setfavoriteProfileId($newfavoriteProfileId);
			$this->setfavoriteProductId($newfavoriteProductId);
			$this->setfavoriteDate($newfavoriteDate);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			// determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 * accessor method for profile id
	 *
	 * @return int value of profile id
	 **/
	public function getfavoriteProfileId() : int {
		return ($this->favoriteProfileId);
	}

	/**
	 * mutator
	 * @param int|null $newfavoriteProfileId new value of tweet
	 * @throws |RangeException if $favoriteProfileId is not positive
	 * @throws |TypeError if $favoriteProfileId is not an integer
	 **/
	public function setfavoriteProfileId(?int $newfavoriteProfileId): void {
		if($newfavoriteProfileId === null) {
			$this->favoriteProfileId = null;

			return;
		}

		if($newfavoriteProfileId <= 0) {
			throw(new\RangeException("favoriteProfile id is not positive"));
		}
		$this->favoriteProfileId = $newfavoriteProfileId;
	}

	/**
	 * accessor method for tweet id
	 *
	 * @return int value of tweet id
	 **/
	public function getfavoriteProductId() : int {
		return ($this->favoriteProductId);
	}
	/**
	 * mutator
	 * @param int|null $favoriteProductId new value of tweet
	 * @throws |RangeException if $favoriteProductId is not positive
	 * @throws |TypeError if $favoriteProductId is not an integer
	 **/
	public function set(?int $favoriteProductId): void {
		if($favoriteProductId === null) {
			$this->favoriteProductId = null;
			return;
		}
	}

	/**
	 * accessor
	 * @return \DateTime value of favoriteDate
	 **/
	public function getfavoriteDate(): \DateTime {
		return ($this->favoriteDate());
	}

	/**
	 * mutator method for favorite date
	 *
	 * @param \DateTime|string|null $newfavoriteDate like date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newfavoriteDate is not a valid object or string
	 * @throws \RangeException if $newfavoriteDate is a date that does not exist
	 **/
	public function setfavoriteDate($newfavoriteDate): void {
		// base case: if the date is null, use the current date and time
		if($newfavoriteDate === null) {
			$this->favoriteDate = new \DateTime();
			return;
		}
		// store the like date using the ValidateDate trait
		try {
			$newLikeDate = self::validateDateTime($newfavoriteDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->favoriteDate = $newfavoriteDate;
	}


/**
 * gets an array of favorites based on its date
 * (this is an optional get by method and has only been added for when specific edge cases arise in capstone projects)
 *
 * @param \PDO $pdo connection object
 * @param \DateTime $sunrisefavoriteDate beginning date to search for
 * @param \DateTime $sunsetfavoriteDate ending date to search for
 * @return \SplFixedArray of tweets found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 * @throws \InvalidArgumentException if either sun dates are in the wrong format
 */
public
function getfavoritebyfavoriteDate(\PDO $pdo, \DateTime $sunrisefavoriteDate, \DateTime $sunsetfavoriteDate): \SplFixedArray {
	//enforce both date are present
	if((empty ($sunrisefavoriteDate) === true) || (empty($sunsetfavoriteDate) === true)) {
		throw (new \InvalidArgumentException("dates are empty of insecure"));
	}
	try {
		$sunrisefavoriteDate = self::validateDateTime($sunrisefavoriteDate);
		$sunsetTweetDate = self::validateDateTime($sunsetfavoriteDate);
	} catch(\InvalidArgumentException | \RangeException $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	$query = "SELECT favoriteProductId, favoriteDate FROM favorite WHERE favorite.favoriteDate >= :sunrisefavoriteId AND favoriteDate <= :sunsetTweetDate";
	$statement = $pdo->prepare($query);
	$formattedSunriseDate = $sunrisefavoriteDate->format("Y-m-d H:i:s");
	$formattedSunsetDate = $sunsetfavoriteDate->format("Y-m-d H:i:s");
	$parameters = ["sunrisefavoriteDate" => $formattedSunriseDate, "sunsetfavoriteDate" => $formattedSunsetDate];
	$statement->execute($parameters);


	$favorite = new \SplFixedArray($statement->rowCount());
	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	while(($row = $statement->fetch()) !== false) {
		try {
			$favorite = new favorite($row["favorite"], $row["favoriteProfileId"], $row["favoriteProductId"], $row["favoriteDate"]);
			$favorite[$favorite->key()] = $favorite;
			$favorite->next();
		} catch(\Exception $exception) {
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}


		/**
		 * inserts this favorite into mySQL
		 *
		 * @param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 **/
		public
		function insert(\PDO $pdo): void {
			if($this->favoriteProfileId === null || $this->favoriteProductId === null) {
				throw(new \PDOException("not a valid favorite"));
			}

			$query = "INSERT INTO `favorite`(favoriteProfileId, favoriteProductId, favoriteDate) VALUES(:favoriteProfileId, :favoriteProductId, :favoriteDate)";
			$statement = $pdo->prepare($query);
			$formattedDate = $this->favoriteDate->format("Y-m-d H:i:s");
			$parameters = ["favoriteProfileId" => $this->favoriteProfileId, "favoriteProduct" => $this->favoriteProductId, "favoriteDate" => $formattedDate];
			$statement->execute($parameters);
		}



		/**
		 * deletes this favorite from mySQL
		 *
		 * @param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 **/
		public
		function delete(\PDO $pdo): void {
			if($this->favoriteProfileId === null || $this->favoriteProductId === null) {
				throw(new \PDOException("not a valid favorite"));
			}
			$query = "DELETE FROM `favorite` WHERE favoriteProfileId = :favoriteProfileId AND favoriteProductId = :favoriteProcuctId";
			$statement = $pdo->prepare($query);
			$parameters = ["favoriteProfileId" => $this->favoriteProfileId, "favoriteProductId" => $this->favoriteProductId];
			$statement->execute($parameters);
		}

		/**
		 * gets the Like by product id and profile id
		 *
		 * @param \PDO $pdo PDO connection object
		 * @param int $favoriteProfileId profile id to search for
		 * @param int $favoriteProductId tweet id to search for
		 * @return favorite|null Like found or null if not found
		 */
		public function getfavoriteByfavoriteProductIdAndfavoriteProfileId(\PDO $pdo, int $favoriteProfileId, int $favoriteProductId): ?favorite {
			// sanitize the tweet id and profile id before searching
			if($favoriteProfileId <= 0) {
				throw(new \PDOException("profile id is not positive"));
			}
			if($favoriteProductId <= 0) {
				throw(new \PDOException("product id is not positive"));
			}
			// create query template
			$query = "SELECT favoriteProfileId, favoriteProductId, favoriteDate FROM `favorite` WHERE favoriteProfileId = :favoriteProfileId AND favoriteProductId = :favoriteProductId";
			$statement = $pdo->prepare($query);
			$parameters = ["favoriteProfileId" => $favoriteProfileId, "favoriteProducttId" => $favoriteProductId];
			$statement->execute($parameters);

			try {
				$favorite = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $statement->fetch();
				if($row !== false) {
					$favorite = new favorite($row["favoriteProfileId"], $row["favoriteProducttId"], $row["favoriteDate"]);
				}
			} catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}

			/**
			 * accessor method for profile id
			 *
			 * @return int value of profile id
			 **/
			public function getfavoriteProfileId() : int {
				return ($this->favoriteProfileId);
			}


		/**
		 * gets the favorite by profile id
		 *
		 * @param \PDO $pdo PDO connection object
		 * @param int $favoriteProfileId profile id to search for
		 * @return \SplFixedArray SplFixedArray of Likes found or null if not found
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError when variables are not the correct data type
		 **/
		public function getfavoriteByfavoriteProfileId(\PDO $pdo, int $favoriteProfileId): \SPLFixedArray {
			// sanitize the profile id
			if($favoriteProfileId <= 0) {
				throw(new \PDOException("profile id is not positive"));
			}
			// create query template
			$query = "SELECT favoriteProfileId, favoriteProductId, favoriteDate FROM `favorite` WHERE favoriteProfileId = :favoriteProfileId";
			$statement = $pdo->prepare($query);
			$parameters = ["favoriteProfileId" => $favoriteProfileId];
			$statement->execute($parameters);
			$favorite = new \SplFixedArray($statement->rowCount());
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			while(($row = $statement->fetch()) !== false) {
				try {
					$favorites = new favorite($row["favoriteProfileId"], $row["favoriteProductId"], $row["favoriteDate"]);
					$favorites[$favorites->key()] = $favorite;
					$favorites->next();
				} catch(\Exception $exception) {
					// if the row couldn't be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
				}

				return ($favorite);}


			/**
			 * gets the Like by product id
			 *
			 * @param \PDO $pdo PDO connection object
			 * @param int $favoriteProductId product id to search for
			 * @return \SplFixedArray array of Likes found or null if not found
			 * @throws \PDOException when mySQL related errors occur
			 * @throws \TypeError when variables are not the correct data type
			 **/
			public
			function getfavoriteByfavoriteProductId(\PDO $pdo, int $favoriteProductId): \SplFixedArray {
				$favoriteProductId = filter_var($favoriteProductId, FILTER_VALIDATE_INT);
				if($favoriteProductId <= 0) {
					throw(new \PDOException("favorite id is not positive"));
				}
				// create query template
				$query = "SELECT favoriteProfileId, favoriteProductId, favoriteDate FROM `favorite` WHERE favoriteProductId = :favoriteProductId";
				$statement = $pdo->prepare($query);
				$parameters = ["favoriteProductId" => $favoriteProductId];
				$statement->execute($parameters);
				$favorites = new \SplFixedArray($statement->rowCount());
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				while(($row = $statement->fetch()) !== false) {
					try {
						$favorite = new Favorite($row["favoriteProfileId"], $row["favoriteProductId"], $row["FavoriteDate"]);
						$favorites[$favorites->key()] = $favorite;
						$favorites->next();
					} catch(\Exception $exception) {
						throw(new \PDOException($exception->getMessage(), 0, $exception));
					}

					return ($favorites);
				}


				/**
				 * formats the state variables for JSON serialization
				 *
				 * @return array resulting state variables to serialize
				 **/
				public
				function jsonSerialize() {
					$fields = get_object_vars($this);
					$fields["favoriteDate"] = round(floatval($this->favoriteDate->format("U.u")) * 1000);
					return ($fields);
				}




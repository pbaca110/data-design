<?php
require_once("autoload.php");

class favorite implements \JsonSerializable {

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
	 * accessor
	 * @return
	 **/
	public function getfavoriteProfileId(): void {
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
	 * accessor
	 * @return
	 **/
	public function getfavoriteProductId(): void {
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
	 * @return \DateTime value of favoriteProductdate
	 **/
	public
	function getfavoriteProductDate(): \DateTime {
		return ($this->favoriteProductDate);
	}
}

try {
	$newfavoriteProductDate = self::validDateTime($newfavoriteProductDate);
} catch(\InvalidArgumentException | \RangeException $exception) {
	$exceptionType = get_class($exception);
	throw(new $exceptionType($exception->getMessage(), 0, $exception));
}
$this->$newfavoriteProductDate = $newfavoriteProductDate;

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
public
function __construct(?int $newfavoriteProfileId, ?int $newfavoriteProductId, string $newfavoriteProductId, $newfavoriteDate = null) {
	try {
		$this->setfavoriteProfileId($newfavoriteProfileId);
		$this->setfavoriteProductId($newfavoriteProductId);
		$this->setfavoriteDate($newfavoriteDate);
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
static function getfavoritebyfavoriteDate(\PDO $pdo, \DateTime $sunrisefavoriteDate, \DateTime $sunsetfavoriteDate): \SplFixedArray {
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
		if($this->favoriteProfileId === null || $this->favoritezproductId === null) {
			throw(new \PDOException("not a valid favorite"));
		}
		$query = "DELETE FROM `favorite` WHERE favoriteProfileId = :favoriteProfileId AND favoriteProductId = :favoriteProcuctId";
		$statement = $pdo->prepare($query);
		$parameters = ["favoriteProfileId" => $this->favoriteProfileId, "favoriteProductId" => $this->favoritezproductId];
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
	public
	static function getLikeByLikeTweetIdAndLikeProfileId(\PDO $pdo, int favoriteProfileId, int $favoriteProductId): ?favorite {
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
				$like = new favorite($row["favoriteProfileId"], $row["favoriteProducttId"], $row["favoriteDate"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($favorite);
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
	public
	static function getfavoriteByfavoriteProfileId(\PDO $pdo, int $favoriteProfileId): \SPLFixedArray {
		// sanitize the profile id
		if($favoriteProfileId <= 0) {
			throw(new \PDOException("profile id is not positive"));
		}
		// create query template
		$query = "SELECT favoriteProfileId, favoriteProducttId, favoriteDate FROM `favorite` WHERE favoriteProfileId = :favoriteProfileId";
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
		}
		return ($favorites);
	}

	/**
	 * gets the Like by product it id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $favoriteProductId product id to search for
	 * @return \SplFixedArray array of Likes found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public
	static function getfavoriteByfavoriteProductId(\PDO $pdo, int $favoriteProductId): \SplFixedArray {
		// sanitize the tweet id
		$favoriteProductId = filter_var($favoriteProductId, FILTER_VALIDATE_INT);
		if($favoriteProductId <= 0) {
			throw(new \PDOException("favorite id is not positive"));
		}
		// create query template
		$query = "SELECT favoriteProfileId, favoriteProducttId, favoriteDate FROM `favorite` WHERE favoriteProductId = :favoriteProductId";
		$statement = $pdo->prepare($query);
		$parameters = ["favoriteProductId" => $favoriteProductId];
		$statement->execute($parameters);
		$favorites = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$favorite = new Like($row["likeProfileId"], $row["likeTweetId"], $row["likeDate"]);
				$favorites[$favorites->key()] = $favorite;
				$favorites->next();
			} catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
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
}
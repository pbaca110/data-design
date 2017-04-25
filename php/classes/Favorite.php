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
 * gets the Tweet by profile id
 *
 * @param \PDO $pdo PDO connection object
 * @param int $tweetProfileId profile id to search by
 * @return \SplFixedArray SplFixedArray of Tweets found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 **/
public static function getfavoritebyfavoriteProfileId(\PDO $pdo, int $favoriteProfileId): \SPLFixedArray {
		// sanitize the profile id before searching
		if($favoriteProfileId <= 0) {
			throw(new \RangeException(" favorite profile id must be positive"));
		}
		$query = "SELECT favoriteProfileId, favoriteProductId, favoriteDate FROM favorite WHERE favoriteProfileId= :favoriteProfileId";
		$statement = $pdo->prepare($query);

		$parameters = ["favoriteProfileId" => $favoriteProfileId];
		$statement->execute($parameters);

		= $favoriteProfileId new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$favoriteProfileId = new favorite($row["favoriteProfileId"], $row["favoriteProductId"], $row["favoriteDate"]);
				$favoriteProfileId [$favoriteProfileId->key()] = $favoriteProfileId;
				$favoriteProfileId->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($favoriteProfileId);
	}
			}

/**
 * gets an array of tweets based on its date
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
	 * gets the Tweet by tweetId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $favoriteProductId tweet id to search for
	 * @return favorite|null favorite found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public
	static function getfavoritebyfavoriteProductId(\PDO $pdo, int $favoriteProductId): ?favorite {
		if($favoriteProductId <= 0) {
			throw(new \PDOException("tweet id is not positive"));
		}
		$query = "SELECT favoriteProductId, favoriteProfileId, favoriteDate, favoriteDate FROM favorite WHERE favoriteProductId = favoriteProductId";
		$statement = $pdo->prepare($query);
		$parameters = ["" => $favoriteProductId];
		$statement->execute($parameters);


		try {
			$favoriteProductId = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$favorite = new favorite($row["favoriteProductId"], $row["favoriteProfileId"], $row["favoriteDate"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($favorite);
	}

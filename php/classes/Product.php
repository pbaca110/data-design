<?php
require_once("autoload.php");

/**
 * write class docblock
 *
 **/
class Product implements \JsonSerializable {

	use ValidateDate;

	/**
	 * @var int $productId
	 **/
	private $productId;

	/**
	 * @var string $productName
	 **/
	private $productName;

	/**
	 * @var string $productPrice
	 **/
	private $productPrice;

	/**
	 * @var string $productDescription
	 **/
	private $productDescription;

	/**
	 * @var DateTime $productDate
	 **/
	private $productDate;

	/**
	 * constructor for this Tweet
	 *
	 * @param int|null $newProductId id of this product or null if a new productId
	 * @param string $newproductName name of the  product that sent this product
	 * @param string $newProductDescription string containing actual product data
	 * @param \DateTime|string|null $newProductDate date and time Tweet was sent or null if set to current date and time
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(?int $newProductId, string $newProductName, string $newProductDescription, $newProductDate = null) {
		try {
			$this->setproductId($newProductId);
			$this->setproductName($newProductName);
			$this->setproductDescription($newProductDescription);
			$this->setproductDate($newProductDate);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(),0, $exception));
		}
	}

	/**
	 * accessor
	 * @return
	 **/
	public function getproductId(): ?int {
		return ($this->productId);
	}

	/**
	 * mutator
	 * @param int|null $productId new value of tweet
	 * @throws |RangeException if $newproductId is not positive
	 * @throws |TypeError if $newproductId is not an integer
	 **/
	public function setProductId(?int $newProductId): void {
		if($newProductId === null) {
			$this->productId = null;
			return;
		}

		if($newProductId <= 0) {
			throw(new\RangeException("product id is not positive"));
		}
		$this->profileId = $newProductId;
	}

	/**
	 * accessor
	 * @return \DateTime value of product date
	 **/
	public function getProductDate(): \DateTime {
		return ($this->productDate);
	}

	/**
	 * @param |DateTime|string|null $newproductDate product date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newproductDate is not a valid object or string
	 * @throws \RangeException if $productDate is a date that does not exist
	 **/
	public function setProductDate($newProductDate = null): void {
		if($newProductDate === null) {
			$this->productDate = new \DateTime();
			return;
		}
		try {
			$newproductDate = self::validateDateTime($newProductDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->productDate = $newproductDate;
	}

	/**
	 * accessor
	 * @return
	 */
	public function getproductDescription(): string {
		return ($this->productDescription);
	}

	/**
	 * mutator
	 * @param |DateTime|string|null $newproductDescription product date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newproductDescription is not a valid object or string
	 * @throws \RangeException if $productDescription is a date that does not exist
	 **/
	public function setproductDescription(string $newproductDescription): void {
		$newproductDescription = trim($newproductDescription);
		$newproductDescription = filter_var($newproductDescription, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newproductDescription) === true) {
			throw(new \InvalidArgumentException("productDescription content is empty or insecure"));
		}
		if(strlen($newproductDescription) > 140) {
			throw(new \RangeException("productDescription content is too large"));
		}
		$this->productDescription = $newproductDescription;
	}

	/**
	 * accessor
	 * @return
	 **/
	public function getproductName(): string {
		return ($this->productName);
	}

	/**
	 *
	 **/
	public function setProductName(string $newproductName): void {
		$newproductName = trim($newproductName);
		$newproductName = filter_var($newproductName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		if(empty($newproductName) === true) {
			throw(new \InvalidArgumentException("productName content is empty or insecure"));
		}

		if(strlen($newproductName) > 140) {
			throw(new \RangeException("productName content is too large"));
		}
		$this->$newproductName = $newproductName;
	}

	/**
	 * gets the Product by productId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $productId tweet id to search for
	 * @return product|null Tweet found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public function getproductByproductId(\PDO $pdo, int $productId): ?Product {
		if($productId <= 0) {
			throw(new \PDOException("product id is not positive"));
		}
		$query = "SELECT productId, productName, productDescription, productDate FROM product WHERE productId = :productId";
		$statement = $pdo->prepare($query);
		$parameters = ["productId" => $productId];
		$statement->execute($parameters);
		try {
			$product = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$product = new product($row["productid"], $row["productName"], $row["productDescription"], $row["productDate"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($product);
	}


	/**
	 * inserts this product into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public
	function insert(\PDO $pdo): void {
		if($this->productId !== null) {
			throw(new \PDOException("not a new product"));
		}
		//
		$query = "INSERT INTO product(productId, productName, productDate,productDescription) VALUES(:productId,productName,productDescription,productDate)";
		$statement = $pdo->prepare($query);
		// bind the member r to the place holders in the template
		$formattedDate = $this->productDate->format("Y-m-d H:i:s");
		$parameters = ["productId" => $this->productId, "productDescription" => $this->productDescription, "favoriteDate" => $formattedDate];
		$statement->execute($parameters);
		// update the null tweetId with what mySQL just gave us
		$this->productId = intval($pdo->lastInsertId());
	}


	/**
	 * deletes this product from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public
	function delete(\PDO $pdo): void {
		if($this->prodctId === null) {
			throw(new \PDOException("unable to delete a product that does not exist"));
		}
		// create query template
		$query = "DELETE FROM product WHERE productId = :productId";
		$statement = $pdo->prepare($query);
		$parameters = ["productId" => $this->productId];
		$statement->execute($parameters);
	}

	/**
	 * updates this product in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo): void {
		if($this->productId === null) {
			throw(new \PDOException("unable to update a tweet that does not exist"));
		}
		$query = "UPDATE product SET productId = :productId, productDescription = :productDescription, productDate = :productDate WHERE productDate = :productId";
		$statement = $pdo->prepare($query);
		$formattedDate = $this->productDate->format("Y-m-d H:i:s");
		$parameters = ["productId" => $this->productId, "productDescription" => $this->productDescription, "productDate" => $formattedDate, "productId" => $this->productId];
		$statement->execute($parameters);
	}


	/**
	 * gets the product by description
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $productContent tweet content to search for
	 * @return \SplFixedArray SplFixedArray of Tweets found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getproductByproductDescription(\PDO $pdo, string $productDescription): \SPLFixedArray {
		$productDescription = trim($productDescription);
		$productDescription = filter_var($productDescription, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($productDescription) === true) {
			throw(new \PDOException("productDescription is invalid"));
		}
		$query = "SELECT productId, productName, ProductDescription, productdate FROM product WHERE product.productDescription LIKE :productDescription";
		$statement = $pdo->prepare($query);
		$productDescription = "%$productDescription%";
		$parameters = ["productDescription" => $productDescription];
		$statement->execute($parameters);
		$products = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$product = new product($row["productId"], $row["productName"], $row["productDescription"], $row["productDate"]);
				$products[$products->key()] = $product;
				$products->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return ($products);
		}
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		//format the date so that the front end can consume it
		$fields["productDate"] = round(floatval($this->productDate->format("U.u")) * 1000);
		return ($fields);

	}
}



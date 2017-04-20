<?php

class product implements \JsonSerializable {

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
	 * accessor
	 * @return
	 **/
	public function getproductId(): void {
		return ($this->productId);
	}

	/**
	 * mutator
	 * @param int|null $productId new value of tweet
	 * @throws |RangeException if $newproductId is not positive
	 * @throws |TypeError if $newproductId is not an integer
	 **/
	public function setproductId(?int $newproductId): void {
		if($newproductId === null) {
			$this->productId = null;
			return;
		}

		if($newproductId <= 0) {
			throw(new\RangeException("product id is not positive"));
		}
		$this->profileId = $newproductId;
	}

	/**
	 * accessor
	 * @return \DateTime value of product date
	 **/
	public
	function getproductDate(): \DateTime {
		return ($this->productDate);
	}

	/**
	 * @param |DateTime|string|null $newproductDate product date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newproductDate is not a valid object or string
	 * @throws \RangeException if $productDate is a date that does not exist
	 **/
	public
	function setproductDate($newproductDate = null): void {
		if($newproductDate === null) {
			$this->productDate = new \DateTime();
			return;
		}
		try {
			$newproductDate = self::validDateTime($newproductDate);
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
	public
	function getproductDescription(): string {
		return ($this->productDescription);
	}
	/**
	 * mutator
	 */
	/**@param |DateTime|string|null $newproductDescription product date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newproductDescription is not a valid object or string
	 * @throws \RangeException if $productDescription is a date that does not exist
	 **/
	public
	function setproductDescription(string $newproductDescription): void {
		{
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
	}

	/**
	 * accessor
	 * @return
	 */

	public
	function getproductName(): string {
		return ($this->productName);
	}


	public
	function setproductName(string $newproductName): void {
		{
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
	}
}






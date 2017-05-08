<?php

require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once("/etc/apache2/data-design-mysql/encrypted-config.php");
use Edu\Cnm\DataDesign\{
	product,
	Profile
};

/**
 * api for the product class
 **/
//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/");

	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$productProfileId = filter_input(INPUT_GET, "productProfileId", FILTER_VALIDATE_INT);
	$productDescription = filter_input(INPUT_GET, "productDescription", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	if($method === "GET") {
		setXsrfCookie();
		if(empty($id) === false) {
			$product = Product::getProducyByProductId($pdo, $id);
			if($product !== null) {
				$reply->data = $product;
			}
		} else if(empty($product) === false) {
			$product = Product::getProductByProductProfileId($pdo, $productProfileId)->toArray();
			if($product !== null) {
				$reply->data = $product;
			}
		} else if(empty($productDescription) === false) {
			$products = Product::getProductByProductContent($pdo, $productDescription)->toArray();
			if($products !== null) {
				$reply->data = $products;
			}
		} else {
			$products = Product::getAllproducts($pdo)->toArray();
			if($products !== null) {
				$reply->data = $products;
			}
		}
	} else if($method === "PUT" || $method === "POST") {
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);
		if(empty($requestObject->productDescription) === true) {
			throw(new \InvalidArgumentException ("No content for product.", 405));
		}
		if(empty($requestObject->productDate) === true) {
			$requestObject->productDate = null;
		}
		if(empty($requestObject->productProfileId) === true) {
			throw(new \InvalidArgumentException ("No Profile ID.", 405));
		}
		if($method === "PUT") {
			$product = Product::getProductByproductId($pdo, $id);
			if($product === null) {
				throw(new RuntimeException("product does not exist", 404));
			}
			if(empty($_SESSION["profile"]) === true || $_SESSION["profile"]->getProfileId() !== $product->getProductProfileId()) {
				throw(new \InvalidArgumentException("You are not allowed to edit this product", 403));
			}
			$product->setproductDate($requestObject->productDate);
			$product->setproductDescription($requestObject->productDescription);
			$product->update($pdo);
			$reply->message = "Product updated OK";
		} else if($method === "POST") {
			if(empty($_SESSION["profile"]) === true) {
				throw(new \InvalidArgumentException("you must be logged in to post products", 403));
			}
			$product = new Product(null, $requestObject->productProfileId, $requestObject->productDescription, null);
			$product->insert($pdo);
			$reply->message = "Product created OK";
		}
	} else if($method === "DELETE") {
		verifyXsrf();
		$product = Product::getProductByProductId($pdo, $id);
		if($product === null) {
			throw(new RuntimeException("Product does not exist", 404));
		}
		if(empty($_SESSION["profile"]) === true || $_SESSION["profile"]->getProfileId() !== $product->getProductProfileId()) {
			throw(new \InvalidArgumentException("You are not allowed to delete this product", 403));
		}
		$product->delete($pdo);
		$reply->message = "Product deleted OK";
	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}
} catch(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);
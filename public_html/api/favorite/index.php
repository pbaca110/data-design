<?php

require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once("/etc/apache2/data-design-mysql/encrypted-config.php");
use Edu\Cnm\DataDesign\{
	Profile,
	favorite
};

/**
 * Api for favorite class
 *
 *
 **/
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/");
	$_SESSION["profile"] = Profile::getProfileByProfileId($pdo, 732);
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];
	var_dump($method);
	$favoriteProfileId = filter_input(INPUT_GET, "favoriteProfileId", FILTER_VALIDATE_INT);
	$favoriteProductId = filter_input(INPUT_GET, "favoriteProductId", FILTER_VALIDATE_INT);
	var_dump($favoriteProfileId);
	var_dump($favoriteProductId);
	if($method === "GET") {
		setXsrfCookie();
		if($favoriteProfileId !== null && $favoriteProductId !== null) {
			$favorite = Favorite::getFavoriteByFavoriteProductIdAndFavoriteProfileId($pdo, $favoriteProfileId, $favoriteProductId);
			if($favorite !== null) {
				$reply->data = $favorite;
			}
		} else if(empty($favoriteProfileId) === false) {
			$like = Favorite::getFavoriteByFavoriteProfileId($pdo, $favoriteProfileId)->toArray();
			if($favorite !== null) {
				$reply->data = $favorite;
			}
		} else if(empty($favoriteProductId) === false) {
			$like = Favorite::getFavoriteByFavoriteProductId($pdo, $favoriteProductId)->toArray();
			if($favorite !== null) {
				$reply->data = $favorite;
			}
		} else {
			throw new InvalidArgumentException("incorrect search parameters ", 404);
		}
	} else if($method === "POST" || $method === "PUT") {
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);
		if(empty($requestObject->favoriteProfileId) === true) {
			throw (new \InvalidArgumentException("No Profile linked to the Like", 405));
		}
		if(empty($requestObject->favoriteProductId) === true) {
			throw (new \InvalidArgumentException("No product linked to the Like", 405));
		}
		if(empty($requestObject->favoriteDate) === true) {
			$requestObject->favoriteDate = null;
		}
		if($method === "POST") {
			if(empty($_SESSION["profile"]) === true) {
				throw(new \InvalidArgumentException("you must be logged in too like posts", 403));
			}
			$favorite = new Favorite($requestObject->favoriteProfileId, $requestObject->favoriteProductId, $requestObject->favoriteDate);
			$favorite->insert($pdo);
			$reply->message = "liked product successful";
		} else if($method === "PUT") {
			verifyXsrf();
			$favorite = Favorite::getFavoriteByFavoriteProductIdAndFavoriteProfileId($pdo, $requestObject->favoriteProfileId, $requestObject->favoriteProductId);
			if($favorite === null) {
				throw (new RuntimeException("favorite does not exist"));
			}
			if(empty($_SESSION["profile"]) === true || $_SESSION["profile"]->getProfileId() !== $like->getFavoriteProfileId()) {
				throw(new \InvalidArgumentException("You are not allowed to delete this favorite", 403));
			}
			$favorite->delete($pdo);
			$reply->message = "favorite successfully deleted";
		}
	} else {
		throw new \InvalidArgumentException("invalid http request", 400);
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
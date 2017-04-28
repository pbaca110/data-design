<?php
namespace Edu\Cnm\DataDesign\ApiTest;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJarInterface;
use PHPUnit\Framework\TestCase;
// grab the encrypted properties file
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once(dirname(__DIR__, 3) . "/vendor/autoload.php");
/**
 * Abstract base class for all API tests
 *
 * this class sets up guzzle and grabs the XSRF token to authenticate requests
 *
 * @package Edu\Cnm\DataDesign\ApiTest
 **/
abstract class DataDesignApiTest extends TestCase {
	/**
	 * cookie jar for guzzle
	 * @var CookieJarInterface $cookieJar
	 **/
	protected $cookieJar = null;
	/**
	 * guzzle HTTP client
	 * @var Client $guzzle
	 **/
	protected $guzzle = null;
	/**
	 * XSRF token for non-GET requests
	 * @var string $xsrfToken
	 **/
	protected $xsrfToken = "";
	/**
	 * helper method to expunge the database in setup and tear down
	 **/
	public final function expungeTables() {
		$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddctwitter.ini");
		$tables = ["like", "tweet", "profile"];
		foreach($tables as $table) {
			$pdo->query("DELETE FROM `$table`");
		}
	}
	/**
	 * setup method that grabs the XSRF token and puts in the cookie jar
	 **/
	public function setUp() {
		$this->expungeTables();
		// get an XSRF token by visiting the main site
		$this->guzzle = new Client(["cookies" => true]);
		$this->guzzle->get("https://bootcamp-coders.cnm.edu/");
		// get the XSRF cookie - this can be simplified once my pull request is published in Guzzle 6.3
		// @see https://github.com/guzzle/guzzle/pull/1318
		$this->cookieJar = $this->guzzle->getConfig("cookies");
		$cookieArray = $this->cookieJar->toArray();
		foreach($cookieArray as $cookie) {
			if(strcasecmp($cookie["Name"], "XSRF-TOKEN") === 0) {
				$this->xsrfToken = $cookie["Value"];
				break;
			}
		}
	}
	/**
	 * tear down method to expunge tables
	 **/
	public final function tearDown() {
		$this->expungeTables();
	}
}
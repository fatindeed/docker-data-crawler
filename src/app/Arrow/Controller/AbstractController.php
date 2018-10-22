<?php

namespace App\Arrow\Controller;

use App\Core\DB;
use App\Core\HttpClient;

class AbstractController {

	protected $client;
	protected $cookie_jar;

	public function __construct($otpions = []) {
		// init database
		if($otpions['fresh_db']) {
			@unlink('data/demo.db');
		}
		DB::getInstance()->connect('data/demo.db')->exec(file_get_contents('data/arrow.sql'));
		HttpClient::getInstance()->init('https://www.arrow.com');
	}

	// public static function mkdir($dir) {
	// 	if(!file_exists($dir)) {
	// 		return mkdir($dir, 0777, true);
	// 	}
	// 	else {
	// 		return true;
	// 	}
	// }

}
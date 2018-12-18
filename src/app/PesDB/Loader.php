<?php

namespace App\PesDB;

class Loader extends \App\Core\Loader {

	protected static $action_mapper = [
		'init' => [__NAMESPACE__.'\\Controller\\Main', 'index'],
	];

	public function __construct($otpions) {
		// init database
		if($otpions['fresh_db']) {
			@unlink('data/pes2019.db');
		}
		\App\Core\DB::getInstance()->connect('data/pes2019.db')->exec(file_get_contents('data/pes2019.sql'));
		\App\Core\HttpClient::getInstance()->init('http://pesdb.net');
	}

}
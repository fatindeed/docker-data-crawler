<?php

namespace App\Arrow;

class Loader extends \App\Core\Loader {

	protected static $action_mapper = [
		'initAllCategory' => [__NAMESPACE__.'\\Controller\\Category', 'getAll'],
		'initProductByManu' => [__NAMESPACE__.'\\Controller\\Product', 'getByManufacturer'],
		'initProductByManuCat' => [__NAMESPACE__.'\\Controller\\Product', 'getByManufacturerCategory'],
		'initProductByManuPL' => [__NAMESPACE__.'\\Controller\\Product', 'getByManufacturerProductLine'],
		'initProductByPL' => [__NAMESPACE__.'\\Controller\\Product', 'getByProductLine'],
		// 'initProduct' => ['Product', 'get'],
		'dumpTxCloudJson' => [__NAMESPACE__.'\\Controller\\Dumper', 'txCloudJson'],
		'dumpLogo' => [__NAMESPACE__.'\\Controller\\Dumper', 'logo'],
	];

	public function __construct($otpions) {
		// init database
		if($otpions['fresh_db']) {
			@unlink('data/demo.db');
		}
		DB::getInstance()->connect('data/demo.db')->exec(file_get_contents('data/arrow.sql'));
		HttpClient::getInstance()->init('https://www.arrow.com');
		$this->otpions = $otpions;
	}

}
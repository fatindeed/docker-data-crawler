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

}
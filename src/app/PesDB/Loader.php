<?php

namespace App\PesDB;

class Loader extends \App\Core\Loader {

	protected static $action_mapper = [
		'init' => [__NAMESPACE__.'\\Controller\\Main', 'index'],
	];

}
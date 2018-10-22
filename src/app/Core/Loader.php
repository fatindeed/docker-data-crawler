<?php

namespace App\Core;

class Loader {

	protected static $action_mapper;

	private $params;

	public function __construct($params) {
		$this->params = $params;
	}

	public function __call($name, $arguments)  {
		if(!isset(static::$action_mapper[$name])) {
			trigger_error('Invalid action - '.$name.PHP_EOL, E_USER_ERROR);
		}
		list($class, $method) = static::$action_mapper[$name];
		$instance = new $class($this->params);
		return call_user_func_array([$instance, $method], $arguments);
	}

}
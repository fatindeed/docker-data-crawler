<?php

namespace App\PesDB\Model;

class Club extends \App\Core\AbstractModel {

	const TABLE_NAME = 'clubs';
	const UNIQUE_KEY = 'ori_name';

	protected static $first;
	protected static $upsert;

	protected $_hidden_fields = [];

	public static function newInstance($data) {
		$fields['name'] = $data[0];
		$fields['ori_name'] = $data[0];
		$fields['league'] = $data[1];
		return parent::firstOrCreate($fields);
	}

}
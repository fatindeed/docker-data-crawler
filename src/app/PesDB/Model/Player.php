<?php

namespace App\PesDB\Model;

class Player extends \App\Core\AbstractModel {

	const TABLE_NAME = 'players';
	const UNIQUE_KEY = 'id';

	protected static $first;
	protected static $upsert;

	protected $_hidden_fields = [];

	public static function newInstance($data) {
		$fields['id'] = $data[0];
		$fields['player_name'] = $data[1];
		$fields['squad_number'] = $data[2];
		$fields['team_name'] = html_entity_decode($data[3]);
		$fields['league'] = html_entity_decode($data[4]);
		$fields['nationality'] = html_entity_decode($data[5]);
		$fields['region'] = html_entity_decode($data[6]);
		$fields['height'] = $data[7];
		$fields['weight'] = $data[8];
		$fields['age'] = $data[9];
		$fields['foot'] = substr($data[10], 0, 1);
		$fields['condition'] = $data[11];
		$fields['position'] = $data[12];
		$fields['playing_styles'] = $data[13];
		return parent::firstOrCreate($fields);
	}

}
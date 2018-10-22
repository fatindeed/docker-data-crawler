<?php

namespace App\PesDB\Model;

class PlayerAbility extends \App\Core\AbstractModel {

	const TABLE_NAME = 'player_abilities';
	const UNIQUE_KEY = 'player_id';

	protected static $first;
	protected static $upsert;

	protected $_hidden_fields = [];

	public static function newInstance($data) {
		$fields['player_id'] = $data[0];
		$fields['attacking_prowess'] = $data[1];
		$fields['ball_control'] = $data[2];
		$fields['dribbling'] = $data[3];
		$fields['low_pass'] = $data[4];
		$fields['lofted_pass'] = $data[5];
		$fields['finishing'] = $data[6];
		$fields['place_kicking'] = $data[7];
		$fields['swerve'] = $data[8];
		$fields['header'] = $data[9];
		$fields['defensive_prowess'] = $data[10];
		$fields['ball_winning'] = $data[11];
		$fields['kicking_power'] = $data[12];
		$fields['speed'] = $data[13];
		$fields['explosive_power'] = $data[14];
		$fields['body_control'] = $data[15];
		$fields['physical_contact'] = $data[16];
		$fields['jump'] = $data[17];
		$fields['stamina'] = $data[18];
		$fields['goalkeeping'] = $data[19];
		$fields['catching'] = $data[20];
		$fields['clearing'] = $data[21];
		$fields['reflexes'] = $data[22];
		$fields['coverage'] = $data[23];
		$fields['overall_rating'] = $data[24];
		$fields['lvup_data'] = $data[25];
		return parent::firstOrCreate($fields);
	}

}
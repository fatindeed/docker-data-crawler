<?php

namespace App\PesDB\Controller;

use App\Core\DB;
use App\Core\HttpClient;
use App\Core\SignalHandler;
use App\PesDB\Model\Club;
use App\PesDB\Model\Player;
use App\PesDB\Model\PlayerAbility;

class Main {

	const REQUEST_CD = 5;

	private static $check;

	public function __construct($otpions = []) {
		$this->check = DB::getInstance()->prepare('SELECT count(*) FROM players WHERE id = ?;');
	}

	public function index() {
		$page = file_get_contents('data/page.txt');
		if(empty($page) || !is_numeric($page) || $page <= 0) {
			$page = 1;
		}
		do {
			try {
				SignalHandler::dispatch();
				$response = HttpClient::getInstance()->request('/pes2018/?page='.$page);
				sleep(self::REQUEST_CD);
				if(!preg_match('|<div class="pages">.*<a href="\./\?page=\d+".*>(\d+)</a>\..*</div>|isU', $response, $match_page)) {
					throw new \RuntimeException('page no not found.', 1);
				}
				$lastpage = intval($match_page[1]);
				if(!preg_match('|<table class="players">(.*)</table>|isU', $response, $match_table)) {
					throw new \RuntimeException('players table not found.', 1);
				}
				if(!preg_match_all('|<tr>.*<a href="\./\?id=(\d+)">.*</tr>|isU', $match_table[1], $match_rows)) {
					throw new \RuntimeException('players rows not found.', 1);
				}
				foreach($match_rows[1] as $id) {
					SignalHandler::dispatch();
					$this->get_player($id);
				}
				echo 'page '.$page++.' / '.$lastpage.' done.'.PHP_EOL;
				file_put_contents('data/page.txt', $page);
			}
			catch(\GuzzleHttp\Exception\ConnectException $e) {
				$handlerContext = $e->getHandlerContext();
				// Connection timed out / Operation timed out
				if($handlerContext['errno'] == 28) {
					fwrite(STDERR, $handlerContext['error'].PHP_EOL);
					sleep(self::REQUEST_CD);
				}
				// Connection refused
				else if($handlerContext['errno'] == 7) {
					fwrite(STDERR, $handlerContext['error'].PHP_EOL);
					sleep(60);
				}
				else {
					fwrite(STDERR, $handlerContext['error'].PHP_EOL);
					exit();
				}
			}
			catch(\GuzzleHttp\Exception\ClientException $e) {
				fwrite(STDERR, $e->getMessage().PHP_EOL);
				sleep(300);
			}
		}
		while($page < $lastpage);
	}

	// http://pesdb.net/pes2019/images/players/33237.png
	private function get_player($id) {
		$this->check->execute([$id]);
		if($this->check->fetchColumn() > 0) return true;
		$response = HttpClient::getInstance()->request('/pes2018/?id='.$id);
		if(!preg_match('|<table id="table_0" class="player" style="display: table; clear: both;">(.*)</table>|isU', $response, $match_info)) {
			throw new \RuntimeException('player info table not found.', 1);
		}
		if(!preg_match_all('|</th><td.*>(.*)</td></tr>|isU', $match_info[1], $match_data)) {
			throw new \RuntimeException('player info rows not found.', 1);
		}
		$data = array_map('strip_tags', $match_data[1]);
		array_unshift($data, $id);
		if(count($data) == 12) {
			array_splice($data, 2, 0, [NULL]);
		}
		else {
			Club::newInstance([$data[3], $data[4]]);
		}
		if(!preg_match('|<script>abilities =(.*);</script>|isU', $response, $match_abilities)) {
			throw new \RuntimeException('abilities data not found.', 1);
		}
		$abilities = json_decode(trim($match_abilities[1]));
		$ability_data = array_map(array('self', 'get_lv30_value'), $abilities);
		array_unshift($ability_data, $id);
		$ability_data[] = json_encode($abilities);
		if(!preg_match('|<table class="playing_styles">(.*)</table>|isU', $response, $match_playing_styles)) {
			throw new \RuntimeException('playing style table not found.', 1);
		}
		if(!preg_match_all('|<tr>(.*)</tr>|isU', $match_playing_styles[1], $match_lines)) {
			throw new \RuntimeException('players style rows not found.', 1);
		}
		$playing_styles = [];
		$category = '';
		foreach($match_lines[1] as $match_line) {
			if(substr($match_line, 0, 4) == '<th>') {
				$category = strip_tags($match_line);
			}
			else {
				$playing_styles[$category][] = strip_tags($match_line);
			}
		}
		$data[] = json_encode($playing_styles);
		Player::newInstance($data);
		PlayerAbility::newInstance($ability_data);
		sleep(self::REQUEST_CD);
	}

	private static function get_lv30_value($value) {
		return $value[29];
	}

}
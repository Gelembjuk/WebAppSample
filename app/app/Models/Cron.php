<?php

namespace app\Models;

//use Guzzle\Http\Client;
// php cron.php "int_api_key=internalapikey&do=hourly"

class Cron extends \Gelembjuk\WebApp\Model {
	public function test() {
		$this->debug('test cron in model');
		
	}

}

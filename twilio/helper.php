<?php defined('SYSPATH') or die('No direct access allowed.');

class TwilioHelper {

	public static function factory() {

		$config = Kohana::$config->load('twilio');

		return new Services_Twilio($config['accountSID'], $config['authToken']);
	}

	public static function number() {
		$config = Kohana::$config->load('twilio');
		return $config->number;
	}

}
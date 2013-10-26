<?php namespace Services\Flightstat;

use Guzzle\Http\Client;

abstract class FlightstatApi
{
	private $client;
	private $config;
	private $type;

	public function __contruct($type) {
		$this->type = $type;
		$this->initialize();
	}

	public function initialize() {
		$this->config = array(
      'appId' => 'bf28d4a0',
      'appKey' => 'a7ca1c2a0eab46e9d097f4aa39168ac7',
    );
		$this->client = new Client('https://api.flightstats.com/flex/'.$this->type.'/rest/v2/json/');
	}

	public function api_call($function) {
		$request = $this->client->get($function, $this->config);
		$response = $request->send();

		return json_decode (json_encode ($response->json()), FALSE);
	}
}

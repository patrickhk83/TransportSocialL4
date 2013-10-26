<?php

class Flight extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function api_call($function) {
		$config = array(
      'appId' => 'bf28d4a0',
      'appKey' => 'a7ca1c2a0eab46e9d097f4aa39168ac7',
    );
		$client = new Client('https://api.flightstats.com/flex/flightstatus/rest/v2/json/');
		$request = $client->get('airport/status/ABQ/dep/2013/10/27/12', $config);
		$response = $request->send();
		$data = json_decode (json_encode ($response->json()), FALSE);
	}
}

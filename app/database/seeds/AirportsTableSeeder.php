<?php

class AirportsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('airports')->delete();
		DB::disableQueryLog();
		$airports = file_get_contents(__DIR__.'/json/airports.json');
		$airports = json_decode($airports);
		foreach($airports as $airport) {
			if(isset($airport->Name)) {
				$seed = array (
					'city' => $airport->City,
					'country_code' => $airport->CountryCode,
					'iata' => isset($airport->IATACode) ? $airport->IATACode : null,
					'icao' => isset($airport->ICAOCode) ? $airport->ICAOCode : null,
					'name' => $airport->Name,
					'latitude' => $airport->Latitude,
					'longitude' => $airport->Longitude,
					'airport_code' => $airport->AirportCode
				);
				DB::table('airports')->insert($seed);
			}
		}
	}

}

<?php

class AirportsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('airports')->truncate();
		DB::disableQueryLog();
		$airports = file_get_contents(__DIR__.'/json/airports.json');
		$airports = json_decode($airports);
		foreach($airports as $airport) {
			$seed = array (
				'city' => $airport->city,
				'country' => $airport->country,
				'dst' => $airport->dst,
				'elevation' => $airport->elevation,
				'iata' => $airport->iata,
				'icao' => $airport->icao,
				'name' => $airport->name,
				'x' => $airport->x,
				'y' => $airport->y,
				'timezone' => $airport->timezone
			);
			DB::table('airports')->insert($seed);
		}
	}

}

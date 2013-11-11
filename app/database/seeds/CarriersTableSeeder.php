<?php

class CarriersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('carriers')->delete();
		DB::disableQueryLog();
		$airlines = file_get_contents(__DIR__.'/json/airlines.json');
		$airlines = json_decode($airlines);
		foreach($airlines as $airline) {
			$seed = array(
				'name' => $airline->Name,
				'iata' => isset($airline->IATACode) ? $airline->IATACode : null,
				'icao' => isset($airline->ICAOCode) ? $airline->ICAOCode : null,
				'airline_code' => $airline->AirlineCode
			);
			DB::table('carriers')->insert($seed);
		}
	}

}

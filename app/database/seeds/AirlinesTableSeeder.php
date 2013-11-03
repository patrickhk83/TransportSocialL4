<?php

class AirlinesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('airlines')->truncate();
		DB::disableQueryLog();
		$airlines = file_get_contents(__DIR__.'/json/airlines.json');
		$airlines = json_decode($airlines);
		foreach($airlines as $airline) {
			$seed = array(
				'active' => $airline->active,
				'mode' => $airline->mode,
				'name' => $airline->name,
				'icao' => $airline->icao,
				'callsign' => $airline->callsign,
				'country' => $airline->country,
				'alias' => $airline->alias
			);
			DB::table('airlines')->insert($seed);
		}
	}

}

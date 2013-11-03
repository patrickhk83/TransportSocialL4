<?php

class CountriesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('countries')->truncate();
		DB::disableQueryLog();
		$countries = file_get_contents(__DIR__.'/json/countries.json');
		$countries = json_decode($countries);
		foreach($countries as $country) {
			$seed = array (
				'name' => $country->name,
				'code' => $country->code
			);
			DB::table('countries')->insert($seed);
		}
	}

}

<?php

use Illuminate\Database\Seeder;

class SourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sources')->insert([
	        [
				'source_name' => 'Polygon',
				'source_domain' => 'polygon.com',
				'source_main_url' => 'https://www.polygon.com/',
				'aggregator' => 0

	        ],
	        [
				'source_name' => 'Rock Paper Shotgun',
				'source_domain' => 'rockpapershotgun.com',
				'source_main_url' => 'https://www.rockpapershotgun.com/',
				'aggregator' => 0

	        ],

	        [
				'source_name' => 'PC Gamer',
				'source_domain' => 'pcgamer.com',
				'source_main_url' => 'https://www.pcgamer.com/',
				'aggregator' => 0

	        ],
	        [
				'source_name' => 'The Next Web',
				'source_domain' => 'thenextweb.com',
				'source_main_url' => 'https://thenextweb.com/latest/',
				'aggregator' => 0

	        ],
	        [
				'source_name' => 'CBC',
				'source_domain' => 'cbc.ca',
				'source_main_url' => 'http://www.cbc.ca/news',
				'aggregator' => 0
	        ],
	        [
				'source_name' => 'BBC',
				'source_domain' => 'bbc.com',
				'source_main_url' => 'http://www.bbc.com/news',
				'aggregator' => 0
	        ],
	        [
				'source_name' => 'The Guardian',
				'source_domain' => 'theguardian.com',
				'source_main_url' => 'https://www.theguardian.com/international',
				'aggregator' => 0
	        ]

    	]);


    }
}

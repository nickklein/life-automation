<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $insert = array();
        for ($i = 1; $i <= 7; $i++) {
        	$insert[] = array(
        		'user_id' => 1,
        		'source_id' => $i
        	);
        }
        DB::table('user_sources')->insert($insert);

        
    }
}

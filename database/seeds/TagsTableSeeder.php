<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tags = ["properties","servers","franchises","impressions","moves","Activisions","hits","features","games","genres","elements","boosts","ends","Specialists","abilities","weapons","newcomers","ropes","enemies","complexities","headshots","techniques","locations","ideas","corridors","zones","Points","rounds","spots","unlockables","models","skills","lots","questions","updates","ways","follow-ups","campaigns","characters","options","rules","whats","people","publishers","components","add-ons","signals","codes","ethics"];
        foreach($tags as $tag) {
        	 DB::table('tags')->insert(['tag_name' => $tag]);
        }
    }
}

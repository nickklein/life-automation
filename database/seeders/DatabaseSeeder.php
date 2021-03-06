<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(DeviceTableSeeder::class);
        $this->call(DeviceSettingsTableSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(UserSourcesTableSeeder::class);
        $this->call(UserTagsTableSeeder::class);
        $this->call(SourcesTableSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(ShoppingItemsSeeder::class);
        $this->call(ShoppingCategoriesSeeder::class);
        $this->call(ShoppingItemsCategorySeeder::class);
    }
}

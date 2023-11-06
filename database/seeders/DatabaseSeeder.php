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
        // \App\Models\User::factory(10)->create();

        $this->call([
            \Database\Seeders\AdminSeeder::class,
            \Database\Seeders\SettingSeoSeeder::class,
            \Database\Seeders\GallerysSeeder::class,
            \Database\Seeders\ContractSettingSeeder::class,
            \Database\Seeders\MarketSettingSeeder::class,
        ]);

    }
}

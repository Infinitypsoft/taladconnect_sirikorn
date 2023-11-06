<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('market_settings')->insert([
            'Latitude' => 14.522083,
            'Longtitude' => 100.919743,
            'Province' => 'Saraburi',
            'Amphoe' => 'เมืองสระบุรี',
            'distict' => 'ปากเพรียว',
            'Road' => 'มิตรภาพ',
            'Address' => '777',
            'Postal' => '18000',
            'Market_name' => 'ตลาดอิ่มเอม',
            'Owner_type' => 2,
            'Parking' => 300,
            'Business_time' => "2,3,4",
            'Business_day' => "1,2,3,4,5,6,7",
            'Product_type' => 3,
            'Selling_type' => 1,
            'Rental_type' => 2,
            'Space_Usage' => 268,
            'Total_Space' => 268,
            'Total_Shop' => 162,
            'Owner_name' => 'คุณสุวิทย์ เตียเจริญ',
            'Co-ordinator_name' => 'คุณสุวิทย์ เตียเจริญ',
            'Mobile_number' => '0805838888',
            'Website' => 'www.aimam-market.com',
            'Register_date' => now(),
            'Update_date' => now(),
        ]);

    }
}

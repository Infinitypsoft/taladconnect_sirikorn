<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->insert([
            'name' => "ipsoftadmin",
            'username' => "ipsoftadmin",
            'email' => "ipsoftadmin@gmail.com",
            'tel' => "0123456789",
            'position' => "-",
            'password' => Hash::make("123456"),
            'pic'=> 'adminpic.jpg',
            'pic_path'=> 'upload/images/admin/adminpic.jpg',
            'role'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        $data = [
            ['key' => 'current_session', 'value' => '2021-2022'],
            ['key' => 'school_title', 'value' => 'Nile'],
            ['key' => 'school_name', 'value' => 'Nile International School'],
            ['key' => 'end_first_term', 'value' => '01-12-2021'],
            ['key' => 'end_second_term', 'value' => '01-03-2022'],
            ['key' => 'phone', 'value' => '0123456789'],
            ['key' => 'address', 'value' => 'القاهرة'],
            ['key' => 'school_email', 'value' => 'mohisham1998@gmail.com'],
            ['key' => 'logo', 'value' => ''],
        ];

        DB::table('settings')->insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'firstname' => 'Richard',
            'lastname' => 'Fahrenheit',
            'birthdate' => date('Y-m-d H:i:s'),
            'reportsubject' => 'asdasasdasdasdasd',
            'country' => 'Zakovia',
            'phone' => '33333',
            'email' => 'uraina@gmail.com'
        ]);
    }
}

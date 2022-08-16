<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
        ]);
        DB::table('companies')->insert([
            'company_name' => 'company1',

        ]);
            DB::table('employees')->insert([
            'companies_id' => 1 ,
            'email' => 'admin@admin.com' ,
            'name' => 'admin',
            'password' => 'admin' ,
            'type' => 1 ,
            'adress' => '344 BD casa' ,
            'tel' => '0666666666',
            'born_date' =>'1990-03-03',

        ]);

    }
    
}

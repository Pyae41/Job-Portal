<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Company::create([
            'name' => 'Hi',
            'email' => 'hi@gmail.com',
            'phone' => '09888888888',
            'address' => 'Mahaaungmyay,Mandalay',
            'company_logo' => 'https://cdn.logo.com/hotlink-ok/logo-social.png',
        ]);
    }
}

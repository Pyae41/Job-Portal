<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $jobTypes = [
            [
                'job_type' => 'Part-time'
            ],
            [
                'job_type' => 'Full-time'
            ],
        ];

        foreach($jobTypes as $jobType){
            JobType::create($jobType);
        }
    }
}

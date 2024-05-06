<?php

namespace Database\Seeders;

use App\Models\JobPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        JobPost::create([
            'category_id' => 1,
            'location_id' => 1,
            'job_type_id' => 2,
            'company_id' => 1,
            'job_position' =>  'Backend Developer',
            'skill' => 'PHP,Laravel',
            'salary' => '500000 MMK',
            'deadline' => date('2023-05-18'),
            'description' => '<ul><li>Proven work experience as a Front-end developer</li><li>Hands on experience with markup languages</li><li>Experience with JavaScript, CSS and jQuery</li><li>Familiarity with browser testing and debugging</li><li>In-depth understanding of the entire web development process (design, development and deployment)</li><li>Understanding of layout aesthetics</li><li>Knowledge of SEO principles</li><li>Familiarity with software like Adobe Suite, Photoshop and content management systems</li><li>An ability to perform well in a fast-paced environment</li><li>Excellent analytical and multitasking skills</li><li>BSc degree in Computer Science or relevant field</li></ul>',
            'status' => 'Inactive',
        ]);
    }
}

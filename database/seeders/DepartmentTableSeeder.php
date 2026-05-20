<?php

namespace Database\Seeders;

use App\Enums\Department as DepartmentEnum;
use App\Models\Frontend\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'title' => 'Academic',
                'title_np' => 'शैक्षिक',
                'slug' => 'academic',
            ],
            [
                'title' => 'Admin',
                'title_np' => 'प्रशासन',
                'slug' => 'admin',
            ],
            [
                'title' => 'Account',
                'title_np' => 'लेखा',
                'slug' => 'account',
            ],
            [
                'title' => 'Examination',
                'title_np' => 'परीक्षा',
                'slug' => 'examination',
            ],
        ];

        Department::truncate();

        foreach ($departments as $index => $department) {

            Department::updateOrCreate(
                [
                    'slug' => $department['slug'],
                ],
                [
                    'title' => $department['title'],
                    'title_np' => $department['title_np'],
                    'order' => $index + 1,
                    'status' => true,
                ]
            );
        }
    }
}

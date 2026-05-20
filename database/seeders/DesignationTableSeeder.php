<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Designation;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [

            [
                'name' => 'Chairperson',
                'name_np' => 'अध्यक्ष',
                'slug' => 'chairperson',
            ],

            [
                'name' => 'Member Secretary',
                'name_np' => 'सदस्य सचिव',
                'slug' => 'member-secretary',
            ],

            [
                'name' => 'Member',
                'name_np' => 'सदस्य',
                'slug' => 'member',
            ],

            [
                'name' => 'Teacher Representative',
                'name_np' => 'शिक्षक प्रतिनिधि',
                'slug' => 'teacher-representative',
            ],

            [
                'name' => 'Local Government Representative',
                'name_np' => 'स्थानीय तह प्रतिनिधि',
                'slug' => 'local-government-representative',
            ],

            [
                'name' => 'Principal',
                'name_np' => 'प्रधानाध्यापक',
                'slug' => 'principal',
            ],

            [
                'name' => 'Head Teacher',
                'name_np' => 'मुख्य शिक्षक',
                'slug' => 'head-teacher',
            ],

            [
                'name' => 'Vice Principal',
                'name_np' => 'सहायक प्रधानाध्यापक',
                'slug' => 'vice-principal',
            ],

            [
                'name' => 'Assistant Head Teacher',
                'name_np' => 'सहायक मुख्य शिक्षक',
                'slug' => 'assistant-head-teacher',
            ],

            [
                'name' => 'Teacher',
                'name_np' => 'शिक्षक',
                'slug' => 'teacher',
            ],

            [
                'name' => 'Accountant',
                'name_np' => 'लेखापाल',
                'slug' => 'accountant',
            ],

            [
                'name' => 'Librarian',
                'name_np' => 'पुस्तकालयाध्यक्ष',
                'slug' => 'librarian',
            ],

            [
                'name' => 'School Nurse',
                'name_np' => 'विद्यालय नर्स',
                'slug' => 'school-nurse',
            ],

            [
                'name' => 'School Assistant',
                'name_np' => 'विद्यालय सहायक',
                'slug' => 'school-assistant',
            ],

            [
                'name' => 'Support Staff',
                'name_np' => 'सहयोगी कर्मचारी',
                'slug' => 'support-staff',
            ],

        ];

        Designation::truncate();

        foreach ($designations as $index => $designation) {

            Designation::updateOrCreate(
                [
                    'slug' => $designation['slug'],
                ],
                [
                    'name' => $designation['name'],
                    'name_np' => $designation['name_np'],
                    'order' => $index + 1,
                ]
            );
        }
    }
}

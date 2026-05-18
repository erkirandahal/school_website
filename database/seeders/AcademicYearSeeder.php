<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\DB;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $years = [
            [
                'year' => 2081
            ],
            [
                'year' => 2082
            ],
            [
                'year' => 2083
            ]

        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        AcademicYear::truncate();

        foreach ($years as $year) {
            AcademicYear::create($year);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

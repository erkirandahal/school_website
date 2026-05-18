<?php

namespace Database\Seeders;

use App\Enums\DocumentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentTypes = [
            [
                'title' => DocumentType::DOWNLOAD->title(),
                'title_ne' => "डाउनलोड",
                'order' => 0,
                'slug' => DocumentType::DOWNLOAD->slug(),
                'status' => 1
            ],
            [
                'title' => DocumentType::REPORT->title(),
                'title_ne' => 'प्रतिवेदन',
                'order' => 1,
                'slug' => DocumentType::REPORT->slug(),
                'status' => 1
            ],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('document_types')->truncate();
        foreach ($documentTypes as $type) {
            DB::table('document_types')->insert($type);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

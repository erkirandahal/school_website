<?php

namespace Database\Seeders;

use App\Models\Frontend\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostCategoryTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'title' => 'News and Events',
                'title_np' => 'समाचार तथा कार्यक्रम',
                'slug' => 'news-and-events',
            ],
            [
                'title' => 'Notice',
                'title_np' => 'सूचना',
                'slug' => 'notice',
            ],
            [
                'title' => 'Result',
                'title_np' => 'नतिजा',
                'slug' => 'result',
            ],
            [
                'title' => 'Career',
                'title_np' => 'रोजगार',
                'slug' => 'career',
            ],
            [
                'title' => 'Annual Calendar',
                'title_np' => 'वार्षिक पात्रो',
                'slug' => 'annual-calendar',
            ],
            [
                'title' => 'SMC Decision',
                'title_np' => 'विद्यालय व्यवस्थापन समितिको निर्णय',
                'slug' => 'smc-decision',
            ],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Remove all existing records
        PostCategory::truncate();

        foreach ($categories as $index => $category) {

            PostCategory::create([
                'title' => $category['title'],
                'title_np' => $category['title_np'],
                'slug' => $category['slug'],
                'order' => $index + 1,
                'status' => true,
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
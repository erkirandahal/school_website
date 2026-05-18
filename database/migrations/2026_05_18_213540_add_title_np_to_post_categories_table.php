<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleNpToPostCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('post_categories', function (Blueprint $table) {
            $table->string('title_np')->nullable()->after('title');
        });
    }

    public function down()
    {
        Schema::table('post_categories', function (Blueprint $table) {
            $table->dropColumn('title_np');
        });
    }
}
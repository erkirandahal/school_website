<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleNeToDocumentTypesTable extends Migration
{
    public function up()
    {
        Schema::table('document_types', function (Blueprint $table) {
            $table->string('title_ne')->nullable()->after('title');
        });
    }

    public function down()
    {
        Schema::table('document_types', function (Blueprint $table) {
            $table->dropColumn('title_ne');
        });
    }
}

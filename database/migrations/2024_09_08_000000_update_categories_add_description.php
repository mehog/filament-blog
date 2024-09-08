<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up()
    {
        // Update categories table to add description column
        Schema::table(config('filamentblog.tables.prefix').'categories', function (Blueprint $table) {
            $table->string('description', 1024)->nullable()->after('name');
        });
    }

    public function down()
    {
        // Drop the description column from categories table if it exists
        Schema::table(config('filamentblog.tables.prefix').'categories', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};

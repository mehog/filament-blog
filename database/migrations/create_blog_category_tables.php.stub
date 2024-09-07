<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up()
    {
        // Create the category_groups table
        if (!Schema::hasTable(config('filamentblog.tables.prefix').'category_groups')) {
            Schema::create(config('filamentblog.tables.prefix').'category_groups', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // Name of the group
                $table->timestamps();
            });
        }

        // Add group_id column to categories table if it does not exist
        if (!Schema::hasColumn(config('filamentblog.tables.prefix').'categories', 'group_id')) {
            Schema::table(config('filamentblog.tables.prefix').'categories', function (Blueprint $table) {
                $table->unsignedBigInteger('group_id')->nullable()->after('id');

                // Add foreign key constraint
                $table->foreign('group_id')
                    ->references('id')
                    ->on(config('filamentblog.tables.prefix').'category_groups')
                    ->onDelete('set null');
            });
        }
    }

    public function down()
    {
        // Drop the foreign key and group_id column from categories table if it exists
        if (Schema::hasColumn(config('filamentblog.tables.prefix').'categories', 'group_id')) {
            Schema::table(config('filamentblog.tables.prefix').'categories', function (Blueprint $table) {
                $table->dropForeign([config('filamentblog.tables.prefix').'categories_group_id_foreign']);
                $table->dropColumn('group_id');
            });
        }

        // Drop category_groups table if it exists
        if (Schema::hasTable(config('filamentblog.tables.prefix').'category_groups')) {
            Schema::dropIfExists(config('filamentblog.tables.prefix').'category_groups');
        }
    }
};

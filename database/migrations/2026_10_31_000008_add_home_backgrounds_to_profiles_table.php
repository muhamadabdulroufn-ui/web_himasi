<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHomeBackgroundsToProfilesTable extends Migration
{
    public function up()
    {
        $columns = [];

        foreach (['home_background_1', 'home_background_2', 'home_background_3'] as $column) {
            if (!Schema::hasColumn('profiles', $column)) {
                $columns[] = $column;
            }
        }

        if ($columns) {
            Schema::table('profiles', function (Blueprint $table) use ($columns) {
                foreach ($columns as $column) {
                    $table->string($column)->nullable();
                }
            });
        }
    }

    public function down()
    {
    }
}

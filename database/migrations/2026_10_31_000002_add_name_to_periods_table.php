<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddNameToPeriodsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('periods', 'name')) {
            Schema::table('periods', function (Blueprint $table) {
                $table->string('name')->default('');
            });
        }

        if (Schema::hasColumn('periods', 'year_period')) {
            DB::table('periods')
                ->where('name', '')
                ->update(['name' => DB::raw('year_period')]);
        }
    }

    public function down()
    {
        // Keep the column on rollback so period names are not lost.
    }
}

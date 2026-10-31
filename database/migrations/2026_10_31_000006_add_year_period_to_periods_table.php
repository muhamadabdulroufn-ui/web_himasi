<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddYearPeriodToPeriodsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('periods', 'year_period')) {
            Schema::table('periods', function (Blueprint $table) {
                $table->string('year_period', 50)->nullable();
            });
        }
    }

    public function down()
    {
    }
}

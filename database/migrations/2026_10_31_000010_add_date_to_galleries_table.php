<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateToGalleriesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('galleries', 'date')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->date('date')->nullable();
            });
        }
    }

    public function down()
    {
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToDivisiesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('divisies', 'slug')) {
            Schema::table('divisies', function (Blueprint $table) {
                $table->string('slug')->nullable();
            });
        }
    }

    public function down()
    {
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNavbarLogoToProfilesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('profiles', 'navbar_logo')) {
            Schema::table('profiles', function (Blueprint $table) {
                $table->string('navbar_logo')->nullable();
            });
        }
    }

    public function down()
    {
    }
}

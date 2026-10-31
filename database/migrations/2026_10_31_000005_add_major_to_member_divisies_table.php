<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMajorToMemberDivisiesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('member_divisies', 'jurusan')) {
            Schema::table('member_divisies', function (Blueprint $table) {
                $table->string('jurusan')->nullable();
            });
        }
    }

    public function down()
    {
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberDivisiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_divisies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('divisi_id');
            $table->string('name');
            $table->text('foto');
            $table->string('jabatan');
            $table->string('jurusan');
            $table->timestamps();

            $table->foreign('divisi_id')
                ->references('id')->on('divisies')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_divisies');
    }
}

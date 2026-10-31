<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prokers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('divisi_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->date('date');
            $table->text('description')->nullable();
            $table->text('lpj')->nullable();
            $table->text('proposal')->nullable();
            $table->unsignedBigInteger('periode_id');
            $table->text('link_documentation')->nullable();
            $table->enum('status', ['belum_terlaksana', 'proses', 'terlaksana']);
            $table->timestamps();

            $table->foreign('divisi_id')
                ->references('id')->on('divisies')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('periode_id')
                ->references('id')->on('periods')
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
        Schema::dropIfExists('prokers');
    }
}

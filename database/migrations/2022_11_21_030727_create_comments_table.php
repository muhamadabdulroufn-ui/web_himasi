<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('proker_id');

            $table->foreign('proker_id')
                ->references('id')->on('prokers')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}

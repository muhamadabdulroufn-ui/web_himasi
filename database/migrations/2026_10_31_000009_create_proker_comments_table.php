<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProkerCommentsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('proker_comments')) {
            Schema::create('proker_comments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('proker_id');
                $table->unsignedBigInteger('user_id');
                $table->text('comment');
                $table->timestamps();

                $table->foreign('proker_id')
                    ->references('id')->on('prokers')
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

                $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');
            });
        }
    }

    public function down()
    {
    }
}

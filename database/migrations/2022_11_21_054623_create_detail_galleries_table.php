<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('galeri_id');
            $table->text('image');
            $table->string('caption');

            $table->foreign('galeri_id')
                ->references('id')->on('galleries')
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
        Schema::dropIfExists('detail_galleries');
    }
}

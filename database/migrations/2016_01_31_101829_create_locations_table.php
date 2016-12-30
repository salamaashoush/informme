<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->integer('gover_id')->unsigned();
            $table->foreign('gover_id')->references('id')->on('governorates');
            $table->integer('div_id')->unsigned();
            $table->foreign('div_id')->references('id')->on('divisions');
            $table->decimal('long',10,8);
            $table->decimal('lat',10,8);
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
        Schema::drop('locations');
    }
}

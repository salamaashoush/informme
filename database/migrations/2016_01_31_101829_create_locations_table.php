<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->bigInteger('gover_id')->unsigned();
            $table->foreign('gover_id')->references('id')->on('governorates');
            $table->bigInteger('div_id')->unsigned();
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

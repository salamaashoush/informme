<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('area')->nullable();
            $table->bigInteger('gover_id')->unsigned();
            $table->foreign('gover_id')->references('id')->on('governorates');
            $table->bigInteger('div_id')->unsigned();
            $table->foreign('div_id')->references('id')->on('divisions');
            $table->boolean('is_division')->nullable();
            $table->decimal('population')->nullable();
            $table->decimal('p_density_rate')->nullable();
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
        Schema::drop('cities');
    }
}

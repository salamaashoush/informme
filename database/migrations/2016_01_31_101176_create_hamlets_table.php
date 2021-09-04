<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateHamletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hamlets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('area')->nullable();
            $table->bigInteger('div_id')->unsigned();
            $table->foreign('div_id')->references('id')->on('divisions');
            $table->bigInteger('vil_id')->unsigned();
            $table->foreign('vil_id')->references('id')->on('villages');
            $table->decimal('population')->nullable();
            $table->text('description')->nullable();
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
        Schema::drop('hamlets');
    }
}

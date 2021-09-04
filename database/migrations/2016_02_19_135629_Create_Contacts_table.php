<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone');
            $table->string('mobile');
            $table->string('fax');
            $table->string('email');
            $table->string('website');
            $table->integer('div_id')->unsigned();
            $table->foreign('div_id')->references('id')->on('divisions');
            $table->string('adress_1');
            $table->string('adress_2');
            $table->integer('contactable_id');
            $table->string('contactable_type');
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
        Schema::drop('contacts');
    }
}

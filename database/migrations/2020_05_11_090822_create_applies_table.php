<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('identity');
            $table->string('grade')->nullable();
            $table->string('card');
            $table->string('phone');
            $table->string('classroom')->nullable();
            $table->string('key_type')->nullable();
            $table->string('teacher')->nullable();
            $table->integer('equipment_id')->unsigned();
            $table->foreign('equipment_id')->references('id')->on('equipment');
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
        Schema::drop('applies');
    }
}

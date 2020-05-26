<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('genre')->unique();
            $table->string('item')->nullable();
            $table->integer('quantity');
        });
    }

    public function down()
    {
        Schema::drop('equipments');
    }
}

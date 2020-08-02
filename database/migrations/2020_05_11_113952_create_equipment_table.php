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
            $table->string('name');
            $table->string('index')->nullable();
            $table->integer('quantity');
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}

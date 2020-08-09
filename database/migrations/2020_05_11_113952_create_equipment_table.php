<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();   //建立、更新時間
            $table->string('genre');    //種類
            $table->string('item'); //項目
            $table->integer('quantity');    //數量
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}

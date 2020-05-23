<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_equipments', function (Blueprint $table) {
            // id: pk
            // timestamps: 申請時間
            // genre: 設備種類
            // item: 設備名稱
            // quantity: 借用數量
            // usage: 用途
            // return_time: 歸還時間
            // remark: 備註
            // apply_id: fk屬於哪一次申請
            $table->increments('id');
            $table->timestamps();
            $table->string('genre');
            $table->string('item')->nullable();
            $table->integer('quantity');
            $table->string('usage');
            $table->dateTime('return_time');
            $table->text('remark')->nullable();
            $table->integer('apply_id')->unsigned();
            $table->foreign('apply_id')->references('id')->on('applies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rent_equipments');
    }
}

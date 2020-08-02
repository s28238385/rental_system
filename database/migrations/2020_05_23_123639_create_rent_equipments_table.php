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
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('application_id')->unsigned();
            $table->string('name');
            $table->string('index')->nullable();
            $table->integer('quantity');
            $table->string('usage');
            $table->text('remark')->nullable();
            $table->enum('status', ['已建立', '借出中', '已歸還']);
            
            $table->foreign('application_id')->references('id')->on('applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_equipments');
    }
}

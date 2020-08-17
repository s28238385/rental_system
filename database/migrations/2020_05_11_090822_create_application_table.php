<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();   //建立、更新時間
            $table->string('name'); //申請人姓名
            $table->string('identity'); //申請人身分或系級
            $table->string('certificate')->nullable();  //抵押證件
            $table->string('phone');    //手機或分機
            $table->enum('status', ['申請中', '借出中', '部分歸還', '已歸還']); //整筆申請的借用狀態
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}

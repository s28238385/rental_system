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
            $table->string('classroom')->nullable();    //借用教室
            $table->enum('key_type', ['服務學習鑰匙', '備用鑰匙'])->nullable(); //鑰匙種類
            $table->string('teacher')->nullable();  //授課教師
            $table->datetime('return_time');    //歸還時間
            $table->enum('all_status', ['申請中', '借出中', '已歸還']); //整筆申請的借用狀態
            $table->enum('key_status', ['申請中', '借出中', '已歸還']);   //鑰匙的借用狀態
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

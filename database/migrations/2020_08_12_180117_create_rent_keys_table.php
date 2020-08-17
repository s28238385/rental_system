<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_keys', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();   //建立、更新時間
            $table->integer('application_id')->unsigned();  //申請資料的id
            $table->string('classroom');
            $table->string('teacher')->nullable();
            $table->enum('key_type', ['主要鑰匙', '服務學習鑰匙', '備用鑰匙', '備備用鑰匙']);   //鑰匙種類
            $table->string('usage'); //用途
            $table->string('remark')->nullable();   //備註
            $table->datetime('return_time');    //歸還時間
            $table->enum('status', ['申請中', '借出中', '已歸還']); //鑰匙狀態
            $table->string('rent_by')->nullable();  //借出經手人
            $table->string('return_by')->nullable();    //歸還經手人
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_keys');
    }
}

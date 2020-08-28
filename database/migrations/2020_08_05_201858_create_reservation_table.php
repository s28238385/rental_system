<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();   //建立、更新時間
            $table->string('name'); //申請人姓名
            $table->string('phone')->nullable();    //連絡電話
            $table->string('reason');   //理由
            $table->string('classroom');    //借用教室
            $table->date('date');   //預約日期
            $table->string('day');  //星期
            $table->integer('begin_time');  //開始節次的index值
            $table->integer('end_time');    //結束節次的index值
            $table->integer('long_term_id')->nullable();    //長期借用的識別碼
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}

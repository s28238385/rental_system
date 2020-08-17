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
            $table->bigIncrements('id');
            $table->timestamps();   //建立、更新時間
            $table->bigInteger('application_id')->unsigned(); //申請資料的id
            $table->string('genre');    //種類
            $table->string('item'); //項目
            $table->integer('quantity');    //數量
            $table->string('usage');    //用途
            $table->text('remark')->nullable(); //備註
            $table->datetime('return_time');
            $table->enum('status', ['申請中', '借出中', '已歸還']); //借用狀態
            $table->string('rent_by')->nullable();  //借出經手人
            $table->string('return_by')->nullable();    //歸還經手人

            //指定application_id為FK，指向applications table的id
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

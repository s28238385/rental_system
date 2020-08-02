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
            // id: pk
            // timestamps: 申請時間
            // name: 申請人姓名
            // identity: 申請人身分
            // grade: 申請人班年級
            // card: 抵押證件
            // phone: 手機或分機
            // classroom: 借用教室
            // key_type: 鑰匙種類
            // teacher: 授課教師
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name');
            $table->string('identity');
            $table->string('certificate')->nullable();
            $table->string('phone');
            $table->string('classroom')->nullable();
            $table->string('key_type')->nullable();
            $table->string('teacher')->nullable();
            $table->datetime('return_time');
            $table->enum('all_status', ['已建立', '借出中', '部分歸還', '已歸還']);
            $table->enum('key_status', ['已建立', '借出中', '已歸還']);
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

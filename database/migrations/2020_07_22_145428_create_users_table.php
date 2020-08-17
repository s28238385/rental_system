<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();   //建立、更新時間
            $table->string('name'); //姓名
            $table->string('email')->unique();  //電子信箱
            $table->string('password'); //密碼
            $table->enum('role', ['管理員', '工讀生']); //使用者身分
            $table->rememberToken();   //user table必備值，供登入用
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

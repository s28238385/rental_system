<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applies', function (Blueprint $table) {
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
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('identity');
            $table->string('grade')->nullable();
            $table->string('card')->nullable();
            $table->string('phone');
            $table->string('classroom')->nullable();
            $table->string('key_type')->nullable();
            $table->string('teacher')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('applies');
    }
}

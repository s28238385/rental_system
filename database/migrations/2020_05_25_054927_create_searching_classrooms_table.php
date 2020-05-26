<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchingClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('searching_classrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('classroomName');
            $table->string('imagePath');
            $table->text('equipmentDescription');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('searching_classrooms');
    }
}

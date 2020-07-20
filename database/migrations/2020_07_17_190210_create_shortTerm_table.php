<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserve_shortterms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('classroom');
            $table->string('name');
            $table->text('reason')->nullable();
            $table->date('date');
            $table->time('startTime');
            $table->time('endTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reserve_shortterms');
    }
}

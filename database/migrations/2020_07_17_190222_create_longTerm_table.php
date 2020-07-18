<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLongTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('long_terms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('classroom');
            $table->string('name');
            $table->text('reason')->nullable();
            $table->date('startDate');
            $table->date('endDate');
            $table->string('DayOfWeek');
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
        Schema::drop('long_terms');
    }
}

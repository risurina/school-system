<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_years', function (Blueprint $table) {
            $table->integer('school_id');
            $table->integer('year');
            $table->string('code');
            $table->date('start');
            $table->date('end');
            $table->date('firstGrading')->nullable();
            $table->date('secondGrading')->nullable();
            $table->date('thirdGrading')->nullable();
            $table->date('fourthGrading')->nullable();
            $table->integer('monthlyExam')->nullable();
            $table->integer('monthlyDue')->nullable();
            $table->increments('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_years');
    }
}

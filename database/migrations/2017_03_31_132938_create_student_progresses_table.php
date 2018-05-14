<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_progresses', function (Blueprint $table) {
            $table->integer('school_year_level_section_id');
            $table->integer('rfcard_id')->nullable();
            $table->integer('student_id');
            $table->integer('syStudentID');
            $table->string('status')->default('ENROLLED');
            $table->date('enrolledDate')->nullable();
            $table->string('ageTimeOfEnrolled')->nullable();
            $table->bigInteger('mobileNo')->nullable();
            $table->string('landlineNo')->nullable();
            $table->string('address')->nullable()->nullable();
            $table->string('guardianName')->nullable();
            $table->string('guardianRelationship')->nullable();
            $table->string('healthProblem')->nullable();
            $table->boolean('isCash')->default(0);
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('student_progresses');
    }
}

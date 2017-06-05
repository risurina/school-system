<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->integer('school_id');
            $table->string('lrnNo')->nullable();
            $table->string('firstName'); 
            $table->string('middleName')->nullable(); 
            $table->string('lastName');
            $table->date('dateOfBirth')->nullable();
            $table->string('sex');
            $table->boolean('isActive')->default(0);
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->increments('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}

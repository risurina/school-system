<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('school_id');
            $table->string('number')->nullable(); 
            $table->string('eeNum'); 
            $table->string('firstName'); 
            $table->string('middleName'); 
            $table->string('lastName');
            $table->string('position');
            $table->string('level');
            $table->date('hiredDate'); 
            $table->date('dateOfBirth'); 
            $table->integer('age');
            $table->float('basicSalary')->default('0'); 
            $table->float('allowance')->default('0');
            $table->float('takeHome')->default('0'); 
            $table->integer('daysOfWork')->default('0'); 
            $table->date('endDate')->nullable();
            $table->integer('percent')->default('0'); 
            $table->float('bonus')->default('0'); 
            $table->float('declare')->default('0'); 
            $table->string('er'); 
            $table->string('ee');
            $table->string('tc');
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
        Schema::dropIfExists('employees');
    }
}

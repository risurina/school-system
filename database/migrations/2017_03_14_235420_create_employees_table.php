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
            $table->integer('rfcard_id')->nullable();
            $table->string('number')->nullable(); 
            $table->string('eeNum')->nullable(); 
            $table->string('firstName'); 
            $table->string('middleName')->nullable(); 
            $table->string('lastName');
            $table->string('position');
            $table->string('address');
            $table->string('assingEmpID');
            $table->string('status')->nullable();
            $table->boolean('isActive')->default(true)->nullable();
            $table->bigInteger('mobileNo')->nullable();
            $table->string('level')->nullable();
            $table->date('hiredDate')->nullable(); 
            $table->date('dateOfBirth')->nullable();
            $table->float('basicSalary')->default('0')->nullable(); 
            $table->float('allowance')->default('0')->nullable();
            $table->float('takeHome')->default('0')->nullable(); 
            $table->integer('daysOfWork')->default('0')->nullable(); 
            $table->date('endDate')->nullable();
            $table->integer('percent')->default('0')->nullable(); 
            $table->float('bonus')->default('0')->nullable(); 
            $table->float('declare')->default('0')->nullable(); 
            $table->string('er')->nullable(); 
            $table->string('ee')->nullable();
            $table->string('tc')->nullable();
            $table->boolean('hasFingerPrint')->default(0);
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->rememberToken();
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

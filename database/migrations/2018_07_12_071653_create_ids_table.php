<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id');

            $table->string('type'); //
            $table->string('student_id_no')->nullable(); //
            $table->string('card_id_no')->nullable(); //
            $table->string('last_name'); //
            $table->string('first_name'); //
            $table->string('middle_name')->nullable(); //
            $table->string('lrn')->nullable(); //
            $table->string('year_level')->nullable(); //
            $table->string('section')->nullable(); //
            $table->boolean('is_new_student')->default(0);
            $table->string('sex')->nullable(); //
            $table->date('date_of_birth')->nullable(); //
            $table->string('phone_number')->nullable(); //
            $table->string('address', 2500)->nullable(); //
            $table->string('address_two', 2500)->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('guardian')->nullable();
            $table->string('adviser')->nullable();
            $table->string('id_status')->default('ENCODING');
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
        Schema::dropIfExists('ids');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_payments', function (Blueprint $table) {
            $table->integer('student_fee_id');
            $table->string('invNo')->nullable();
            $table->string('payment_by');
            $table->date('payment_date');
            $table->float('amount');
            $table->boolean('isCancel')->default(0);
            $table->string('cancel_by')->nullable();
            $table->dateTime('cancel_date')->nullable();
            $table->string('restore_by')->nullable();
            $table->dateTime('restore_date')->nullable();
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
        Schema::dropIfExists('student_payments');
    }
}

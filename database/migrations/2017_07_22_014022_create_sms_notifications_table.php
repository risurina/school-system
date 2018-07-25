<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('sms_notifications', function (Blueprint $table) {
            $table->string('message');
            $table->string('number')->default('9322790056');
            $table->boolean('isSend')->default(0);
		    $table->boolean('isLog')->default(0);
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
        Schema::dropIfExists('sms_notifications');
    }
}

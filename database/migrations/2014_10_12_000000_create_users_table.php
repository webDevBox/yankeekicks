<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->tinyInteger('status')->comment('0 = Active , 1 = InActive');
            $table->tinyInteger('role')->comment('0 = user , 1 = admin');
            $table->string('forgot_token')->nullable();
            $table->dateTime('token_generation_time')->nullable();
            $table->tinyInteger('wihdraw_request')->default(0)->comment('0 = notRequested , 1 = Requested');
            $table->bigInteger('amount')->default(0);
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
        Schema::dropIfExists('users');
    }
}

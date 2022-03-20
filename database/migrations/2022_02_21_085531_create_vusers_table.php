<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Vusers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',50)->default('')->comment('账号');
            $table->string('truename',50)->default('')->comment('真实姓名');
            $table->string('email',50)->default('')->comment('邮箱');
            $table->string('phone',50)->default('')->comment('手机');
            $table->string('password',250)->default('')->comment('密码');
            $table->enum('sex',['男','女'])->default('男')->comment('性别');
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
        Schema::dropIfExists('vusers');
    }
};

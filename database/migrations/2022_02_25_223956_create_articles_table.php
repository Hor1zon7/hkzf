<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titile', 200)->comment('文章标题');
            $table->string('desn', 255)->default("")->comment('文章摘要');
            $table->string('pic', 100)->default("")->comment('文章封面');
            $table->string('author', 30)->default("")->comment('作者');
            $table->text('body')->comment('文章内容');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};

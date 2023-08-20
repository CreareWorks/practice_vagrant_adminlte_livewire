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
        Schema::create('illusts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); # 外部キー
            $table->foreign('user_id')->references('id')->on('users'); # 外部キー制約をつける
            $table->string('title');
            $table->text('toDataURL');
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
        Schema::dropIfExists('illusts');
    }
};

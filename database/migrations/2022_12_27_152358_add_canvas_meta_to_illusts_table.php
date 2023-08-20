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
        Schema::table('illusts', function (Blueprint $table) {
            $table->string('canvas_meta')->after('toDataURL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('illusts', function (Blueprint $table) {
            $table->dropColumn('canvas_meta');
        });
    }
};

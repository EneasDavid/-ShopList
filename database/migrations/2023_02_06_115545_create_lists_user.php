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
        Schema::create('lists_user', function (Blueprint $table) {
            $table->unsignedBigInteger('lists_id');
            $table->unsignedBigInteger('user_id');
        });
		Schema::table('lists_user', function (Blueprint $table) {
            $table->foreign('lists_id')->references('id')->on('lists')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lists_user');
    }
};

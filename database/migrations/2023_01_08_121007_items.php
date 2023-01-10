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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nomeProduto');
            $table->decimal('preco');
            $table->unsignedBigInteger('quantidade');
            $table->string('descricao');
            $table->unsignedBigInteger('responsavelItem');
            $table->unsignedBigInteger('listaPertence');
            $table->timestamps();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->foreign('listaPertence')->references('id')->on('lists')->onDelete('cascade');
        });
    }

     /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};

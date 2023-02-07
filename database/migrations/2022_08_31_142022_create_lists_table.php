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
        Schema::create('lists', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('categoria');
            $table->unsignedBigInteger('idCriador');
            $table->string('Criador');
            $table->unsignedBigInteger('quantidadeItem')->nullable();
            $table->json('participantes')->nullable();
            $table->decimal('valorTotal');
            $table->decimal('limiteLista')->nullable();
            $table->decimal('porcetagemLimite');
            $table->boolean('finaizada');
            $table->timestamps();
        });
		Schema::table('lists', function (Blueprint $table) {
            $table->foreign('idCriador')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lists');
    }
};

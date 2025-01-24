<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listas_itens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lista_id'); 
            $table->foreignId('produto_id');
            $table->enum('faltando', ['S', 'N'])->default('N');
            $table->integer('quantidade')->nullable(); 
            $table->double('valor', 10, 2)->nullable();
            $table->double('desconto', 5, 2)->nullable();
            $table->double('total', 9, 2)->nullable();
            $table->timestamps();

            $table->foreign('lista_id')->references('id')->on('listas');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('listas_itens');
        Schema::enableForeignKeyConstraints();
    }
};

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
        Schema::create('listas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario');
            $table->string('descricao');
            $table->string('observacao')->nullable();
            $table->enum('status', ['A', 'C'])->default('A');
            $table->dateTime('data_criacao');
            $table->dateTime('data_conclusao')->nullable();
            $table->timestamps();

            $table->foreign('usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('listas');
        Schema::enableForeignKeyConstraints();
    }
};

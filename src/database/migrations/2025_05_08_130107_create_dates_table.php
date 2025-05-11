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
        Schema::create('dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->constrained('users')->onDelete('cascade');
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->integer('duracion')->nullable();
            $table->string('marca');
            $table->string('modelo');
            $table->string('matricula');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dates');
    }
};

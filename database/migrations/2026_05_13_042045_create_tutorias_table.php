<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiante_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tutor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade');
            $table->string('tema');
            $table->text('descripcion')->nullable();
            $table->dateTime('fecha_hora');
            $table->string('modalidad')->default('online');
            $table->string('enlace_videollamada')->nullable();
            $table->enum('estado', ['pendiente', 'aceptada', 'rechazada', 'completada', 'cancelada'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutorias');
    }
};
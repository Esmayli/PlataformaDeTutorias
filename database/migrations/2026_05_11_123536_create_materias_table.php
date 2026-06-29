<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_materia', 100);
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        // Insertar materias por defecto
        DB::table('materias')->insert([
            ['nombre_materia' => 'Matemática', 'descripcion' => 'Cálculo, álgebra y geometría', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_materia' => 'Programación', 'descripcion' => 'Lenguajes de programación y algoritmos', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_materia' => 'Física', 'descripcion' => 'Mecánica, termodinámica y electromagnetismo', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_materia' => 'Química', 'descripcion' => 'Química general y orgánica', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};
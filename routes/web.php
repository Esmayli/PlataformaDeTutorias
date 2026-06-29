<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConsultaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RecomendacionController;
use App\Http\Controllers\TutoriaController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\TutorController;

// ============================================
// RUTA PRINCIPAL
// ============================================
Route::get('/', function () {
    return view('welcome');
});

// ============================================
// REDIRECCIÓN SEGÚN ROL
// ============================================
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->rol === 'tutor') {
        return redirect('/tutor/dashboard');
    }

    return redirect('/estudiante/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ============================================
// RUTAS DEL ESTUDIANTE (PROTEGIDAS)
// ============================================
Route::middleware(['auth', 'role:estudiante'])->prefix('estudiante')->group(function () {

    Route::get('/dashboard', function () {
        return view('estudiante.dashboard');
    })->name('estudiante.dashboard');

    Route::get('/consulta', [ConsultaController::class, 'crear'])
        ->name('estudiante.consulta');

    Route::post('/consulta', [ConsultaController::class, 'guardar'])
        ->name('estudiante.consulta.guardar');

    Route::get('/historial', [ConsultaController::class, 'historial'])
        ->name('estudiante.historial');

    // ESTA ES LA CORRECCIÓN IMPORTANTE
    Route::get('/recomendaciones', [RecomendacionController::class, 'index'])
        ->name('estudiante.recomendaciones');

        // Rutas de Calificaciones (Estudiante)
Route::get('/tutorias/{tutoria}/calificar', [CalificacionController::class, 'crear'])
    ->name('estudiante.calificaciones.crear');

Route::post('/tutorias/{tutoria}/calificar', [CalificacionController::class, 'guardar'])
    ->name('estudiante.calificaciones.guardar');

            // Rutas de Agenda de Tutorías (Estudiante)
    Route::get('/tutorias', [TutoriaController::class, 'indexEstudiante'])->name('estudiante.tutorias.index');
    Route::get('/tutorias/crear', [TutoriaController::class, 'crear'])->name('estudiante.tutorias.crear');
    Route::post('/tutorias', [TutoriaController::class, 'guardar'])->name('estudiante.tutorias.guardar');
});
// ============================================
// RUTAS DEL TUTOR (PROTEGIDAS)
// ============================================
Route::middleware(['auth', 'role:tutor'])->prefix('tutor')->group(function () {

    Route::get('/dashboard', function () {
        return view('tutor.dashboard');
    })->name('tutor.dashboard');

    Route::get('/consultas', [ConsultaController::class, 'consultasTutor'])
        ->name('tutor.consultas');

    // Rutas de Agenda de Tutorías (Tutor)
    Route::get('/tutorias', [TutoriaController::class, 'indexTutor'])
        ->name('tutor.tutorias.index');

    Route::post('/tutorias/{id}/estado', [TutoriaController::class, 'cambiarEstado'])
        ->name('tutor.tutorias.estado');

        // Ruta de Calificaciones (Tutor)
Route::get('/calificaciones', [CalificacionController::class, 'indexTutor'])
    ->name('tutor.calificaciones.index');

        // Rutas adicionales del Tutor
    Route::get('/mis-estudiantes', [TutorController::class, 'misEstudiantes'])->name('tutor.estudiantes.index');
    Route::get('/alertas', [TutorController::class, 'alertas'])->name('tutor.alertas.index');
});

// ============================================
// RUTAS DE PERFIL (Laravel Breeze)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
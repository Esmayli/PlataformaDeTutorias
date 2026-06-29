<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Tutor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Uncial+Antiqua&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-gothic">
    <div class="min-h-screen">
        <nav class="bg-gradient-to-r from-gothic-purple to-gothic-deepPurple text-gray-100 p-4 shadow-[0_0_30px_rgba(74,14,78,0.4)] border-b border-accent-gold/30">
            <div class="max-w-7xl mx-auto flex justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gothic-black/50 backdrop-blur-sm rounded-lg flex items-center justify-center shadow-[0_0_15px_rgba(212,175,55,0.5)] animate-glow">
                        <svg class="w-6 h-6 text-accent-gold" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold text-white font-gothic-title text-2xl">👨‍🏫 TutoríaIA - Panel Tutor</h1>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-gothic-black/50 hover:bg-gothic-black/70 backdrop-blur-sm px-6 py-2 rounded-lg transition-all duration-300 transform hover:-translate-y-0.5 shadow-[0_0_20px_rgba(212,175,55,0.3)] border border-accent-gold/50 text-gray-100 font-bold">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto mt-8 px-4 pb-10">
            <div class="bg-black/70 backdrop-blur-lg rounded-2xl shadow-[0_0_40px_rgba(74,14,78,0.2)] p-8 border border-gothic-purple/30">
                <h2 class="text-4xl font-bold bg-gradient-to-r from-accent-gold via-gothic-blood to-gothic-purple bg-clip-text text-transparent animate-gothic-pulse font-gothic-title">
                    Bienvenido, {{ Auth::user()->name }} 👋
                </h2>
                <p class="text-gray-100 mt-2 text-lg font-semibold">Especialidad: {{ Auth::user()->carrera }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">

                <!-- Tarjeta 1: Mis Estudiantes -->
                <div class="bg-black/60 backdrop-blur-lg p-6 rounded-2xl shadow-xl border border-gothic-purple/30 hover:shadow-[0_0_30px_rgba(74,14,78,0.4)] hover:scale-105 transition-all duration-300 text-center">
                    <div class="text-5xl mb-4 animate-float drop-shadow-[0_0_15px_rgba(74,14,78,0.8)]">👥</div>
                    <h3 class="text-2xl font-bold text-accent-gold font-gothic">Mis Estudiantes</h3>
                    <p class="text-gray-100 text-sm mt-3 font-medium">Lista de estudiantes asignados.</p>
                    <a href="{{ route('tutor.estudiantes.index') }}" class="mt-6 block bg-gradient-to-r from-gothic-purple to-gothic-deepPurple hover:from-gothic-deepPurple hover:to-gothic-purple text-gothic-black py-3 rounded-xl shadow-[0_0_20px_rgba(74,14,78,0.4)] hover:shadow-[0_0_30px_rgba(74,14,78,0.6)] transition-all duration-300 transform hover:-translate-y-0.5 font-bold border border-gothic-purple/50">Ver Estudiantes</a>
                </div>

                <!-- Tarjeta 2: Consultas Frecuentes -->
                <div class="bg-black/60 backdrop-blur-lg p-6 rounded-2xl shadow-xl border border-gothic-blood/30 hover:shadow-[0_0_30px_rgba(139,0,0,0.4)] hover:scale-105 transition-all duration-300 text-center">
                    <div class="text-5xl mb-4 animate-float drop-shadow-[0_0_15px_rgba(139,0,0,0.8)]">📊</div>
                    <h3 class="text-2xl font-bold text-accent-gold font-gothic">Consultas Frecuentes</h3>
                    <p class="text-gray-100 text-sm mt-3 font-medium">Consultas más frecuentes de tus estudiantes.</p>
                    <a href="{{ route('tutor.consultas') }}" class="mt-6 block bg-gradient-to-r from-gothic-crimson to-gothic-blood hover:from-gothic-blood hover:to-gothic-crimson text-gothic-black py-3 rounded-xl shadow-[0_0_20px_rgba(139,0,0,0.4)] hover:shadow-[0_0_30px_rgba(139,0,0,0.6)] transition-all duration-300 transform hover:-translate-y-0.5 font-bold border border-gothic-blood/50">
                        Ver Consultas
                    </a>
                </div>

                <!-- Tarjeta 3: Solicitudes de Tutoría -->
                <div class="bg-black/60 backdrop-blur-lg p-6 rounded-2xl shadow-xl border border-accent-gold/30 hover:shadow-[0_0_30px_rgba(212,175,55,0.4)] hover:scale-105 transition-all duration-300 text-center">
                    <div class="text-5xl mb-4 animate-float drop-shadow-[0_0_15px_rgba(212,175,55,0.8)]">📅</div>
                    <h3 class="text-2xl font-bold text-accent-gold font-gothic">Solicitudes de Tutoría</h3>
                    <p class="text-gray-100 text-sm mt-3 font-medium">Gestiona las solicitudes de clase de tus estudiantes.</p>
                    <a href="{{ route('tutor.tutorias.index') }}" class="mt-6 block bg-gradient-to-r from-accent-gold to-gothic-blood hover:from-gothic-blood hover:to-accent-gold text-gothic-black py-3 rounded-xl shadow-[0_0_20px_rgba(212,175,55,0.4)] hover:shadow-[0_0_30px_rgba(212,175,55,0.6)] transition-all duration-300 transform hover:-translate-y-0.5 font-bold border border-accent-gold/50">
                        Ver Solicitudes
                    </a>
                </div>

                <!-- Tarjeta 4: Alertas -->
                <div class="bg-black/60 backdrop-blur-lg p-6 rounded-2xl shadow-xl border border-gothic-crimson/30 hover:shadow-[0_0_30px_rgba(220,20,60,0.4)] hover:scale-105 transition-all duration-300 text-center">
                    <div class="text-5xl mb-4 animate-float drop-shadow-[0_0_15px_rgba(220,20,60,0.8)]">🔔</div>
                    <h3 class="text-2xl font-bold text-accent-gold font-gothic">Alertas</h3>
                    <p class="text-gray-100 text-sm mt-3 font-medium">Estudiantes que necesitan atención.</p>
                   <a href="{{ route('tutor.alertas.index') }}" class="mt-6 block bg-gradient-to-r from-gothic-crimson to-gothic-purple hover:from-gothic-purple hover:to-gothic-crimson text-gothic-black py-3 rounded-xl shadow-[0_0_20px_rgba(220,20,60,0.4)] hover:shadow-[0_0_30px_rgba(220,20,60,0.6)] transition-all duration-300 transform hover:-translate-y-0.5 font-bold border border-gothic-crimson/50">Ver Alertas</a>
                </div>

                <!-- Tarjeta 5: Calificaciones -->
                <div class="bg-black/60 backdrop-blur-lg p-6 rounded-2xl shadow-xl border border-secondary-500/30 hover:shadow-[0_0_30px_rgba(139,26,139,0.4)] hover:scale-105 transition-all duration-300 text-center">
                    <div class="text-5xl mb-4 animate-float drop-shadow-[0_0_15px_rgba(139,26,139,0.8)]">⭐</div>
                    <h3 class="text-2xl font-bold text-accent-gold font-gothic">Calificaciones</h3>
                    <p class="text-gray-100 text-sm mt-3 font-medium">Revisa la valoración de tus tutorías.</p>
                    <a href="{{ route('tutor.calificaciones.index') }}"
                       class="mt-6 block bg-gradient-to-r from-secondary-500 to-gothic-purple hover:from-gothic-purple hover:to-secondary-500 text-gothic-black py-3 rounded-xl shadow-[0_0_20px_rgba(139,26,139,0.4)] hover:shadow-[0_0_30px_rgba(139,26,139,0.6)] transition-all duration-300 transform hover:-translate-y-0.5 font-bold border border-secondary-500/50">
                        Ver Calificaciones
                    </a>
                </div>

            </div>

            <!-- Sección informativa -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div class="bg-gradient-to-br from-gothic-purple/10 to-gothic-deepPurple/10 border border-gothic-purple/30 rounded-2xl p-6 shadow-[0_0_30px_rgba(74,14,78,0.2)]">
                    <h3 class="text-xl font-bold text-red-600 mb-3 animate-gothic-pulse font-gothic">
                        ¿Cómo funciona tu panel?
                    </h3>
                    <p class="text-gray-100 text-sm font-medium">
                        Desde aquí puedes gestionar tus estudiantes, revisar las consultas más frecuentes,
                        y administrar las solicitudes de tutoría que recibes.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-accent-gold/10 to-gothic-blood/10 border border-accent-gold/30 rounded-2xl p-6 shadow-[0_0_30px_rgba(212,175,55,0.2)]">
                    <h3 class="text-xl font-bold text-red-600 mb-3 animate-gothic-pulse font-gothic">
                        Recomendación
                    </h3>
                    <p class="text-gray-100 text-sm font-medium">
                        Mantente atento a las alertas de estudiantes que necesitan atención especial
                        y revisa las calificaciones para mejorar la calidad de tus tutorías.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

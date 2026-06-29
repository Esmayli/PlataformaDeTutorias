<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Estudiante - TutoríaIA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Uncial+Antiqua&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-gothic">
    <div class="min-h-screen">

        <!-- Barra superior -->
        <nav class="bg-gradient-to-r from-gothic-blood to-gothic-purple text-gray-100 p-4 shadow-[0_0_30px_rgba(139,0,0,0.4)] border-b border-accent-gold/30">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gothic-black/50 backdrop-blur-sm rounded-lg flex items-center justify-center shadow-[0_0_15px_rgba(212,175,55,0.5)] animate-glow">
                        <svg class="w-6 h-6 text-accent-gold" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold text-white font-gothic-title text-2xl">
                        🎓 TutoríaIA - Panel Estudiante
                    </h1>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="bg-gothic-black/50 hover:bg-gothic-black/70 backdrop-blur-sm px-6 py-2 rounded-lg transition-all duration-300 transform hover:-translate-y-0.5 shadow-[0_0_20px_rgba(212,175,55,0.3)] border border-accent-gold/50 text-gray-100 font-bold">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="max-w-7xl mx-auto mt-8 px-4 pb-10">

            <!-- Bienvenida -->
            <div class="bg-black/70 backdrop-blur-lg rounded-2xl shadow-[0_0_40px_rgba(139,0,0,0.2)] p-8 border border-gothic-purple/30">
                <h2 class="text-4xl font-bold bg-gradient-to-r from-accent-gold via-gothic-blood to-gothic-purple bg-clip-text text-transparent animate-gothic-pulse font-gothic-title">
                    Bienvenido, {{ Auth::user()->name }} 👋
                </h2>

                <p class="text-gray-100 mt-2 text-lg font-semibold">
                    Carrera: {{ Auth::user()->carrera ?? 'No registrada' }}
                </p>

                <p class="text-gray-100 mt-4 text-base">
                    Desde este panel puedes realizar consultas académicas, revisar tu historial
                    y recibir recomendaciones personalizadas según tus dudas.
                </p>
            </div>

            <!-- Tarjetas principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">

                <!-- Tarjeta: Preguntar a la IA -->
                <div class="bg-black/60 backdrop-blur-lg p-6 rounded-2xl shadow-xl border border-accent-gold/30 hover:shadow-[0_0_30px_rgba(212,175,55,0.4)] hover:scale-105 transition-all duration-300">
                    <div class="text-5xl mb-4 animate-float drop-shadow-[0_0_15px_rgba(212,175,55,0.8)]">🤖</div>

                    <h3 class="text-2xl font-bold text-accent-gold font-gothic">
                        Preguntar a la IA
                    </h3>

                    <p class="text-gray-100 text-sm mt-3 font-medium">
                        Realiza consultas académicas en Programación, Matemática, Física o Química.
                    </p>

                    <a href="{{ route('estudiante.consulta') }}"
                       class="mt-6 block bg-gradient-to-r from-gothic-blood to-gothic-purple hover:from-gothic-purple hover:to-gothic-crimson text-gothic-black py-3 rounded-xl shadow-[0_0_20px_rgba(139,0,0,0.4)] hover:shadow-[0_0_30px_rgba(139,0,0,0.6)] transition-all duration-300 transform hover:-translate-y-0.5 text-center font-bold border border-accent-gold/50">
                        Ir al Asistente
                    </a>
                </div>

                <!-- Tarjeta: Historial -->
                <div class="bg-black/60 backdrop-blur-lg p-6 rounded-2xl shadow-xl border border-gothic-purple/30 hover:shadow-[0_0_30px_rgba(74,14,78,0.4)] hover:scale-105 transition-all duration-300">
                    <div class="text-5xl mb-4 animate-float drop-shadow-[0_0_15px_rgba(74,14,78,0.8)]">📋</div>

                    <h3 class="text-2xl font-bold text-accent-gold font-gothic">
                        Historial de Consultas
                    </h3>

                    <p class="text-gray-100 text-sm mt-3 font-medium">
                        Revisa tus preguntas anteriores, respuestas generadas y nivel de confianza.
                    </p>

                    <a href="{{ route('estudiante.historial') }}"
                       class="mt-6 block bg-gradient-to-r from-gothic-purple to-gothic-deepPurple hover:from-gothic-deepPurple hover:to-gothic-purple text-gothic-black py-3 rounded-xl shadow-[0_0_20px_rgba(74,14,78,0.4)] hover:shadow-[0_0_30px_rgba(74,14,78,0.6)] transition-all duration-300 transform hover:-translate-y-0.5 text-center font-bold border border-gothic-purple/50">
                        Ver Historial
                    </a>
                </div>

                <!-- Tarjeta: Recomendaciones -->
                <div class="bg-black/60 backdrop-blur-lg p-6 rounded-2xl shadow-xl border border-gothic-blood/30 hover:shadow-[0_0_30px_rgba(139,0,0,0.4)] hover:scale-105 transition-all duration-300">
                    <div class="text-5xl mb-4 animate-float drop-shadow-[0_0_15px_rgba(139,0,0,0.8)]">⭐</div>

                    <h3 class="text-2xl font-bold text-accent-gold font-gothic">
                        Recomendaciones
                    </h3>

                    <p class="text-gray-100 text-sm mt-3 font-medium">
                        Consulta sugerencias personalizadas según tu historial de consultas y materias.
                    </p>

                    <a href="{{ route('estudiante.recomendaciones') }}"
                       class="mt-6 block bg-gradient-to-r from-gothic-crimson to-gothic-blood hover:from-gothic-blood hover:to-gothic-crimson text-gothic-black py-3 rounded-xl shadow-[0_0_20px_rgba(139,0,0,0.4)] hover:shadow-[0_0_30px_rgba(139,0,0,0.6)] transition-all duration-300 transform hover:-translate-y-0.5 text-center font-bold border border-gothic-blood/50">
                        Ver Recomendaciones
                    </a>
                </div>

                <!-- Tarjeta: Agendar Tutoría -->
                <div class="bg-black/60 backdrop-blur-lg p-6 rounded-2xl shadow-xl border border-accent-gold/30 hover:shadow-[0_0_30px_rgba(212,175,55,0.4)] hover:scale-105 transition-all duration-300">
                    <div class="text-5xl mb-4 animate-float drop-shadow-[0_0_15px_rgba(212,175,55,0.8)]">📅</div>

                    <h3 class="text-2xl font-bold text-accent-gold font-gothic">
                        Agendar Tutoría
                    </h3>

                    <p class="text-gray-100 text-sm mt-3 font-medium">
                        Solicita clases con tutores y videollamadas.
                    </p>

                    <a href="{{ route('estudiante.tutorias.index') }}"
                       class="mt-6 block bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-gothic-black py-3 rounded-xl shadow-[0_0_20px_rgba(249,115,22,0.4)] hover:shadow-[0_0_30px_rgba(249,115,22,0.6)] transition-all duration-300 transform hover:-translate-y-0.5 text-center font-bold border border-orange-300/70">
                        Agendar Tutoría
                    </a>
                </div>
            </div>

            <!-- Sección informativa -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

                <div class="bg-gradient-to-br from-accent-gold/10 to-gothic-blood/10 border border-accent-gold/30 rounded-2xl p-6 shadow-[0_0_30px_rgba(212,175,55,0.2)]">
                    <h3 class="text-xl font-bold text-accent-gold mb-3 animate-gothic-pulse font-gothic">
                        ¿Cómo funciona TutoríaIA?
                    </h3>

                    <p class="text-gray-100 text-sm font-medium">
                        El sistema analiza tus preguntas académicas y genera respuestas de apoyo.
                        Además, utiliza tu historial para recomendar temas que puedes reforzar.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-gothic-purple/10 to-gothic-deepPurple/10 border border-gothic-purple/30 rounded-2xl p-6 shadow-[0_0_30px_rgba(74,14,78,0.2)]">
                    <h3 class="text-xl font-bold text-red-600 mb-3 animate-gothic-pulse font-gothic">
                        Recomendación
                    </h3>

                    <p class="text-gray-100 text-sm font-medium">
                        Mientras más consultas realices, el sistema podrá ofrecerte recomendaciones
                        más precisas sobre las materias donde necesitas mayor refuerzo.
                    </p>
                </div>

            </div>

        </main>
    </div>
</body>
</html>

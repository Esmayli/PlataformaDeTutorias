<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Tutorías IA') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Uncial+Antiqua&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-100 antialiased bg-gradient-gothic">
        <div class="min-h-screen flex flex-col">
            <!-- Navbar -->
            <nav class="bg-gothic-dark/90 backdrop-blur-sm border-b border-gothic-purple/30 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-gothic-blood to-gothic-purple rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-accent-gold" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </div>
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-accent-gold to-gothic-blood bg-clip-text text-transparent font-gothic-title text-3xl">Tutorías IA</h1>
                        </div>
                        <div class="flex items-center gap-4">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-6 py-2 bg-gradient-to-r from-gothic-blood to-gothic-purple hover:from-gothic-purple hover:to-gothic-crimson text-white font-medium rounded-lg transition-all duration-300 transform hover:-translate-y-0.5 border border-accent-gold/50">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="px-4 py-2 text-accent-gold font-medium hover:bg-accent-gold/10 rounded-lg transition-all duration-300 border border-accent-gold/30">
                                        Log in
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="px-4 py-2 bg-gradient-to-r from-gothic-purple to-gothic-deepPurple hover:from-gothic-deepPurple hover:to-gothic-purple text-white font-medium rounded-lg transition-all duration-300 border border-accent-gold/50">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <main class="flex-grow flex items-center justify-center px-4 py-20 md:py-28">
                <div class="max-w-3xl w-full mx-auto">
                    <div class="bg-gothic-dark/90 backdrop-blur-sm border border-gothic-purple/30 rounded-[32px] shadow-[0_30px_80px_rgba(0,0,0,0.55)] px-6 py-12 md:px-10 md:py-16 text-center">
                        <div class="mx-auto max-w-2xl">
                            <div class="inline-flex items-center justify-center gap-3 rounded-full border border-gothic-purple/30 bg-gothic-black/40 px-4 py-2 mb-8">
                                <div class="w-10 h-10 bg-gradient-to-br from-gothic-blood to-gothic-purple rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-accent-gold" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-white font-gothic-title">
                                    Tutorías IA
                                </h1>
                            </div>
                            <p class="text-lg md:text-xl text-gray-200 mb-10 leading-relaxed font-medium">
                                Plataforma de tutorías potenciada por IA. Aprende al tu propio ritmo con tutores expertos y tecnología inteligente.
                            </p>
                            <div class="flex flex-col items-center gap-4">
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="w-[200px] max-w-[220px] px-6 py-3 bg-gradient-to-r from-gothic-blood to-gothic-purple hover:from-gothic-purple hover:to-gothic-crimson text-white text-base font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5 border border-accent-gold/50 inline-flex items-center justify-center">
                                        Comenzar Ahora
                                    </a>
                                @endif
                                <a href="#features" class="w-[200px] max-w-[220px] px-6 py-3 border-2 border-accent-gold text-accent-gold hover:bg-accent-gold/10 text-base font-semibold rounded-xl transition-all duration-200 hover:border-accent-gold hover:text-white inline-flex items-center justify-center">
                                    Saber Más
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Features Section -->
            <section id="features" class="bg-gothic-dark/50 backdrop-blur-sm border-t border-gothic-purple/30 py-16 px-4">
                <div class="max-w-4xl mx-auto">
                    <h3 class="text-3xl font-bold text-center mb-12 text-accent-gold font-gothic-title">Características</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-gothic-dark/90 rounded-2xl p-6 shadow-md border border-gothic-purple/20 hover:shadow-xl hover:border-accent-gold/40 hover:-translate-y-1 transition-all duration-300">
                            <div class="w-12 h-12 bg-gradient-to-br from-gothic-blood to-gothic-purple rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold mb-2 text-white font-gothic">Cursos Variados</h4>
                            <p class="text-gray-300 font-medium">Acceso a múltiples disciplinas y niveles de aprendizaje.</p>
                        </div>
                        <div class="bg-gothic-dark/90 rounded-2xl p-6 shadow-md border border-gothic-purple/20 hover:shadow-xl hover:border-accent-gold/40 hover:-translate-y-1 transition-all duration-300">
                            <div class="w-12 h-12 bg-gradient-to-br from-gothic-purple to-gothic-deepPurple rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold mb-2 text-white font-gothic">IA Inteligente</h4>
                            <p class="text-gray-300 font-medium">Tecnología avanzada para personalizar tu experiencia.</p>
                        </div>
                        <div class="bg-gothic-dark/90 rounded-2xl p-6 shadow-md border border-gothic-purple/20 hover:shadow-xl hover:border-accent-gold/40 hover:-translate-y-1 transition-all duration-300">
                            <div class="w-12 h-12 bg-gradient-to-br from-gothic-crimson to-gothic-blood rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h-2m0 0h-2m2 0v-2m0 2v2m0-11a9 9 0 110 18 9 9 0 010-18z"/>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold mb-2 text-white font-gothic">Tutores Expertos</h4>
                            <p class="text-gray-300 font-medium">Aprende de profesionales certificados en la materia.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="bg-gothic-black border-t border-gothic-purple/30 py-8 px-4 mt-auto">
                <div class="max-w-4xl mx-auto text-center text-gray-300 text-sm font-medium">
                    <p>© 2026 Tutorías IA - Plataforma de Educación Inteligente. Todos los derechos reservados.</p>
                </div>
            </footer>
        </div>
    </body>
</html>

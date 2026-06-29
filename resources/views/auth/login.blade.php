<x-guest-layout>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Uncial+Antiqua&display=swap" rel="stylesheet">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-accent-gold font-bold text-xl font-gothic-title" />
            <x-text-input id="email" class="block mt-1 w-full bg-gothic-dark/50 border-accent-gold/30 text-white placeholder-gray-400 focus:border-accent-gold focus:ring-accent-gold" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-accent-gold font-bold text-xl font-gothic-title" />

            <x-text-input id="password" class="block mt-1 w-full bg-gothic-dark/50 border-accent-gold/30 text-white placeholder-gray-400 focus:border-accent-gold focus:ring-accent-gold"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-gothic-dark border-accent-gold/30 text-accent-gold shadow-sm focus:ring-accent-gold focus:ring-offset-gothic-dark" name="remember">
                <span class="ms-2 text-base text-white font-semibold">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-base text-accent-gold hover:text-gothic-blood hover:shadow-[0_0_10px_rgba(212,175,55,0.5)] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-gold focus:ring-offset-gothic-dark transition-all duration-300 font-bold font-gothic" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

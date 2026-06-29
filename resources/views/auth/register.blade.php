<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gothic-purple font-bold" />
            <x-text-input id="name" class="block mt-1 w-full bg-gothic-dark/50 border-gothic-purple/30 text-white placeholder-gray-400 focus:border-gothic-purple focus:ring-gothic-purple" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-gothic-purple font-bold" />
            <x-text-input id="email" class="block mt-1 w-full bg-gothic-dark/50 border-gothic-purple/30 text-white placeholder-gray-400 focus:border-gothic-purple focus:ring-gothic-purple" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gothic-purple font-bold" />

            <x-text-input id="password" class="block mt-1 w-full bg-gothic-dark/50 border-gothic-purple/30 text-white placeholder-gray-400 focus:border-gothic-purple focus:ring-gothic-purple"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gothic-purple font-bold" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gothic-dark/50 border-gothic-purple/30 text-white placeholder-gray-400 focus:border-gothic-purple focus:ring-gothic-purple"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <!-- Rol -->
<div class="mt-4">
    <x-input-label for="rol" :value="__('Tipo de Usuario')" class="text-gothic-purple font-bold" />
    <select id="rol" name="rol" 
    class="block mt-1 w-full bg-gothic-dark/50 border-gothic-purple/30 text-white rounded-md shadow-sm focus:border-gothic-purple focus:ring-gothic-purple">
    <option value="estudiante">Estudiante</option>
    <option value="tutor">Tutor</option>
</select>
    <x-input-error :messages="$errors->get('rol')" class="mt-2" />
</div>

<!-- Carrera -->
<div class="mt-4">
    <x-input-label for="carrera" :value="__('Carrera o Especialidad')" class="text-gothic-purple font-bold" />
    <x-text-input id="carrera" class="block mt-1 w-full bg-gothic-dark/50 border-gothic-purple/30 text-white placeholder-gray-400 focus:border-gothic-purple focus:ring-gothic-purple" 
        type="text" name="carrera" 
        :value="old('carrera')" 
        placeholder="Ej: Sistemas Informáticos" />
    <x-input-error :messages="$errors->get('carrera')" class="mt-2" />
</div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-gothic-purple hover:text-gothic-crimson hover:shadow-[0_0_10px_rgba(74,14,78,0.5)] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gothic-purple focus:ring-offset-gothic-dark transition-all duration-300" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

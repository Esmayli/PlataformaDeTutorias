<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-8 py-3 bg-gothic-dark/90 border-2 border-gothic-purple/50 rounded-xl font-bold text-sm text-gothic-purple uppercase tracking-widest shadow-[0_0_20px_rgba(74,14,78,0.3)] hover:bg-gothic-purple/10 hover:shadow-[0_0_30px_rgba(74,14,78,0.5)] focus:outline-none focus:ring-2 focus:ring-gothic-purple focus:ring-offset-2 focus:ring-offset-gothic-dark disabled:opacity-25 transition ease-in-out duration-300 transform hover:-translate-y-0.5 hover:scale-105']) }}>
    {{ $slot }}
</button>

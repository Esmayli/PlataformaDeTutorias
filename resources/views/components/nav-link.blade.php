@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 pt-1 border-b-2 border-accent-gold text-sm font-bold leading-5 text-accent-gold focus:outline-none focus:border-accent-gold transition duration-300 ease-in-out shadow-[0_0_10px_rgba(212,175,55,0.3)]'
            : 'inline-flex items-center px-4 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-400 hover:text-accent-gold hover:border-accent-gold/50 focus:outline-none focus:text-accent-gold focus:border-accent-gold/50 transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

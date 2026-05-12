@props(['variant' => 'primary'])

@php
    $variants = [
        'primary' => 'bg-gradient-to-tr from-cyber-purple-500 to-indigo-600 text-white shadow-lg shadow-cyber-purple-500/20 hover:shadow-cyber-purple-500/40 hover:-translate-y-0.5',
        'secondary' => 'bg-white text-cyber-purple-600 border-2 border-cyber-purple-100 hover:border-cyber-purple-200 hover:bg-cyber-purple-50',
        'outline' => 'bg-transparent text-gray-700 border-2 border-gray-200 hover:border-cyber-purple-200 hover:text-cyber-purple-600',
    ];
    $variantClass = $variants[$variant] ?? $variants['primary'];
@endphp

<button {{ $attributes->merge(['class' => "px-8 py-4 rounded-2xl font-bold transition-all duration-300 active:scale-95 " . $variantClass]) }}>
    {{ $slot }}
</button>

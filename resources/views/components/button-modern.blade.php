@props(['variant' => 'primary'])

@php
    $variants = [
        'primary'   => 'bg-uni-gold-400 text-uni-purple-950 shadow-md shadow-uni-gold-400/20 hover:bg-uni-gold-300 hover:shadow-lg hover:shadow-uni-gold-400/30 hover:-translate-y-0.5 focus-visible:ring-uni-gold-500',
        'secondary' => 'bg-uni-purple-800 text-white hover:bg-uni-purple-700 hover:-translate-y-0.5 focus-visible:ring-uni-purple-500',
        'outline'   => 'bg-transparent text-uni-purple-800 border-2 border-uni-purple-200 hover:border-uni-purple-400 hover:bg-uni-purple-50 focus-visible:ring-uni-purple-400',
    ];
    $variantClass = $variants[$variant] ?? $variants['primary'];
@endphp

<button {{ $attributes->merge(['class' => "inline-flex items-center justify-center gap-2 px-7 py-3.5 min-h-[44px] rounded-xl font-semibold text-sm transition-[transform,background-color,border-color,color,box-shadow] duration-150 ease-out-strong active:translate-y-0 active:scale-[0.97] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none " . $variantClass]) }}>
    {{ $slot }}
</button>
